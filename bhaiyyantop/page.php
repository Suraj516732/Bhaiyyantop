<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
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
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article-container page-article' ); ?>>
                    
                    <header class="single-article-header">
                        <h1 class="single-article-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="single-featured-image">
                            <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bhaiyyantop' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        echo '<div class="bhaiyyantop-comments-area">';
                        comments_template();
                        echo '</div>';
                    endif;
                    ?>
                </article>
                <?php
            endwhile;
            ?>
        </main>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
