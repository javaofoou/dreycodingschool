import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.heroSwiper', {
        modules: [Navigation, Pagination, Autoplay],

        loop: true,

        autoplay: {
            delay: 2500, // ⏱ speed of slide
            disableOnInteraction: false, // 🔥 keeps sliding after click
            pauseOnMouseEnter: false, // keeps sliding even when hovering
        },

        speed: 800, // smooth transition

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});