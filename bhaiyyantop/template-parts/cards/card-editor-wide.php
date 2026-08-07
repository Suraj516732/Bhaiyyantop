<?php
/**
 * Card Component: Editor Wide Card (Alias for Card Editor)
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$args['variant'] = 'wide';
get_template_part( 'template-parts/cards/card', 'editor', $args );
