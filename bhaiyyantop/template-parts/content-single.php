<?php
/**
 * Template part for displaying single post content
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
$cat_link   = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '#';
$read_time  = function_exists( 'bhaiyyantop_reading_time' ) ? bhaiyyantop_reading_time() : '4 मिनट पठन';
$views      = function_exists( 'bhaiyyantop_post_views' ) ? bhaiyyantop_post_views() : '1';
?>

<!-- Reading Progress Bar -->
<div class="reading-progress-bar" id="readingProgressBar"></div>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article-container' ); ?>>

    <!-- Breadcrumb Navigation -->
    <?php
    if ( function_exists( 'bhaiyyantop_breadcrumbs' ) ) {
        bhaiyyantop_breadcrumbs();
    }
    ?>

    <!-- Article Header -->
    <header class="single-article-header">
        <a href="<?php echo esc_url( $cat_link ); ?>" class="cat-badge pink" style="font-size: 14px; padding: 4px 12px;"><?php echo esc_html( $cat_name ); ?></a>

        <h1 class="single-article-title"><?php the_title(); ?></h1>

        <div class="single-meta-bar">
            <?php
            if ( function_exists( 'bhaiyyantop_posted_by' ) ) {
                bhaiyyantop_posted_by();
            }
            ?>
            &bull;
            <?php
            if ( function_exists( 'bhaiyyantop_posted_on' ) ) {
                bhaiyyantop_posted_on();
            }
            ?>
            <span class="single-meta-badge"><i class="fa fa-clock"></i> <?php echo esc_html( $read_time ); ?></span>
            <span class="single-meta-badge"><i class="fa fa-eye"></i> <?php echo esc_html( $views ); ?> बार देखा गया</span>
        </div>
    </header>

    <!-- Content & Sticky Share Wrapper -->
    <div class="single-content-wrapper">

        <!-- Sticky Social Share Bar -->
        <?php
        if ( function_exists( 'bhaiyyantop_share_buttons' ) ) {
            bhaiyyantop_share_buttons();
        }
        ?>

        <!-- Article Main Content -->
        <div class="single-post-content">

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-featured-image">
                    <?php the_post_thumbnail( 'full' ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bhaiyyantop' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bhaiyyantop' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div>

            <!-- Author Box -->
            <?php
            if ( function_exists( 'bhaiyyantop_author_box' ) ) {
                bhaiyyantop_author_box();
            }
            ?>

            <!-- Post Navigation (Prev/Next) -->
            <nav class="bhaiyyantop-post-navigation" aria-label="Post Navigation">
                <div class="nav-link-box prev">
                    <span class="nav-label"><i class="fa fa-arrow-left"></i> पिछला समाचार</span>
                    <?php previous_post_link( '%link', '%title' ); ?>
                </div>
                <div class="nav-link-box next">
                    <span class="nav-label">अगला समाचार <i class="fa fa-arrow-right"></i></span>
                    <?php next_post_link( '%link', '%title' ); ?>
                </div>
            </nav>

            <!-- Related Posts Section -->
            <?php
            if ( function_exists( 'bhaiyyantop_related_posts' ) ) {
                bhaiyyantop_related_posts();
            }
            ?>

            <!-- Comments Section -->
            <?php
            if ( comments_open() || get_comments_number() ) :
                echo '<div class="bhaiyyantop-comments-area">';
                comments_template();
                echo '</div>';
            endif;
            ?>

        </div>
    </div>

</article>
