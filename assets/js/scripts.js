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
                loop: true,
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
            const $menu     = $(index + ' .swiper-pagination');
            const $slider   = $(index + ' #slider');
            const $menuItems = $menu.find('span');
            let activeClass  = 'swiper-pagination-bullet-active';
            let activeAdding = 'active';

            function setSliderPosition($el) {
                const rect = $el[0].getBoundingClientRect();
                const menuRect = $menu[0].getBoundingClientRect();
                $slider.css({
                    width: rect.width + 'px',
                    left: $el.position().left + 'px'
                });
            }

            const $activeItem = $menu.find('.' + activeAdding);
            setSliderPosition($activeItem);

            // Hover
            $menuItems.on('mouseenter', function () {
                setSliderPosition($(this));
            });

            // Zurück zur aktiven Position
            $menu.on('mouseleave', function () {
                setSliderPosition($menu.find('.' + activeAdding));
            });

            // Click Handler
            $menuItems.each(function () {
                const $item = $(this);
                $item.find('a').on('click', function (e) {
                    e.preventDefault();

                    $menuItems.removeClass(activeAdding).find('span').removeClass(activeClass);

                    $item.addClass(activeAdding);
                    $(this).addClass(activeClass);

                    setSliderPosition($item);
                });
            });

        }
    }

    /**
     * CustomSwiper with outofthebox Navigation
     */
    function webinarSlider(){
        new Swiper('.swiper.webinar-slider', {
            slidesPerView: 1.5,
            spaceBetween: 20,
            
            slidesPerGroup: 1,
  
            navigation: {
                nextEl: '.webinar-arrows .custom-next',
                prevEl: '.webinar-arrows .custom-prev',
            },
        })
    }

    function refSlider(){
        new Swiper('.referenz-slider',{
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            slidesPerGroup: 1,
  
            navigation: {
                nextEl: '.referenz-arrows .custom-next',
                prevEl: '.referenz-arrows .custom-prev',
            },
        })
    }

    function detectScrollPosition(){
        const targetScroll = window.innerHeight * 0.9;
        let hasReached = false;
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
})(jQuery)
