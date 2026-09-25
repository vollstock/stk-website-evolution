addEventListener("DOMContentLoaded", (event) => {

    const swiper = new Swiper('#blog-swiper', {
        slidesPerView: 1.125,
        spaceBetween: 24,
        grabCursor: true,
        lazy: true,
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
            type: 'bullets'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 1.75,
            },
            1024: {
                slidesPerView: 2.5,
            }
        },
        keyboard: true,
        scrollbar: false,
        // {
        //     el: '.swiper-scrollbar',
        //     draggable: true
        // },
        a11y: true
    });


});