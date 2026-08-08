<?php
/**
 * Post Fetching and Data Retrieval Helper Functions
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Fetch Breaking News Ticker Posts with Transient Caching.
 *
 * @param int $count Number of ticker items.
 * @return array List of ticker post objects.
 */
function bhaiyyantop_get_ticker_posts( $count = 5 ) {
    $count = absint( $count );
    if ( $count <= 0 ) {
        $count = 5;
    }

    $transient_key = 'bhaiyyantop_ticker_posts_' . $count;
    $ticker_posts  = get_transient( $transient_key );

    if ( false === $ticker_posts ) {
        $query_args = array(
            'posts_per_page'         => $count,
            'post_status'            => 'publish',
            'no_found_rows'          => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'suppress_filters'       => true,
        );

        $ticker_posts = get_posts( $query_args );
        if ( ! is_array( $ticker_posts ) ) {
            $ticker_posts = array();
        }

        set_transient( $transient_key, $ticker_posts, 5 * MINUTE_IN_SECONDS );
    }

    return $ticker_posts;
}

/**
 * Fetch Recent Posts or Return Dynamic Fallback Content with Query Optimizations.
 *
 * @param array $args Parameters for posts query (numberposts, category, exclude, orderby, order).
 * @return array List of post objects or formatted post arrays.
 */
function bhaiyyantop_get_recent_posts( $args = array() ) {
    $defaults = array(
        'numberposts' => 10,
        'category'    => '',
        'exclude'     => array(),
        'orderby'     => 'date',
        'order'       => 'DESC',
    );

    $parsed_args   = wp_parse_args( $args, $defaults );
    $transient_key = 'bhaiyyantop_recent_posts_' . md5( serialize( $parsed_args ) );
    $cached_posts  = get_transient( $transient_key );

    if ( false !== $cached_posts && is_array( $cached_posts ) ) {
        return $cached_posts;
    }

    $posts = array();

    if ( function_exists( 'get_posts' ) ) {
        $query_args = array(
            'posts_per_page'         => absint( $parsed_args['numberposts'] ),
            'post_status'            => 'publish',
            'orderby'                => sanitize_key( $parsed_args['orderby'] ),
            'order'                  => 'ASC' === strtoupper( $parsed_args['order'] ) ? 'ASC' : 'DESC',
            'no_found_rows'          => true,
            'update_post_term_cache' => true,
            'update_post_meta_cache' => true,
        );

        if ( ! empty( $parsed_args['category'] ) ) {
            $query_args['category_name'] = sanitize_title( $parsed_args['category'] );
        }

        if ( ! empty( $parsed_args['exclude'] ) ) {
            $query_args['post__not_in'] = array_map( 'absint', (array) $parsed_args['exclude'] );
        }

        $wp_posts = get_posts( $query_args );

        if ( ! empty( $wp_posts ) ) {
            foreach ( $wp_posts as $p ) {
                $cats      = get_the_category( $p->ID );
                $cat_name  = ! empty( $cats ) ? $cats[0]->name : __( 'समाचार', 'bhaiyyantop' );
                $cat_slug  = ! empty( $cats ) ? $cats[0]->slug : 'samachar';
                $thumb_id  = get_post_thumbnail_id( $p->ID );
                $thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'bhaiyyantop-medium' ) : '';

                $posts[] = array(
                    'id'        => $p->ID,
                    'title'     => get_the_title( $p ),
                    'permalink' => get_permalink( $p ),
                    'date'      => get_the_date( 'j F, Y', $p ),
                    'author'    => get_the_author_meta( 'display_name', $p->post_author ),
                    'category'  => $cat_name,
                    'cat_slug'  => $cat_slug,
                    'cat_url'   => bhaiyyantop_get_category_url( $cat_slug ),
                    'thumbnail' => $thumb_url,
                    'excerpt'   => get_the_excerpt( $p ),
                );
            }

            set_transient( $transient_key, $posts, 15 * MINUTE_IN_SECONDS );
            return $posts;
        }
    }

    $mock_posts = bhaiyyantop_get_mock_posts( $parsed_args );
    set_transient( $transient_key, $mock_posts, 15 * MINUTE_IN_SECONDS );
    return $mock_posts;
}

/**
 * Fallback Mock Data Generator for Local Development or Empty Database.
 *
 * @param array $args Query parameters.
 * @return array Array of mock post data.
 */
