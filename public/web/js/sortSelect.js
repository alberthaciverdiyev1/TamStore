document.addEventListener("DOMContentLoaded", function() {
    const sortContainer = document.getElementById("customSort");
    const trigger = document.getElementById("sortTrigger");
    const optionsMenu = document.getElementById("sortOptions");
    const options = document.querySelectorAll(".sort-option");
    const hiddenInput = document.getElementById("sortHiddenInput");
    const selectedText = document.getElementById("sortSelectedText");

    trigger.addEventListener("click", function(e) {
        e.stopPropagation(); 
        sortContainer.classList.toggle("open");
        optionsMenu.classList.toggle("show");
    });

    options.forEach(option => {
        option.addEventListener("click", function(e) {
            e.stopPropagation();
            
            options.forEach(opt => opt.classList.remove("hidden-option"));
            
            this.classList.add("hidden-option");

            selectedText.textContent = this.textContent;
            hiddenInput.value = this.getAttribute("data-value");

            sortContainer.classList.remove("open");
            optionsMenu.classList.remove("show");
        });
    });

    document.addEventListener("click", function(e) {
        if (!sortContainer.contains(e.target)) {
            sortContainer.classList.remove("open");
            optionsMenu.classList.remove("show");
        }
    });
});