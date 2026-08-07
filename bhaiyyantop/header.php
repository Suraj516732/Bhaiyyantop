<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="header-overlay-bg"></div>
    <div class="container header-inner">
        <div class="logo-container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="भैय्यान्टॉप" class="custom-logo">
            </a>
        </div>

        <!-- Right Side Widgets (Date, Weather, Live TV) -->
        <div class="header-widgets-container">
            <!-- Hindi Date & Weather Widget -->
            <div class="date-weather-widget">
                <div class="date-text">
                    <i class="fa fa-calendar-alt"></i>
                    <span><?php 
                        $days = array('रविवार', 'सोमवार', 'मंगलवार', 'बुधवार', 'गुरुवार', 'शुक्रवार', 'शनिवार');
                        $months = array('', 'जनवरी', 'फरवरी', 'मार्च', 'अप्रैल', 'मई', 'जून', 'जुलाई', 'अगस्त', 'सितंबर', 'अक्टूबर', 'नवंबर', 'दिसंबर');
                        
                        $day_of_week = $days[date('w')];
                        $day_of_month = date('j');
                        $month = $months[date('n')];
                        $year = date('Y');
                        
                        echo esc_html("$day_of_week, $day_of_month $month $year");
                    ?></span>
                </div>
                <div class="weather-text">
                    <i class="fa fa-cloud-sun"></i>
                    <span>नई दिल्ली, 31°C</span>
                </div>
            </div>

            <!-- Social Follow Icons -->
            <div class="header-social-icons">
                <a href="#" class="social-icon facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon twitter" aria-label="Twitter (X)"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon youtube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle Dark Mode">
                    <i class="fa fa-moon"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Sticky and Responsive Navigation Menu Bar -->
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'bhaiyyantop' ); ?>">
    <div class="container nav-container">
        <!-- Mobile Menu Hamburger Trigger -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>

        <div class="nav-menu-wrapper" id="primary-menu">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'header-menu',
                    'container'      => false,
                    'depth'          => 1,
                ) );
            } else {
                $categories = function_exists('bhaiyyantop_get_all_categories') ? bhaiyyantop_get_all_categories() : array();
                echo '<ul class="header-menu">';
                echo '<li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">होम</a></li>';
                foreach ( $categories as $slug => $cat_info ) {
                    echo '<li><a href="' . esc_url( $cat_info['url'] ) . '">' . esc_html( $cat_info['name'] ) . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div>

        <!-- Search and Action Buttons -->
        <div class="header-actions">
            <button class="search-trigger" id="searchTriggerBtn" aria-label="<?php esc_attr_e( 'Search', 'bhaiyyantop' ); ?>">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Breaking News Ticker -->
<section class="breaking-ticker">
    <div class="container ticker-inner">
        <div class="ticker-label">
            <i class="fa fa-bolt"></i>
            <span>ताजा खबरें</span>
        </div>
        <div class="ticker-slider">
            <ul class="ticker-list">
                <li class="ticker-item">सरकार ने लॉन्च की नई हेल्थ इंश्योरेंस योजना</li>
                <li class="ticker-item">शेयर बाजार में जोरदार उछाल, सेंसेक्स 1200 अंक ऊपर</li>
                <li class="ticker-item">भारत ने टी20 सीरीज़ 3-1 से जीती</li>
                <li class="ticker-item">मौसम विभाग ने जारी की भारी बारिश की चेतावनी</li>
            </ul>
        </div>
        <div class="ticker-controls">
            <button class="ticker-control-btn ticker-prev" aria-label="<?php esc_attr_e( 'Previous news', 'bhaiyyantop' ); ?>">
                <i class="fa fa-chevron-left"></i>
            </button>
            <button class="ticker-control-btn ticker-next" aria-label="<?php esc_attr_e( 'Next news', 'bhaiyyantop' ); ?>">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>
