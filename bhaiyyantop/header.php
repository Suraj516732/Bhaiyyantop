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

<!-- Skip to Content Link for Keyboard Accessibility -->
<a class="skip-link screen-reader-text" href="#primary-content"><?php esc_html_e( 'मुख्य सामग्री पर जाएं', 'bhaiyyantop' ); ?></a>

<!-- Mobile Drawer Backdrop Overlay -->
<div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>

<!-- Main Header Section -->
<header id="masthead" class="site-header">
    <div class="container header-inner">
        <!-- Categories Navigation Menu Toggle (Mobile Left) -->
        <nav id="site-navigation" class="header-nav main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'bhaiyyantop' ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Navigation', 'bhaiyyantop' ); ?>">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <!-- Slide-in Drawer Container -->
            <div class="nav-menu-wrapper" id="primary-menu">
                <div class="mobile-drawer-header">
                    <span class="mobile-drawer-title"><?php esc_html_e( 'मेनू / कैटेगरीज', 'bhaiyyantop' ); ?></span>
                    <button type="button" class="mobile-drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'bhaiyyantop' ); ?>">&times;</button>
                </div>

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'header-menu',
                        'container'      => false,
                        'depth'          => 2,
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
        </nav>

        <!-- Site Branding Logo (Mobile Centered) -->
        <div class="logo-container">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo">
                </a>
            <?php endif; ?>
        </div>

        <!-- Right Side Actions: Inline Search (Mobile Right) -->
        <div class="header-actions">
            <!-- Inline Expanding Search Form -->
            <div class="header-search-container">
                <div class="search-expand-wrap" id="headerSearchExpand">
                    <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="header-search-input" placeholder="<?php echo esc_attr( get_theme_mod( 'bhaiyyantop_search_placeholder', __( 'खबरें खोजें...', 'bhaiyyantop' ) ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
                        <button type="submit" class="search-submit-btn" aria-label="<?php esc_attr_e( 'Search Submit', 'bhaiyyantop' ); ?>">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <button type="button" class="search-toggle-btn" id="headerSearchToggle" aria-expanded="false" aria-controls="headerSearchExpand" aria-label="<?php esc_attr_e( 'Toggle Search Bar', 'bhaiyyantop' ); ?>">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <!-- Social Media Buttons (Desktop Only) -->
            <div class="header-social-buttons">
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_instagram', '#' ) ); ?>" class="social-btn instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>" class="social-btn youtube" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>" class="social-btn facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Horizontal Category Scroll Bar (Google News Style Snap Scrolling) -->
<div class="mobile-category-bar">
    <div class="mobile-cat-scroll">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cat-pill active">होम</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'desh' ) ); ?>" class="cat-pill">देश</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'duniya' ) ); ?>" class="cat-pill">दुनिया</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'business' ) ); ?>" class="cat-pill">बिज़नेस</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'khel' ) ); ?>" class="cat-pill">खेल</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'technology' ) ); ?>" class="cat-pill">तकनीक</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'manoranjan' ) ); ?>" class="cat-pill">मनोरंजन</a>
        <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'swasthya' ) ); ?>" class="cat-pill">स्वास्थ्य</a>
    </div>
</div>

<!-- Premium Floating Sticky Navigation Bar (Desktop Sticky Header) -->
<div id="bhaiyyantop-sticky-nav" class="bhaiyyantop-sticky-navbar">
    <div class="container sticky-navbar-inner">
        <div class="sticky-logo-wrap">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="sticky-logo-link">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo_img       = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( $logo_img ) :
                        ?>
                        <img src="<?php echo esc_url( $logo_img[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="sticky-logo-img">
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="sticky-logo-img">
                    <?php endif; ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="sticky-logo-img">
                <?php endif; ?>
            </a>
        </div>

        <nav class="sticky-nav main-navigation" aria-label="<?php esc_attr_e( 'Sticky Navigation Menu', 'bhaiyyantop' ); ?>">
            <button class="menu-toggle sticky-menu-toggle" aria-controls="sticky-primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Sticky Navigation', 'bhaiyyantop' ); ?>">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <div class="nav-menu-wrapper" id="sticky-primary-menu">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'header-menu sticky-header-menu',
                        'container'      => false,
                        'depth'          => 1,
                    ) );
                } else {
                    $categories = function_exists('bhaiyyantop_get_all_categories') ? bhaiyyantop_get_all_categories() : array();
                    echo '<ul class="header-menu sticky-header-menu">';
                    echo '<li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">होम</a></li>';
                    foreach ( $categories as $slug => $cat_info ) {
                        echo '<li><a href="' . esc_url( $cat_info['url'] ) . '">' . esc_html( $cat_info['name'] ) . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </nav>

        <div class="sticky-actions">
            <div class="header-search-container sticky-search-container">
                <div class="search-expand-wrap" id="stickySearchExpand">
                    <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="header-search-input" placeholder="<?php echo esc_attr( get_theme_mod( 'bhaiyyantop_search_placeholder', __( 'खबरें खोजें...', 'bhaiyyantop' ) ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
                        <button type="submit" class="search-submit-btn" aria-label="<?php esc_attr_e( 'Search Submit', 'bhaiyyantop' ); ?>">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <button type="button" class="search-toggle-btn" id="stickySearchToggle" aria-expanded="false" aria-controls="stickySearchExpand" aria-label="<?php esc_attr_e( 'Toggle Search Bar', 'bhaiyyantop' ); ?>">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <div class="header-social-buttons sticky-social-buttons">
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_instagram', '#' ) ); ?>" class="social-btn instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>" class="social-btn youtube" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>" class="social-btn facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</div>

<?php if ( get_theme_mod( 'bhaiyyantop_show_ticker', true ) ) : ?>
<!-- Compact 40px Breaking News Ticker -->
<section class="breaking-ticker">
    <div class="container ticker-container-wrap">
        <div class="ticker-white-box">
            <div class="ticker-label">
                <span><?php echo esc_html( get_theme_mod( 'bhaiyyantop_header_notice', __( 'ताज़ा खबरें', 'bhaiyyantop' ) ) ); ?></span>
                <i class="fa fa-bolt"></i>
            </div>
            <div class="ticker-slider">
                <ul class="ticker-list">
                    <?php
                    $ticker_posts = get_posts( array( 'posts_per_page' => 5, 'post_status' => 'publish' ) );
                    if ( ! empty( $ticker_posts ) ) :
                        foreach ( $ticker_posts as $t_post ) :
                            ?>
                            <li class="ticker-item"><a href="<?php echo esc_url( get_permalink( $t_post->ID ) ); ?>"><?php echo esc_html( get_the_title( $t_post->ID ) ); ?></a></li>
                            <?php
                        endforeach;
                    else :
                        ?>
                        <li class="ticker-item"><a href="#">सरकार ने लॉन्च की नई हेल्थ इंश्योरेंस योजना</a></li>
                        <li class="ticker-item"><a href="#">शेयर बाजार में जोरदार उछाल, सेंसेक्स 1200 अंक ऊपर</a></li>
                        <li class="ticker-item"><a href="#">भारत ने टी20 सीरीज़ 3-1 से जीती</a></li>
                        <li class="ticker-item"><a href="#">मौसम विभाग ने जारी की भारी बारिश की चेतावनी</a></li>
                    <?php endif; ?>
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
    </div>
</section>
<?php endif; ?>
