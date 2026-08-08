<?php
/**
 * The template for displaying the footer
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$home_url     = home_url( '/' );
$social_links = array(
    'facebook'  => array( 'url' => get_theme_mod( 'bhaiyyantop_social_facebook' ),  'icon' => 'fab fa-facebook-f',  'label' => 'Facebook' ),
    'twitter'   => array( 'url' => get_theme_mod( 'bhaiyyantop_social_twitter' ),   'icon' => 'fab fa-twitter',     'label' => 'Twitter' ),
    'instagram' => array( 'url' => get_theme_mod( 'bhaiyyantop_social_instagram' ), 'icon' => 'fab fa-instagram',   'label' => 'Instagram' ),
    'youtube'   => array( 'url' => get_theme_mod( 'bhaiyyantop_social_youtube' ),   'icon' => 'fab fa-youtube',     'label' => 'YouTube' ),
    'telegram'  => array( 'url' => get_theme_mod( 'bhaiyyantop_social_telegram' ),  'icon' => 'fab fa-telegram',    'label' => 'Telegram' ),
    'whatsapp'  => array( 'url' => get_theme_mod( 'bhaiyyantop_social_whatsapp' ),  'icon' => 'fab fa-whatsapp',    'label' => 'WhatsApp' ),
    'linkedin'  => array( 'url' => get_theme_mod( 'bhaiyyantop_social_linkedin' ),  'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn' ),
);
?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <h4><?php echo esc_html( get_theme_mod( 'bhaiyyantop_footer_about_title', __( 'हमारे बारे में', 'bhaiyyantop' ) ) ); ?></h4>
                    <p><?php echo wp_kses_post( get_theme_mod( 'bhaiyyantop_footer_about_text', __( 'भैय्यान्टॉप भारत का एक अग्रणी न्यूज़ पोर्टल है जो नवीनतम समाचार, राजनीति, खेल, मनोरंजन और तकनीकी जगत की ख़बरें हिंदी में प्रदान करता है।', 'bhaiyyantop' ) ) ); ?></p>
                </div>
                <?php if ( get_theme_mod( 'bhaiyyantop_footer_quick_links_enable', true ) ) : ?>
                <div class="footer-widget">
                    <h4><?php esc_html_e( 'मुख्य श्रेणियां', 'bhaiyyantop' ); ?></h4>
                    <ul>
                        <?php
                        $categories = function_exists( 'bhaiyyantop_get_all_categories' ) ? bhaiyyantop_get_all_categories() : array();
                        $count      = 0;
                        foreach ( $categories as $cat_info ) {
                            if ( $count >= 5 ) {
                                break;
                            }
                            echo '<li><a href="' . esc_url( $cat_info['url'] ) . '">' . esc_html( $cat_info['name'] ) . '</a></li>';
                            $count++;
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="footer-widget">
                    <h4><?php esc_html_e( 'सामाजिक और संपर्क', 'bhaiyyantop' ); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'मुख्य पृष्ठ (Home)', 'bhaiyyantop' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'फेसबुक पेज़', 'bhaiyyantop' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'यूट्यूब चैनल', 'bhaiyyantop' ); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Banner Ad Slot -->
            <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'footer_banner' ); ?>

            <div class="footer-bottom">
                <p><?php echo wp_kses_post( get_theme_mod( 'bhaiyyantop_footer_copyright', sprintf( __( '© %s भैय्यान्टॉप. सर्वाधिकार सुरक्षित।', 'bhaiyyantop' ), date( 'Y' ) ) ) ); ?></p>
                <?php if ( get_theme_mod( 'bhaiyyantop_footer_social_icons_enable', true ) ) : ?>
                <div class="footer-socials" aria-label="<?php esc_attr_e( 'Footer Social Links', 'bhaiyyantop' ); ?>">
                    <?php foreach ( $social_links as $key => $social ) : ?>
                        <?php if ( ! empty( $social['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $social['url'] ); ?>" class="social-btn <?php echo esc_attr( $key ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social['label'] ); ?>"><i class="<?php echo esc_attr( $social['icon'] ); ?>" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
