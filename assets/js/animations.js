setTimeout(() => {

    document.querySelector('.loader').style.display = 'none';
    document.getElementById('wrapper').style.display = 'block';
}, 2000); 

function slideUpFooter() {
    const footer = document.getElementById('footer');
    const windowHeight = window.innerHeight;
    const footerTop = footer.getBoundingClientRect().top;

    if (footerTop < windowHeight) {
        footer.style.opacity = 1;
        footer.classList.add('slide-up');
    } else {
        footer.classList.remove('slide-up');
        footer.style.opacity = 0;
    }
}

window.addEventListener('scroll', slideUpFooter);

slideUpFooter();


