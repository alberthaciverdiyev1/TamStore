new Swiper(".categoriesSwiper", {
    slidesPerView: 6,
    spaceBetween: 22,
    speed: 500,
    loop: false,
    navigation: {
        nextEl: ".c-btn-next",
        prevEl: ".c-btn-prew",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 14 },
        360: { slidesPerView: 1.1, spaceBetween: 22 },
        480: { slidesPerView: 1.5, spaceBetween: 22 },
        520: { slidesPerView: 1.9, spaceBetween: 16 },
        768: { slidesPerView: 2.5, spaceBetween: 16 },
        900: { slidesPerView: 3.2, spaceBetween: 18 },
        1024: { slidesPerView: 3.5, spaceBetween: 18 },
        1200: { slidesPerView: 4, spaceBetween: 22 },
        1400: { slidesPerView: 4.5, spaceBetween: 22 },
    },
});

new Swiper(".blogsSwiper", {
    slidesPerView: 6,
    spaceBetween: 22,
    speed: 500,
    loop: false,
    navigation: {
        nextEl: ".b-btn-next",
        prevEl: ".b-btn-prew",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 14 },
        360: { slidesPerView: 1.1, spaceBetween: 22 },
        480: { slidesPerView: 1.5, spaceBetween: 22 },
        520: { slidesPerView: 1.9, spaceBetween: 16 },
        768: { slidesPerView: 2.5, spaceBetween: 16 },
        900: { slidesPerView: 3.2, spaceBetween: 18 },
        1024: { slidesPerView: 3.5, spaceBetween: 18 },
        1200: { slidesPerView: 4, spaceBetween: 22 },
        1400: { slidesPerView: 4.5, spaceBetween: 22 },
    },
});

new Swiper(".productsSwiper", {
    slidesPerView: 6,
    spaceBetween: 22,
    speed: 500,
    loop: false,
    navigation: {
        nextEl: ".p-btn-next",
        prevEl: ".p-btn-prew",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 14 },
        360: { slidesPerView: 1.1, spaceBetween: 22 },
        480: { slidesPerView: 1.5, spaceBetween: 22 },
        520: { slidesPerView: 1.9, spaceBetween: 16 },
        768: { slidesPerView: 2.5, spaceBetween: 16 },
        900: { slidesPerView: 3.2, spaceBetween: 18 },
        1024: { slidesPerView: 3.5, spaceBetween: 18 },
        1200: { slidesPerView: 4, spaceBetween: 22 },
        1400: { slidesPerView: 4.5, spaceBetween: 22 },
    },
});

var swiper = new Swiper(".heroSwiper", {
    slidesPerView: 1,
    loop: true,
    speed: 500,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
});