<?php
/**
 * Custom Search Form Template
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-field-input" class="screen-reader-text"><?php esc_html_e( 'खोजें:', 'bhaiyyantop' ); ?></label>
    <div class="search-form-inner">
        <input type="search" id="search-field-input" class="search-field" placeholder="<?php echo esc_attr_x( 'समाचार खोजें...', 'placeholder', 'bhaiyyantop' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
        <button type="submit" class="search-submit" aria-label="<?php echo esc_attr__( 'खोजें', 'bhaiyyantop' ); ?>">
            <i class="fa fa-search"></i>
        </button>
    </div>
</form>
