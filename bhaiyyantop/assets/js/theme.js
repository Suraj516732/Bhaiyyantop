/**
 * Bhaiyyantop Theme JavaScript
 * Mobile Navigation UX Fixes (GPU Slide-In Drawer, Auto-Close on Nav Link Click, Backdrop, ESC key, Body Scroll Lock)
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

    // Inline Expanding Search Handler (No Popups / No Modals)
    function initInlineSearch() {
        const searchContainers = document.querySelectorAll('.header-search-container');

        searchContainers.forEach(function (container) {
            const toggleBtn = container.querySelector('.search-toggle-btn');
            const expandWrap = container.querySelector('.search-expand-wrap');
            const searchInput = container.querySelector('.header-search-input');

            if (!toggleBtn || !expandWrap || !searchInput) return;

            function openSearch() {
                toggleBtn.classList.add('is-active');
                toggleBtn.setAttribute('aria-expanded', 'true');
                expandWrap.classList.add('is-open');
                setTimeout(function () {
                    searchInput.focus();
                }, 100);
            }

            function closeSearch() {
                toggleBtn.classList.remove('is-active');
                toggleBtn.setAttribute('aria-expanded', 'false');
                expandWrap.classList.remove('is-open');
            }

            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (expandWrap.classList.contains('is-open')) {
                    closeSearch();
                } else {
                    openSearch();
                }
            });

            // Prevent click inside search form from closing
            expandWrap.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            // Close on Click Outside
            document.addEventListener('click', function (e) {
                if (expandWrap.classList.contains('is-open') && !container.contains(e.target)) {
                    closeSearch();
                }
            });

            // Close on Escape Key Press
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && expandWrap.classList.contains('is-open')) {
                    closeSearch();
                    toggleBtn.focus();
                }
            });
        });

        // Mobile Bottom Bar Search Trigger Listener
        const mobileBottomSearchBtn = document.getElementById('mobileBottomSearchTrigger');
        if (mobileBottomSearchBtn) {
            mobileBottomSearchBtn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                const mainSearchToggle = document.getElementById('headerSearchToggle');
                if (mainSearchToggle) {
                    setTimeout(function () {
                        mainSearchToggle.click();
                    }, 250);
                }
            });
        }
    }

    // Smooth Mobile Left Slide-In Drawer & Overlay Handler
    function initMobileMenuToggles() {
        const toggleButtons = document.querySelectorAll('.menu-toggle');
        const backdrop = document.getElementById('mobileMenuBackdrop');
        const closeDrawerBtn = document.querySelector('.mobile-drawer-close');
        const navMenuWrapper = document.getElementById('primary-menu');

        function closeMenu() {
            toggleButtons.forEach(function (btn) {
                btn.setAttribute('aria-expanded', 'false');
                btn.classList.remove('is-active');
            });
            if (navMenuWrapper) {
                navMenuWrapper.classList.remove('active');
            }
            if (backdrop) {
                backdrop.classList.remove('active');
            }
            document.body.classList.remove('menu-open', 'mobile-menu-open');
        }

        function openMenu() {
            toggleButtons.forEach(function (btn) {
                btn.setAttribute('aria-expanded', 'true');
                btn.classList.add('is-active');
            });
            if (navMenuWrapper) {
                navMenuWrapper.classList.add('active');
            }
            if (backdrop) {
                backdrop.classList.add('active');
            }
            document.body.classList.add('menu-open', 'mobile-menu-open');
        }

        function toggleMenu(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            if (navMenuWrapper && navMenuWrapper.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        toggleButtons.forEach(function (toggleBtn) {
            toggleBtn.addEventListener('click', toggleMenu);
        });

        if (backdrop) {
            backdrop.addEventListener('click', closeMenu);
        }

        if (closeDrawerBtn) {
            closeDrawerBtn.addEventListener('click', closeMenu);
        }

        // Auto-close mobile drawer when any navigation link is clicked
        if (navMenuWrapper) {
            const navLinks = navMenuWrapper.querySelectorAll('a');
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    closeMenu();
                });
            });
        }

        // Close on Escape Key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', onScroll, { passive: true });
            handleScroll();
            initInlineSearch();
            initMobileMenuToggles();
        });
    } else {
        window.addEventListener('scroll', onScroll, { passive: true });
        handleScroll();
        initInlineSearch();
        initMobileMenuToggles();
    }
})();
