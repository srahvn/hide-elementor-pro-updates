<?php
/*
Plugin Name: Hide Elementor Pro Updates
Plugin URI: https://github.com/srahvn/hide-elementor-pro-updates
Description: Hides Elementor Pro update notifications, admin notices, and disables access to its update server.
Version: 1.0
Author: Your Name
Author URI: https://github.com/srahvn
*/

// Hide Elementor Pro admin notices
add_action('admin_head', function() {
    echo '<style>
        .elementor-admin-notices, .notice.elementor-message, .e-notice--dismissible {
            display: none !important;
        }
    </style>';
});

// Disable Elementor Pro updates by removing the update server connection
add_filter('http_request_args', function($request_args, $url) {
    if (strpos($url, 'my.elementor.com') !== false) {
        $request_args['blocked'] = true;
    }
    return $request_args;
}, 10, 2);

// Remove update notifications for Elementor Pro
add_filter('site_transient_update_plugins', function($transient) {
    if (isset($transient->response['elementor-pro/elementor-pro.php'])) {
        unset($transient->response['elementor-pro/elementor-pro.php']);
    }
    return $transient;
});
