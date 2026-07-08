document.addEventListener('DOMContentLoaded', () => {
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const collapseEl = item.querySelector('.accordion-collapse');
        const buttonEl = item.querySelector('.accordion-button');
        
        if (!collapseEl) return;

        const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });

        item.addEventListener('mouseenter', () => {
            bsCollapse.show(); 
            buttonEl.classList.remove('collapsed');
            buttonEl.setAttribute('aria-expanded', 'true');
        });

        item.addEventListener('mouseleave', () => {
            bsCollapse.hide(); 
            buttonEl.classList.add('collapsed');
            buttonEl.setAttribute('aria-expanded', 'false');
        });
    });
});