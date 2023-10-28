<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add required and optional plugins
 * 
 * @since 2.0.0
 * 
 * @link http://tgmpluginactivation.com/
 */
function pdg_register_plugins() {

    tgmpa( array(
        array(
            'name'               => 'Advanced Custom Fields PRO',
            'slug'               => 'advanced-custom-fields-pro',
            'source'             => PDG_URL_PLUGINS . '/advanced-custom-fields-pro.zip',
            'required'           => true,
            'version'            => '5.8.7',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Advanced Custom Fields Multilingual',
            'slug'               => 'advanced-custom-fields-multilingual',
            'source'             => PDG_URL_PLUGINS . '/acfml.1.9.4.zip',
            'required'           => false,
            'version'            => '1.9.4',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Sitepress Multilingual CMS',
            'slug'               => 'sitepress-multilingual-cms',
            'source'             => PDG_URL_PLUGINS . '/sitepress-multilingual-cms.4.4.12.zip',
            'required'           => false,
            'version'            => '4.4.12',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'WPML String Translation',
            'slug'               => 'wpml-string-translation',
            'source'             => PDG_URL_PLUGINS . '/wpml-string-translation.3.1.10.zip',
            'required'           => false,
            'version'            => '3.1.10',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'WPML Translation Management',
            'slug'               => 'wpml-translation-management',
            'source'             => PDG_URL_PLUGINS . '/wpml-translation-management.2.10.8.zip',
            'required'           => false,
            'version'            => '2.10.8',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Custom Post Type UI',
            'slug'               => 'custom-post-type-ui',
            'source'             => PDG_URL_PLUGINS . '/custom-post-type-ui.1.7.1.zip',
            'required'           => false,
            'version'            => '1.7.1',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Simple Custom Post Order',
            'slug'               => 'simple-custom-post-order',
            'source'             => PDG_URL_PLUGINS . '/simple-custom-post-order.2.4.7.zip',
            'required'           => false,
            'version'            => '2.4.7',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'reSmush.it',
            'slug'               => 'resmush-it',
            'source'             => PDG_URL_PLUGINS . '/resmushit-image-optimizer.0.4.1.zip',
            'required'           => false,
            'version'            => '0.4.1',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Fly Dynamic Image Resizer',
            'slug'               => 'fly-dynamic-image-resizer',
            'source'             => PDG_URL_PLUGINS . '/fly-dynamic-image-resizer.2.0.8.zip',
            'required'           => false,
            'version'            => '2.0.8',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Autoptimize',
            'slug'               => 'autoptimize',
            'source'             => PDG_URL_PLUGINS . '/autoptimize.2.5.1.zip',
            'required'           => false,
            'version'            => '2.5.1',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'W3 Total Cache',
            'slug'               => 'w3-total-cache',
            'source'             => PDG_URL_PLUGINS . '/w3-total-cache.0.12.0.zip',
            'required'           => false,
            'version'            => '0.12.0',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'YOAST SEO',
            'slug'               => 'yoast-seo',
            'source'             => PDG_URL_PLUGINS . '/wordpress-seo.17.0.zip',
            'required'           => false,
            'version'            => '17.0',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        )
    ), array() );

}
add_action( 'tgmpa_register', 'pdg_register_plugins' );