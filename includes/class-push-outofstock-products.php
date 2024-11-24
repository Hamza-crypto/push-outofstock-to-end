<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class.
 */
class Push_OutofStock_Products
{
    /**
     * Initialize the plugin.
     */
    public static function init()
    {
        // Check if WooCommerce is active.
        if (self::is_woocommerce_active()) {
            add_filter('posts_clauses', [ __CLASS__, 'order_by_stock_status' ], 2000);
        }
    }

    /**
     * Check if WooCommerce is active.
     *
     * @return bool
     */
    public static function is_woocommerce_active()
    {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')), true);
    }

    /**
     * Modify the query to order products by stock status.
     *
     * @param array $posts_clauses Query clauses.
     * @return array Modified query clauses.
     */
    public static function order_by_stock_status($posts_clauses)
    {
        global $wpdb;

        // Only modify query on WooCommerce shop pages.
        if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
            $posts_clauses['join']    .= " INNER JOIN {$wpdb->postmeta} istockstatus ON ({$wpdb->posts}.ID = istockstatus.post_id) ";
            $posts_clauses['orderby']  = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
            $posts_clauses['where']   .= " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' ";
        }

        return $posts_clauses;
    }
}
