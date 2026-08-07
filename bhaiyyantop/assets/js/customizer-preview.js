/**
 * Bhaiyyantop Customizer Live Preview JS
 * Updates CSS Variables and text content live without reloading the preview window.
 */
(function ($) {
    'use strict';

    // Primary Color
    wp.customize('bhaiyyantop_primary_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--primary-color', newVal);
            document.documentElement.style.setProperty('--nav-hover-bg', newVal);
            document.documentElement.style.setProperty('--button-bg', newVal);
        });
    });

    // Secondary Color
    wp.customize('bhaiyyantop_secondary_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--secondary-color', newVal);
            document.documentElement.style.setProperty('--header-bg', newVal);
        });
    });

    // Accent Color
    wp.customize('bhaiyyantop_accent_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--accent-yellow', newVal);
        });
    });

    // Header Overlay Opacity
    wp.customize('bhaiyyantop_header_overlay_opacity', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--header-overlay-opacity', newVal);
        });
    });

    // Header Min Height
    wp.customize('bhaiyyantop_header_min_height', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--header-min-height', newVal + 'px');
        });
    });

    // Navigation Text Color
    wp.customize('bhaiyyantop_nav_text_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--nav-text', newVal);
        });
    });

    // Navigation Hover Color
    wp.customize('bhaiyyantop_nav_hover_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--nav-hover', newVal);
        });
    });

    // Navigation Hover Background
    wp.customize('bhaiyyantop_nav_hover_bg', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--nav-hover-bg', newVal);
        });
    });

    // Navigation Font Size
    wp.customize('bhaiyyantop_nav_font_size', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--nav-font-size', newVal + 'px');
        });
    });

    // Button Background Color
    wp.customize('bhaiyyantop_button_bg', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--button-bg', newVal);
        });
    });

    // Button Hover Color
    wp.customize('bhaiyyantop_button_hover', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--button-hover', newVal);
        });
    });

    // Container Radius
    wp.customize('bhaiyyantop_container_radius', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--container-radius', newVal + 'px');
        });
    });

    // Body Background Color
    wp.customize('bhaiyyantop_body_bg_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--light-bg', newVal);
        });
    });

    // Footer Background Color
    wp.customize('bhaiyyantop_footer_bg_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--footer-bg', newVal);
        });
    });

    // Footer Text Color
    wp.customize('bhaiyyantop_footer_text_color', function (value) {
        value.bind(function (newVal) {
            document.documentElement.style.setProperty('--footer-text', newVal);
        });
    });

    // Ticker Badge Text
    wp.customize('bhaiyyantop_header_notice', function (value) {
        value.bind(function (newVal) {
            $('.ticker-label span').text(newVal);
        });
    });

    // Footer About Title
    wp.customize('bhaiyyantop_footer_about_title', function (value) {
        value.bind(function (newVal) {
            $('.footer-column:first-child h3').text(newVal);
        });
    });

    // Footer About Text
    wp.customize('bhaiyyantop_footer_about_text', function (value) {
        value.bind(function (newVal) {
            $('.footer-column:first-child p').html(newVal);
        });
    });

    // Footer Copyright Text
    wp.customize('bhaiyyantop_footer_copyright', function (value) {
        value.bind(function (newVal) {
            $('.footer-bottom p').html(newVal);
        });
    });

})(jQuery);
