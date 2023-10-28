<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Theme setup, defines defaults and adds some Wordpress features.
 * 
 * @since 2.0.0
 */
function pdg_setup() {

    add_theme_support( 'align-wide' );

    add_theme_support( 'editor-styles' );

    add_theme_support( 'html5', array( 'script', 'style' ) );

    add_theme_support( 'menus' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'responsive-embeds' );

    add_theme_support( 'title-tag' );

    add_theme_support( 'widgets' );

    add_theme_support( 'wp-block-styles' );

    if ( class_exists( 'WooCommerce' ) ) {
        add_theme_support( 'woocommerce' );
    }

}
add_action( 'after_setup_theme', 'pdg_setup', 0 );

/**
 * Adds support for SVG upload 
 * 
 * @since 2.0.0
 */
function pdg_svg_upload( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';

    return $mimes;

}
add_filter( 'upload_mimes', 'pdg_svg_upload' );

/**
 * Increase Gutenbers editors width in admin panel.
 * 
 * @since 2.0.0
 */
function pdg_increase_gutenbergs_width() {

    echo '<style>.wp-block { max-width: 1200px; }</style>';

}
add_action( 'admin_head', 'pdg_increase_gutenbergs_width' );

/**
 * Add blog id to body class if multisite.
 * 
 * @since 2.0.0
 */
function pdg_multisite_body_classes( $classes ) {

    if ( is_multisite() ) {
        $classes[] = 'multisite-enabled';
        $classes[] = 'multisite-site-' . get_current_blog_id();
    }

    return $classes;

}
add_filter( 'body_class', 'pdg_multisite_body_classes' );

/**
 * Adds class to empty paragraphs from the_content() function.
 * 
 * @since 2.0.0
 */
function pdg_empty_paragraph_class( $content ) {

    return str_replace( '<p>&nbsp;</p>','<p class="empty-paragraph">&nbsp;</p>', $content );

}
add_filter( 'the_content', 'pdg_empty_paragraph_class', 100 );

/**
 * Wraps embeded iframes with <div> element for styling purposes.
 * 
 * @since 2.0.0
 */
function pdg_wrap_embed_with_div( $html, $url, $attr ) {

    return '<div class="embed-container"><div class="embed-inner">' . $html . '</div></div>';

}
add_filter( 'embed_oembed_html', 'pdg_wrap_embed_with_div', 10, 3 );

// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links', 2 );

// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );

// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove index link
remove_action( 'wp_head', 'index_rel_link' ); 

// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 

// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

// Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_generator' );

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Remove emoji scripts and styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'do_shortcode' ); 

// Remove <p> tags in Dynamic Sidebars
add_filter( 'widget_text', 'shortcode_unautop' );

// Remove <p> and <br> tags from Contact Form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'shortcode_unautop' );

// Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' );

// Remove <p> tags from Excerpt altogether
remove_filter( 'the_excerpt', 'wpautop' );

// Disallows WP to convert quotes inside the_content() function. Removeing this because it breaks output from json_encode() inside the_content().
remove_filter( 'the_content', 'wptexturize' );

// Remove Monsterinsights Google Analytics tracking script.
function pdg_remove_hooks() {

    remove_action( 'wp_head', 'monsterinsights_tracking_script', 6 );

}
add_action( 'init', 'pdg_remove_hooks', 11 );

/**
 * Remove admin menus.
 */
function pdg_remove_admin_menus() {

    global $pdg_config;

    if ( get_field( 'pdg_general_remove_comments', 'option' ) || is_null( get_field( 'pdg_general_remove_comments', 'option' ) ) ) {
        remove_menu_page( 'edit-comments.php' );
    }

}
add_action( 'admin_menu', 'pdg_remove_admin_menus' );

/**
 * Add custom admin bar buttons.
 * 
 * @since 2.0.0
 */
function pdg_add_admin_bar_items( $admin_bar ) {

    if ( current_user_can( 'administrator' ) ) {
        $admin_bar->add_menu( array(
            'id'    => 'dump-assets',
            'title' => 'Dump assets',
            'href'  => '/?dump-assets'
        ) );
    }

}
add_action( 'admin_bar_menu', 'pdg_add_admin_bar_items', 999 );

/**
 * Clear cache when saving posts.
 * 
 * @since 2.0.0
 */
