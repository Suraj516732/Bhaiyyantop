<?php
/**
 * The template for displaying all single posts
 *
 * @package Bhaiyyantop
 */

get_header();
?>

<div class="main-wrapper">
    <div class="container theme-grid" style="grid-template-columns: 1fr 340px;">
        
        <!-- Main Content Area -->
        <main id="primary" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'main-content-area' ); ?>>
                    <header class="post-header">
                        <?php
                        $cats = get_the_category();
                        if ( ! empty( $cats ) ) :
                            echo '<span class="cat-badge pink">' . esc_html( $cats[0]->name ) . '</span>';
                        endif;
                        ?>
                        <h1><?php the_title(); ?></h1>
                        <div class="post-meta">
                            by <span><?php the_author(); ?></span> &bull; 
                            <?php echo get_the_date(); ?> &bull; 
                            <i class="fa fa-comment"></i> <?php comments_number( '0 टिप्पणियां', '1 टिप्पणी', '% टिप्पणियां' ); ?>
                        </div>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail-single">
                            <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bhaiyyantop' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'bhaiyyantop' ) );
                        if ( $tags_list ) {
                            /* translators: 1: list of tags. */
                            printf( '<span class="tags-links">' . esc_html__( 'टैग्स: %1$s', 'bhaiyyantop' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }
                        ?>
                    </footer>
                </article>
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
