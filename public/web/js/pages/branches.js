function showMap(event, lat, lng, zoom) {
    event.preventDefault();
    zoom = zoom ?? 15;
    lat = lat ?? 40.4;
    lng = lng ?? 49.8;
    const map = document.getElementById('mainMap');


    map.src = `https://www.google.com/maps?q=${lat},${lng}&z=${zoom}&output=embed`;
}


async function getBranches(search) {
    try {
        const response = await fetch(`/branch-json?search=${encodeURIComponent(search)}`);
        if (!response.ok) throw new Error('API hatası');
        return await response.json();
    } catch (error) {
        console.error('Arama hatası:', error);
        return [];
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('[data-name="search"]');
    const branchList = document.querySelector('#branch-list');

    searchInput.addEventListener('input', async (e) => {
        const branches = await getBranches(e.target.value);

        if (branches.length === 0) {
            branchList.innerHTML = '<p>Nəticə tapılmadı.</p>';
            return;
        }

        branchList.innerHTML = branches.map(branch => `
            <div class="branch-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <span class="branch-name">${branch.name}</span>
                        <div class="branch-status">
                            <div class="circle" style="background: ${branch.is_open ? 'green' : 'red'}"></div>
                            <span>${branch.is_open ? 'İndi Açıqdır' : 'Açıq deyil'}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="branch-info">
                        <img src="/web/icons/location-icon.svg" alt="" class="info-icon">
                        <span class="info-text">${branch.address}</span>
                    </div>
                    <div class="branch-info">
                        <img src="/web/icons/phone-icon.svg" alt="" class="info-icon">
                        <span class="info-text">${branch.phone_1} / ${branch.phone_2}</span>
                    </div>
                    <div class="branch-info">
                        <img src="/web/icons/clock-icon.svg" alt="" class="info-icon">
                        <span class="info-text">Hər gün: ${branch.working_hours_start} - ${branch.working_hours_end}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="javascript:void(0)"
                       class="show-on-map"
                       onclick="showMap(event, '${branch.lat}', '${branch.lng}')">
                        <span>Xəritədə göstər</span>
                    </a>
                </div>
            </div>
        `).join('');
    });
});
