<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add main options pages.
 * @since 2.0.0
 */
function pdg_add_options_pages() {

    $main = acf_add_options_page( array(
        'page_title' => 'PandaGo Options',
        'menu_title' => 'PandaGo Options',
        'position'   => '999.9'
    ) );

	$general = acf_add_options_sub_page( array(
        'page_title'  => 'General',
        'menu_title'  => 'General',
		'menu_slug'   => 'pdg-general',
        'parent_slug' => $main['menu_slug']
    ) );

    $apis = acf_add_options_sub_page( array(
        'page_title'  => 'APIs & Keys',
        'menu_title'  => 'APIs & Keys',
		'menu_slug'   => 'pdg-apis',
        'parent_slug' => $main['menu_slug']
    ) );

    $browser = acf_add_options_sub_page( array(
        'page_title'  => 'Browser Support',
        'menu_title'  => 'Browser Support',
		'menu_slug'   => 'pdg-browser',
        'parent_slug' => $main['menu_slug']
    ) );

    $cookies = acf_add_options_sub_page( array(
        'page_title'  => 'Cookie Consent',
        'menu_title'  => 'Cookie Consent',
		'menu_slug'   => 'pdg-cookie',
        'parent_slug' => $main['menu_slug']
    ) );

    $js = acf_add_options_sub_page( array(
        'page_title'  => 'JavaScript Plugins',
        'menu_title'  => 'JavaScript Plugins',
		'menu_slug'   => 'pdg-js',
        'parent_slug' => $main['menu_slug']
    ) );

    $optimisation = acf_add_options_sub_page( array(
        'page_title'  => 'Optimisation',
        'menu_title'  => 'Optimisation',
		'menu_slug'   => 'pdg-optimisation',
        'parent_slug' => $main['menu_slug']
    ) );

	$theme_main = acf_add_options_page( array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
		'menu_slug'  => 'pdgc-options',
        'position'   => '998.9'
    ) );

	$theme_general = acf_add_options_sub_page( array(
        'page_title'  => 'General',
        'menu_title'  => 'General',
		'menu_slug'   => 'pdgc-general',
        'parent_slug' => 'pdgc-options',
		'position'    => '10'
    ) );

	$social = acf_add_options_sub_page( array(
        'page_title'  => 'Social Networks',
        'menu_title'  => 'Social Networks',
		'menu_slug'   => 'pdgc-soc',
        'parent_slug' => $theme_general['menu_slug'],
		'position'    => '10.1'
    ) );

}
add_action( 'acf/init', 'pdg_add_options_pages' );

/**
 * Generates instructions for "JavaScript Plugins" options
 * page fields for code readibility.
 * 
 * @since 2.0.0
 * @param string  $handle
 * @param string  $link
 * @param string  $ver
 * @param boolean $js
 * @param boolean $css
 * @return string
 */
function pdg_js_options_instructions( $handle, $link, $ver, $js, $css ) {

	$has_js  = ( $js ) ? 'Yes' : 'No';
	$has_css = ( $css ) ? 'Yes' : 'No';

	$handle = '<strong>Handle:</strong> ' . $handle . '<br>';
	$link   = '<strong>Link:</strong> <a href="' . $link . '" target="_blank">' . $link . '</a><br>';
	$ver    = '<strong>Version:</strong> ' . $ver . '<br>';
	$js     = '<strong>JS:</strong> ' . $has_js . '<br>';
	$css    = '<strong>CSS:</strong> ' . $has_css;

	return $handle . $link . $ver . $js . $css;

}

/**
 * Add fields for "General" options page.
 */
function pdg_options_get_general_fields() {

	$fields = array(
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_general_remove_comments',
			'label'             => 'Remove Comments',
			'name'              => 'pdg_general_remove_comments',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'message'           => '',
			'default_value'     => 1,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => ''
		)
	);

	// Create "Main Contact Form" fields for every language.
	if ( class_exists( 'WPCF7' ) ) {
		$fields[] = array(
			'wpml_cf_preferences' => 0,

			'key'               => 'pdg_general_main_cf',
			'label'             => 'Main Contact Form',
			'name'              => 'pdg_general_main_cf',
			'type'              => 'post_object',
			'instructions'      => 'Main Contact form from which messages will be retrieved for JavaScript validation.',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'post_type'         => array(
				0 => 'wpcf7_contact_form',
			),
			'taxonomy'          => '',
			'allow_null'        => 0,
			'multiple'          => 0,
			'return_format'     => 'object',
			'ui'                => 1
		);
	}

	return $fields;

}

