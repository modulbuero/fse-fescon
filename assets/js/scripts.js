(($) => {
	$(document).ready(()=>{
        leistungenSwiper()

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
            console.log(index)
            let slideNames = ['Set', 'Grow', 'Lead', 'Elevate'];
            let slidesPerView = spv;
    
            let cSwiperParams ={
                loop: true,
                keyboard: {
                    enabled: true,
                },
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
        }
    }

    /**
     * CustomSwiper with outofthebox Navigation
     */
    function webinarSlider(){
        new Swiper('.webinar-slider', {
            navigation: {
                nextEl: '.custom-next',
                prevEl: '.custom-prev',
            },
        });
    }

})(jQuery)