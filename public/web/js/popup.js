document.addEventListener("DOMContentLoaded", () => {
    let closeBtns = document.querySelectorAll('.close-popup');
    let popup = document.querySelector('.popup-container');
    let htmlEl = document.documentElement;
    let bodyEl = document.body;

    if (!popup) return;

    if (sessionStorage.getItem('popupClosed') !== 'true') {

        popup.classList.remove('close');

        htmlEl.classList.add('no-scroll');
        bodyEl.classList.add('no-scroll');
    }

    if (closeBtns.length > 0) {
        closeBtns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();

                popup.classList.add('close');

                htmlEl.classList.remove('no-scroll');
                bodyEl.classList.remove('no-scroll');

                sessionStorage.setItem('popupClosed', 'true');

                console.log('Popup uğurla bağlandı və yaddaşa yazıldı.');
            });
        });
    }
});
