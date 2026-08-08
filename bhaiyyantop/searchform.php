<?php
/**
 * Custom Search Form Template
 * WCAG 2.1 AA Accessible Search Form with Unique ID & ARIA Labels.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$unique_id = wp_unique_id( 'search-field-' );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo esc_attr( $unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'समाचार खोजें:', 'bhaiyyantop' ); ?></label>
    <div class="search-form-inner">
        <input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'समाचार खोजें...', 'placeholder', 'bhaiyyantop' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" required aria-required="true" />
        <button type="submit" class="search-submit" aria-label="<?php echo esc_attr__( 'खोजें', 'bhaiyyantop' ); ?>">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>
