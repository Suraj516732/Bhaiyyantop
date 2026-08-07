<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php if ( is_single() ) : ?>
        <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( get_the_excerpt() ); ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <meta property="og:image" content="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>">
        <?php endif; ?>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Section with Inline Expanding Search Bar -->
<header id="masthead" class="site-header">
    <div class="container header-inner">
        <!-- Site Branding Logo -->
        <div class="logo-container">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo">
                </a>
            <?php endif; ?>
        </div>

        <!-- Categories Navigation Menu on Banner -->
        <nav id="site-navigation" class="header-nav main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'bhaiyyantop' ); ?>">
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
        </nav>

        <!-- Inline Expanding Search Input Bar & Social Buttons -->
        <div class="header-actions">
            <div class="expandable-search-form-wrap">
                <form role="search" method="get" class="expandable-search-form" id="expandableSearchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="expandable-search-input" id="expandableSearchInput" name="s" placeholder="<?php echo esc_attr_x( 'समाचार खोजें...', 'placeholder', 'bhaiyyantop' ); ?>" required />
                    <button type="button" class="search-trigger" id="searchTriggerBtn" aria-label="<?php esc_attr_e( 'Search', 'bhaiyyantop' ); ?>">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-social-buttons">
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_instagram', '#' ) ); ?>" class="social-btn instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>" class="social-btn youtube" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>" class="social-btn facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</header>

<?php if ( get_theme_mod( 'bhaiyyantop_show_ticker', true ) ) : ?>
<!-- Breaking News Ticker in Transparent Faded Yellow Bar with White Color Box -->
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