acf_add_local_field_group( array(
    'key'   => 'group_pdg_general',
    'title' => 'General',

    'fields' => pdg_options_get_general_fields(),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdg-general',
            )
        )
    ),

    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );

/**
 * Add fields for "APIs & Keys" options page.
 */
acf_add_local_field_group( array(
    'key'   => 'group_pdg_apis',
    'title' => 'APIs & Keys',

    'fields' => array(
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_apis_gm',
			'label'             => 'Google Maps',
			'name'              => 'pdg_apis_gm',
			'type'              => 'group',
			'instructions'      => 'When API key is entered Google Maps script will be registered with handle "pdg-google-maps" which can later be enqueued using wp_enqueue_script( \'pdg-google-maps\' ) when you need it.<br>As an alternative you can tick "Enqueue" checkbox to load this script on all pages ( not recommended ).',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_apis_gm_key',
					'label'             => 'API Key',
					'name'              => 'key',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_apis_gm_callback',
					'label'             => 'Callback',
					'name'              => 'callback',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '30',
						'class' => '',
						'id'    => ''
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_apis_gm_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '20',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				)
			),
		),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_apis_fb_app_id',
            'label'             => 'Facebook APP ID',
            'name'              => 'pdg_apis_fb_app_id',
            'type'              => 'text',
            'instructions'      => 'This field can be retrieved using get_field( \'pdg_apis_fb_app_id\', \'option\' ) or in JavaScript using pdg_opts.fb_app_id',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
        )
    ),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdg-apis',
            )
        )
    ),

    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );

/**
 * Add fields for "Browser Support" options page.
 */
acf_add_local_field_group( array(
    'key'   => 'group_pdg_browser',
    'title' => 'Browser Support',

    'fields' => array(
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_browser_notice',
            'label'             => 'Browser Notice',
            'name'              => 'pdg_browser_notice',
            'type'              => 'checkbox',
            'instructions'      => 'Show outdated browser notice for the following browsers',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'choices'           => array(
                'ie6'  => 'IE6',
                'ie7'  => 'IE7',
                'ie8'  => 'IE8',
                'ie9'  => 'IE9',
                'ie10' => 'IE10',
                'ie11' => 'IE11',
                'edge' => 'Edge'
            ),
            'allow_custom'      => 0,
            'default_value'     => array(
                0 => 'ie6',
                1 => 'ie7',
                2 => 'ie8',
                3 => 'ie9',
                4 => 'ie10',
				5 => 'ie11'
            ),
            'layout'            => 'horizontal',
            'toggle'            => 0,
            'return_format'     => 'value',
            'save_custom'       => 0
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_browser_class',
            'label'             => 'Browser Class',
            'name'              => 'pdg_browser_class',
            'type'              => 'checkbox',
            'instructions'      => 'Add browsers class to html element for following browsers / devices',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
            'width' => '',
            'class' => '',
            'id' => '',
            ),
            'choices'           => array(
                'ie10'    => 'IE10',
                'ie11'    => 'IE11',
                'edge'    => 'Edge',
                'chrome'  => 'Chrome',
                'firefox' => 'Firefox',
                'opera'   => 'Opera',
                'safari'  => 'Safari',
                'ios'     => 'iOS',
                'android' => 'Android',
                'touch'   => 'Touch'
            ),
            'allow_custom'      => 0,
            'default_value'     => array(),
            'layout'            => 'horizontal',
            'toggle'            => 0,
            'return_format'     => 'value',
            'save_custom'       => 0
        )
    ),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdg-browser',
            )
        )
    ),

    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );

/**
 * Add fields for "Cookie Consent" options page.
 */
