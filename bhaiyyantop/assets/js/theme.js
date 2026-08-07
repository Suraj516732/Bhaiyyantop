/**
 * Bhaiyyantop Theme JavaScript
 * Handles Premium Floating Sticky Navigation Bar & Scroll Throttling
 */

(function () {
    'use strict';

    // Throttled Scroll Listener using requestAnimationFrame
    let isTicking = false;
    const scrollThreshold = 120;

    function handleScroll() {
        const stickyNav = document.getElementById('bhaiyyantop-sticky-nav');
        if (!stickyNav) return;

        const currentScrollY = window.scrollY || window.pageYOffset;

        if (currentScrollY > scrollThreshold) {
            stickyNav.classList.add('sticky-active');
        } else {
            stickyNav.classList.remove('sticky-active');
        }

        isTicking = false;
    }

    function onScroll() {
        if (!isTicking) {
            window.requestAnimationFrame(handleScroll);
            isTicking = true;
        }
    }

    // Toggle menu for sticky navbar on mobile screens
    function initStickyMenuToggle() {
        const stickyNav = document.getElementById('bhaiyyantop-sticky-nav');
        if (!stickyNav) return;

        const toggleBtn = stickyNav.querySelector('.sticky-menu-toggle');
        const menuWrapper = stickyNav.querySelector('#sticky-primary-menu');

        if (toggleBtn && menuWrapper) {
            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                toggleBtn.setAttribute('aria-expanded', !isExpanded);
                menuWrapper.classList.toggle('active');
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', onScroll, { passive: true });
            handleScroll();
            initStickyMenuToggle();
        });
    } else {
        window.addEventListener('scroll', onScroll, { passive: true });
        handleScroll();
        initStickyMenuToggle();
    }
})();
