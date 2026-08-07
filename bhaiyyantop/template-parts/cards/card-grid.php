<?php
/**
 * Card Component: Grid Card (Alias for Card Category)
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_template_part( 'template-parts/cards/card', 'category', $args );
