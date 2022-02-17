let menuButton = document.querySelector('.openMenu');
let menu = document.querySelector('.mobile-menu');

menuButton.addEventListener('click', (e) => {
    e.preventDefault()
    menu.classList.toggle('menuOpen')
})