acf_add_local_field_group( array(
    'key'   => 'group_pdg_cookies',
    'title' => 'Cookie Consent',

    'fields' => array(
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_cookie_enable',
			'label'             => 'Enable',
			'name'              => 'pdg_cc_enable',
			'type'              => 'true_false',
			'instructions'      => 'Enable/disable simple cookie consent popup. Disable this if you want to use custom cookie consent plugin.',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'message'           => '',
			'default_value'     => 1,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => ''
		),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_cookie_position',
            'label'             => 'Position',
            'name'              => 'pdg_cc_position',
            'type'              => 'select',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'choices'           => array(
                'bottom-right' => 'Bottom Right',
                'bottom-left'  => 'Bottom Left'
            ),
            'default_value'     => array(
                0 => 'bottom-right'
            ),
            'allow_null'        => 0,
            'multiple'          => 0,
            'ui'                => 0,
            'return_format'     => 'value',
            'ajax'              => 0,
            'placeholder'       => ''
        ),
        array(
			'wpml_cf_preferences' => 2,

            'key'               => 'pdg_cookie_message',
            'label'             => 'Message',
            'name'              => 'pdg_cc_message',
            'type'              => 'textarea',
            'instructions'      => 'Set custom message to display instead of the default one.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 4,
            'new_lines'         => 'br'
        ),
        array(
			'wpml_cf_preferences' => 2,

            'key'               => 'pdg_cookie_allow',
            'label'             => 'Allow',
            'name'              => 'pdg_cc_allow',
            'type'              => 'text',
            'instructions'      => 'Set custom text for "Allow" button.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '33.33',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
        ),
        array(
			'wpml_cf_preferences' => 2,

            'key'               => 'pdg_cookie_deny',
            'label'             => 'Deny',
            'name'              => 'pdg_cc_deny',
            'type'              => 'text',
            'instructions'      => 'Set custom text for "Deny" button.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '33.33',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
        ),
        array(
			'wpml_cf_preferences' => 2,

            'key'               => 'pdg_cookie_learn_more',
            'label'             => 'Learn More',
            'name'              => 'pdg_cc_learn_more',
            'type'              => 'text',
            'instructions'      => 'Set custom text for "Learn More" link.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '33.33',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
        ),
        array(
			'wpml_cf_preferences' => 2,

            'key'               => 'pdg_cookie_link',
            'label'             => 'Privacy Policy',
            'name'              => 'pdg_cc_link',
            'type'              => 'text',
            'instructions'      => 'Link to privacy policy page.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_on_consent_head',
            'label'             => 'On Consent ( HEAD )',
            'name'              => 'pdg_cc_on_consent_head',
            'type'              => 'textarea',
            'instructions'      => 'Code that will be appended to the head tag of your site when cookie consent gets accepted.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 16,
            'new_lines'         => ''
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_on_consent_body',
            'label'             => 'On Consent ( BODY )',
            'name'              => 'pdg_cc_on_consent_body',
            'type'              => 'textarea',
            'instructions'      => 'Code that will be appended to the body tag of your site when cookie consent gets accepted.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 16,
            'new_lines'         => ''
        ),
    ),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdg-cookie',
            )
        )
    ),

    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );

/**
 * Add fields for "JavaScript Plugins" options page.
 */
