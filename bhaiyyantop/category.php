<?php
/**
 * Custom Category Template for Bhaiyyantop
 * Renders custom layout structures per category slug while keeping the brand color scheme.
 *
 * @package Bhaiyyantop
 */

get_header();

$current_cat = get_queried_object();
$cat_slug    = isset( $current_cat->slug ) ? $current_cat->slug : 'general';
$cat_name    = isset( $current_cat->name ) ? $current_cat->name : single_cat_title( '', false );

// Map category slugs to icons & titles
$cat_icons = array(
    'desh'       => 'fa-flag',
    'duniya'     => 'fa-globe-asia',
    'business'   => 'fa-chart-line',
    'technology' => 'fa-laptop-code',
    'khel'       => 'fa-trophy',
    'manoranjan' => 'fa-film',
    'swasthya'   => 'fa-heart-pulse',
    'lifestyle'  => 'fa-shirt',
    'blog'       => 'fa-feather-pointed',
    'video'      => 'fa-circle-play',
);
$cat_icon = isset( $cat_icons[ $cat_slug ] ) ? $cat_icons[ $cat_slug ] : 'fa-newspaper';
?>

<!-- Category Header Banner -->
<div class="category-banner">
    <div class="container category-banner-inner">
        <div class="category-title-area">
            <h1>
                <span class="category-icon-badge"><i class="fa <?php echo esc_attr( $cat_icon ); ?>"></i></span>
                <?php echo esc_html( $cat_name ); ?>
            </h1>
            <div class="category-desc">
                <?php echo category_description() ? category_description() : esc_html( $cat_name ) . ' की सभी प्रमुख एवं ताज़ा ख़बरें और विशेष रिपोर्ट'; ?>
            </div>
        </div>
        <div class="category-breadcrumbs">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home"></i> होम</a>
            <i class="fa fa-angle-right"></i>
            <span><?php echo esc_html( $cat_name ); ?></span>
        </div>
    </div>
</div>

