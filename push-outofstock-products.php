<?php
/**
 * Plugin Name: Push Out-of-Stock Products
 * Plugin URI:  https://github.com/Hamza-crypto/push-outofstock-to-end.git
 * Description: Automatically pushes out-of-stock WooCommerce products to the end of product lists in WooCommerce.
 * Version:     1.0.0
 * Author:      Hamza Siddique
 * Author URI:  https://www.upwork.com/freelancers/~01d452dc67bce01a15
 * License:     GPL-2.0+
 * Text Domain: push-outofstock-products
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

// Define constants.
define('PUSH_OUTOFSTOCK_PRODUCTS_VERSION', '1.0.0');
define('PUSH_OUTOFSTOCK_PRODUCTS_PATH', plugin_dir_path(__FILE__));
define('PUSH_OUTOFSTOCK_PRODUCTS_URL', plugin_dir_url(__FILE__));

// Include the main plugin class.
require_once PUSH_OUTOFSTOCK_PRODUCTS_PATH . 'includes/class-push-outofstock-products.php';

// Initialize the plugin.
add_action('plugins_loaded', [ 'Push_OutofStock_Products', 'init' ]);
