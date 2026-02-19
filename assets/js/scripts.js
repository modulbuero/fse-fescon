(($) => {
	$(document).ready(()=>{
        detectScrollPosition()
        leistungenSwiper()
        refSlider()
        webinarSlider()
        contactInfo()
        openFirstDetailRef()
        setTimeout(abstandLinks, 300)

        $(document).on('nfFormReady', function() {
            contactFormLabel(); 
            ninjaFormSubmit()
        });

        if(window.innerWidth <= 601){
            // Unter einen anderen Container setzen
            $('.wp-block-image.alignfull.size-full.only-mobile').insertBefore('.contact-cover');   
        }
    })

    /**
     * Custom Swiper with String Pagination
     * 
     * @param {*} index 'Selector'
     * @param {*} spv 'SlidesÜerView'
     */
    function leistungenSwiper(index='.leistungen-slider', spv=1){
        if($(index).length){
            let slideNames = ['Set', 'Grow', 'Lead', 'Elevate'];
            let slidesPerView = spv;
    
            let cSwiperParams ={
                loop: false,
                navigation: {
                    nextEl: index + ' .swiper-button-next',
                    prevEl: index + ' .swiper-button-prev',
                },
                pagination: {
                    el: index + ' .swiper-pagination',
                    clickable: true,
                    renderBullet: function (i, className) {
                        return '<span class="fescon-bulletpoints '+ className+' ">'+ slideNames[i] + '</span>';
                    },
                    clickable: true,
                },
                
                slidesPerView: slidesPerView,
                effect: "slide",
            }
    
            let standSwiper = new Swiper(index, cSwiperParams);
            disableSwipeDrag(standSwiper);

            // Klick auf eigene Pagination Bugfix Touch Navigataion
            document.querySelectorAll('.swiper-pagination-bullet').forEach(bullet => {
                bullet.addEventListener('click', function () {
                    const index = parseInt(this.dataset.slide, 10);
                    standSwiper.slideToLoop(index);
                });
            });

            //Animation des Menüs
            $(index + ' .swiper-pagination').before('<div class="slider" id="slider"></div>');
            $(index + ' .swiper-pagination, '+ index + ' #slider').wrapAll('<div class="menu-container"></div>');

            const $menu      = $(index + ' .swiper-pagination');
            const $slider    = $(index + ' #slider');
            const $menuItems = $menu.find('span');
            const $prevBtn   = $(index + ' .swiper-button-prev');
            const $nextBtn   = $(index + ' .swiper-button-next');
            let activeClass  = 'swiper-pagination-bullet-active';
            let currentIndex = 0;
            let disableBTN   = 'swiper-button-disabled'

            // Slider-Position setzen
            function setSliderPosition($el) {
                const rect = $el[0].getBoundingClientRect();
                const menuRect = $menu[0].getBoundingClientRect();

                $slider.css({
                    width: rect.width + 'px',
                    left: 13 + $el.position().left + 'px'
                });
            }

            // Aktiven Menüpunkt setzen
            function setActiveItem(i) {
                
                console.log($menuItems.eq(i).addClass(activeClass))
                $menuItems.removeClass(activeClass)                
                setTimeout(function(){$menuItems.eq(i).addClass(activeClass)}, 300)
                setSliderPosition($menuItems.eq(i));
                updateButtonStates();
            }

            // Button States aktualisieren
            function updateButtonStates() {
                setTimeout(function(){
                    if(currentIndex === 0){
                        $prevBtn.prop('disabled', true).addClass(disableBTN);
                    }else{
                        $prevBtn.prop('disabled', false).removeClass(disableBTN);
                    }
                    if(currentIndex === ($menuItems.length - 1)){
                        $nextBtn.prop('disabled', true).addClass(disableBTN);
                    }else{
                        $nextBtn.prop('disabled', false).removeClass(disableBTN);
                    }
                }, 300)

                console.log(currentIndex)
            }

            // Initiale Position setzen
            const $activeItem = $menu.find('.'+activeClass);
            if ($activeItem.length) {
                setSliderPosition($activeItem);
            }
            updateButtonStates();

            // Hover-Effekte
            $menuItems.on('mouseenter', function () {
                setSliderPosition($(this));
            });

            // Zurück zur aktiven Position
            $('.menu-container').on('mouseleave', function () {
                
                let $active = $menu.find('.'+activeClass);
                
                if ($active.length) {
                    
                    setSliderPosition($active);
                }
            });

            // Click Handler
            $menuItems.each(function (index) {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    currentIndex = index;
                    setActiveItem(currentIndex);
                });
            });

            // Prev Button
            $prevBtn.on('click', function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    setActiveItem(currentIndex);
                }
            });

            // Next Button
            $nextBtn.on('click', function () {
                if (currentIndex < $menuItems.length - 1) {
                    currentIndex++;
                    setActiveItem(currentIndex);
                }
            });

            
        }
    }

    /**
     * CustomSwiper with outofthebox Navigation
     */
    function webinarSlider() {
        // default webinar slider
        let webinarNon = new Swiper('.swiper.webinar-slider:not(.fescon-webinar)', {
            slidesPerGroup: 1,
            navigation: {
            nextEl: '.webinar-arrows .custom-next',
            prevEl: '.webinar-arrows .custom-prev',
            },

            // mobile
            slidesPerView: 1,
            spaceBetween: 16,
            allowTouchMove: false,
            simulateTouch: false,
            // bigger screens
            breakpoints: {
            550: { slidesPerView: 1.5, spaceBetween: 20 },
            }
        });

        // fescon-webinar variant
        let webinarS = new Swiper('.swiper.webinar-slider.fescon-webinar', {
            slidesPerGroup: 1,
            navigation: {
            nextEl: '.webinar-arrows .custom-next',
            prevEl: '.webinar-arrows .custom-prev',
            },
            allowTouchMove: false,
            simulateTouch: false,
            /// mobile
            slidesPerView: 1,
            spaceBetween: 16,
            
            breakpoints: {
            550: { slidesPerView: 2.5, spaceBetween: 20 },
            }
        });

        disableSwipeDrag(webinarNon);
        disableSwipeDrag(webinarS);
        
        if(window.innerWidth <= 601){
            // Unter einen anderen Container setzen
            $('.webinar-arrows').insertAfter('.webinars-wrapper');   
        }

        setTimeout(function(){
            $('.query-loop-termine .webinar-slider').addClass('addtransition')
        },1000)
    }

    function refSlider() {
       let refS = new Swiper('.referenz-slider', {
            loop: true,
            slidesPerGroup: 1,
            navigation: {
                nextEl: '.referenz-arrows .custom-next',
                prevEl: '.referenz-arrows .custom-prev',
            },
            slidesPerView: 1,
            spaceBetween: 20,
           
            
            breakpoints: {
                602: { 
                    slidesPerView: 2,
                    allowTouchMove: false,
                    touchRatio: 0
                },
                1120: { 
                    slidesPerView: 3,
                    allowTouchMove: false,
                    touchRatio: 0
                }
            }
        });


        disableSwipeDrag(refS);
        
        if(window.innerWidth <= 601){
            // Unter einen anderen Container setzen
            $('.referenz-arrows').insertAfter('.refrences-wrapper .wp-block-query');   
        }
    }   


    function detectScrollPosition(){
        let targetScroll = window.innerHeight * 0.7;
        if(window.innerWidth <= 650){
            targetScroll = window.innerHeight * 0.1;
        }

        let hasReached = false;
        if($('body.home').length){
            $('.home header').addClass('isSpecialHeader')
            $(window).on('scroll', function() {
                const scrollPosition = $(window).scrollTop();
                if (scrollPosition >= targetScroll && !hasReached) {
                    hasReached = true;
                    $('header').removeClass('isSpecialHeader')
                }
                
                if (scrollPosition < targetScroll && hasReached) {
                    hasReached = false;
                    $('header').addClass('isSpecialHeader')
                }
            });    
        }
    }

    /*Kontakt-Formular Label-Activation*/
    function contactFormLabel(){
        let labelWrap = 'form ';
        let input     = labelWrap + '.nf-field-element input';
        let textarea  = labelWrap + '.nf-field-element textarea';
        let fields    = input + ", " + textarea;
        
        function checkInputField() {
            $(fields).each(function(){
                if($(this).val() == ""){
                    $(this).parents(':eq(1)').removeClass('focus-input');
                }
            })
        }

        $(fields).on('focus click', function(){
            checkInputField();
        })

        $(fields).on('focus click', function(){
            $(this).parents(':eq(1)').addClass('focus-input');
        })

        $(fields).on('focusout', function(){
            checkInputField()
        })
    }

    function abstandLinks(){
        let marginLeft = parseInt($("header > .parts-header > .wp-block-group").css('marginLeft'));
        let paddingLeft = parseInt($("header > .parts-header").css('paddingLeft'));
        let abstandLeft = marginLeft + paddingLeft
        //Abstand für Hero-Slider
        $('.webinar-slider-container, .webinar-simple-wrap, .blog .webinar-slider-wrapper').css('paddingLeft',abstandLeft + 'px')	
    }

    function contactInfo(){
        let kontaktieren = '.contac-info-wrapper .contact'
        $(kontaktieren).on('click', function () {
            $(this).closest('.contac-info-wrapper').toggleClass('open-info');
        });
    }

    function disableSwipeDrag(swiperInstance) {
        if(!swiperInstance || !swiperInstance.wrapperEl) {
            return;
        }
        if($(window).width() <= 601){
            //return;
        }
        //'touchstart', 'touchmove', 'touchend',
        const events = ['mousedown', 'mousemove', 'mouseup',  'pointerdown', 'pointermove', 'pointerup'];
        
        events.forEach(eventType => {
            swiperInstance.wrapperEl.addEventListener(eventType, (e) => {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            }, { capture: true, passive: false });
        });
    }

    function ninjaFormSubmit(){
        $(document).on('nfFormSubmitResponse', function(event, response) {
            // Klasse zum Body hinzufügen
            $('body').addClass('ninja-form-submitted');
        });
    }

    function openFirstDetailRef(){
        if($('.single-referenzen-html').length){
            $('.entry-content > .wp-block-details:nth-child(2) summary').click()
        }
    }
})(jQuery)
