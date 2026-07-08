let btn = document.querySelector('.close-popup');
let popup = document.querySelector('.popup-container');

if (btn && popup) {
    btn.addEventListener("click", (e) => {
        e.preventDefault();  
        e.stopPropagation(); 
        
        popup.classList.add('close');
        console.log('Popup səssizcə bağlandı, link işə düşmədi.');
    });
}