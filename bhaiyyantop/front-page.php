<?php
/**
 * The front page template file
 *
 * @package Bhaiyyantop
 */

get_header();

// Setup mock assets URLs
$theme_uri = get_template_directory_uri();
$mock_hero_gate = $theme_uri . '/assets/images/hero_india_gate.png';
$mock_diet = $theme_uri . '/assets/images/healthy_diet.png';
$mock_skyline = $theme_uri . '/assets/images/city_skyline.png';
$mock_athlete = $theme_uri . '/assets/images/athlete_running.png';
$mock_rbi = $theme_uri . '/assets/images/rbi_building.png';
$mock_herbs = $theme_uri . '/assets/images/herbs_immunity.png';
$mock_concert = $theme_uri . '/assets/images/music_concert.png';
$mock_reading = $theme_uri . '/assets/images/editor_girl_reading.png';

// Check database posts
$db_posts = get_posts( array( 'numberposts' => 10, 'post_status' => 'publish' ) );
$use_mock = empty( $db_posts );
?>

<div class="main-wrapper">
    <div class="container theme-grid">
        
        <!-- ========================================== -->
        <!-- COLUMN 1: LEFT SIDEBAR (फीचर्ड न्यूज़) -->
        <!-- ========================================== -->
        <aside class="col-left">
            <div class="section-title-wrap">
                <h2 class="section-title">फीचर्ड न्यूज़</h2>
                <a href="#" class="section-more-link">और देखें <i class="fa fa-angle-right"></i></a>
            </div>

            <div class="featured-news-list">
                <?php if ( $use_mock ) : ?>
                    <!-- Mock Item 1 -->
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <img src="<?php echo esc_url( $mock_diet ); ?>" alt="Healthy Diet">
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title"><a href="#">कम बजट में हेल्दी डाइट के टिप्स</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                    <!-- Mock Item 2 -->
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <img src="<?php echo esc_url( $mock_skyline ); ?>" alt="Celebrity Scandal">
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title"><a href="#">सेलिब्रिटी स्कैंडल: ताज़ा खुलासे और प्रतिक्रियाएं</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                    <!-- Mock Item 3 -->
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <img src="<?php echo esc_url( $mock_athlete ); ?>" alt="Athlete Running">
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title"><a href="#">चोटिल हुए स्टार एथलीट, ओलंपिक से बाहर</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                    <!-- Mock Item 4 -->
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <img src="<?php echo esc_url( $mock_rbi ); ?>" alt="RBI Building">
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title"><a href="#">RBI ने बदली रेपो रेट, जानें क्या होगा असर</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                    <!-- Mock Item 5 -->
                    <article class="mini-news-card">
                        <div class="mini-news-thumb">
                            <img src="<?php echo esc_url( $mock_herbs ); ?>" alt="Herbs Immunity">
                        </div>
                        <div class="mini-news-content">
                            <h3 class="mini-news-title"><a href="#">इम्यूनिटी बढ़ाने वाले आसान घरेलू नुस्खे</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                <?php else : 
                    // Render first 5 posts
                    $left_query = new WP_Query( array( 'posts_per_page' => 5 ) );
                    while ( $left_query->have_posts() ) : $left_query->the_post(); ?>
                        <article class="mini-news-card">
                            <div class="mini-news-thumb">
                                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-thumb' ); else : ?>
                                    <img src="<?php echo esc_url( $mock_diet ); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="mini-news-content">
                                <h3 class="mini-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata();
                endif; ?>
            </div>

            <!-- Pink Color Card Promo Box -->
            <div class="color-card-promo">
                <h3><a href="#">क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति</a></h3>
                <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
            </div>

            <!-- Advertisement Area (336x280) -->
            <div class="advertisement-box">
                <div class="ad-title">विज्ञापन स्थान</div>
                <div class="ad-size">ADVERTISEMENT AREA<br>336 x 280</div>
            </div>
        </aside>

        <!-- ========================================== -->
        <!-- COLUMN 2: MIDDLE MAIN CONTENT (Hero & Featured) -->
        <!-- ========================================== -->
        <main class="col-middle">
            
            <!-- Hero Slider -->
            <div class="hero-slider-wrap">
                <?php if ( $use_mock ) : ?>
                    <div class="hero-slide">
                        <img src="<?php echo esc_url( $mock_hero_gate ); ?>" alt="Delhi Pollution">
                        <div class="hero-overlay">
                            <span class="cat-badge pink">देश</span>
                            <h2 class="hero-title"><a href="#">दिल्ली में प्रदूषण का स्तर फिर बढ़ा, जानें कारण और बचाव के उपाय</a></h2>
                            <p class="hero-excerpt">दिल्ली-एनसीआर में वायु प्रदूषण खतरनाक स्तर पर पहुंचा। विशेषज्ञों ने लोगों को सतर्क रहने और मास्क पहनने की सलाह दी है...</p>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </div>
                <?php else :
                    $slider_query = new WP_Query( array( 'posts_per_page' => 3 ) );
                    $count = 0;
                    while ( $slider_query->have_posts() ) : $slider_query->the_post(); 
                        $cats = get_the_category();
                        $cat_name = !empty( $cats ) ? $cats[0]->name : 'समाचार';
                        ?>
                        <div class="hero-slide" style="<?php echo ($count > 0) ? 'display:none;' : ''; ?>">
                            <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-hero' ); else : ?>
                                <img src="<?php echo esc_url( $mock_hero_gate ); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="hero-overlay">
                                <span class="cat-badge pink"><?php echo esc_html( $cat_name ); ?></span>
                                <h2 class="hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="hero-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                            </div>
                        </div>
                        <?php 
                        $count++;
                    endwhile; wp_reset_postdata();
                endif; ?>
                
                <!-- Dot indicators -->
                <div class="slider-pagination">
                    <span class="slider-dot active"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                    <span class="slider-dot"></span>
                </div>
            </div>

            <!-- Middle Wide Featured Card -->
            <div class="mid-featured-story">
                <?php if ( $use_mock ) : ?>
                    <div class="mid-card-inner">
                        <div class="mid-card-content">
                            <span class="cat-badge teal">मनोरंजन</span>
                            <h3 class="mid-card-title"><a href="#">नया म्यूज़िक एल्बम रिलीज़: कलाकार की सफलता की नई उड़ान</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                        <div class="mid-card-image">
                            <img src="<?php echo esc_url( $mock_concert ); ?>" alt="Music Concert">
                        </div>
                    </div>
                <?php else :
                    // Grab 6th post (or one from entertainment category)
                    $mid_query = new WP_Query( array( 'posts_per_page' => 1, 'offset' => 5 ) );
                    if ( $mid_query->have_posts() ) : $mid_query->the_post();
                        $cats = get_the_category();
                        $cat_name = !empty( $cats ) ? $cats[0]->name : 'मनोरंजन';
                        ?>
                        <div class="mid-card-inner">
                            <div class="mid-card-content">
                                <span class="cat-badge teal"><?php echo esc_html( $cat_name ); ?></span>
                                <h3 class="mid-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                            </div>
                            <div class="mid-card-image">
                                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                    <img src="<?php echo esc_url( $mock_concert ); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; wp_reset_postdata();
                endif; ?>
            </div>
        </main>

        <!-- ========================================== -->
        <!-- COLUMN 3: RIGHT SIDEBAR (एडिटर्स चॉइस) -->
        <!-- ========================================== -->
        <aside class="col-right">
            <div class="section-title-wrap">
                <h2 class="section-title">एडिटर्स चॉइस</h2>
                <a href="#" class="section-more-link">और देखें <i class="fa fa-angle-right"></i></a>
            </div>

            <div class="editors-choice-list">
                <?php if ( $use_mock ) : ?>
                    <!-- Editors Hero Card -->
                    <article class="editors-hero-card">
                        <div class="editors-hero-image">
                            <img src="<?php echo esc_url( $mock_reading ); ?>" alt="Girl reading">
                        </div>
                        <div class="editors-hero-content">
                            <span class="cat-badge pink">बिज़नेस</span>
                            <h3 class="editors-hero-title"><a href="#">वैश्विक व्यापार पर नए टैरिफ का बाज़ारों पर क्या असर?</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>

                    <!-- Editors Wide List 1 -->
                    <article class="editors-wide-card">
                        <div class="editors-wide-content">
                            <span class="cat-badge teal">टेक्नोलॉजी</span>
                            <h3 class="editors-wide-title"><a href="#">क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                        <div class="editors-wide-thumb">
                            <img src="<?php echo esc_url( $mock_skyline ); ?>" alt="Tech Skyline">
                        </div>
                    </article>

                    <!-- Editors Wide List 2 -->
                    <article class="editors-wide-card">
                        <div class="editors-wide-content">
                            <span class="cat-badge blue">खेल</span>
                            <h3 class="editors-wide-title"><a href="#">भारत की शानदार जीत, फैंस में जश्न का माहौल</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                        <div class="editors-wide-thumb">
                            <img src="<?php echo esc_url( $mock_concert ); ?>" alt="Sports Fans">
                        </div>
                    </article>
                <?php else :
                    // Query for editors choice posts
                    $editor_query = new WP_Query( array( 'posts_per_page' => 3, 'offset' => 6 ) );
                    $count = 0;
                    while ( $editor_query->have_posts() ) : $editor_query->the_post();
                        $cats = get_the_category();
                        $cat_name = !empty( $cats ) ? $cats[0]->name : 'समाचार';
                        
                        if ( $count === 0 ) : ?>
                            <article class="editors-hero-card">
                                <div class="editors-hero-image">
                                    <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                        <img src="<?php echo esc_url( $mock_reading ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="editors-hero-content">
                                    <span class="cat-badge pink"><?php echo esc_html( $cat_name ); ?></span>
                                    <h3 class="editors-hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                                </div>
                            </article>
                        <?php else : ?>
                            <article class="editors-wide-card">
                                <div class="editors-wide-content">
                                    <span class="cat-badge teal"><?php echo esc_html( $cat_name ); ?></span>
                                    <h3 class="editors-wide-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                                </div>
                                <div class="editors-wide-thumb">
                                    <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-thumb' ); else : ?>
                                        <img src="<?php echo esc_url( $mock_skyline ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endif;
                        $count++;
                    endwhile; wp_reset_postdata();
                endif; ?>
            </div>
        </aside>

        <!-- ========================================== -->
        <!-- BOTTOM SECTION: LATEST NEWS (लेटेस्ट न्यूज़) -->
        <!-- ========================================== -->
        <section class="bottom-news-section">
            <div class="bottom-section-header">
                <h2 class="section-title">लेटेस्ट न्यूज़</h2>
                <!-- Filter Tabs -->
                <ul class="category-tabs">
                    <li><button class="cat-tab-btn active" data-category="all">सभी</button></li>
                    <li><button class="cat-tab-btn" data-category="देश">देश</button></li>
                    <li><button class="cat-tab-btn" data-category="दुनिया">दुनिया</button></li>
                    <li><button class="cat-tab-btn" data-category="बिज़नेस">बिज़नेस</button></li>
                    <li><button class="cat-tab-btn" data-category="खेल">खेल</button></li>
                    <li><button class="cat-tab-btn" data-category="तकनीक">तकनीक</button></li>
                </ul>
            </div>

            <div class="latest-news-grid">
                <?php if ( $use_mock ) : ?>
                    <!-- Card 1 -->
                    <article class="grid-news-card" data-category="all" data-cats="देश">
                        <div class="grid-news-thumb">
                            <img src="<?php echo esc_url( $mock_hero_gate ); ?>" alt="Delhi Pollution">
                        </div>
                        <div class="grid-news-content">
                            <span class="cat-badge pink">देश</span>
                            <h3 class="grid-news-title"><a href="#">दिल्ली में प्रदूषण का स्तर फिर बढ़ा, जानें कारण और बचाव के उपाय</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>

                    <!-- Card 2 -->
                    <article class="grid-news-card" data-category="all" data-cats="बिज़नेस">
                        <div class="grid-news-thumb">
                            <img src="<?php echo esc_url( $mock_reading ); ?>" alt="Business reading">
                        </div>
                        <div class="grid-news-content">
                            <span class="cat-badge pink">बिज़नेस</span>
                            <h3 class="grid-news-title"><a href="#">वैश्विक व्यापार पर नए टैरिफ का बाज़ारों पर क्या असर?</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>

                    <!-- Card 3 -->
                    <article class="grid-news-card" data-category="all" data-cats="मनोरंजन">
                        <div class="grid-news-thumb">
                            <img src="<?php echo esc_url( $mock_concert ); ?>" alt="Music concert">
                        </div>
                        <div class="grid-news-content">
                            <span class="cat-badge pink">मनोरंजन</span>
                            <h3 class="grid-news-title"><a href="#">नया म्यूज़िक एल्बम रिलीज़: कलाकार की सफलता की नई उड़ान</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>

                    <!-- Card 4 -->
                    <article class="grid-news-card" data-category="all" data-cats="तकनीक">
                        <div class="grid-news-thumb">
                            <img src="<?php echo esc_url( $mock_skyline ); ?>" alt="Tech skyline">
                        </div>
                        <div class="grid-news-content">
                            <span class="cat-badge pink">तकनीक</span>
                            <h3 class="grid-news-title"><a href="#">क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति</a></h3>
                            <div class="post-meta">by <span>bhaiyantop</span> &bull; 1 जुलाई, 2024</div>
                        </div>
                    </article>
                <?php else :
                    $latest_query = new WP_Query( array( 'posts_per_page' => 8 ) );
                    while ( $latest_query->have_posts() ) : $latest_query->the_post();
                        $cats = get_the_category();
                        $cat_slugs = array();
                        $cat_names = array();
                        foreach ( $cats as $c ) {
                            $cat_slugs[] = $c->slug;
                            $cat_names[] = $c->name;
                        }
                        $primary_cat = !empty( $cat_names ) ? $cat_names[0] : 'समाचार';
                        ?>
                        <article class="grid-news-card" data-category="all" data-cats="<?php echo esc_attr( implode( ',', $cat_names ) ); ?>">
                            <div class="grid-news-thumb">
                                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                    <img src="<?php echo esc_url( $mock_hero_gate ); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="grid-news-content">
                                <span class="cat-badge pink"><?php echo esc_html( $primary_cat ); ?></span>
                                <h3 class="grid-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata();
                endif; ?>
            </div>
        </section>

    </div>
</div>

<?php
get_footer();
