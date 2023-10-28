<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add JavaScript plugin files based on
 * options page  choices.
 * 
 * @since 2.0.0
 * @param string $field Option field name
 * @param string $ver   Plugin version
 * @param string $js    URL to plugins JavaScript file
 * @param string $css   URL to plugins CSS file
 */
function pdg_add_js_plugin( $field, $ver, $js = false, $css = false ) {

    $handle = 'pdg-' . str_replace( 'pdg_js_', '', $field );
    $group  = get_field( $field, 'option' );

    if ( is_array( $group ) ) {
        $register = $group['register'];
        $enqueue  = $group['enqueue'];
    
        if ( $register ) {
            if ( $js ) {
                wp_register_script( $handle, $js, array( 'jquery' ), $ver, true );
    
                if ( $enqueue ) {
                    wp_enqueue_script( $handle );
                }
            }
    
            if ( $css ) {
                wp_register_style( $handle, $css, array(), $ver );
    
                if ( $enqueue ) {
                    wp_enqueue_style( $handle );
                }
            }
        }
    }

}


/**
 * Get script url by handle.
 * 
 * @since 2.0.0
 * @param string $handle Script handle
 * @return array/bool
 */
function pdg_get_script_src_by_handle( $handle ) {

    global $wp_scripts;

    if ( in_array( $handle, $wp_scripts->queue ) ) {
        $arr = array(
            'src'   => $wp_scripts->registered[$handle]->src,
            'extra' => '',
            'deps'  => $wp_scripts->registered[$handle]->deps
        );

        if ( isset( $wp_scripts->registered[$handle]->extra['data'] ) ) {
            $arr['extra'] = $wp_scripts->registered[$handle]->extra['data'];
        }

        return $arr;
    }

    return false;

}

function pdg_get_style_src_by_handle( $handle ) {

    global $wp_styles;

    if ( in_array( $handle, $wp_styles->queue ) ) {
        $arr = array(
            'src'  => $wp_styles->registered[$handle]->src,
            'deps' => $wp_styles->registered[$handle]->deps
        );

        return $arr;
    }

    return false;

}

/**
 * Add static assets required for the theme.
 * 
 * @since 2.0.0
 */
