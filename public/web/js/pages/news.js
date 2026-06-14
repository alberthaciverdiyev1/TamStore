document.addEventListener("DOMContentLoaded", () => {
    let currentCategory = "";
    let currentPage = 1;

    const categoryTabs = document.querySelectorAll('.category-tab, #tab-all');

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            document.querySelector('.nav-link.active')?.classList.remove('active');
            tab.classList.add('active');

            currentCategory = tab.getAttribute('data-category-id') || "";
            currentPage = 1;
            loadNews(currentCategory, currentPage);
        });
    });

    document.getElementById('news-pagination')?.addEventListener('click', (e) => {
        const pageItem = e.target.closest('.page-item');
        if (!pageItem || pageItem.classList.contains('active') || pageItem.classList.contains('dots') || pageItem.classList.contains('disabled')) return;

        const page = pageItem.dataset.page;
        if (!page) return;

        currentPage = parseInt(page);
        loadNews(currentCategory, currentPage);
    });

    loadNews(currentCategory, currentPage);
});

async function loadNews(categoryId = "", page = 1) {
    const container = document.querySelector("#news-cards");
    if (!container) return;

    container.style.opacity = "0.5";

    try {
        const data = await fetchNews(categoryId, page);
        renderNews(data.data || data, container);
        renderPagination(data);
    } catch (error) {
        console.error("Fetch Error:", error);
        container.innerHTML = "<p class='error-msg'>Unable to load news posts.</p>";
    } finally {
        container.style.opacity = "1";
    }
}

async function fetchNews(categoryId, page) {
    const params = new URLSearchParams();
    if (categoryId) params.set('category_id', categoryId);
    params.set('page', page);

    const url = `/news-json?${params.toString()}`;
    const response = await fetch(url);

    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

    return await response.json();
}

function renderNews(news, container) {
    if (!news || news.length === 0) {
        container.innerHTML = "<p class='empty-msg'>No news posts found in this category.</p>";
        return;
    }

    container.innerHTML = news.map(news => `
        <a href="/news/${news.id}" class="news-card">

            <div class="news-image">
                <img src="${news.image}" alt="">
                <div class="news-category">
                    <span>${news?.category?.name}</span>
                </div>
            </div>

            <div class="news-infos">
                <span class="news-title">${news.title}</span>
                <p class="news-description">${news.description}</p>
            </div>

            <div class="news-card-footer">
                <span class="news-date">${news.date}</span>
                <img src="/web/icons/link-icon.svg" alt="">
            </div>

        </a>
    `).join('');
}

function renderPagination(data) {
    const container = document.getElementById('news-pagination');
    if (!container) return;

    if (!data.last_page || data.last_page <= 1) {
        container.innerHTML = '';
        return;
    }

    const current = data.current_page;
    const last = data.last_page;

    let html = '';

    // Previous button
    html += `
        <li class="page-item ${current === 1 ? 'disabled' : ''}" data-page="${current - 1}">
            <a class="page-link" href="#">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
        </li>`;

    // Page numbers with ellipsis
    const pages = getPageRange(current, last);
    pages.forEach(p => {
        if (p === '...') {
            html += `<li class="page-item dots"><span class="page-link">...</span></li>`;
        } else {
            html += `
                <li class="page-item ${p === current ? 'active' : ''}" data-page="${p}">
                    <a class="page-link" href="#">${p}</a>
                </li>`;
        }
    });

    // Next button
    html += `
        <li class="page-item ${current === last ? 'disabled' : ''}" data-page="${current + 1}">
            <a class="page-link" href="#">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </li>`;

    container.innerHTML = html;
}

function getPageRange(current, last) {
    const pages = [];
    if (last <= 5) {
        for (let i = 1; i <= last; i++) pages.push(i);
        return pages;
    }

    pages.push(1);
    if (current > 3) pages.push('...');

    const start = Math.max(2, current - 1);
    const end = Math.min(last - 1, current + 1);
    for (let i = start; i <= end; i++) pages.push(i);

    if (current < last - 2) pages.push('...');
    pages.push(last);

    return pages;
}
