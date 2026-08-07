<?php
/**
 * Related Posts Module for Bhaiyyantop
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_related_posts' ) ) :
    function bhaiyyantop_related_posts() {
        $post_id = get_the_ID();
        $categories = get_the_category( $post_id );

        if ( empty( $categories ) ) {
            return;
        }

        $category_ids = array();
        foreach ( $categories as $cat ) {
            $category_ids[] = $cat->term_id;
        }

        $args = array(
            'category__in'        => $category_ids,
            'post__not_in'        => array( $post_id ),
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => 1,
            'orderby'             => 'rand',
        );

        $related_query = new WP_Query( $args );

        if ( $related_query->have_posts() ) :
            ?>
            <div class="bhaiyyantop-related-posts">
                <div class="section-title-wrap">
                    <h3 class="section-title"><i class="fa fa-newspaper"></i> सम्बंधित समाचार (Related News)</h3>
                </div>
                <div class="related-posts-grid">
                    <?php
                    while ( $related_query->have_posts() ) :
                        $related_query->the_post();
                        ?>
                        <article class="grid-news-card">
                            <div class="grid-news-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'bhaiyyantop-medium' ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/city_skyline.png' ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="grid-news-content">
                                <h4 class="grid-news-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="post-meta">
                                    by <span><?php the_author(); ?></span> &bull; <?php echo esc_html( get_the_date( 'j F, Y' ) ); ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
endif;