function pdg_clear_cache_on_posts_save( $post_id, $post, $update ) {

    if ( function_exists( 'w3tc_flush_all' ) && get_field( 'pdg_optimisation_clear_cache_when_saving_posts', 'option' ) ) {
        w3tc_flush_all();
    }

}
add_action( 'save_post', 'pdg_clear_cache_on_posts_save', 10, 3 );

/**
 * Translate root page titles in breadcrumbs (BreadcrumbsNavXT).
 * 
 * @since 2.0.0
 */
function pdg_filter_bcn_breadcrumb_title( $title, $this_type, $this_id ) { 

    if ( defined( 'ICL_LANGUAGE_CODE' ) && is_array( $this_type ) ) {
        $is_root = false;

        foreach ( $this_type as $type ) {
            if ( strpos( $type, '-root' ) !== false || $type == 'post-page' ) {
                $is_root = true;
                break;
            }
        }

        if ( $is_root ) {
            $transl_id = icl_object_id( $this_id, 'page', false, ICL_LANGUAGE_CODE );

            if ( $transl_id ) {
                $title = get_the_title( $transl_id );
            }
        }
    }

    return $title; 

}; 
add_filter( 'bcn_breadcrumb_title', 'pdg_filter_bcn_breadcrumb_title', 10, 3 );

/**
 * Load more posts.
 * 
 * @since 2.0.0
 */
function pdg_load_more(){
 
	$args                = json_decode( stripslashes( $_POST['args'] ), true );
	$args['paged']       = $_POST['page'] + 1;
	$args['post_status'] = 'publish';

    if ( ! file_exists( PDGC_PATH . '/' . $_POST['tpl'] . '.php' ) ) {
        return;
    }

    if ( defined( 'ICL_LANGUAGE_CODE' ) && isset( $_POST['lang'] ) ) {
        do_action( 'wpml_switch_language', htmlspecialchars( $_POST['lang'] ) );
    }

    $tpl_args = array();

    if ( isset( $_POST['tpl_args'] ) ) {
        $tpl_args = json_decode( stripslashes( $_POST['tpl_args'] ), true );

        if ( ! is_array( $tpl_args ) ) {
            return;
        }
    }

	query_posts( $args );

	if ( have_posts() ) {
        $tpl = htmlspecialchars( $_POST['tpl'] );

        while ( have_posts() ) {
            the_post();

            get_template_part( $tpl, null, $tpl_args );
        }
    }

	exit;

}
add_action( 'wp_ajax_pdg_load_more', 'pdg_load_more');
add_action( 'wp_ajax_nopriv_pdg_load_more', 'pdg_load_more');

/**
 * Get messages from main contact form.
 * 
 * @since 2.0.0
 * 
 * @return boolean/array
 */
function pdg_get_cf_messages() {

    if ( $form = get_field( 'pdg_general_main_cf', 'option' ) ) {
        return WPCF7_ContactForm::get_instance( $form->ID )->get_properties()['messages'];
    }

    return false;

}

/**
 * Check if request is REST request.
 * 
 * @since 2.0.6
 */
function pdg_is_rest() {

    if ( defined( 'REST_REQUEST' ) && REST_REQUEST || isset( $_GET['rest_route'] ) && strpos( $_GET['rest_route'], '/', 0 ) === 0 ) {
        return true;
    }

    global $wp_rewrite;

    if ( $wp_rewrite === null ) {
        $wp_rewrite = new WP_Rewrite();
    }

    $rest_url = wp_parse_url( trailingslashit( rest_url( ) ) );
    $current_url = wp_parse_url( add_query_arg( array( ) ) );

    return strpos( $current_url['path'], $rest_url['path'], 0 ) === 0;

}

/**
 * Add old IE assets to head.
 * 
 * @since 2.0.6
 */
function pdg_ie_assets() {
    get_template_part( 'template-parts/head/ie', 'assets' );
}
add_action( 'wp_head', 'pdg_ie_assets', 10 );

/**
 * Add old IE browser notice to body.
 * 
 * @since 2.0.6
 */
function pdg_ie_notice() {
    get_template_part( 'template-parts/head/ie', 'notice' );
}
add_action( 'wp_body_open', 'pdg_ie_notice', 1 );