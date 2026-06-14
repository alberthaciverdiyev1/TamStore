document.addEventListener("DOMContentLoaded", function() {
    const sliderMin = document.getElementById("slider-min");
    const sliderMax = document.getElementById("slider-max");
    const displayMin = document.getElementById("display-min");
    const displayMax = document.getElementById("display-max");
    const inputMinPrice = document.getElementById("input-min-price");
    const inputMaxPrice = document.getElementById("input-max-price");
    const sliderTrack = document.getElementById("slider-track");

    const minGap = 10; // İki düymə arasındakı minimum fərq (məsələn 10 manat)
    const maxValue = sliderMin.max;

    function updateSlider() {
        let valMin = parseInt(sliderMin.value);
        let valMax = parseInt(sliderMax.value);

        // Bir düymənin digərini keçməsinin qarşısını alırıq
        if (valMax - valMin <= minGap) {
            if (this.id === "slider-min") {
                sliderMin.value = valMax - minGap;
                valMin = sliderMin.value;
            } else {
                sliderMax.value = valMin + minGap;
                valMax = sliderMax.value;
            }
        }

        // 1. Görünən textləri yeniləyirik
        displayMin.textContent = valMin + " ₼";
        displayMax.textContent = valMax + " ₼";

        // 2. Backend üçün GİZLİ inputları yeniləyirik!
        inputMinPrice.value = valMin;
        inputMaxPrice.value = valMax;

        // 3. Qırmızı xəttin vizual uzunluğunu və yerini tənzimləyirik
        let percent1 = (valMin / maxValue) * 100;
        let percent2 = (valMax / maxValue) * 100;
        
        sliderTrack.style.left = percent1 + "%";
        sliderTrack.style.width = (percent2 - percent1) + "%";
    }

    sliderMin.addEventListener("input", updateSlider);
    sliderMax.addEventListener("input", updateSlider);

    // Səhifə açılanda xəttin düzgün görünməsi üçün funksiyanı bir dəfə işə salırıq
    updateSlider.call(sliderMin);
});