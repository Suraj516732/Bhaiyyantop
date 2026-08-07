<?php
/**
 * The front page template file
 *
 * @package Bhaiyyantop
 */

get_header();

// Setup mock assets URLs
$theme_uri = function_exists('get_template_directory_uri') ? get_template_directory_uri() : 'bhaiyyantop';

// Fetch recent posts using theme function
$recent_posts = function_exists('bhaiyyantop_get_recent_posts') ? bhaiyyantop_get_recent_posts( array('numberposts' => 12) ) : array();

// Categorize posts for different layout sections
$featured_posts = array_slice( $recent_posts, 0, 5 );
$hero_post       = isset( $recent_posts[0] ) ? $recent_posts[0] : null;
$mid_card_post   = isset( $recent_posts[7] ) ? $recent_posts[7] : ( isset( $recent_posts[1] ) ? $recent_posts[1] : null );
$editors_posts   = array_slice( $recent_posts, 2, 3 );
$grid_posts      = array_slice( $recent_posts, 0, 8 );
?>

<div class="main-wrapper">
    <div class="container theme-grid">
        
        <!-- ========================================== -->
        <!-- COLUMN 1: LEFT SIDEBAR (फीचर्ड न्यूज़) -->
        <!-- ========================================== -->
        <aside class="col-left">
            <div class="section-title-wrap">
                <h2 class="section-title">फीचर्ड न्यूज़</h2>
                <a href="<?php echo esc_url( bhaiyyantop_get_category_url('desh') ); ?>" class="section-more-link">और देखें <i class="fa fa-angle-right"></i></a>
            </div>

            <div class="featured-news-list">
                <?php foreach ( $featured_posts as $item ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'mini', array( 'item' => $item ) ); ?>
                <?php endforeach; ?>
            </div>

            <!-- Pink Color Card Promo Box -->
            <?php if ( isset( $recent_posts[6] ) ) : $promo = $recent_posts[6]; ?>
                <div class="color-card-promo whole-card-link">
                    <h3><a href="<?php echo esc_url( $promo['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $promo['title'] ); ?></a></h3>
                    <div class="post-meta">by <span><?php echo esc_html( $promo['author'] ); ?></span> &bull; <?php echo esc_html( $promo['date'] ); ?></div>
                </div>
            <?php endif; ?>
        </aside>

        <!-- ========================================== -->
        <!-- COLUMN 2: MIDDLE MAIN CONTENT (Hero & Featured) -->
        <!-- ========================================== -->
        <main class="col-middle">
            
            <!-- Hero Slider -->
            <div class="hero-slider-wrap" id="heroSlider">
                <?php if ( $hero_post ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'hero', array( 'item' => $hero_post ) ); ?>
                <?php endif; ?>
                
                <!-- Dot indicators -->
                <div class="slider-pagination">
                    <span class="slider-dot active"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                </div>
            </div>

            <!-- Middle Wide Featured Card -->
            <?php if ( $mid_card_post ) : ?>
                <?php get_template_part( 'template-parts/cards/card', 'mid', array( 'item' => $mid_card_post ) ); ?>
            <?php endif; ?>
        </main>

        <!-- ========================================== -->
        <!-- COLUMN 3: RIGHT SIDEBAR (एडिटर्स चॉइस) -->
        <!-- ========================================== -->
        <aside class="col-right">
            <div class="section-title-wrap">
                <h2 class="section-title">एडिटर्स चॉइस</h2>
                <a href="<?php echo esc_url( bhaiyyantop_get_category_url('blog') ); ?>" class="section-more-link">और देखें <i class="fa fa-angle-right"></i></a>
            </div>

            <div class="editors-choice-list">
                <?php if ( isset( $editors_posts[0] ) ) : $ed1 = $editors_posts[0]; ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-hero', array( 'item' => $ed1 ) ); ?>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[1] ) ) : $ed2 = $editors_posts[1]; ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-wide', array( 'item' => $ed2, 'badge_color' => 'teal' ) ); ?>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[2] ) ) : $ed3 = $editors_posts[2]; ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-wide', array( 'item' => $ed3, 'badge_color' => 'blue' ) ); ?>
                <?php endif; ?>
            </div>
        </aside>

        <!-- ========================================== -->
        <!-- BOTTOM SECTION: LATEST NEWS (लेटेस्ट न्यूज़) -->
        <!-- ========================================== -->
        <section class="bottom-news-section">
            <div class="bottom-section-header">
                <h2 class="section-title">लेटेस्ट न्यूज़</h2>
                <!-- Filter Tabs with Category Paths -->
                <ul class="category-tabs">
                    <li><button class="cat-tab-btn active" data-category="all">सभी</button></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url('desh') ); ?>" class="cat-tab-btn" data-category="desh">देश</a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url('duniya') ); ?>" class="cat-tab-btn" data-category="duniya">दुनिया</a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url('business') ); ?>" class="cat-tab-btn" data-category="business">बिज़नेस</a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url('khel') ); ?>" class="cat-tab-btn" data-category="khel">खेल</a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url('technology') ); ?>" class="cat-tab-btn" data-category="technology">तकनीक</a></li>
                </ul>
            </div>

            <div class="latest-news-grid" id="latestNewsGrid">
                <?php foreach ( $grid_posts as $post_item ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'grid', array( 'item' => $post_item ) ); ?>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</div>

<?php
get_footer();
