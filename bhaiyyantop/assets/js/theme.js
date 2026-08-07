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
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // -------------------------------------------------------------
    // Interactive Search & Subscribe Triggers
    // -------------------------------------------------------------
    const searchBtn = document.getElementById('searchTriggerBtn');
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            let searchBox = document.getElementById('headerSearchOverlay');
            if (!searchBox) {
                searchBox = document.createElement('div');
                searchBox.id = 'headerSearchOverlay';
                searchBox.innerHTML = `
                    <div style="position:fixed; inset:0; background:rgba(0,0,0,0.7); backdrop-filter:blur(5px); z-index:9999; display:flex; align-items:center; justify-content:center; animation:fadeIn 0.3s ease;">
                        <div style="background:#ffffff; padding:30px; border-radius:12px; max-width:500px; width:90%; box-shadow:0 15px 30px rgba(0,0,0,0.3); position:relative;">
                            <button id="closeSearchBtn" style="position:absolute; top:12px; right:16px; background:none; border:none; font-size:22px; cursor:pointer; color:#777;">&times;</button>
                            <h3 style="margin-bottom:15px; font-family:'Noto Sans Devanagari', sans-serif; color:#e91e63;">भैय्यान्टॉप पर खोजें</h3>
                            <form action="/" method="get" style="display:flex; gap:10px;">
                                <input type="text" name="s" placeholder="अपनी पसंदीदा ख़बर खोजें..." style="flex-grow:1; padding:12px 16px; border:2px solid #00bcd4; border-radius:6px; font-size:15px; outline:none;" required autofocus>
                                <button type="submit" style="background:#e91e63; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:700; cursor:pointer;">खोजें</button>
                            </form>
                        </div>
                    </div>
                `;
                document.body.appendChild(searchBox);
                document.getElementById('closeSearchBtn').addEventListener('click', () => searchBox.remove());
                searchBox.querySelector('div').addEventListener('click', (e) => {
                    if (e.target === searchBox.querySelector('div')) searchBox.remove();
                });
            }
        });
    }

    const subBtn = document.getElementById('subscribeBtn');
    if (subBtn) {
        subBtn.addEventListener('click', function() {
            let subBox = document.getElementById('headerSubscribeOverlay');
            if (!subBox) {
                subBox = document.createElement('div');
                subBox.id = 'headerSubscribeOverlay';
                subBox.innerHTML = `
                    <div style="position:fixed; inset:0; background:rgba(0,0,0,0.7); backdrop-filter:blur(5px); z-index:9999; display:flex; align-items:center; justify-content:center; animation:fadeIn 0.3s ease;">
                        <div style="background:#ffffff; padding:35px; border-radius:12px; max-width:450px; width:90%; text-align:center; box-shadow:0 15px 30px rgba(0,0,0,0.3); position:relative;">
                            <button id="closeSubBtn" style="position:absolute; top:12px; right:16px; background:none; border:none; font-size:22px; cursor:pointer; color:#777;">&times;</button>
                            <div style="width:60px; height:60px; background:#e91e63; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px; font-size:28px;"><i class="fa fa-envelope"></i></div>
                            <h3 style="margin-bottom:10px; font-family:'Noto Sans Devanagari', sans-serif; color:#1a1a1a;">भैय्यान्टॉप न्यूज़लेटर सब्सक्राइब करें</h3>
                            <p style="font-size:14px; color:#666; margin-bottom:20px;">देश-दुनिया की ताज़ा खबरें सीधे अपने इनबॉक्स में पाएं!</p>
                            <form onsubmit="event.preventDefault(); alert('धन्यवाद! आपका सब्सक्रिप्शन सफल रहा।'); this.closest('#headerSubscribeOverlay').remove();" style="display:flex; flex-direction:column; gap:12px;">
                                <input type="email" placeholder="अपना ईमेल एड्रेस दर्ज करें..." style="padding:12px 16px; border:1px solid #ccc; border-radius:6px; font-size:14px;" required>
                                <button type="submit" style="background:#e91e63; color:#fff; border:none; padding:12px; border-radius:6px; font-weight:800; font-size:15px; cursor:pointer; transition:background 0.2s;">अभी सब्सक्राइब करें</button>
                            </form>
                        </div>
                    </div>
                `;
                document.body.appendChild(subBox);
                document.getElementById('closeSubBtn').addEventListener('click', () => subBox.remove());
                subBox.querySelector('div').addEventListener('click', (e) => {
                    if (e.target === subBox.querySelector('div')) subBox.remove();
                });
            }
        });
    }
});
