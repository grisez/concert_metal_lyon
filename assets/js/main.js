const toggleClass = (el, className, pixelDelai) => el.classList.toggle(className, window.scrollY > window.innerHeight * pixelDelai);

window.onscroll = (event) => {
    setTimeout(() => {
        toggleClass(document.querySelector('.navbar'), 'scrolled', 0.25);
    }, 250);
}; 