function pdg_add_assets() {

    // Add Google Maps script.
    $gm = get_field( 'pdg_apis_gm', 'option' );

    if ( $gm['key'] ) {
        $gm_url = 'https://maps.googleapis.com/maps/api/js?key=' . $gm['key'];

        if ( $gm['callback'] ) {
            $gm_url .= '&callback=' . $gm['callback'];
        }

        wp_register_script( 'pdg-google-maps', $gm_url, array(), '3', true );

        if ( $gm['enqueue'] ) {
            wp_enqueue_script( 'pdg-google-maps' );
        }
    }

    /*
     * JS plugins from 
     * options page.
     */

    // AOS
    pdg_add_js_plugin( 'pdg_js_aos', '2.0.0', PDG_URL . '/assets/vendor/aos/aos.js', PDG_URL . '/assets/vendor/aos/aos.css' );

    // Clamp
    pdg_add_js_plugin( 'pdg_js_clamp', '0.5.1', PDG_URL . '/assets/vendor/clamp/clamp.min.js' );

    // Datepicker
    pdg_add_js_plugin( 'pdg_js_datepicker', '1.12.1', PDG_URL . '/assets/vendor/datepicker/jquery-ui.min.js', PDG_URL . '/assets/vendor/datepicker/jquery-ui.min.css' );

    // Fancybox
    pdg_add_js_plugin( 'pdg_js_fancybox', '3.5.7', PDG_URL . '/assets/vendor/fancybox/jquery.fancybox.min.js', PDG_URL . '/assets/vendor/fancybox/jquery.fancybox.min.css' );

    // Flexslider
    pdg_add_js_plugin( 'pdg_js_flexslider', '2.7.2', PDG_URL . '/assets/vendor/flexslider/jquery.flexslider-min.js', PDG_URL . '/assets/vendor/flexslider/flexslider.css' );

    // hoverIntent
    pdg_add_js_plugin( 'pdg_js_hoverintent', '1.10.0', PDG_URL . '/assets/vendor/fancybox/jquery.hoverIntent.min.js' );

    // isOnScreen
    pdg_add_js_plugin( 'pdg_js_isonscreen', '', PDG_URL . '/assets/vendor/isonscreen/jquery.isonscreen.min.js' );

    // Modernizr
    pdg_add_js_plugin( 'pdg_js_modernizr', '3.6.0', PDG_URL . '/assets/vendor/modernizr/modernizr-3.6.0-custom.min.js' );

    // NiceScroll
    pdg_add_js_plugin( 'pdg_js_nicescroll', '3.7.6', PDG_URL . '/assets/vendor/nicescroll/jquery.nicescroll.min.js' );

    // Slick slider
    pdg_add_js_plugin( 'pdg_js_slick', '1.8.1', PDG_URL . '/assets/vendor/slick/slick.min.js', PDG_URL . '/assets/vendor/slick/slick.css' );

    // SumoSelect
    pdg_add_js_plugin( 'pdg_js_sumoselect', '3.0.2', PDG_URL . '/assets/vendor/sumoselect/jquery.sumoselect.min.js', PDG_URL . '/assets/vendor/sumoselect/sumoselect.min.css' );

    // Tooltipster
    pdg_add_js_plugin( 'pdg_js_tooltipster', '4.2.8', PDG_URL . '/assets/vendor/tooltipster/tooltipster.bundle.min.js', PDG_URL . '/assets/vendor/tooltipster/tooltipster.bundle.min.css' );


    // Add main stylesheet
    wp_enqueue_style( 'pdg-main', PDG_URL . '/assets/css/main.css', array(), PDG_VER, 'all' );

    // Add 404 specific stylesheet.
    if ( is_404() ) {
        wp_enqueue_style( '404', PDG_URL . '/assets/vendor/404/404.css', array(), PDG_VER, 'all' );
    }

    // Add main script.
    wp_enqueue_script( 'pdg-main', PDG_URL . '/assets/main.js', array( 'jquery' ), PDG_VER, true );

    // Parse site url to get host for cookie consent plugin.
    $parsed_url = parse_url( site_url() );

    // Pass variables to script.
    $pdg_opts = array(
        'host'               => $parsed_url['host'],
        'site_url'           => esc_url( home_url() ),
        'ajax_url'           => admin_url( 'admin-ajax.php' ),
        'theme_url'          => PDG_URL,
        'child_theme_url'    => get_stylesheet_directory_uri(),
        'logged_in'          => ( is_user_logged_in() && current_user_can( 'administrator' ) ) ? true : false,
        'cc_enable'          => ( get_field( 'pdg_cc_enable', 'option' ) || is_null( get_field( 'pdg_cc_enable', 'option' ) ) ) ? true : false,
        'cc_position'        => ( get_field( 'pdg_cc_position', 'option' ) ) ? get_field( 'pdg_cc_position', 'option' ) : 'bottom-right',
        'cc_url'             => ( get_field( 'pdg_cc_link', 'option' ) ) ? esc_url( get_field( 'pdg_cc_link', 'option' ) ) : get_privacy_policy_url(),
        'cc_on_consent_head' => ( get_field( 'pdg_cc_on_consent_head', 'option' ) ) ? get_field( 'pdg_cc_on_consent_head', 'option' ) : false,
        'cc_on_consent_body' => ( get_field( 'pdg_cc_on_consent_body', 'option' ) ) ? get_field( 'pdg_cc_on_consent_body', 'option' ) : false,
        'browser_class'      => get_field( 'pdg_browser_class', 'option' ),
        'browser_notice'     => get_field( 'pdg_browser_notice', 'option' )
    );

    if ( get_field( 'pdg_apis_fb_app_id', 'option' ) ) {
        $pdg_opts['fb_app_id'] = get_field( 'pdg_apis_fb_app_id', 'option' );
    }

    wp_add_inline_script( 'pdg-main', 'var pdg_opts = ' . json_encode( $pdg_opts ), 'before' );

    // Pass translated strings to script.
    wp_localize_script( 'pdg-main', 'pdg_strings', array(
        'cc_msg'        => ( get_field( 'pdg_cc_message', 'option' ) ) ? get_field( 'pdg_cc_message', 'option' ) : __( 'Šajā vietnē tiek izmantotas sīkdatnes. Turpinot izmantot šo vietni, Jūs piekrītat mūsu sīkdatņu politikai.', 'pandago' ),
        'cc_allow'      => ( get_field( 'pdg_cc_allow', 'option' ) ) ? get_field( 'pdg_cc_allow', 'option' ) : __( 'Apstiprināt', 'pandago' ),
        'cc_deny'       => ( get_field( 'pdg_cc_deny', 'option' ) ) ? get_field( 'pdg_cc_deny', 'option' ) : __( 'Noraidīt', 'pandago' ),
        'cc_learn_more' => ( get_field( 'pdg_cc_learn_more', 'option' ) ) ? get_field( 'pdg_cc_learn_more', 'option' ) : __( 'Uzzināt vairāk', 'pandago' ),
        'cf_messages'   => pdg_get_cf_messages()
    ) );

}
add_action( 'wp_enqueue_scripts', 'pdg_add_assets' );

