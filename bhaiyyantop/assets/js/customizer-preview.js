/**
 * Bhaiyyantop Customizer Live Preview JS
 * Updates CSS Custom Properties, element text, HTML, attributes, and styles live in real-time.
 *
 * @package Bhaiyyantop
 */

(function ($) {
    'use strict';

    // Helper function to set CSS custom properties on :root
    function setCssVar(property, value) {
        document.documentElement.style.setProperty(property, value);
    }

    // 1. BRAND
    wp.customize('bhaiyyantop_logo_text_title', function (value) {
        value.bind(function (newVal) {
            $('.logo-text-banner h1, .logo-link h1').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_logo_bubble_letter', function (value) {
        value.bind(function (newVal) {
            $('.logo-bubble span').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_logo_width', function (value) {
        value.bind(function (newVal) {
            setCssVar('--logo-width', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_logo_height', function (value) {
        value.bind(function (newVal) {
            setCssVar('--logo-height', newVal + 'px');
        });
    });

    // 2. HEADER
    wp.customize('bhaiyyantop_header_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--header-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_header_overlay_opacity', function (value) {
        value.bind(function (newVal) {
            setCssVar('--header-overlay-opacity', newVal);
        });
    });

    wp.customize('bhaiyyantop_header_min_height', function (value) {
        value.bind(function (newVal) {
            setCssVar('--header-min-height', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_sticky_header_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-header-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_header_shadow', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-header-shadow', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_header_blur', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-header-blur', newVal + 'px');
        });
    });

    // 3. NAVIGATION
    wp.customize('bhaiyyantop_nav_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-text', newVal);
        });
    });

    wp.customize('bhaiyyantop_nav_hover_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-hover', newVal);
        });
    });

    wp.customize('bhaiyyantop_nav_hover_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-hover-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_nav_dropdown_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-dropdown-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_mobile_menu_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--mobile-menu-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_mobile_overlay_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--mobile-overlay-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_hamburger_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--hamburger-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_nav_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-nav-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_nav_font_size', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-font-size', newVal + 'px');
        });
    });

    // 5. BREAKING NEWS
    wp.customize('bhaiyyantop_header_notice', function (value) {
        value.bind(function (newVal) {
            $('.ticker-label span').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_breaking_news_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--breaking-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_breaking_news_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--breaking-text-color', newVal);
        });
    });

    // 6. SIDEBAR
    wp.customize('bhaiyyantop_sidebar_title_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sidebar-title-color', newVal);
        });
    });

    // 7. FOOTER
    wp.customize('bhaiyyantop_footer_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--footer-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_footer_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--footer-text', newVal);
        });
    });

    wp.customize('bhaiyyantop_footer_about_title', function (value) {
        value.bind(function (newVal) {
            $('.footer-widget:first-child h4').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_footer_about_text', function (value) {
        value.bind(function (newVal) {
            $('.footer-widget:first-child p').html(newVal);
        });
    });

    wp.customize('bhaiyyantop_footer_copyright', function (value) {
        value.bind(function (newVal) {
            $('.footer-bottom p').html(newVal);
        });
    });

    // 9. SOCIAL MEDIA
    ['facebook', 'instagram', 'twitter', 'youtube', 'linkedin', 'telegram', 'whatsapp'].forEach(function (net) {
        wp.customize('bhaiyyantop_social_' + net, function (value) {
            value.bind(function (newVal) {
                $('.social-btn.' + net + ', .footer-socials a[aria-label*="' + net + '"]').attr('href', newVal);
            });
        });
    });

    // 10. TYPOGRAPHY
    wp.customize('bhaiyyantop_body_font', function (value) {
        value.bind(function (newVal) {
            setCssVar('--font-primary', "'" + newVal + "', sans-serif");
        });
    });

    wp.customize('bhaiyyantop_heading_font', function (value) {
        value.bind(function (newVal) {
            setCssVar('--font-heading', "'" + newVal + "', sans-serif");
        });
    });

    wp.customize('bhaiyyantop_base_font_size', function (value) {
        value.bind(function (newVal) {
            document.body.style.fontSize = newVal + 'px';
        });
    });

    wp.customize('bhaiyyantop_line_height', function (value) {
        value.bind(function (newVal) {
            document.body.style.lineHeight = newVal;
        });
    });

    wp.customize('bhaiyyantop_letter_spacing', function (value) {
        value.bind(function (newVal) {
            document.body.style.letterSpacing = newVal + 'px';
        });
    });

    // 11. BUTTONS
    wp.customize('bhaiyyantop_button_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_button_secondary_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-secondary-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_button_hover', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-hover', newVal);
        });
    });

    wp.customize('bhaiyyantop_button_radius', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-radius', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_button_shadow', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-shadow', newVal);
        });
    });

    // 12. CARDS
    wp.customize('bhaiyyantop_card_border_radius', function (value) {
        value.bind(function (newVal) {
            setCssVar('--card-border-radius', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_card_shadow', function (value) {
        value.bind(function (newVal) {
            setCssVar('--card-shadow', newVal);
        });
    });

    wp.customize('bhaiyyantop_card_spacing', function (value) {
        value.bind(function (newVal) {
            setCssVar('--card-spacing', newVal + 'px');
        });
    });

    // 13. ANIMATION
    wp.customize('bhaiyyantop_transition_speed', function (value) {
        value.bind(function (newVal) {
            setCssVar('--transition-speed', newVal + 's');
        });
    });

    // 14. COLORS
    wp.customize('bhaiyyantop_primary_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--primary-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_secondary_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--secondary-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_accent_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--accent-yellow', newVal);
        });
    });

    wp.customize('bhaiyyantop_body_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--light-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--text-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_border_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--border-color', newVal);
        });
    });

    // 15. LAYOUT
    wp.customize('bhaiyyantop_container_width', function (value) {
        value.bind(function (newVal) {
            setCssVar('--container-width', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_content_gap', function (value) {
        value.bind(function (newVal) {
            setCssVar('--content-gap', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_container_radius', function (value) {
        value.bind(function (newVal) {
            setCssVar('--container-radius', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_search_placeholder', function (value) {
        value.bind(function (newVal) {
            $('.header-search-input').attr('placeholder', newVal);
        });
    });

})(jQuery);
