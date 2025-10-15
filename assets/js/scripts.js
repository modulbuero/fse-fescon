(($) => {
	$(document).ready(()=>{
        leistungenSwiper()
    })

    function leistungenSwiper(index='.leistungen-slider', spv=1){
        setTimeout(function(){ // Timeout im Parent weil Swiper.JS nach Script.JS geladen wird.

            

            if($(index).length){
                console.log(index)
                let slideNames = ['Set', 'Grow', 'Scale']; // beliebige Labels
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
                    
                    
                    // if window width is bigger than
                    
                }
        
                let standSwiper = new Swiper(index, cSwiperParams);

                // Klick auf eigene Pagination Bugfix Touch Navigataion
                document.querySelectorAll('.swiper-pagination-bullet').forEach(bullet => {
                    bullet.addEventListener('click', function () {
                        const index = parseInt(this.dataset.slide, 10);
                        standSwiper.slideToLoop(index);
                    });
                });

                // Funktion zur Aktualisierung
                function updateCustomPagination(standSwiper) {
                    document.querySelectorAll('.swiper-pagination-bullet').forEach((bullet, i) => {
                        bullet.classList.toggle('active', i === standSwiper.realIndex);
                        console.log("TochSlideIndex " + standSwiper.realIndex)
                    });
                }
            }
        }, 1000)
            
    }

})(jQuery)