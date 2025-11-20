document.addEventListener('DOMContentLoaded', () => {
    // Hamburger menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const dropdowns = document.querySelectorAll('.dropdown');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });

    // Dropdown toggle for mobile
    dropdowns.forEach((dropdown) => {
        const button = dropdown.querySelector('button');
        button.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                dropdown.classList.toggle('open');
                button.setAttribute('aria-expanded', dropdown.classList.contains('open'));
            }
        });
    });

    // Hero slider
    const slides = document.querySelectorAll('.hero-slider .slide');
    const nextBtn = document.querySelector('.slider-nav.next');
    const prevBtn = document.querySelector('.slider-nav.prev');
    let currentIndex = 0;
    let slideInterval = setInterval(nextSlide, 7000);

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            slide.style.left = i === index ? '0' : (i < index ? '-100%' : '100%');
        });
        currentIndex = index;
    }

    function nextSlide() {
        let nextIndex = (currentIndex + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 7000);
    }

    // Accessibility: close menus on outside click
    document.addEventListener('click', (e) => {
        if (!navLinks.contains(e.target) && !hamburger.contains(e.target)) {
            navLinks.classList.remove('open');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('open');
                dropdown.querySelector('button').setAttribute('aria-expanded', 'false');
            });
        }
    });
});
