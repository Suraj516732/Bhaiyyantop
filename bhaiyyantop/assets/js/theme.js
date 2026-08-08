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

    function initSearch() {
        const searchWraps = document.querySelectorAll('.header-search-wrap');
        
        searchWraps.forEach(wrap => {
            const form = wrap.querySelector('.header-search-form');
            const input = wrap.querySelector('.header-search-input');
            const btn = wrap.querySelector('.header-search-submit-btn');
            
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (!wrap.classList.contains('active')) {
                    wrap.classList.add('active');
                    input.focus();
                } else {
                    const query = input.value.trim();
                    if (query) {
                        performSearch(query);
                    } else {
                        wrap.classList.remove('active');
                        performSearch(''); // Reset search
                    }
                }
            });
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const query = input.value.trim();
                performSearch(query);
            });
            
            form.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        
        document.addEventListener('click', function() {
            searchWraps.forEach(wrap => {
                const input = wrap.querySelector('.header-search-input');
                if (wrap.classList.contains('active') && !input.value.trim()) {
                    wrap.classList.remove('active');
                }
            });
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchWraps.forEach(wrap => {
                    const input = wrap.querySelector('.header-search-input');
                    input.value = '';
                    wrap.classList.remove('active');
                    performSearch('');
                });
            }
        });
        
        function performSearch(query) {
            query = query.toLowerCase();
            
            const cards = document.querySelectorAll(
                '.mini-news-card, .color-card-promo, .mid-featured-story, .hero-slider-wrap, .editors-hero-card, .editors-wide-card, .grid-news-card'
            );
            
            let matchCount = 0;
            
            cards.forEach(card => {
                if (!query) {
                    card.style.display = '';
                    matchCount++;
                } else {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(query)) {
                        card.style.display = '';
                        matchCount++;
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
            
            // Sync input values in all search forms
            const inputs = document.querySelectorAll('.header-search-input');
            inputs.forEach(input => {
                input.value = query;
            });
            
            let noResultsDiv = document.getElementById('noSearchResults');
            if (!noResultsDiv) {
                noResultsDiv = document.createElement('div');
                noResultsDiv.id = 'noSearchResults';
                noResultsDiv.style.gridColumn = '1 / -1';
                noResultsDiv.style.textAlign = 'center';
                noResultsDiv.style.padding = '40px';
                noResultsDiv.style.fontSize = '20px';
                noResultsDiv.style.fontWeight = 'bold';
                noResultsDiv.style.color = '#757575';
                noResultsDiv.textContent = 'कोई परिणाम नहीं मिला';
                
                const grid = document.querySelector('.theme-grid');
                if (grid) {
                    grid.appendChild(noResultsDiv);
                }
            }
            
            if (matchCount === 0) {
                noResultsDiv.style.display = 'block';
            } else {
                noResultsDiv.style.display = 'none';
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', onScroll, { passive: true });
            handleScroll();
            initStickyMenuToggle();
            initSearch();
        });
    } else {
        window.addEventListener('scroll', onScroll, { passive: true });
        handleScroll();
        initStickyMenuToggle();
        initSearch();
    }
})();
