<?php
/**
 * Tag Archive Template
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<div class="main-wrapper">
    <div class="container theme-grid">
        
        <main id="primary" class="site-main">
            
            <div class="archive-header-box">
                <h1 class="archive-title"><?php single_tag_title( 'टैग: ' ); ?></h1>
                <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="cards-grid-wrapper">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/cards/card', 'grid' );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( '&laquo; पिछला', 'bhaiyyantop' ),
                        'next_text' => __( 'अगला &raquo;', 'bhaiyyantop' ),
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <div class="no-posts-found">
                    <p><?php esc_html_e( 'इस टैग से संबंधित कोई समाचार नहीं मिला।', 'bhaiyyantop' ); ?></p>
                </div>

            <?php endif; ?>

        </main>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
