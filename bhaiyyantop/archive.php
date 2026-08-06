<?php
/**
 * The template for displaying archive pages
 *
 * @package Bhaiyyantop
 */

get_header();
?>

<div class="main-wrapper">
    <div class="container theme-grid" style="grid-template-columns: 1fr 340px;">
        
        <!-- Main Content Area -->
        <main id="primary" class="site-main">
            
            <header class="section-title-wrap">
                <h1 class="section-title">
                    <?php the_archive_title(); ?>
                </h1>
            </header>

            <?php if ( have_posts() ) : ?>
                <div class="latest-news-grid" style="margin-top: 20px; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article class="grid-news-card">
                            <div class="grid-news-thumb">
                                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'bhaiyyantop-medium' ); else : ?>
                                    <div class="no-thumb" style="height:150px; background-color:#ccc;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="grid-news-content">
                                <h3 class="grid-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta">by <span><?php the_author(); ?></span> &bull; <?php echo get_the_date(); ?></div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="pagination" style="margin-top: 30px; display: flex; gap: 10px; font-weight: 700;">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '<i class="fa fa-chevron-left"></i>',
                        'next_text' => '<i class="fa fa-chevron-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <p><?php esc_html_e( 'कोई पोस्ट नहीं मिली।', 'bhaiyyantop' ); ?></p>
            <?php endif; ?>
        </main>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