acf_add_local_field_group(array(
	'key'   => 'group_pdg_js',
	'title' => 'JavaScript Plugins',

	'fields' => array(
		array(
			'key' => 'pdg_js_info',
			'label' => 'Info',
			'name' => '',
			'type'              => 'message',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'message'           => 'Ticking "Register" will register the plugin files using wp_register_* function which you can later on enqueue using wp_enqueue_* when you need it.<br>If plugin has only JS you need to use just wp_enqueue_script() if it has both JS and CSS you additionally need to use wp_enqueue_style().<br><br>Ticking "Enqueue" will enqueue plugin files on all pages.',
			'new_lines'         => 'wpautop',
			'esc_html'          => 0
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_aos',
			'label'             => 'AOS',
			'name'              => 'pdg_js_aos',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-aos', 'https://github.com/michalsnik/aos/tree/v2/', '2.0.0', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_aos_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_aos_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_clamp',
			'label'             => 'Clamp',
			'name'              => 'pdg_js_clamp',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-clamp', 'https://github.com/josephschmitt/Clamp.js/', '0.5.1', true, false ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_clamp_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_clamp_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_datepicker',
			'label'             => 'Datepicker',
			'name'              => 'pdg_js_datepicker',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-datepicker', 'https://api.jqueryui.com/datepicker/', '1.12.1', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_datepicker_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_datepicker_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_fancybox',
			'label'             => 'Fancybox',
			'name'              => 'pdg_js_fancybox',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-fancybox', 'http://fancyapps.com/fancybox/3/', '3.5.7', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_fancybox_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_fancybox_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_flexslider',
			'label'             => 'Flexslider',
			'name'              => 'pdg_js_flexslider',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-flexslider', 'http://flexslider.woothemes.com/', '2.7.2', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_flexslider_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_flexslider_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_hoverintent',
			'label'             => 'HoverIntent',
			'name'              => 'pdg_js_hoverintent',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-hoverintent', 'https://github.com/briancherne/jquery-hoverIntent', '1.10.1', true, false ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_hoverintent_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_hoverintent_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_isonscreen',
			'label'             => 'isOnScreen',
			'name'              => 'pdg_js_isonscreen',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-isonscreen', 'https://github.com/moagrius/isOnScreen/', 'N/A', true, false ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_isonscreen_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_isonscreen_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_modernizr',
			'label'             => 'Modernizr',
			'name'              => 'pdg_js_modernizr',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-modernizr', 'https://modernizr.com/', '3.5.0', true, false ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_modernizr_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_modernizr_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_nicescroll',
			'label'             => 'NiceScroll',
			'name'              => 'pdg_js_nicescroll',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-nicescroll', 'https://nicescroll.areaaperta.com/', '3.7.6', true, false ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_nicescroll_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_nicescroll_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_slick_slider',
			'label'             => 'Slick Slider',
			'name'              => 'pdg_js_slick',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-slick', 'https://kenwheeler.github.io/slick/', '1.8.1', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_slick_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_slick_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_sumoselect',
			'label'             => 'SumoSelect',
			'name'              => 'pdg_js_sumoselect',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-sumoselect', 'https://github.com/HemantNegi/jquery.sumoselect', '3.0.2', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_sumoselect_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_sumoselect_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_js_tooltipster',
			'label'             => 'Tooltipster',
			'name'              => 'pdg_js_tooltipster',
			'type'              => 'group',
			'instructions'      => pdg_js_options_instructions( 'pdg-tooltipster', 'https://www.heteroclito.fr/modules/tooltipster/', '4.2.8', true, true ),
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'layout'            => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_tooltipster_register',
					'label'             => 'Register',
					'name'              => 'register',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'pdg_js_tooltipster_enqueue',
					'label'             => 'Enqueue',
					'name'              => 'enqueue',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => ''
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 0,
					'ui_on_text'        => '',
					'ui_off_text'       => ''
				),
			),
		)
	),

	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'pdg-js',
			),
		),
	),

	'menu_order'            => 0,
	'position'              => 'normal',
	'style'                 => 'default',
	'label_placement'       => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen'        => '',
	'active'                => true,
	'description'           => ''
) );

/**
 * Add fields for "Optimisation" options page.
 */
