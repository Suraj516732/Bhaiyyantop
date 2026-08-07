<?php
/**
 * The template for displaying the footer
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <h4><?php esc_html_e( 'हमारे बारे में', 'bhaiyyantop' ); ?></h4>
                    <p><?php esc_html_e( 'भैय्यान्टॉप भारत का एक अग्रणी न्यूज़ पोर्टल है जो नवीनतम समाचार, राजनीति, खेल, मनोरंजन और तकनीकी जगत की ख़बरें हिंदी में प्रदान करता है।', 'bhaiyyantop' ); ?></p>
                </div>
                <div class="footer-widget">
                    <h4><?php esc_html_e( 'मुख्य श्रेणियां', 'bhaiyyantop' ); ?></h4>
                    <ul>
                        <?php
                        $categories = function_exists('bhaiyyantop_get_all_categories') ? bhaiyyantop_get_all_categories() : array();
                        $count = 0;
                        foreach ( $categories as $slug => $cat_info ) {
                            if ( $count >= 5 ) break;
                            echo '<li><a href="' . esc_url( $cat_info['url'] ) . '">' . esc_html( $cat_info['name'] ) . '</a></li>';
                            $count++;
                        }
                        ?>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4><?php esc_html_e( 'सामाजिक और संपर्क', 'bhaiyyantop' ); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'मुख्य पृष्ठ (Home)', 'bhaiyyantop' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>"><?php esc_html_e( 'फेसबुक पेज़', 'bhaiyyantop' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>"><?php esc_html_e( 'यूट्यूब चैनल', 'bhaiyyantop' ); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p><?php echo wp_kses_post( get_theme_mod( 'bhaiyyantop_footer_copyright', sprintf( __( '© %s भैय्यान्टॉप. सर्वाधिकार सुरक्षित।', 'bhaiyyantop' ), date( 'Y' ) ) ) ); ?></p>
                <div class="footer-socials">
                    <?php if ( get_theme_mod( 'bhaiyyantop_social_facebook' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_facebook', '#' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'bhaiyyantop_social_twitter' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_twitter', '#' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'bhaiyyantop_social_instagram' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_instagram', '#' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'bhaiyyantop_social_youtube' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_youtube', '#' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'bhaiyyantop_social_telegram' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'bhaiyyantop_social_telegram', '#' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><i class="fab fa-telegram"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
