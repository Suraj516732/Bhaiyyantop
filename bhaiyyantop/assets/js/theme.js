/**
 * Bhaiyyantop Theme JavaScript
 * Production-ready Vanilla JS with Throttled RAF Scroll, Debounced Resize, 
 * Ticker Auto-slider, Search Focus Management, and Memory-Leak Free Mobile Drawer.
 *
 * @package Bhaiyyantop
 */

(function () {
    'use strict';

    // ==========================================
    // UTILITIES: Throttle & Debounce
    // ==========================================
    function debounce(fn, wait) {
        let timeout;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                fn.apply(context, args);
            }, wait);
        };
    }

    // ==========================================
    // 1. OPTIMIZED STICKY HEADER
    // ==========================================
    function initStickyHeader() {
        const stickyNav = document.getElementById('bhaiyyantop-sticky-nav');
        if (!stickyNav) return;

        const scrollThreshold = 120;
        let isTicking = false;
        let lastState = false;

        function updateStickyState() {
            const currentScrollY = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;
            const shouldBeSticky = currentScrollY > scrollThreshold;

            if (shouldBeSticky !== lastState) {
                if (shouldBeSticky) {
                    stickyNav.classList.add('sticky-active');
                } else {
                    stickyNav.classList.remove('sticky-active');
                }
                lastState = shouldBeSticky;
            }
            isTicking = false;
        }

        window.addEventListener('scroll', function () {
            if (!isTicking) {
                window.requestAnimationFrame(updateStickyState);
                isTicking = true;
            }
        }, { passive: true });

        updateStickyState();
    }

    // ==========================================
    // 2. INLINE & MOBILE SEARCH MODULE
    // ==========================================
    function initSearch() {
        const searchContainers = document.querySelectorAll('.header-search-container');
        if (!searchContainers.length) return;

        function closeAllSearches() {
            searchContainers.forEach(function (container) {
                const toggleBtn = container.querySelector('.search-toggle-btn');
                const expandWrap = container.querySelector('.search-expand-wrap');
                if (toggleBtn && expandWrap) {
                    toggleBtn.classList.remove('is-active');
                    toggleBtn.setAttribute('aria-expanded', 'false');
                    expandWrap.classList.remove('is-open');
                }
            });
        }

        searchContainers.forEach(function (container) {
            const toggleBtn = container.querySelector('.search-toggle-btn');
            const expandWrap = container.querySelector('.search-expand-wrap');
            const searchInput = container.querySelector('.header-search-input');

            if (!toggleBtn || !expandWrap || !searchInput) return;

            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const isOpen = expandWrap.classList.contains('is-open');

                closeAllSearches();

                if (!isOpen) {
                    toggleBtn.classList.add('is-active');
                    toggleBtn.setAttribute('aria-expanded', 'true');
                    expandWrap.classList.add('is-open');
                    window.requestAnimationFrame(function () {
                        searchInput.focus();
                    });
                }
            });

            expandWrap.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });

        // Single Delegated Document Click for Outside Close
        document.addEventListener('click', function (e) {
            let insideSearch = false;
            searchContainers.forEach(function (container) {
                if (container.contains(e.target)) {
                    insideSearch = true;
                }
            });
            if (!insideSearch) {
                closeAllSearches();
            }
        });

        // Mobile Bottom Navigation Search Trigger
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

    // ==========================================
    // 3. SIMPLE DROPDOWN MOBILE MENU
    // ==========================================
    function initMobileMenu() {
        const toggleButtons = document.querySelectorAll('.menu-toggle');
        const navMenuWrapper = document.getElementById('primary-menu');

        function closeMenu() {
            toggleButtons.forEach(function (btn) {
                btn.setAttribute('aria-expanded', 'false');
                btn.classList.remove('is-active', 'active');
            });
            if (navMenuWrapper) {
                navMenuWrapper.classList.remove('active');
            }
        }

        function openMenu() {
            toggleButtons.forEach(function (btn) {
                btn.setAttribute('aria-expanded', 'true');
                btn.classList.add('is-active', 'active');
            });
            if (navMenuWrapper) {
                navMenuWrapper.classList.add('active');
            }
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

        if (navMenuWrapper) {
            const navLinks = navMenuWrapper.querySelectorAll('a');
            navLinks.forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });
        }

        // Global Escape Key Handler for both Menu & Search (Single listener)
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeMenu();
                const searchContainers = document.querySelectorAll('.header-search-container');
                searchContainers.forEach(function (container) {
                    const expandWrap = container.querySelector('.search-expand-wrap');
                    const toggleBtn = container.querySelector('.search-toggle-btn');
                    if (expandWrap && expandWrap.classList.contains('is-open')) {
                        expandWrap.classList.remove('is-open');
                        if (toggleBtn) {
                            toggleBtn.classList.remove('is-active');
                            toggleBtn.setAttribute('aria-expanded', 'false');
                            toggleBtn.focus();
                        }
                    }
                });
            }
        });

        // Debounced Window Resize Handler
        const handleResize = debounce(function () {
            if (window.innerWidth > 1024) {
                closeMenu();
            }
        }, 150);

        window.addEventListener('resize', handleResize, { passive: true });
    }

    // ==========================================
    // 4. OPTIMIZED BREAKING NEWS TICKER SLIDER
    // ==========================================
    function initBreakingTicker() {
        const ticker = document.querySelector('.breaking-ticker');
        if (!ticker) return;

        const tickerList = ticker.querySelector('.ticker-list');
        const tickerItems = ticker.querySelectorAll('.ticker-item');
        if (!tickerList || tickerItems.length <= 1) return;

        const prevBtn = ticker.querySelector('.ticker-prev');
        const nextBtn = ticker.querySelector('.ticker-next');

        let currentIndex = 0;
        let tickerInterval = null;
        const totalItems = tickerItems.length;
        const slideIntervalTime = 4000;

        function showSlide(index) {
            if (index < 0) {
                currentIndex = totalItems - 1;
            } else if (index >= totalItems) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            const offset = -(currentIndex * 100);
            tickerList.style.transform = 'translate3d(0, ' + offset + '%, 0)';
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        function startAutoSlide() {
            stopAutoSlide();
            tickerInterval = setInterval(nextSlide, slideIntervalTime);
        }

        function stopAutoSlide() {
            if (tickerInterval) {
                clearInterval(tickerInterval);
                tickerInterval = null;
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function (e) {
                e.preventDefault();
                prevSlide();
                startAutoSlide();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function (e) {
                e.preventDefault();
                nextSlide();
                startAutoSlide();
            });
        }

        // Pause ticker on mouse hover
        ticker.addEventListener('mouseenter', stopAutoSlide);
        ticker.addEventListener('mouseleave', startAutoSlide);

        // Pause ticker when browser tab is inactive
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                stopAutoSlide();
            } else {
                startAutoSlide();
            }
        });

        // Clean up on page unload to prevent memory leaks
        window.addEventListener('beforeunload', stopAutoSlide);

        startAutoSlide();
    }

    // ==========================================
    // INITIALIZATION
    // ==========================================
    function init() {
        initStickyHeader();
        initSearch();
        initMobileMenu();
        initBreakingTicker();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
