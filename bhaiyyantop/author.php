<?php
/**
 * Author Archive Template
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

$author = get_queried_object();
?>

<div class="main-wrapper">
    <div class="container theme-grid">
        
        <main id="primary" class="site-main">
            
            <div class="author-profile-card">
                <div class="author-avatar-wrapper">
                    <?php echo get_avatar( $author->ID, 100 ); ?>
                </div>
                <div class="author-info-wrapper">
                    <h1 class="author-display-name"><?php echo esc_html( $author->display_name ); ?></h1>
                    <?php if ( get_the_author_meta( 'description', $author->ID ) ) : ?>
                        <p class="author-bio"><?php echo esc_html( get_the_author_meta( 'description', $author->ID ) ); ?></p>
                    <?php else : ?>
                        <p class="author-bio"><?php esc_html_e( 'भैय्यान्टॉप डिजिटल न्यूज़ डेस्क के वरिष्ठ लेखक और पत्रकार।', 'bhaiyyantop' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="archive-header-box" style="margin-top: 24px;">
                <h2 class="archive-title"><?php printf( esc_html__( '%s के सभी प्रकाशित लेख', 'bhaiyyantop' ), esc_html( $author->display_name ) ); ?></h2>
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
                    <p><?php esc_html_e( 'इस लेखक द्वारा अभी तक कोई समाचार प्रकाशित नहीं किया गया है।', 'bhaiyyantop' ); ?></p>
                </div>

            <?php endif; ?>

        </main>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