/**
 * Remove static assets.
 * 
 * @since 2.0.0
 */
function pdg_remove_custom_assets() {

    // Remove JS.
    if ( $remove_js = get_field( 'pdg_optimisation_remove_js', 'option' ) ) {
        $remove_js = array_map( 'trim', explode( ',', $remove_js ) );

        if ( $remove_js ) {
            foreach ( $remove_js as $handle ) {
                wp_deregister_script( $handle );
                wp_dequeue_script( $handle );
            }
        }
    }

    // Remove CSS.
    if ( $remove_css = get_field( 'pdg_optimisation_remove_css', 'option' ) ) {
        $remove_css = array_map( 'trim', explode( ',', $remove_css ) );

        if ( $remove_css ) {
            foreach ( $remove_css as $handle ) {
                wp_deregister_style( $handle );
                wp_dequeue_style( $handle );
            }
        }
    }

}
add_action( 'wp_enqueue_scripts', 'pdg_remove_custom_assets', 9999 );

function pdg_add_late_assets() {

    $late_load = array(
        'js'  => array(),
        'css' => array()
    );

    if ( get_field( 'pdg_optimisation_late_js', 'option' ) ) {
        $late_load['js'] = array_map( 'trim', explode( ',', get_field( 'pdg_optimisation_late_js', 'option' ) ) );
    }

    if ( get_field( 'pdg_optimisation_late_css', 'option' ) ) {
        $late_load['css'] = array_map( 'trim', explode( ',', get_field( 'pdg_optimisation_late_css', 'option' ) ) );
    }

    $late = array(
        'js'    => array(),
        'css'   => array(),
        'extra' => array()
    );

    $late['js'][] = array(
        'handle' => 'pdg-late',
        'url'    => PDG_URL . '/assets/vendor/pandago/late.js',
        'deps'   => array()
    );

    // if ( isset( $late_load['js'] ) && ! empty( $late_load['js'] ) ) {
    //     foreach ( $late_load['js'] as $handle ) {
    //         $script = pdg_get_script_src_by_handle( $handle );

    //         $late['js'][] = array(
    //             'handle' => $handle,
    //             'url'    => $script['src'],
    //             'deps'   => $script['deps']
    //         );

    //         if ( $script['extra'] ) {
    //             $late['extra'][] = array(
    //                 'handle' => $handle,
    //                 'data'   => $script['extra']
    //             );
    //         }

    //         wp_deregister_script( $handle );
    //         wp_dequeue_script( $handle );
    //     }
    // }

    // if ( isset( $late_load['css'] ) && ! empty( $late_load['css'] ) ) {
    //     // Reverse array order so that style order is preserved.
    //     $late_load['css'] = array_reverse( $late_load['css'] );

    //     foreach ( $late_load['css'] as $handle ) {
    //         $style = pdg_get_style_src_by_handle( $handle );

    //         $late['css'][] = array(
    //             'handle' => $handle,
    //             'url'    => $style['src'],
    //             'deps'   => $style['deps']
    //         );

    //         wp_deregister_style( $handle );
    //         wp_dequeue_style( $handle );
    //     }
    // }

    if ( class_exists( 'WPCF7' ) ) {
        $late['js'][] = array(
            'handle' => 'pdg-cf-validation',
            'url'    => PDG_URL . '/assets/vendor/cf-validation/cf-validation.js',
            'deps'   => array( 'domelement:.wpcf7' )
        );

        $late['css'][] = array(
            'handle' => 'pdg-cf-validation',
            'url'    => PDG_URL . '/assets/vendor/cf-validation/cf-validation.css',
            'deps'   => array( 'domelement:.wpcf7' )
        );
    }

    wp_add_inline_script( 'pdg-main', 'var pdg_late_load = ' . json_encode( $late ), 'before' );

}
add_action( 'wp_enqueue_scripts', 'pdg_add_late_assets', 90 );