<div class="main-wrapper">
    <div class="container">

        <?php
        // ----------------------------------------------------
        // 1. BUSINESS CATEGORY CUSTOM STRUCTURE
        // ----------------------------------------------------
        if ( $cat_slug === 'business' ) :
        ?>
            <!-- Live Stock Market Ticker Strip -->
            <div class="market-ticker-strip">
                <div class="market-ticker-inner">
                    <div class="market-item">
                        <span class="market-name">BSE SENSEX:</span>
                        <span class="market-val">79,842.15</span>
                        <span class="market-change up"><i class="fa fa-caret-up"></i> +620.40 (0.78%)</span>
                    </div>
                    <div class="market-item">
                        <span class="market-name">NSE NIFTY 50:</span>
                        <span class="market-val">24,312.80</span>
                        <span class="market-change up"><i class="fa fa-caret-up"></i> +185.10 (0.77%)</span>
                    </div>
                    <div class="market-item">
                        <span class="market-name">GOLD (10g):</span>
                        <span class="market-val">₹72,450</span>
                        <span class="market-change down"><i class="fa fa-caret-down"></i> -120 (-0.16%)</span>
                    </div>
                </div>
            </div>
        <?php
        // ----------------------------------------------------
        // 2. KHEL (SPORTS) CATEGORY CUSTOM STRUCTURE
        // ----------------------------------------------------
        elseif ( $cat_slug === 'khel' ) :
        ?>
            <!-- Live Scoreboard Widget -->
            <div class="khel-scoreboard">
                <div class="scoreboard-header">
                    <span><i class="fa fa-trophy"></i> T20 International Series</span>
                    <span class="live-tag">LIVE</span>
                </div>
                <div class="scoreboard-body">
                    <div class="team-box">
                        <span class="team-flag">🇮🇳</span>
                        <span class="team-name">भारत (IND)</span>
                        <span class="team-score">186/4 (20 ov)</span>
                    </div>
                    <div class="vs-badge">VS</div>
                    <div class="team-box">
                        <span class="team-flag">🇦🇺</span>
                        <span class="team-name">ऑस्ट्रेलिया (AUS)</span>
                        <span class="team-score">142/8 (17.4 ov)</span>
                    </div>
                </div>
            </div>
        <?php
        // ----------------------------------------------------
        // 3. SWASTHYA (HEALTH) CATEGORY CUSTOM STRUCTURE
        // ----------------------------------------------------
        elseif ( $cat_slug === 'swasthya' ) :
        ?>
            <!-- Health Tip Banner -->
            <div class="health-tip-banner">
                <div class="health-tip-icon">
                    <i class="fa fa-heart-pulse"></i>
                </div>
                <div class="health-tip-content">
                    <h3>आज का विशेष स्वास्थ्य सुझाव</h3>
                    <p>रोज़ाना कम से कम 8 गिलास पानी पीएं और सुबह 20 मिनट योग या वॉकिंग को अपनी दिनचर्या में शामिल करें।</p>
                </div>
            </div>
        <?php
        // ----------------------------------------------------
        // 4. DUNIYA (WORLD) CATEGORY CUSTOM STRUCTURE
        // ----------------------------------------------------
        elseif ( $cat_slug === 'duniya' ) :
        ?>
            <!-- Continent Filter Bar -->
            <div class="continent-filter-bar">
                <button class="continent-btn active">सभी क्षेत्र</button>
                <button class="continent-btn">एशिया</button>
                <button class="continent-btn">यूरोप</button>
                <button class="continent-btn">अमेरिका</button>
                <button class="continent-btn">मिडिल ईस्ट</button>
            </div>
        <?php endif; ?>

        <!-- Category Grid Layout -->
        <div class="theme-grid" style="grid-template-columns: 1fr 340px;">
            <main id="primary" class="site-main">

                <?php if ( have_posts() ) : ?>

                    <?php if ( $cat_slug === 'video' ) : ?>
                        <!-- VIDEO GRID FORMAT -->
                        <div class="latest-news-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="grid-news-card poster-card">
                                    <div class="grid-news-thumb" style="position: relative;">
                                        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/city_skyline.png" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="play-icon-overlay"><i class="fa fa-play"></i></div>
                                        <span class="video-duration-badge">03:45</span>
                                    </div>
                                    <div class="grid-news-content">
                                        <h3 class="grid-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>

                    <?php elseif ( $cat_slug === 'blog' ) : ?>
                        <!-- EDITORIAL BLOG FORMAT -->
                        <div class="blog-posts-list">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="editorial-post-card">
                                    <div class="author-meta-box">
                                        <div class="author-avatar"><?php echo mb_substr( get_the_author(), 0, 1 ); ?></div>
                                        <div>
                                            <strong><?php the_author(); ?></strong>
                                            <div style="font-size:12px; color:#666;"><?php echo get_the_date(); ?></div>
                                        </div>
                                        <span class="read-time-pill" style="margin-left:auto;"><i class="fa fa-clock"></i> 4 मिनट पठन</span>
                                    </div>
                                    <h2 style="font-size:22px; font-weight:800; margin-bottom:12px;"><a href="<?php the_permalink(); ?>" style="color:#111; text-decoration:none;"><?php the_title(); ?></a></h2>
                                    <p style="color:#444; line-height:1.6; margin-bottom:15px;"><?php echo get_the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="read-more-link" style="color:#e91e63; font-weight:700; text-decoration:none;">पूरा लेख पढ़ें <i class="fa fa-arrow-right"></i></a>
                                </article>
                            <?php endwhile; ?>
                        </div>

                    <?php elseif ( $cat_slug === 'manoranjan' ) : ?>
                        <!-- MANORANJAN POSTER GRID FORMAT -->
                        <div class="latest-news-grid" style="grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="poster-card">
                                    <div class="grid-news-thumb">
                                        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/music_concert.png" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="grid-news-content" style="padding:15px;">
                                        <span class="star-rating-badge"><i class="fa fa-star"></i> 4.5/5 रिव्यू</span>
                                        <h3 class="grid-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>
                        <!-- STANDARD / DESH / TECH / LIFESTYLE GRID FORMAT -->
                        <div class="latest-news-grid">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="grid-news-card">
                                    <div class="grid-news-thumb">
                                        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/city_skyline.png" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="grid-news-content">
                                        <h3 class="grid-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <div class="pagination" style="margin-top: 30px; display: flex; gap: 10px; font-weight: 700;">
                        <?php
                        echo paginate_links( array(
                            'prev_text' => '<i class="fa fa-chevron-left"></i>',
                            'next_text' => '<i class="fa fa-chevron-right"></i>',
                        ) );
                        ?>
                    </div>

                <?php else : ?>
                    <div style="background:#fff; padding:30px; border-radius:8px; text-align:center;">
                        <h3>इस कैटेगरी में वर्तमान में कोई समाचार पोस्ट नहीं है।</h3>
                        <p style="margin-top:10px; color:#666;">कृपया अन्य श्रेणियों की जांच करें।</p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="subscribe-btn" style="display:inline-block; margin-top:15px; text-decoration:none;">मुख्य पृष्ठ पर जाएं</a>
                    </div>
                <?php endif; ?>

            </main>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php
get_footer();
