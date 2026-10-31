<?php
/**
 * Plugin Name: Advanced Blog Grid for Elementor
 * Description: Custom responsive posts grid with Elementor design controls and pagination.
 * Version: 1.0.0
 * Requires Plugins: elementor
 * Text Domain: advanced-blog-grid
 * Author: Drunall Technologies
 */
if (!defined('ABSPATH')) exit;
add_action('plugins_loaded', function () {
    if (!did_action('elementor/loaded')) return;
    add_action('elementor/widgets/register', function ($manager) {
        require_once __DIR__ . '/widget.php';
        $manager->register(new \ABG_Blog_Grid_Widget());
    });
});
add_action('wp_enqueue_scripts', function () {
    wp_register_style('abg-blog-grid', plugins_url('assets/style.css', __FILE__), [], '1.0.0');
});