/**
 * Remove unnecessary WordPress assets.
 * 
 * @since 2.0.0
 */
function pdg_remove_assets() {

    if ( ! is_admin() ) {
        wp_deregister_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library' );

        wp_deregister_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wp-block-library-theme' );

        wp_deregister_style( 'global-styles' );
        wp_dequeue_style( 'global-styles' );
    }

}
add_action( 'wp_enqueue_scripts', 'pdg_remove_assets' );

/**
 * Helper function for pdg_dump_assets which retrieves
 * all registered assets and returns them.
 * 
 * @since 2.0.0
 * @return array
 */
function pdg_get_dump_assets() {

    global $wp_scripts, $wp_styles;

    $result = array(
        'scripts' => array(),
        'styles'  => array()
    );
    
    foreach( $wp_scripts->queue as $handle ) {
        $result['scripts'][$handle] = $wp_scripts->registered[$handle]->src . ';';
    }

    foreach( $wp_styles->queue as $handle ) {
        $result['styles'][$handle] = $wp_styles->registered[$handle]->src . ';';
    }

    return $result;

}

/**
 * Checks if user is logged in and 'dump-assets'
 * parameter is present.
 * 
 * @since 2.0.0
 */
function pdg_dump_assets() {

    if ( isset( $_GET['dump-assets'] ) && is_user_logged_in() ) {
        echo '<pre>';
        var_dump( pdg_get_dump_assets() );
        echo '</pre>';

        die();
    }

}
add_action( 'wp_head', 'pdg_dump_assets');

/**
 * Remove jQuery Migrate.
 * 
 * @since 2.0.0
 */
function pdg_dequeue_jquery_migrate( $scripts ) {

    $remove = false;

    if ( get_field( 'pdg_optimisation_remove_jquery_migrate', 'option' ) || is_null( get_field( 'pdg_optimisation_remove_jquery_migrate', 'option' ) ) ) {
        $remove = true;
    }

    if ( $remove && ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            [ 'jquery-migrate' ]
        );
    }

}
add_action( 'wp_default_scripts', 'pdg_dequeue_jquery_migrate' );

/**
 * Move jQuery to body.
 * 
 * @since 2.0.0
 */
function pdg_move_jquery_to_footer() {

    $remove = false;

    if ( get_field( 'pdg_optimisation_move_jquery_to_footer', 'option' ) || is_null( get_field( 'pdg_optimisation_move_jquery_to_footer', 'option' ) ) ) {
        $remove = true;
    }

    if ( $remove ) {
        wp_scripts()->add_data( 'jquery', 'group', 1 );
        wp_scripts()->add_data( 'jquery-core', 'group', 1 );
        wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
    }

}
add_action( 'wp_enqueue_scripts', 'pdg_move_jquery_to_footer' );

/**
 * Add admin assets.
 */
function pdg_admin_assets( $hook ) {

    if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) {
        return;
    }

    wp_enqueue_style( 'pdg-admin-main', PDG_URL . '/assets/vendor/pandago/admin.css' );
    wp_enqueue_script( 'pdg-admin-main', PDG_URL . '/assets/vendor/pandago/admin.js', array( 'jquery' ), PDG_VER, true );

}
add_action( 'admin_enqueue_scripts', 'pdg_admin_assets' );