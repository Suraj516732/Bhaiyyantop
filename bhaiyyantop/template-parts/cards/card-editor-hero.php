<?php
/**
 * Card Component: Editor Hero Card (Alias for Card Editor)
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$args['variant'] = 'hero';
get_template_part( 'template-parts/cards/card', 'editor', $args );