function pdg_options_get_optimisation_fields() {

	$fields = array(
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_optimisation_remove_jquery_migrate',
			'label'             => 'Remove jQuery Migrate',
			'name'              => 'pdg_optimisation_remove_jquery_migrate',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'message'           => '',
			'default_value'     => 1,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => ''
		),
		array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_optimisation_move_jquery_to_footer',
			'label'             => 'Move jQuery To Footer',
			'name'              => 'pdg_optimisation_move_jquery_to_footer',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '33.33',
				'class' => '',
				'id'    => ''
			),
			'message'           => '',
			'default_value'     => 1,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => ''
		),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_optimisation_late_js',
            'label'             => 'Late JS',
            'name'              => 'pdg_optimisation_late_js',
            'type'              => 'textarea',
            'instructions'      => 'Which JavaScript files should be loaded after user interaction. Use WP handles separated by commas.<br>Handles can be found <a href="/?dump-assets" target="_blank">here</a>.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => 'pdgc-late',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 4,
            'new_lines'         => ''
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_optimisation_late_css',
            'label'             => 'Late CSS',
            'name'              => 'pdg_optimisation_late_css',
            'type'              => 'textarea',
            'instructions'      => 'Which CSS files should be loaded after user interaction. Use WP handles separated by commas.<br>Handles can be found <a href="/?dump-assets" target="_blank">here</a>.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => 'pdgc-late',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 4,
            'new_lines'         => ''
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_optimisation_remove_js',
            'label'             => 'Remove JS',
            'name'              => 'pdg_optimisation_remove_js',
            'type'              => 'textarea',
            'instructions'      => 'Which JS files should be removed. Use WP handles separated by commas.<br>Handles can be found <a href="/?dump-assets" target="_blank">here</a>.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 4,
            'new_lines'         => ''
        ),
        array(
			'wpml_cf_preferences' => 1,

            'key'               => 'pdg_optimisation_remove_css',
            'label'             => 'Remove CSS',
            'name'              => 'pdg_optimisation_remove_css',
            'type'              => 'textarea',
            'instructions'      => 'Which CSS files should be removed. Use WP handles separated by commas.<br>Handles can be found <a href="/?dump-assets" target="_blank">here</a>.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'maxlength'         => '',
            'rows'              => 4,
            'new_lines'         => ''
        )
	);

	if ( function_exists( 'w3tc_flush_all' ) ) {
		$fields[] = array(
			'wpml_cf_preferences' => 1,

			'key'               => 'pdg_optimisation_clear_cache_when_saving_posts',
			'label'             => 'Clear Cache When Saving Posts',
			'name'              => 'pdg_optimisation_clear_cache_when_saving_posts',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'message'           => '',
			'default_value'     => 0,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => ''
		);
	}

	return $fields;

}

acf_add_local_field_group( array(
    'key'   => 'group_pdg_optimisation',
    'title' => 'Optimisation',

    'fields' => pdg_options_get_optimisation_fields(),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdg-optimisation',
            )
        )
    ),

    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );

/**
 * Add fields for "Social Networks" options page.
 */
acf_add_local_field_group( array(
	'key'   => 'group_pdg_soc',
	'title' => 'Social',

	'fields' => array(
		array(
			'key'               => 'pdg_soc_social',
			'label'             => 'Social',
			'name'              => 'social',
			'type'              => 'repeater',
			'wpml_cf_preferences' => 1,
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => ''
			),
			'collapsed'         => '',
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'table',
			'button_label'      => 'Add Item',
			'sub_fields'        => array(
				array(
					'key'               => 'pdg_soc_social_title',
					'label'             => 'Title',
					'name'              => 'title',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => ''
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => ''
				),
				array(
					'key'               => 'pdg_soc_social_icon',
					'label'             => 'Icon',
					'name'              => 'icon',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => ''
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => ''
				),
				array(
					'key'               => 'pdg_soc_social_url',
					'label'             => 'URL',
					'name'              => 'url',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => ''
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => ''
				)
			)
		)
	),
	'location' => array(
		array(
			array(
				'param'    => 'options_page',
				'operator' => '==',
				'value'    => 'pdgc-soc'
			),
		),
	),
	'menu_order'            => 0,
	'position'              => 'normal',
	'style'                 => 'default',
	'label_placement'       => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen'        => '',
	'active'                => true,
	'description'           => ''
) );

/**
 * Add generic page fields.
 */
acf_add_local_field_group(array(
	'key' => 'group_61658fe87fd7b',
	'title' => 'Page',
	'fields' => array(
		array(
			'key' => 'field_61658fee1b5b9',
			'label' => 'Hide Page Title',
			'name' => 'hide_page_title',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
) );

/**
 * Add general fields for "Theme Options".
 */
acf_add_local_field_group( array(
    'key'   => 'group_pdgc_general',
    'title' => 'General',

    'fields' => array(
		array(
            'key'               => 'pdgc_general_copyright',
            'label'             => 'Copyright',
            'name'              => 'copyright',
            'type'              => 'text',
            'instructions'      => 'Copyright text. Place [year] where automatic year should appear.',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => ''
            ),
            'default_value'     => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
            'maxlength'         => ''
		)
	),

    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'pdgc-general',
            )
        )
    ),

    'menu_order'            => 1,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => ''
) );