/**
 * Bhaiyyantop Customizer Live Preview Handler
 * Updates CSS variables, DOM properties, text nodes, and images in real-time.
 *
 * @package Bhaiyyantop
 */

(function ($) {
    'use strict';

    // Helper: Update CSS root custom property
    function setCssVar(varName, value) {
        document.documentElement.style.setProperty(varName, value);
    }

    // 1. BRAND & LOGO
    wp.customize('bhaiyyantop_logo', function (value) {
        value.bind(function (newVal) {
            if (newVal) {
                $('.logo-container img.custom-logo').attr('src', newVal);
            }
        });
    });

    wp.customize('bhaiyyantop_retina_logo', function (value) {
        value.bind(function (newVal) {
            if (newVal) {
                var currentSrc = $('.logo-container img.custom-logo').attr('src');
                $('.logo-container img.custom-logo').attr('srcset', currentSrc + ' 1x, ' + newVal + ' 2x');
            }
        });
    });

    wp.customize('bhaiyyantop_logo_text_title', function (value) {
        value.bind(function (newVal) {
            $('.logo-link').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_logo_bubble_letter', function (value) {
        value.bind(function (newVal) {
            $('.logo-bubble-char').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_logo_width', function (value) {
        value.bind(function (newVal) {
            setCssVar('--logo-max-width', newVal + 'px');
            $('.custom-logo').css('max-width', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_logo_height', function (value) {
        value.bind(function (newVal) {
            setCssVar('--logo-max-height', newVal + 'px');
            $('.custom-logo').css('max-height', newVal + 'px');
        });
    });

    // 2. HEADER
    wp.customize('bhaiyyantop_header_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--header-bg', newVal);
            $('.site-header').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_header_bg_image', function (value) {
        value.bind(function (newVal) {
            if (newVal) {
                $('.site-header').css('background-image', 'url(' + newVal + ')');
            } else {
                $('.site-header').css('background-image', 'none');
            }
        });
    });

    wp.customize('bhaiyyantop_header_overlay_opacity', function (value) {
        value.bind(function (newVal) {
            var bgImg = wp.customize('bhaiyyantop_header_bg_image')();
            if (bgImg) {
                var gradient = 'linear-gradient(to bottom, rgba(0, 188, 212, ' + newVal + ') 0%, rgba(0, 188, 212, ' + newVal + ') 100%), url(' + bgImg + ')';
                $('.site-header').css('background-image', gradient);
            }
        });
    });

    wp.customize('bhaiyyantop_header_min_height', function (value) {
        value.bind(function (newVal) {
            setCssVar('--header-min-height', newVal + 'px');
            $('.site-header').css('min-height', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_sticky_header_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-nav-bg', newVal);
            $('.bhaiyyantop-sticky-navbar').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_header_shadow', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-nav-shadow', newVal);
            $('.bhaiyyantop-sticky-navbar').css('box-shadow', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_header_blur', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-nav-blur', newVal + 'px');
            $('.bhaiyyantop-sticky-navbar').css('backdrop-filter', 'blur(' + newVal + 'px)');
        });
    });

    // 3. NAVIGATION
    wp.customize('bhaiyyantop_nav_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-text', newVal);
            $('.header-menu > li > a').css('color', newVal);
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
            $('.header-menu .sub-menu, .header-menu .dropdown-menu').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_mobile_menu_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--mobile-menu-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_hamburger_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--hamburger-color', newVal);
            $('.hamburger-bar').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_sticky_nav_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--sticky-nav-color', newVal);
            $('.sticky-header-menu > li > a').css('color', newVal);
        });
    });

    wp.customize('bhaiyyantop_nav_font_size', function (value) {
        value.bind(function (newVal) {
            setCssVar('--nav-font-size', newVal + 'px');
            $('.header-menu > li > a').css('font-size', newVal + 'px');
        });
    });

    // 4. TYPOGRAPHY
    wp.customize('bhaiyyantop_heading_font', function (value) {
        value.bind(function (newVal) {
            setCssVar('--heading-font', "'" + newVal + "', sans-serif");
            $('h1, h2, h3, h4, h5, h6, .site-header, .section-title').css('font-family', "'" + newVal + "', sans-serif");
        });
    });

    wp.customize('bhaiyyantop_body_font', function (value) {
        value.bind(function (newVal) {
            setCssVar('--body-font', "'" + newVal + "', sans-serif");
            $('body').css('font-family', "'" + newVal + "', sans-serif");
        });
    });

    wp.customize('bhaiyyantop_base_font_size', function (value) {
        value.bind(function (newVal) {
            setCssVar('--base-font-size', newVal + 'px');
            $('body').css('font-size', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_line_height', function (value) {
        value.bind(function (newVal) {
            setCssVar('--line-height', newVal);
            $('body').css('line-height', newVal);
        });
    });

    wp.customize('bhaiyyantop_letter_spacing', function (value) {
        value.bind(function (newVal) {
            setCssVar('--letter-spacing', newVal + 'px');
            $('body').css('letter-spacing', newVal + 'px');
        });
    });

    // 5. COLORS & THEME SYSTEM
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
            setCssVar('--bg-color', newVal);
            $('body').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--text-color', newVal);
            $('body').css('color', newVal);
        });
    });

    wp.customize('bhaiyyantop_heading_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--dark-color', newVal);
            $('h1, h2, h3, h4, h5, h6, .section-title').css('color', newVal);
        });
    });

    // 6. BUTTONS
    wp.customize('bhaiyyantop_button_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-bg', newVal);
            $('.btn-primary').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_button_hover', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-hover', newVal);
        });
    });

    wp.customize('bhaiyyantop_secondary_button_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--secondary-button-bg', newVal);
            $('.btn-secondary').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_button_radius', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-radius', newVal + 'px');
            $('.btn').css('border-radius', newVal + 'px');
        });
    });

    wp.customize('bhaiyyantop_button_shadow', function (value) {
        value.bind(function (newVal) {
            setCssVar('--button-shadow', newVal);
            $('.btn').css('box-shadow', newVal);
        });
    });

    // 7. CARDS & LAYOUT
    wp.customize('bhaiyyantop_card_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--card-bg', newVal);
        });
    });

    wp.customize('bhaiyyantop_container_radius', function (value) {
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

    wp.customize('bhaiyyantop_container_width', function (value) {
        value.bind(function (newVal) {
            setCssVar('--container-width', newVal + 'px');
            $('.container').css('max-width', newVal + 'px');
        });
    });

    // 8. FOOTER
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

    wp.customize('bhaiyyantop_footer_bg_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--footer-bg', newVal);
            $('.site-footer').css('background-color', newVal);
        });
    });

    wp.customize('bhaiyyantop_footer_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--footer-text', newVal);
            $('.site-footer').css('color', newVal);
        });
    });

    // 9. SEARCH
    wp.customize('bhaiyyantop_search_placeholder', function (value) {
        value.bind(function (newVal) {
            $('.header-search-input').attr('placeholder', newVal);
        });
    });

    // 10. BREAKING NEWS TICKER
    wp.customize('bhaiyyantop_header_notice', function (value) {
        value.bind(function (newVal) {
            $('.ticker-label span').text(newVal);
        });
    });

    wp.customize('bhaiyyantop_ticker_bg', function (value) {
        value.bind(function (newVal) {
            setCssVar('--ticker-bg', newVal);
            $('.ticker-container-wrap').css('background', newVal);
        });
    });

    wp.customize('bhaiyyantop_ticker_text_color', function (value) {
        value.bind(function (newVal) {
            setCssVar('--ticker-text-color', newVal);
            $('.ticker-list a').css('color', newVal);
        });
    });

    // 11. SOCIAL MEDIA LINKS
    ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram', 'whatsapp'].forEach(function (net) {
        wp.customize('bhaiyyantop_social_' + net, function (value) {
            value.bind(function (newVal) {
                $('.footer-socials a.' + net).attr('href', newVal);
            });
        });
    });

})(jQuery);
