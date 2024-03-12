document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('.grid');

    navToggle.addEventListener('click', function () {
        nav.classList.toggle('nav-open');
    });
});
