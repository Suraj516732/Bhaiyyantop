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

<?php
$home_url        = home_url( '/' );
$site_name       = get_bloginfo( 'name' );
$categories_data = function_exists( 'bhaiyyantop_get_all_categories' ) ? bhaiyyantop_get_all_categories() : array();
?>

<!-- Skip to Content Link for Keyboard Accessibility -->
<a class="skip-link screen-reader-text" href="#primary-content"><?php esc_html_e( 'मुख्य सामग्री पर जाएं', 'bhaiyyantop' ); ?></a>

<!-- Main Header Section -->
<header id="masthead" class="site-header" role="banner">
    <div class="container header-inner">
        <!-- Categories Navigation Menu Toggle -->
        <nav id="site-navigation" class="header-nav main-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation Menu', 'bhaiyyantop' ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Navigation Menu', 'bhaiyyantop' ); ?>">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <!-- Weather and Date Widget -->
            <div class="header-weather-date">
                <span class="header-date"><i class="fa-regular fa-calendar-alt" aria-hidden="true"></i> <?php echo esc_html( date_i18n( 'j F' ) ); ?></span>
                <span class="header-temp"><i class="fa-solid fa-cloud-sun" aria-hidden="true"></i> 28°C</span>
            </div>

            <!-- Dropdown Navigation Container -->
            <div class="nav-menu-wrapper" id="primary-menu">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'header-menu',
                        'container'      => false,
                        'depth'          => 2,
                    ) );
                } else {
                    echo '<ul class="header-menu">';
                    echo '<li class="current-menu-item"><a href="' . esc_url( $home_url ) . '">' . esc_html__( 'होम', 'bhaiyyantop' ) . '</a></li>';
                    foreach ( $categories_data as $cat_info ) {
                        echo '<li><a href="' . esc_url( $cat_info['url'] ) . '">' . esc_html( $cat_info['name'] ) . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </nav>

        <!-- Site Branding Logo -->
        <div class="logo-container">
            <?php
            $custom_logo = get_theme_mod( 'bhaiyyantop_logo' );
            $retina_logo = get_theme_mod( 'bhaiyyantop_retina_logo' );
            $logo_text   = get_theme_mod( 'bhaiyyantop_logo_text_title', $site_name );
            if ( ! empty( $custom_logo ) ) :
                $srcset = ! empty( $retina_logo ) ? ' srcset="' . esc_url( $custom_logo ) . ' 1x, ' . esc_url( $retina_logo ) . ' 2x"' : '';
                ?>
                <a href="<?php echo esc_url( $home_url ); ?>" rel="home" class="logo-link" aria-label="<?php echo esc_attr( $logo_text ); ?>">
                    <img src="<?php echo esc_url( $custom_logo ); ?>"<?php echo wp_kses_post( $srcset ); ?> alt="<?php echo esc_attr( $logo_text ); ?>" class="custom-logo" width="400" height="112" fetchpriority="high" decoding="async">
                </a>
            <?php elseif ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( $home_url ); ?>" rel="home" class="logo-link" aria-label="<?php echo esc_attr( $site_name ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php echo esc_attr( $site_name ); ?>" class="custom-logo" width="400" height="112" fetchpriority="high" decoding="async">
                </a>
            <?php endif; ?>
        </div>

        <!-- Right Side Actions: Inline Search (Mobile Right) -->
        <div class="header-actions">
            <!-- Inline Expanding Search Form -->
            <div class="header-search-container">
                <div class="search-expand-wrap" id="headerSearchExpand">
                    <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( $home_url ); ?>">
                        <label for="header-search-input-field" class="screen-reader-text"><?php esc_html_e( 'खबरें खोजें:', 'bhaiyyantop' ); ?></label>
                        <input type="search" id="header-search-input-field" class="header-search-input" placeholder="<?php echo esc_attr( get_theme_mod( 'bhaiyyantop_search_placeholder', __( 'खबरें खोजें...', 'bhaiyyantop' ) ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" autocomplete="off" aria-label="<?php esc_attr_e( 'खबरें खोजें', 'bhaiyyantop' ); ?>">
                        <button type="submit" class="search-submit-btn" aria-label="<?php esc_attr_e( 'Search Submit', 'bhaiyyantop' ); ?>">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <button type="button" class="search-toggle-btn" id="headerSearchToggle" aria-expanded="false" aria-controls="headerSearchExpand" aria-label="<?php esc_attr_e( 'Toggle Search Bar', 'bhaiyyantop' ); ?>">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<?php if ( get_theme_mod( 'bhaiyyantop_sticky_header_enable', true ) ) : ?>
<!-- Premium Floating Sticky Navigation Bar (Desktop & Mobile Sticky Header) -->
<div id="bhaiyyantop-sticky-nav" class="bhaiyyantop-sticky-navbar">
    <div class="container sticky-navbar-inner">
        <div class="sticky-logo-wrap">
            <a href="<?php echo esc_url( $home_url ); ?>" rel="home" class="sticky-logo-link" aria-label="<?php echo esc_attr( $site_name ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo_img       = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( $logo_img ) :
                        ?>
                        <img src="<?php echo esc_url( $logo_img[0] ); ?>" alt="<?php echo esc_attr( $site_name ); ?>" class="sticky-logo-img">
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php echo esc_attr( $site_name ); ?>" class="sticky-logo-img">
                    <?php endif; ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php echo esc_attr( $site_name ); ?>" class="sticky-logo-img">
                <?php endif; ?>
            </a>
        </div>

        <nav class="sticky-nav main-navigation" aria-label="<?php esc_attr_e( 'Sticky Navigation Menu', 'bhaiyyantop' ); ?>">
            <button class="menu-toggle sticky-menu-toggle" aria-controls="sticky-primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Sticky Navigation', 'bhaiyyantop' ); ?>">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <div class="header-weather-date">
                <span class="header-date"><i class="fa-regular fa-calendar-alt" aria-hidden="true"></i> <?php echo esc_html( date_i18n( 'j F' ) ); ?></span>
                <span class="header-temp"><i class="fa-solid fa-cloud-sun" aria-hidden="true"></i> 28°C</span>
            </div>

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
                    echo '<ul class="header-menu sticky-header-menu">';
                    echo '<li class="current-menu-item"><a href="' . esc_url( $home_url ) . '">' . esc_html__( 'होम', 'bhaiyyantop' ) . '</a></li>';
                    foreach ( $categories_data as $cat_info ) {
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
                    <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( $home_url ); ?>">
                        <label for="sticky-search-input-field" class="screen-reader-text"><?php esc_html_e( 'खबरें खोजें:', 'bhaiyyantop' ); ?></label>
                        <input type="search" id="sticky-search-input-field" class="header-search-input" placeholder="<?php echo esc_attr( get_theme_mod( 'bhaiyyantop_search_placeholder', __( 'खबरें खोजें...', 'bhaiyyantop' ) ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" autocomplete="off" aria-label="<?php esc_attr_e( 'खबरें खोजें', 'bhaiyyantop' ); ?>">
                        <button type="submit" class="search-submit-btn" aria-label="<?php esc_attr_e( 'Search Submit', 'bhaiyyantop' ); ?>">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <button type="button" class="search-toggle-btn" id="stickySearchToggle" aria-expanded="false" aria-controls="stickySearchExpand" aria-label="<?php esc_attr_e( 'Toggle Search Bar', 'bhaiyyantop' ); ?>">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>

<!-- Header Banner Ad Space -->
<?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'header_banner' ); ?>

<?php if ( get_theme_mod( 'bhaiyyantop_breaking_news_enable', get_theme_mod( 'bhaiyyantop_show_ticker', true ) ) ) : ?>
<!-- Compact 40px Breaking News Ticker -->
<section class="breaking-ticker" role="region" aria-label="<?php esc_attr_e( 'Breaking News Ticker', 'bhaiyyantop' ); ?>">
    <div class="container ticker-container-wrap">
        <div class="ticker-white-box">
            <div class="ticker-label">
                <span><?php echo esc_html( get_theme_mod( 'bhaiyyantop_header_notice', __( 'ताज़ा खबरें', 'bhaiyyantop' ) ) ); ?></span>
                <i class="fa fa-bolt" aria-hidden="true"></i>
            </div>
            <div class="ticker-slider">
                <ul class="ticker-list" aria-live="polite">
                    <?php
                    $ticker_posts = function_exists( 'bhaiyyantop_get_ticker_posts' ) ? bhaiyyantop_get_ticker_posts( 5 ) : array();
                    if ( ! empty( $ticker_posts ) ) :
                        foreach ( $ticker_posts as $t_post ) :
                            ?>
                            <li class="ticker-item"><a href="<?php echo esc_url( get_permalink( $t_post->ID ) ); ?>"><?php echo esc_html( get_the_title( $t_post->ID ) ); ?></a></li>
                            <?php
                        endforeach;
                    else :
                        ?>
                        <li class="ticker-item"><a href="#"><?php esc_html_e( 'सरकार ने लॉन्च की नई हेल्थ इंश्योरेंस योजना', 'bhaiyyantop' ); ?></a></li>
                        <li class="ticker-item"><a href="#"><?php esc_html_e( 'शेयर बाजार में जोरदार उछाल, सेंसेक्स 1200 अंक ऊपर', 'bhaiyyantop' ); ?></a></li>
                        <li class="ticker-item"><a href="#"><?php esc_html_e( 'भारत ने टी20 सीरीज़ 3-1 से जीती', 'bhaiyyantop' ); ?></a></li>
                        <li class="ticker-item"><a href="#"><?php esc_html_e( 'मौसम विभाग ने जारी की भारी बारिश की चेतावनी', 'bhaiyyantop' ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="ticker-controls">
                <button type="button" class="ticker-control-btn ticker-prev" aria-label="<?php esc_attr_e( 'Previous News', 'bhaiyyantop' ); ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                <button type="button" class="ticker-control-btn ticker-next" aria-label="<?php esc_attr_e( 'Next News', 'bhaiyyantop' ); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Subheader with Menu Toggle and Gwalior Breaking -->
<div class="mobile-subheader">
    <div class="container mobile-subheader-inner">
        <button class="menu-toggle subheader-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Navigation Menu', 'bhaiyyantop' ); ?>">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>
        <span class="gwalior-breaking-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
    </div>
</div>
<?php endif; ?>
