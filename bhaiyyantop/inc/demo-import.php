<?php
/**
 * Bhaiyyantop One-Click Demo Content Importer
 *
 * Provides a simple, secure admin page under Appearance > Import Demo Data to populates
 * sample news categories, posts, and navigation menu.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Admin Menu Item for Demo Import
 */
function bhaiyyantop_demo_import_menu() {
    add_theme_page(
        __( 'Import Demo Data', 'bhaiyyantop' ),
        __( 'Import Demo Data', 'bhaiyyantop' ),
        'manage_options',
        'bhaiyyantop-demo-import',
        'bhaiyyantop_demo_import_page_render'
    );
}
add_action( 'admin_menu', 'bhaiyyantop_demo_import_menu' );

/**
 * Render Demo Import Admin Page
 */
function bhaiyyantop_demo_import_page_render() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'bhaiyyantop' ) );
    }

    $message = '';
    $imported = false;

    // Handle Import Action
    if ( isset( $_POST['bhaiyyantop_import_nonce'] ) && wp_verify_nonce( $_POST['bhaiyyantop_import_nonce'], 'bhaiyyantop_import_action' ) ) {
        $result = bhaiyyantop_execute_demo_import();
        if ( $result ) {
            $message = __( 'डेमो कंटेंट और कैटेगरी सफलतापूर्वक इम्पोर्ट हो गए हैं!', 'bhaiyyantop' );
            $imported = true;
        } else {
            $message = __( 'डेमो इम्पोर्ट के दौरान त्रुटि हुई। कृपया पुनः प्रयास करें।', 'bhaiyyantop' );
        }
    }
    ?>

    <div class="wrap bhaiyyantop-demo-import-wrap">
        <h1><?php esc_html_e( 'भैय्यान्टॉप - One-Click Demo Content Importer', 'bhaiyyantop' ); ?></h1>
        <p><?php esc_html_e( 'एक क्लिक में अपनी वेबसाइट पर सैंपल न्यूज़ कैटेगरी, आर्टिकल्स और प्राइमरी मेन्यू इम्पोर्ट करें।', 'bhaiyyantop' ); ?></p>

        <?php if ( ! empty( $message ) ) : ?>
            <div class="notice <?php echo $imported ? 'notice-success' : 'notice-error'; ?> is-dismissible">
                <p><strong><?php echo esc_html( $message ); ?></strong></p>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 600px; padding: 24px; margin-top: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            <h2><?php esc_html_e( 'सैंपल कंटेंट इम्पोर्ट करें', 'bhaiyyantop' ); ?></h2>
            <p><?php esc_html_e( 'इस प्रक्रिया से देश, दुनिया, बिज़नेस, खेल और टेक्नोलॉजी की ताज़ा खबरों के सैंपल पोस्ट स्वतः बन जाएंगे।', 'bhaiyyantop' ); ?></p>

            <form method="post" action="">
                <?php wp_nonce_field( 'bhaiyyantop_import_action', 'bhaiyyantop_import_nonce' ); ?>
                <button type="submit" name="bhaiyyantop_run_import" class="button button-primary button-hero" onclick="return confirm('क्या आप सैंपल डेमो डाटा इम्पोर्ट करना चाहते हैं?');">
                    <i class="dashicons dashicons-download"></i> <?php esc_html_e( 'डेमो कंटेंट इम्पोर्ट करें', 'bhaiyyantop' ); ?>
                </button>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Execute Sample Demo Import Procedure
 *
 * @return bool True on success.
 */
