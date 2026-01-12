(($) => {
	$(document).ready(()=>{
        detectScrollPosition()
        leistungenSwiper()
        refSlider()
        webinarSlider()
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
                allowTouchMove: false,

                slidesPerView: slidesPerView,
                effect: "slide",
            }
    
            let standSwiper = new Swiper(index, cSwiperParams);

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
            let activeAdding = 'active';

            let currentIndex = 0;

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
                $menuItems.removeClass(activeClass).removeClass('active');
                $menuItems.eq(i).addClass(activeClass).addClass('active');

                setSliderPosition($menuItems.eq(i));
                updateButtonStates();
            }

            // Button States aktualisieren
            function updateButtonStates() {
                $prevBtn.prop('disabled', currentIndex === 0);
                $nextBtn.prop('disabled', currentIndex === $menuItems.length - 1);
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
            $menu.on('mouseleave', function () {
                const $active = $menu.find('.'+activeClass);
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
        new Swiper('.swiper.webinar-slider:not(.fescon-webinar)', {
            slidesPerGroup: 1,
            navigation: {
            nextEl: '.webinar-arrows .custom-next',
            prevEl: '.webinar-arrows .custom-prev',
            },

            // mobile
            slidesPerView: 1,
            spaceBetween: 16,
            allowTouchMove: false,
            // bigger screens
            breakpoints: {
            550: { slidesPerView: 1.5, spaceBetween: 20 },
            }
        });

        // fescon-webinar variant
        new Swiper('.swiper.webinar-slider.fescon-webinar', {
            slidesPerGroup: 1,
            navigation: {
            nextEl: '.webinar-arrows .custom-next',
            prevEl: '.webinar-arrows .custom-prev',
            },
            allowTouchMove: false,
            // mobile
            slidesPerView: 1,
            spaceBetween: 16,

            // ✅ bigger screens
            breakpoints: {
            550: { slidesPerView: 2.5, spaceBetween: 20 },
            }
        });

    }

    function refSlider() {
        new Swiper('.referenz-slider', {
            loop: true,
            slidesPerGroup: 1,
            navigation: {
            nextEl: '.referenz-arrows .custom-next',
            prevEl: '.referenz-arrows .custom-prev',
            },

            // responsive
            slidesPerView: 1,
            spaceBetween: 20,

            breakpoints: {
                602: {          // Tablet breakpoint
                    slidesPerView: 2,
                },
                961: {          // Desktop breakpoint
                    slidesPerView: 3,
                }
            }
        });
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
})(jQuery)
