const visibleNumber = document.getElementById('number-visible');
const hiddenNumber = document.getElementById('number-hidden');
const mainThumbsItems = document.querySelectorAll('.thumbs-img');
const modalThumbsSlides = document.querySelectorAll(".thumbSwiper .swiper-slide");
const modalElement = document.getElementById("exampleModal");
const overlay = document.getElementsByClassName('overlay');

let mainSwiper;
let modalSwiper;
let modalThumbsSwiper;
let mainThumbsSwiper;

function updateMainThumbsActiveClass(activeIndex) {
    mainThumbsItems.forEach(thumb => thumb.classList.remove("active"));
    if (mainThumbsItems[activeIndex]) {
        mainThumbsItems[activeIndex].classList.add("active");
    }
}

function updateModalThumbsActiveClass(activeIndex) {
    modalThumbsSlides.forEach(slide => slide.classList.remove("active"));
    if (modalThumbsSlides[activeIndex]) {
        modalThumbsSlides[activeIndex].classList.add("active");
    }
}

if (hiddenNumber) {
    hiddenNumber.addEventListener('click', () => {
        hiddenNumber.style.display = 'none';
        if (visibleNumber) {
            visibleNumber.style.display = 'flex';
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {

    const bootstrapModal = new bootstrap.Modal(document.getElementById('exampleModal'));


    mainSwiper = new Swiper("#mainSwiper", {
        slidesPerView: 1,
        loop: true,
        preventClicksPropagation: false,
        navigation: {
            nextEl: "#mainSwiper .swiper-button-next",
            prevEl: "#mainSwiper .swiper-button-prev",
        },
        pagination: {
            el: ".pagination div",
            type: "fraction",
        },
        on: {
            slideChange: function () {
                if (modalSwiper) {
                    modalSwiper.slideTo(this.realIndex);
                }
                updateMainThumbsActiveClass(this.realIndex);
            },
            click: function (swiper, e) {
                const clickedIndex = swiper.realIndex;
                modalSwiper.slideTo(clickedIndex);
                updateModalThumbsActiveClass(clickedIndex);
                bootstrapModal.show();
            },
        },
    });

    modalSwiper = new Swiper("#modalSwiper", {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: "#modalSwiper .swiper-button-next",
            prevEl: "#modalSwiper .swiper-button-prev",
        },
        pagination: {
            el: "#modalSwiper .swiper-pagination",
            clickable: true,
        },
        on: {
            slideChange: function () {
                updateModalThumbsActiveClass(this.activeIndex);
            },
        },
    });

    modalThumbsSwiper = new Swiper(".thumbSwiper", {
        spaceBetween: 5,
        slidesPerView: 3,
        loop: true,
        breakpoints: {
            360: {
                slidesPerView: 4,
            },
            480: {
                slidesPerView: 6,
            },
            768: {
                slidesPerView: 7,
            },
            1024: {
                slidesPerView: 8,
            },
            1200: {
                slidesPerView: 10,
            },
            1400: {
                slidesPerView: 12,
            }
        },
        freeMode: true,
        pagination: {
        },
    });

    mainThumbsSwiper = new Swiper(".mainThumbsSwiper", {
        slidesPerView: 6,
        spaceBetween: 12,
        freeMode: true,
        loop: false,
        allowTouchMove: false,

        on: {
            init: function () {
                if (this.slides.length >= 6) {
                    [...overlay].forEach(el => {
                        el.style.display = 'flex';
                    });
                }
            }
        }
    });

    modalThumbsSlides.forEach((slide, index) => {
        slide.addEventListener("mouseenter", function () {
            modalSwiper.slideTo(index);
            updateModalThumbsActiveClass(index);
        });
    });

    modalElement?.addEventListener("shown.bs.modal", function () {
        if (modalSwiper && mainSwiper) {
            modalSwiper.slideTo(mainSwiper.realIndex);
            modalSwiper.update();
            updateModalThumbsActiveClass(mainSwiper.realIndex);
        }
    });

    mainSwiper.on("slideChange", function () {
        const currentIndex = mainSwiper.realIndex;
        updateMainThumbsActiveClass(currentIndex);
    });

    mainThumbsItems.forEach((thumb, index) => {
        thumb.addEventListener("mouseenter", function () {
            mainSwiper.slideTo(index);
        });
    });

    modalSwiper.on("slideChange", function () {
        const currentIndex = modalSwiper.activeIndex;
        updateModalThumbsActiveClass(currentIndex);
    });

    updateMainThumbsActiveClass(mainSwiper.realIndex);
    updateModalThumbsActiveClass(modalSwiper.activeIndex);


    modalThumbsSlides.forEach((slide, index) => {
        slide.addEventListener("mouseenter", function () {
            const slidesPerView = Math.floor(modalThumbsSwiper.params.slidesPerView);
            const offsetIndex = Math.max(0, index - Math.floor(slidesPerView / 2));
            modalThumbsSwiper.slideTo(offsetIndex, 300);
        });
    });

    modalSwiper.on("slideChange", function () {
        const activeIndex = modalSwiper.realIndex;
        const slidesPerView = Math.floor(modalThumbsSwiper.params.slidesPerView);
        const offsetIndex = Math.max(0, activeIndex - Math.floor(slidesPerView / 2));

        modalThumbsSwiper.slideTo(offsetIndex, 300);
    });

    mainSwiper.on("slideChange", function () {
        const realIndex = mainSwiper.realIndex;
        updateMainThumbsActiveClass(realIndex);
    });

    mainThumbsItems.forEach((thumb, index) => {
        thumb.addEventListener("mouseenter", function () {
            mainSwiper.slideToLoop(index, 300);
        });
    });

});