const header = document.querySelector("header");

const STICKY_AT = 10;

window.addEventListener("scroll", () => {
  if (window.scrollY > STICKY_AT) {
    header.classList.add("is-sticky");
  } else {
    header.classList.remove("is-sticky");
  }
});
