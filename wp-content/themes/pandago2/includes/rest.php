<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register REST API routes.
 * 
 * @since 2.0.0
 */
function pdg_register_rest_routes() {

    register_rest_route( 'pdg/v2', 'browser-notice', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'pdg_get_browser_notice',
        'permission_callback' => '__return_true'
    ) );

}
add_action( 'rest_api_init', 'pdg_register_rest_routes' );

/**
 * Get browser notification markup.
 * 
 * @since 2.0.0
 * @return string
 */
function pdg_get_browser_notice() {

    ob_start();

    get_template_part( 'template-parts/browser-notice' );

    return ob_get_clean();

}