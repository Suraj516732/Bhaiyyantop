document.addEventListener('DOMContentLoaded', function() {
    // -------------------------------------------------------------
    // Breaking News Ticker Auto Scroll
    // -------------------------------------------------------------
    const tickerList = document.querySelector('.ticker-list');
    const tickerItems = document.querySelectorAll('.ticker-item');
    const prevBtn = document.querySelector('.ticker-prev');
    const nextBtn = document.querySelector('.ticker-next');
    
    if (tickerList && tickerItems.length > 0) {
        let tickerIndex = 0;
        let tickerInterval;

        function getTranslateValue() {
            // Find current item width + margin/padding
            let width = 0;
            for (let i = 0; i < tickerIndex; i++) {
                width += tickerItems[i].offsetWidth;
            }
            return width;
        }

        function updateTicker() {
            tickerList.style.transform = `translateX(-${getTranslateValue()}px)`;
        }

        function slideNext() {
            tickerIndex++;
            if (tickerIndex >= tickerItems.length) {
                tickerIndex = 0;
            }
            updateTicker();
        }

        function slidePrev() {
            tickerIndex--;
            if (tickerIndex < 0) {
                tickerIndex = tickerItems.length - 1;
            }
            updateTicker();
        }

        function startTicker() {
            tickerInterval = setInterval(slideNext, 4000);
        }

        function stopTicker() {
            clearInterval(tickerInterval);
        }

        // Event listeners for controls
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                stopTicker();
                slideNext();
                startTicker();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                stopTicker();
                slidePrev();
                startTicker();
            });
        }

        // Hover triggers
        tickerList.addEventListener('mouseenter', stopTicker);
        tickerList.addEventListener('mouseleave', startTicker);

        startTicker();
    }

    // -------------------------------------------------------------
    // Hero Slider Carousel
    // -------------------------------------------------------------
    const sliderDots = document.querySelectorAll('.slider-dot');
    const sliderSlides = document.querySelectorAll('.hero-slide');
    
    if (sliderSlides.length > 1 && sliderDots.length > 0) {
        let activeSlideIndex = 0;
        let slideInterval;

        function showSlide(index) {
            sliderSlides.forEach((slide, idx) => {
                if (idx === index) {
                    slide.style.display = 'block';
                } else {
                    slide.style.display = 'none';
                }
            });

            sliderDots.forEach((dot, idx) => {
                if (idx === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function nextSlide() {
            activeSlideIndex = (activeSlideIndex + 1) % sliderSlides.length;
            showSlide(activeSlideIndex);
        }

        function startSlider() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function stopSlider() {
            clearInterval(slideInterval);
        }

        sliderDots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                stopSlider();
                activeSlideIndex = index;
                showSlide(activeSlideIndex);
                startSlider();
            });
        });

        // Initialize display
        showSlide(0);
        startSlider();
    } else if (sliderSlides.length === 1) {
        sliderSlides[0].style.display = 'block';
    }

    // -------------------------------------------------------------
    // Category Tabs Filter (Bottom Section)
    // -------------------------------------------------------------
    const tabButtons = document.querySelectorAll('.cat-tab-btn');
    const gridCards = document.querySelectorAll('.grid-news-card');

    if (tabButtons.length > 0 && gridCards.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all
                tabButtons.forEach(btn => btn.classList.remove('active'));
                // Add to clicked
                this.classList.add('active');

                const filterCategory = this.getAttribute('data-category');

                gridCards.forEach(card => {
                    const cardCats = card.getAttribute('data-cats') ? card.getAttribute('data-cats').split(',') : [];
                    
                    if (filterCategory === 'all' || cardCats.includes(filterCategory)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }
});
