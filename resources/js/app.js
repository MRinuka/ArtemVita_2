import Swiper from 'swiper/bundle'; // Import Swiper if you're using ES modules
import 'swiper/swiper-bundle.css'; // Import Swiper styles if not already included

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Swiper
    const swiper = new Swiper('.mySwiper', {
        loop: true,
        spaceBetween: 20, // Space between slides
        slidesPerView: 1, // Default view
        breakpoints: {
            // Adjust slides per view based on screen width
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});
