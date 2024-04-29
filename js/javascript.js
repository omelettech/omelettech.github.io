const navList = document.querySelector('.nav-list');
const mobileMenuButton = document.querySelector('.mobile-menu-button');



mobileMenuButton.addEventListener('click', () => {
    navList.classList.toggle('active');
    mobileMenuButton.classList.toggle('hidden');
});
// Close mobile menu when clicking anywhere else
document.addEventListener('click', (event) => {
    if (event.target !== mobileMenuButton && !mobileMenuButton.contains(event.target)) {
        navList.classList.remove('active');
        mobileMenuButton.classList.remove('hidden');

    }
});
