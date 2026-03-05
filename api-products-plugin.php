<?php
/**
 * Plugin Name: API Products Plugin
 * Description: Fetch products from external API and display via shortcode with AJAX.
 * Version: 1.0
 * Author: Muhammad Usama
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class API_Products_Plugin {

    public function __construct() {
        // Register shortcode
        add_shortcode('api_products', [$this, 'shortcode_html']);

        // Enqueue JS & CSS
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        // AJAX actions for logged in and guest users
        add_action('wp_ajax_fetch_products', [$this, 'ajax_fetch_products']);
        add_action('wp_ajax_nopriv_fetch_products', [$this, 'ajax_fetch_products']);
    }

    // Enqueue JS and CSS
    public function enqueue_scripts() {
        wp_enqueue_style(
            'api-products-css',
            plugin_dir_url(__FILE__) . 'style.css'
        );

        wp_enqueue_script(
            'api-products-js',
            plugin_dir_url(__FILE__) . 'script.js',
            ['jquery'],
            '1.0',
            true
        );

        // Pass AJAX URL to JS
        wp_localize_script(
            'api-products-js',
            'api_ajax_obj',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]
        );
    }

    // Shortcode HTML
   public function shortcode_html() {
    ob_start(); ?>
    <div id="api-products">
        <button id="load-products" class="load-btn">Load Products</button>
        <div id="products-loader" style="display:none;">Loading...</div>
        <div id="products-list" class="products-grid"></div>
    </div>
    <?php
    return ob_get_clean();
}
    // AJAX handler
    public function ajax_fetch_products() {

        // Check if cached
        $cached = get_transient('api_products_cache');
        if ($cached !== false) {
            wp_send_json($cached);
        }

        // Fetch from API
        $response = wp_remote_get('https://fakestoreapi.com/products');

        if (is_wp_error($response)) {
            wp_send_json_error('API request failed.');
        }

        $body = wp_remote_retrieve_body($response);
        $products = json_decode($body, true);

        // Cache for 1 hour
        set_transient('api_products_cache', $products, HOUR_IN_SECONDS);

        wp_send_json($products);
    }
}

new API_Products_Plugin();