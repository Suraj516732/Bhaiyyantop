<?php
/**
 * Author Bio Box Component for Bhaiyyantop
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_author_box' ) ) :
    function bhaiyyantop_author_box() {
        $author_id = get_the_author_meta( 'ID' );
        $author_name = get_the_author();
        $author_bio = get_the_author_meta( 'description' );
        $author_posts_url = get_author_posts_url( $author_id );
        $author_avatar = get_avatar( $author_id, 80 );
        ?>
        <div class="bhaiyyantop-author-box">
            <div class="author-box-avatar">
                <a href="<?php echo esc_url( $author_posts_url ); ?>">
                    <?php echo $author_avatar; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </a>
            </div>
            <div class="author-box-details">
                <h4 class="author-box-name">
                    <a href="<?php echo esc_url( $author_posts_url ); ?>"><?php echo esc_html( $author_name ); ?></a>
                </h4>
                <div class="author-box-role"><?php esc_html_e( 'वरिष्ठ पत्रकार एवं लेखक', 'bhaiyyantop' ); ?></div>
                <p class="author-box-bio">
                    <?php
                    if ( ! empty( $author_bio ) ) {
                        echo esc_html( $author_bio );
                    } else {
                        echo esc_html__( 'भैय्यान्टॉप डिजिटल न्यूज़ डेस्क के लिए विशेष रिपोर्टिंग, संपादकीय विश्लेषण और ताज़ा समाचार कवरेज।', 'bhaiyyantop' );
                    }
                    ?>
                </p>
                <div class="author-box-links">
                    <a href="<?php echo esc_url( $author_posts_url ); ?>" class="author-all-posts"><i class="fa fa-newspaper"></i> <?php esc_html_e( 'लेखक की सभी ख़बरें पढ़ें', 'bhaiyyantop' ); ?></a>
                </div>
            </div>
        </div>
        <?php
    }
endif;
