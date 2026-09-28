window.addEventListener("DOMContentLoaded", (event) => {

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

var scrollHint = document.getElementById("scroll-hint");
var scrollHintActive = true;

window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 10) {
        scrollHint.classList.add("opacity-0!", "-bottom-8!");
        scrollHintActive = false;
    } else if (document.documentElement.scrollTop <= 10) {
        scrollHint.classList.remove("opacity-0!", "-bottom-8!");
        scrollHintActive = true;
    }
});