function bhaiyyantop_execute_demo_import() {
    // 1. Create Sample Categories
    $categories = array(
        'desh'       => 'देश',
        'duniya'     => 'दुनिया',
        'business'   => 'बिज़नेस',
        'technology' => 'टेक्नोलॉजी',
        'khel'       => 'खेल',
        'manoranjan' => 'मनोरंजन',
        'swasthya'   => 'स्वास्थ्य',
        'lifestyle'  => 'लाइफस्टाइल',
        'blog'       => 'ब्लॉग',
        'video'      => 'वीडियो',
    );

    $cat_ids = array();
    foreach ( $categories as $slug => $name ) {
        $term = get_term_by( 'slug', $slug, 'category' );
        if ( ! $term ) {
            $new_cat = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
            if ( ! is_wp_error( $new_cat ) ) {
                $cat_ids[$slug] = $new_cat['term_id'];
            }
        } else {
            $cat_ids[$slug] = $term->term_id;
        }
    }

    // 2. Create Sample Posts
    $sample_posts = array(
        array(
            'title'    => 'दिल्ली में प्रदूषण का स्तर फिर बढ़ा, जानें कारण और बचाव के उपाय',
            'content'  => 'दिल्ली-एनसीआर में वायु प्रदूषण खतरनाक स्तर पर पहुंच गया है। मौसम विशेषज्ञों और स्वास्थ्य डॉक्टरों ने बुजुर्गों व बच्चों को सुबह की सैर से बचने और मास्क पहनने की सलाह दी है। सरकार जल्द नए नियम लागू कर सकती है।',
            'excerpt'  => 'दिल्ली-एनसीआर में वायु प्रदूषण खतरनाक स्तर पर पहुंचा। विशेषज्ञों ने सतर्क रहने की सलाह दी है...',
            'category' => 'desh',
        ),
        array(
            'title'    => 'RBI ने बदली रेपो रेट, जानें होम लोन और EMI पर क्या होगा असर',
            'content'  => 'भारतीय रिजर्व बैंक की मौद्रिक नीति समिति की तीन दिवसीय समीक्षा बैठक समाप्त हो गई है। केंद्रीय बैंक ने नीतिगत ब्याज दरों (रेपो रेट) में बड़ा बदलाव घोषित किया है। इससे होम लोन और कार लोन की EMI पर सीधा असर पड़ेगा।',
            'excerpt'  => 'रिजर्व बैंक की मौद्रिक नीति समिति की बैठक के बाद नीतिगत ब्याज दरों में नया फैसला घोषित हुआ...',
            'category' => 'business',
        ),
        array(
            'title'    => 'क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति',
            'content'  => 'सुपरकंप्यूटिंग से भी लाखों गुना तेज़ काम करने वाली नई क्वांटम तकनीक से बदल जाएगी पूरी दुनिया। विज्ञानिकों ने डेटा प्रोसेसिंग और साइबर सुरक्षा में नए कीर्तिमान स्थापित किए हैं।',
            'excerpt'  => 'सुपरकंप्यूटिंग से भी लाखों गुना तेज़ काम करने वाली नई क्वांटम तकनीक से बदल जाएगी पूरी दुनिया...',
            'category' => 'technology',
        ),
        array(
            'title'    => 'चोटिल हुए स्टार एथलीट, ओलंपिक से बाहर होने की संभावना',
            'content'  => 'ट्रैक एंड फील्ड के दिग्गज खिलाड़ी ट्रेनिंग सत्र के दौरान गंभीर रूप से चोटग्रस्त हो गए हैं। मेडिकल टीम ने दो सप्ताह के आराम की सलाह दी है, जिससे आगामी टूर्नामेंट में उनकी भागीदारी संदिग्ध मानी जा रही है।',
            'excerpt'  => 'ट्रैक एंड फील्ड के दिग्गज खिलाड़ी ट्रेनिंग के दौरान चोटग्रस्त हुए, फैंस में निराशा...',
            'category' => 'khel',
        ),
        array(
            'title'    => 'कम बजट में हेल्दी डाइट के टिप्स: रोज़मर्रा के खाने में लाएं बदलाव',
            'content'  => 'स्वास्थ्य विशेषज्ञ बता रहे हैं कि किस तरह जेब पर भारी पड़े बिना आप पोषाहार से भरपूर भोजन चुन सकते हैं। मौसमी सब्जियां, दालें और फल शरीर को पर्याप्त ऊर्जा प्रदान करते हैं।',
            'excerpt'  => 'स्वास्थ्य विशेषज्ञ बता रहे हैं कि किस तरह जेब पर भारी पड़े बिना आप पोषाहार से भरपूर भोजन चुन सकते हैं...',
            'category' => 'swasthya',
        ),
    );

    foreach ( $sample_posts as $post_data ) {
        $cat_slug = $post_data['category'];
        $cat_id   = isset( $cat_ids[$cat_slug] ) ? $cat_ids[$cat_slug] : 1;

        // Check if post already exists
        $existing = get_page_by_title( $post_data['title'], OBJECT, 'post' );
        if ( ! $existing ) {
            wp_insert_post( array(
                'post_title'    => $post_data['title'],
                'post_content'  => $post_data['content'],
                'post_excerpt'  => $post_data['excerpt'],
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array( $cat_id ),
            ) );
        }
    }

    // 3. Setup Primary Menu if not assigned
    $menu_name = 'Bhaiyyantop Primary Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Add Categories to Menu
        foreach ( $categories as $slug => $name ) {
            if ( isset( $cat_ids[$slug] ) ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $name,
                    'menu-item-object'    => 'category',
                    'menu-item-object-id' => $cat_ids[$slug],
                    'menu-item-type'      => 'taxonomy',
                    'menu-item-status'    => 'publish',
                ) );
            }
        }

        // Set Menu to Primary Location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    return true;
}
