document.addEventListener("DOMContentLoaded", () => {
    let closeBtns = document.querySelectorAll('.close-popup');
    let popup = document.querySelector('.popup-container');
    let htmlEl = document.documentElement;
    let bodyEl = document.body;

    if (!popup) return;

    const closePopupAction = () => {
        popup.classList.add('close');

        htmlEl.classList.remove('no-scroll');
        bodyEl.classList.remove('no-scroll');

        sessionStorage.setItem('popupClosed', 'true');
    };

    if (sessionStorage.getItem('popupClosed') !== 'true') {
        popup.classList.remove('close');

        // Popup açıqdırsa scroll-u dondur
        htmlEl.classList.add('no-scroll');
        bodyEl.classList.add('no-scroll');
    }

    popup.addEventListener("click", (e) => {
        if (e.target === popup) {
            e.preventDefault();
        }
    });

    if (closeBtns.length > 0) {
        closeBtns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                closePopupAction();
            });
        });
    }
});
