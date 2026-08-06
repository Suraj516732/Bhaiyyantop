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
    <div class="container header-inner">
        <!-- Site Branding (Logo) -->
        <div class="logo-container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-container">
                <div class="logo-bubble">
                    <span>भ</span>
                </div>
                <div class="logo-text-banner">
                    <h1>भैय्यान्टॉप</h1>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav id="site-navigation" class="header-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'bhaiyyantop' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'header-menu',
                    'container'      => false,
                    'depth'          => 1,
                ) );
            } else {
                // Fallback menu matching the screenshot exactly
                echo '<ul class="header-menu">';
                echo '<li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">होम</a></li>';
                echo '<li><a href="#">देश</a></li>';
                echo '<li><a href="#">दुनिया</a></li>';
                echo '<li><a href="#">बिज़नेस</a></li>';
                echo '<li><a href="#">टेक्नोलॉजी</a></li>';
                echo '<li><a href="#">खेल</a></li>';
                echo '<li><a href="#">मनोरंजन</a></li>';
                echo '<li><a href="#">स्वास्थ्य</a></li>';
                echo '<li><a href="#">लाइफस्टाइल</a></li>';
                echo '<li><a href="#">ब्लॉग</a></li>';
                echo '<li><a href="#">वीडियो</a></li>';
                echo '</ul>';
            }
            ?>

            <!-- Search and Action Buttons -->
            <div class="header-actions">
                <button class="search-trigger" aria-label="<?php esc_attr_e( 'Search', 'bhaiyyantop' ); ?>">
                    <i class="fa fa-search"></i>
                </button>
                <button class="subscribe-btn"><?php esc_html_e( 'Subscribe', 'bhaiyyantop' ); ?></button>
            </div>
        </nav>
    </div>
</header>

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
