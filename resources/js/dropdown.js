let dropdowns = document.querySelectorAll('.data-dropdown-menu-btn');

dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', e => {
        let menu = document.querySelector(`.${dropdown.dataset.target}`);

        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    })
})

window.addEventListener('click', function(event) {
    if (
        event.target.matches('.data-dropdown-menu-btn')
        || event.target.parentElement.matches('.data-dropdown-menu-btn')
    ) {
        return;
    }

    const dropdowns = document.getElementsByClassName("dropdown");
    let i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === 'block') {
            openDropdown.style.display = 'none';
        }
    }
});
