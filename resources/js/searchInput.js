const searchBox = document.getElementById("searchBox");
const input = searchBox.querySelector(".search-input");

searchBox.addEventListener("click", (e) => {
  e.stopPropagation();

  // artıq açıqdırsa, kliklə bağlama
  if (!searchBox.classList.contains("is-open")) {
    searchBox.classList.add("is-open");
    input.focus();
  }
});

// inputa klik edəndə sən yenə də document click-ə düşməmək üçün
input.addEventListener("click", (e) => e.stopPropagation());

document.addEventListener("click", () => {
  searchBox.classList.remove("is-open");
});
