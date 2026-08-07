<?php
/**
 * The main blog posts index template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
                <h1 class="archive-title"><?php single_post_title(); ?></h1>
                <p class="archive-description"><?php esc_html_e( 'नवीनतम समाचार और मुख्य लेख', 'bhaiyyantop' ); ?></p>
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
                    <h2><?php esc_html_e( 'कोई लेख नहीं मिला', 'bhaiyyantop' ); ?></h2>
                    <p><?php esc_html_e( 'क्षमा करें, आपके अनुरोध के अनुसार कोई समाचार उपलब्ध नहीं है।', 'bhaiyyantop' ); ?></p>
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </main>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
