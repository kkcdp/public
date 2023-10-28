<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Theme defines.
 */
define( 'PDG_VER',  wp_get_theme()->get( 'Version' ) );
define( 'PDG_PATH', get_template_directory() );
define( 'PDG_URL',  str_replace( get_site_url(), '', get_template_directory_uri() ) );

define( 'PDG_CHILD_PATH', get_stylesheet_directory() );

define( 'PDG_URL_PLUGINS', 'http://developers.sem.lv/resources/pandago/plugins' );

/**
 * Whole theme setup relies on ACF plugin. Throw an error
 * if it's not enabled.
 *
 * @since 2.0.0
 */
function pdg_acf_notice() {

    if ( ! function_exists( 'get_field' ) ) {
        echo '<div class="notice notice-error"><p>PandaGo 2 requires ACF plugin to work!</p></div>';
    }

}
add_action( 'admin_notices', 'pdg_acf_notice' );

if ( ! is_admin() && $GLOBALS['pagenow'] != 'wp-login.php' && $GLOBALS['pagenow'] != 'wp-logout.php' && ! function_exists( 'get_field' ) ) {
    die( 'PandaGo 2 requires ACF plugin to work!' );
}

/**
 * Plugin activator.
 */
include PDG_PATH . '/includes/vendor/TGM_Plugin_Activation.php';

/**
 * Required plugins.
 */
include PDG_PATH . '/includes/plugins.php';

if ( is_admin() && ! function_exists( 'get_field' ) ) {
    return;
}

/**
 * Core features.
 */
include PDG_PATH . '/includes/core.php';

/**
 * Manage static assets.
 */
include PDG_PATH . '/includes/assets.php';

/**
 * ACF blocks.
 */
include PDG_PATH . '/includes/blocks.php';

/**
 * Custom usable functions.
 */
include PDG_PATH . '/includes/functions.php';

/**
 * Custom theme hooks.
 */
include PDG_PATH . '/includes/hooks.php';

/**
 * Options pages.
 */
include PDG_PATH . '/includes/options.php';

/**
 * REST API functions.
 */
include PDG_PATH . '/includes/rest.php';

/**
 * Theme updates.
 */
include PDG_PATH . '/includes/update.php';