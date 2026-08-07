/**
 * Bhaiyyantop Theme JavaScript
 * Handles Premium Floating Sticky Navigation Bar, Mobile Drawer, and Accessibility Keyboard Focus
 */

(function () {
    'use strict';

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

    function initMobileMenuToggles() {
        // Find all hamburger toggle buttons (main header & sticky header)
        const toggleButtons = document.querySelectorAll('.menu-toggle');

        toggleButtons.forEach(function (toggleBtn) {
            const targetId = toggleBtn.getAttribute('aria-controls');
            const menuWrapper = targetId ? document.getElementById(targetId) : null;

            if (!toggleBtn || !menuWrapper) return;

            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                const nextState = !isExpanded;

                toggleBtn.setAttribute('aria-expanded', nextState ? 'true' : 'false');
                toggleBtn.classList.toggle('is-active', nextState);
                menuWrapper.classList.toggle('active', nextState);

                // Add body scroll lock on mobile when drawer is active
                if (window.innerWidth <= 768) {
                    document.body.classList.toggle('mobile-menu-open', nextState);
                }
            });
        });

        // Close mobile drawer on Escape key press for Accessibility
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                toggleButtons.forEach(function (toggleBtn) {
                    const targetId = toggleBtn.getAttribute('aria-controls');
                    const menuWrapper = targetId ? document.getElementById(targetId) : null;
                    if (toggleBtn && menuWrapper && menuWrapper.classList.contains('active')) {
                        toggleBtn.setAttribute('aria-expanded', 'false');
                        toggleBtn.classList.remove('is-active');
                        menuWrapper.classList.remove('active');
                        document.body.classList.remove('mobile-menu-open');
                    }
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', onScroll, { passive: true });
            handleScroll();
            initMobileMenuToggles();
        });
    } else {
        window.addEventListener('scroll', onScroll, { passive: true });
        handleScroll();
        initMobileMenuToggles();
    }
})();