function bhaiyyantop_get_mock_posts( $args = array() ) {
    static $mock_all = null;

    if ( null === $mock_all ) {
        $theme_uri = get_template_directory_uri();
        $mock_all  = array(
            array(
                'id'        => 101,
                'title'     => 'दिल्ली में प्रदूषण का स्तर फिर बढ़ा, जानें कारण और बचाव के उपाय',
                'permalink' => bhaiyyantop_get_category_url( 'desh' ) . '#post-101',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'देश',
                'cat_slug'  => 'desh',
                'cat_url'   => bhaiyyantop_get_category_url( 'desh' ),
                'thumbnail' => $theme_uri . '/assets/images/hero_india_gate.png',
                'excerpt'   => 'दिल्ली-एनसीआर में वायु प्रदूषण खतरनाक स्तर पर पहुंचा। विशेषज्ञों ने लोगों को सतर्क रहने और मास्क पहनने की सलाह दी है...',
            ),
            array(
                'id'        => 102,
                'title'     => 'कम बजट में हेल्दी डाइट के टिप्स: रोज़मर्रा के खाने में लाएं बदलाव',
                'permalink' => bhaiyyantop_get_category_url( 'swasthya' ) . '#post-102',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'स्वास्थ्य',
                'cat_slug'  => 'swasthya',
                'cat_url'   => bhaiyyantop_get_category_url( 'swasthya' ),
                'thumbnail' => $theme_uri . '/assets/images/healthy_diet.png',
                'excerpt'   => 'स्वास्थ्य विशेषज्ञ बता रहे हैं कि किस तरह जेब पर भारी पड़े बिना आप पोषाहार से भरपूर भोजन चुन सकते हैं...',
            ),
            array(
                'id'        => 103,
                'title'     => 'सेलिब्रिटी स्कैंडल: ताज़ा खुलासे और बॉलीवुड की प्रतिक्रियाएं',
                'permalink' => bhaiyyantop_get_category_url( 'manoranjan' ) . '#post-103',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'मनोरंजन',
                'cat_slug'  => 'manoranjan',
                'cat_url'   => bhaiyyantop_get_category_url( 'manoranjan' ),
                'thumbnail' => $theme_uri . '/assets/images/city_skyline.png',
                'excerpt'   => 'मनोरंजन जगत से आ रही बड़ी खबरें और विवादों पर बॉलीवुड सितारों के बयान...',
            ),
            array(
                'id'        => 104,
                'title'     => 'चोटिल हुए स्टार एथलीट, ओलंपिक 2024 से बाहर होने की संभावना',
                'permalink' => bhaiyyantop_get_category_url( 'khel' ) . '#post-104',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'खेल',
                'cat_slug'  => 'khel',
                'cat_url'   => bhaiyyantop_get_category_url( 'khel' ),
                'thumbnail' => $theme_uri . '/assets/images/athlete_running.png',
                'excerpt'   => 'ट्रैक एंड फील्ड के दिग्गज खिलाड़ी ट्रेनिंग के दौरान चोटग्रस्त हुए, फैंस में निराशा...',
            ),
            array(
                'id'        => 105,
                'title'     => 'RBI ने बदली रेपो रेट, जानें होम लोन और EMI पर क्या होगा असर',
                'permalink' => bhaiyyantop_get_category_url( 'business' ) . '#post-105',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'बिज़नेस',
                'cat_slug'  => 'business',
                'cat_url'   => bhaiyyantop_get_category_url( 'business' ),
                'thumbnail' => $theme_uri . '/assets/images/rbi_building.png',
                'excerpt'   => 'रिजर्व बैंक की मौद्रिक नीति समिति की बैठक के बाद नीतिगत ब्याज दरों में नया फैसला घोषित हुआ...',
            ),
            array(
                'id'        => 106,
                'title'     => 'इम्यूनिटी बढ़ाने वाले आसान घरेलू नुस्खे: आयुर्वेद की शक्ति',
                'permalink' => bhaiyyantop_get_category_url( 'swasthya' ) . '#post-106',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'स्वास्थ्य',
                'cat_slug'  => 'swasthya',
                'cat_url'   => bhaiyyantop_get_category_url( 'swasthya' ),
                'thumbnail' => $theme_uri . '/assets/images/herbs_immunity.png',
                'excerpt'   => 'रसोई में रखी साधारण सामग्रियां आपकी रोग प्रतिरोधक क्षमता को दोगुना बढ़ा सकती हैं...',
            ),
            array(
                'id'        => 107,
                'title'     => 'क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति',
                'permalink' => bhaiyyantop_get_category_url( 'technology' ) . '#post-107',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'टेक्नोलॉजी',
                'cat_slug'  => 'technology',
                'cat_url'   => bhaiyyantop_get_category_url( 'technology' ),
                'thumbnail' => $theme_uri . '/assets/images/editor_girl_reading.png',
                'excerpt'   => 'सुपरकंप्यूटिंग से भी लाखों गुना तेज़ काम करने वाली नई क्वांटम तकनीक से बदल जाएगी पूरी दुनिया...',
            ),
            array(
                'id'        => 108,
                'title'     => 'नया म्यूज़िक एल्बम रिलीज़: कलाकार की सफलता की नई उड़ान',
                'permalink' => bhaiyyantop_get_category_url( 'manoranjan' ) . '#post-108',
                'date'      => '1 जुलाई, 2024',
                'author'    => 'bhaiyantop',
                'category'  => 'मनोरंजन',
                'cat_slug'  => 'manoranjan',
                'cat_url'   => bhaiyyantop_get_category_url( 'manoranjan' ),
                'thumbnail' => $theme_uri . '/assets/images/music_concert.png',
                'excerpt'   => 'संगीत की दुनिया में छा गया नया एल्बम, यूट्यूब और स्पॉटीफाई पर मिलियन व्यूज पार...',
            ),
        );
    }

    $results = $mock_all;

    if ( ! empty( $args['category'] ) ) {
        $filtered    = array();
        $target_slug = strtolower( trim( $args['category'] ) );
        foreach ( $results as $item ) {
            if ( strtolower( $item['cat_slug'] ) === $target_slug || strtolower( $item['category'] ) === $target_slug ) {
                $filtered[] = $item;
            }
        }
        if ( ! empty( $filtered ) ) {
            $results = $filtered;
        }
    }

    $number = isset( $args['numberposts'] ) ? absint( $args['numberposts'] ) : 10;
    return array_slice( $results, 0, $number );
}
