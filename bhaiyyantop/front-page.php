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
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <a href="<?php echo esc_url( $item['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $item['thumbnail'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
                            </a>
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title">
                                <a href="<?php echo esc_url( $item['permalink'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                            </h3>
                            <div class="post-meta">by <span><?php echo esc_html( $item['author'] ); ?></span> &bull; <?php echo esc_html( $item['date'] ); ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pink Color Card Promo Box -->
            <?php if ( isset( $recent_posts[6] ) ) : $promo = $recent_posts[6]; ?>
                <div class="color-card-promo">
                    <h3><a href="<?php echo esc_url( $promo['permalink'] ); ?>"><?php echo esc_html( $promo['title'] ); ?></a></h3>
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
                    <div class="hero-slide active">
                        <a href="<?php echo esc_url( $hero_post['permalink'] ); ?>" class="hero-img-link">
                            <img src="<?php echo esc_url( $hero_post['thumbnail'] ); ?>" alt="<?php echo esc_attr( $hero_post['title'] ); ?>">
                        </a>
                        <div class="hero-overlay">
                            <a href="<?php echo esc_url( $hero_post['cat_url'] ); ?>" class="cat-badge pink"><?php echo esc_html( $hero_post['category'] ); ?></a>
                            <h2 class="hero-title"><a href="<?php echo esc_url( $hero_post['permalink'] ); ?>"><?php echo esc_html( $hero_post['title'] ); ?></a></h2>
                            <p class="hero-excerpt"><?php echo esc_html( $hero_post['excerpt'] ); ?></p>
                            <div class="post-meta">by <span><?php echo esc_html( $hero_post['author'] ); ?></span> &bull; <?php echo esc_html( $hero_post['date'] ); ?></div>
                        </div>
                    </div>
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
                <div class="mid-featured-story">
                    <div class="mid-card-inner">
                        <div class="mid-card-content">
                            <a href="<?php echo esc_url( $mid_card_post['cat_url'] ); ?>" class="cat-badge teal"><?php echo esc_html( $mid_card_post['category'] ); ?></a>
                            <h3 class="mid-card-title"><a href="<?php echo esc_url( $mid_card_post['permalink'] ); ?>"><?php echo esc_html( $mid_card_post['title'] ); ?></a></h3>
                            <div class="post-meta">by <span><?php echo esc_html( $mid_card_post['author'] ); ?></span> &bull; <?php echo esc_html( $mid_card_post['date'] ); ?></div>
                        </div>
                        <div class="mid-card-image">
                            <a href="<?php echo esc_url( $mid_card_post['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $mid_card_post['thumbnail'] ); ?>" alt="<?php echo esc_attr( $mid_card_post['title'] ); ?>">
                            </a>
                        </div>
                    </div>
                </div>
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
                    <!-- Editors Hero Card -->
                    <article class="editors-hero-card">
                        <div class="editors-hero-image">
                            <a href="<?php echo esc_url( $ed1['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $ed1['thumbnail'] ); ?>" alt="<?php echo esc_attr( $ed1['title'] ); ?>">
                            </a>
                        </div>
                        <div class="editors-hero-content">
                            <a href="<?php echo esc_url( $ed1['cat_url'] ); ?>" class="cat-badge pink"><?php echo esc_html( $ed1['category'] ); ?></a>
                            <h3 class="editors-hero-title"><a href="<?php echo esc_url( $ed1['permalink'] ); ?>"><?php echo esc_html( $ed1['title'] ); ?></a></h3>
                            <div class="post-meta">by <span><?php echo esc_html( $ed1['author'] ); ?></span> &bull; <?php echo esc_html( $ed1['date'] ); ?></div>
                        </div>
                    </article>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[1] ) ) : $ed2 = $editors_posts[1]; ?>
                    <!-- Editors Wide List 1 -->
                    <article class="editors-wide-card">
                        <div class="editors-wide-content">
                            <a href="<?php echo esc_url( $ed2['cat_url'] ); ?>" class="cat-badge teal"><?php echo esc_html( $ed2['category'] ); ?></a>
                            <h3 class="editors-wide-title"><a href="<?php echo esc_url( $ed2['permalink'] ); ?>"><?php echo esc_html( $ed2['title'] ); ?></a></h3>
                            <div class="post-meta">by <span><?php echo esc_html( $ed2['author'] ); ?></span> &bull; <?php echo esc_html( $ed2['date'] ); ?></div>
                        </div>
                        <div class="editors-wide-thumb">
                            <a href="<?php echo esc_url( $ed2['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $ed2['thumbnail'] ); ?>" alt="<?php echo esc_attr( $ed2['title'] ); ?>">
                            </a>
                        </div>
                    </article>
                <?php endif; ?>

                <?php if ( isset( $editors_posts[2] ) ) : $ed3 = $editors_posts[2]; ?>
                    <!-- Editors Wide List 2 -->
                    <article class="editors-wide-card">
                        <div class="editors-wide-content">
                            <a href="<?php echo esc_url( $ed3['cat_url'] ); ?>" class="cat-badge blue"><?php echo esc_html( $ed3['category'] ); ?></a>
                            <h3 class="editors-wide-title"><a href="<?php echo esc_url( $ed3['permalink'] ); ?>"><?php echo esc_html( $ed3['title'] ); ?></a></h3>
                            <div class="post-meta">by <span><?php echo esc_html( $ed3['author'] ); ?></span> &bull; <?php echo esc_html( $ed3['date'] ); ?></div>
                        </div>
                        <div class="editors-wide-thumb">
                            <a href="<?php echo esc_url( $ed3['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $ed3['thumbnail'] ); ?>" alt="<?php echo esc_attr( $ed3['title'] ); ?>">
                            </a>
                        </div>
                    </article>
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
                    <article class="grid-news-card" data-category="all" data-cats="<?php echo esc_attr( $post_item['cat_slug'] ); ?>">
                        <div class="grid-news-thumb">
                            <a href="<?php echo esc_url( $post_item['permalink'] ); ?>">
                                <img src="<?php echo esc_url( $post_item['thumbnail'] ); ?>" alt="<?php echo esc_attr( $post_item['title'] ); ?>">
                            </a>
                        </div>
                        <div class="grid-news-content">
                            <a href="<?php echo esc_url( $post_item['cat_url'] ); ?>" class="cat-badge pink"><?php echo esc_html( $post_item['category'] ); ?></a>
                            <h3 class="grid-news-title">
                                <a href="<?php echo esc_url( $post_item['permalink'] ); ?>"><?php echo esc_html( $post_item['title'] ); ?></a>
                            </h3>
                            <div class="post-meta">by <span><?php echo esc_html( $post_item['author'] ); ?></span> &bull; <?php echo esc_html( $post_item['date'] ); ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</div>

<?php
get_footer();
