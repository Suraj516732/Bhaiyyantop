<?php
/**
 * The template for displaying comments
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf( esc_html__( '1 टिप्पणी', 'bhaiyyantop' ) );
            } else {
                printf( esc_html( _nx( '%1$s टिप्पणी', '%1$s टिप्पणियां', $comment_count, 'comments title', 'bhaiyyantop' ) ), number_format_i18n( $comment_count ) );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'टिप्पणी अनुभाग बंद है।', 'bhaiyyantop' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'         => __( 'अपनी प्रतिक्रिया दें', 'bhaiyyantop' ),
        'title_reply_to'      => __( '%s को जवाब दें', 'bhaiyyantop' ),
        'cancel_reply_link'   => __( 'रद्द करें', 'bhaiyyantop' ),
        'label_submit'        => __( 'टिप्पणी पोस्ट करें', 'bhaiyyantop' ),
        'class_submit'        => 'submit-btn-pink',
    ) );
    ?>

</div>
