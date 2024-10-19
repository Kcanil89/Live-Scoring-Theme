document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const searchToggle = document.querySelector('.search-toggle');
    const menu = document.querySelector('.main-navigation ul');
    const searchForm = document.querySelector('.search-form');
    const searchField = searchForm.querySelector('.search-field');

    // Toggle mobile menu
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            menu.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', menu.classList.contains('active'));
        });
    }

    // Toggle search form
    if (searchToggle) {
        searchToggle.addEventListener('click', function() {
            searchForm.classList.toggle('active');
            searchToggle.setAttribute('aria-expanded', searchForm.classList.contains('active'));

            searchField.classList.toggle('active');

            // Focus on the search field when the form is shown
            if (searchField.classList.contains('active')) {
                searchField.focus();
            } else {
                searchField.value = ''; // Clear the search field when hidden
            }
        });
    }
});
