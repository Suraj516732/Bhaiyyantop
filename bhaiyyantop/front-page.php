<?php
/**
 * The front page template file
 * Componentized Homepage Layout for Hero, Cards, Editor's Choice, Featured, and Ad Slots.
 *
 * @package Bhaiyyantop
 */

get_header();

// Fetch recent posts using theme function
$recent_posts   = function_exists( 'bhaiyyantop_get_recent_posts' ) ? bhaiyyantop_get_recent_posts( array( 'numberposts' => 12 ) ) : array();

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
        <!-- COLUMN 1: LEFT SIDEBAR (फीचर्ड न्यूज़ / Trending) -->
        <!-- ========================================== -->
        <aside class="col-left">
            <div class="section-title-wrap">
                <h2 class="section-title"><?php esc_html_e( 'फीचर्ड न्यूज़', 'bhaiyyantop' ); ?></h2>
                <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'desh' ) ); ?>" class="section-more-link">
                    <?php esc_html_e( 'और देखें', 'bhaiyyantop' ); ?> <i class="fa fa-angle-right"></i>
                </a>
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
                    <div class="post-meta">
                        <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $promo['author'] ); ?></span> &bull; <?php echo esc_html( $promo['date'] ); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Sidebar Ad Slot -->
            <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'sidebar-left' ); ?>
        </aside>

        <!-- ========================================== -->
        <!-- COLUMN 2: MIDDLE MAIN CONTENT (Hero & Main Feed) -->
        <!-- ========================================== -->
        <main class="col-middle">
            
            <!-- Hero Slider Component -->
            <div class="hero-slider-wrap" id="heroSlider">
                <?php if ( $hero_post ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'hero', array( 'item' => $hero_post ) ); ?>
                <?php endif; ?>
                
                <!-- Slider Pagination Indicators -->
                <div class="slider-pagination" aria-label="<?php esc_attr_e( 'Slider Controls', 'bhaiyyantop' ); ?>">
                    <span class="slider-dot active"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                </div>
            </div>

            <!-- Middle Wide Featured Card Component -->
            <?php if ( $mid_card_post ) : ?>
                <?php get_template_part( 'template-parts/cards/card', 'mid', array( 'item' => $mid_card_post ) ); ?>
            <?php endif; ?>

            <!-- In-Feed Ad Slot -->
            <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'feed-middle' ); ?>
        </main>

        <!-- ========================================== -->
        <!-- COLUMN 3: RIGHT SIDEBAR (एडिटर्स चॉइस) -->
        <!-- ========================================== -->
        <aside class="col-right">
            <div class="section-title-wrap">
                <h2 class="section-title"><?php esc_html_e( 'एडिटर्स चॉइस', 'bhaiyyantop' ); ?></h2>
                <a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'blog' ) ); ?>" class="section-more-link">
                    <?php esc_html_e( 'और देखें', 'bhaiyyantop' ); ?> <i class="fa fa-angle-right"></i>
                </a>
            </div>

            <div class="editors-choice-list">
                <?php if ( isset( $editors_posts[0] ) ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-hero', array( 'item' => $editors_posts[0] ) ); ?>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[1] ) ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-wide', array( 'item' => $editors_posts[1], 'badge_color' => 'teal' ) ); ?>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[2] ) ) : ?>
                    <?php get_template_part( 'template-parts/cards/card', 'editor-wide', array( 'item' => $editors_posts[2], 'badge_color' => 'blue' ) ); ?>
                <?php endif; ?>
            </div>

            <!-- Right Sidebar Ad Slot -->
            <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'sidebar-right' ); ?>
        </aside>

        <!-- ========================================== -->
        <!-- BOTTOM SECTION: LATEST NEWS (लेटेस्ट न्यूज़) -->
        <!-- ========================================== -->
        <section class="bottom-news-section">
            <div class="bottom-section-header">
                <h2 class="section-title"><?php esc_html_e( 'लेटेस्ट न्यूज़', 'bhaiyyantop' ); ?></h2>
                <!-- Filter Tabs with Category Links -->
                <ul class="category-tabs" role="tablist">
                    <li><button class="cat-tab-btn active" data-category="all"><?php esc_html_e( 'सभी', 'bhaiyyantop' ); ?></button></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'desh' ) ); ?>" class="cat-tab-btn" data-category="desh"><?php esc_html_e( 'देश', 'bhaiyyantop' ); ?></a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'duniya' ) ); ?>" class="cat-tab-btn" data-category="duniya"><?php esc_html_e( 'दुनिया', 'bhaiyyantop' ); ?></a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'business' ) ); ?>" class="cat-tab-btn" data-category="business"><?php esc_html_e( 'बिज़नेस', 'bhaiyyantop' ); ?></a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'khel' ) ); ?>" class="cat-tab-btn" data-category="khel"><?php esc_html_e( 'खेल', 'bhaiyyantop' ); ?></a></li>
                    <li><a href="<?php echo esc_url( bhaiyyantop_get_category_url( 'technology' ) ); ?>" class="cat-tab-btn" data-category="technology"><?php esc_html_e( 'तकनीक', 'bhaiyyantop' ); ?></a></li>
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
