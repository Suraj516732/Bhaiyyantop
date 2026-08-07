<?php
/**
 * Sticky Social Share Buttons for Single Posts
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_share_buttons' ) ) :
    function bhaiyyantop_share_buttons() {
        $post_url   = urlencode( get_permalink() );
        $post_title = urlencode( get_the_title() );

        $whatsapp_url = 'https://api.whatsapp.com/send?text=' . $post_title . '%20' . $post_url;
        $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
        $twitter_url  = 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_url;
        $telegram_url = 'https://t.me/share/url?url=' . $post_url . '&text=' . $post_title;
        $linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url;
        ?>
        <div class="bhaiyyantop-social-share" id="socialShareBar">
            <span class="share-label"><i class="fa fa-share-nodes"></i> शेयर करें</span>
            <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn whatsapp" title="WhatsApp पर शेयर करें">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn facebook" title="Facebook पर शेयर करें">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn twitter" title="X (Twitter) पर शेयर करें">
                <i class="fab fa-x-twitter"></i>
            </a>
            <a href="<?php echo esc_url( $telegram_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn telegram" title="Telegram पर शेयर करें">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn linkedin" title="LinkedIn पर शेयर करें">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <button type="button" class="share-btn copy-link" id="copyShareLinkBtn" data-link="<?php echo esc_url( get_permalink() ); ?>" title="लिंक कॉपी करें">
                <i class="fa fa-link"></i>
            </button>
        </div>
        <?php
    }
endif;
