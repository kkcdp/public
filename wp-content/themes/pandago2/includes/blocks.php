<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register custom block categories.
 */
function pdg_acf_block_category( $categories, $post ) {

    $categories[] = array(
        'slug' => 'custom',
        'title' => 'Custom'
    );

    return $categories;

}
add_filter( 'block_categories_all', 'pdg_acf_block_category', 10, 2 );

/**
 * Register custom ACF block.
 * 
 * @since 2.0.0
 * @param string     $name     Block name
 * @param bool       $style    Include style.css from blocks directory
 * @param bool       $script   Include script.js from blocks directory
 * @param bool/array $assets   Include custom assets
 * @param bool       $nestable Whether this block is nestable or not
 * @param string     $mode     Whether show block in edit or preview mode by default
 */
function pdg_add_acf_block( $name, $style = false, $script = false, $assets = false, $nestable = false, $mode = 'edit' ) {

    $slug = strtolower( str_replace( ' ', '-', $name ) );
    $args = array(
        'name'            => $slug,
        'title'           => $name,
        'mode'            => $mode,
        'render_template' => 'template-parts/blocks/' . $slug . '/index.php',
        'category'        => 'custom',
        'keywords'        => array( str_replace( '-', ' ', $slug ) ),
		'supports'        => array(
			'anchor' => true
		)
    );

	if ( ! is_admin() ) {
		if ( $style ) {
			$args['enqueue_style'] = PDGC_URL . '/template-parts/blocks/' . $slug . '/style.css';
		}
	
		if ( $script ) {
			$args['enqueue_script'] = PDGC_URL . '/template-parts/blocks/' . $slug . '/script.js';
		}
	
		if ( $assets ) {
			$args['enqueue_assets'] = $assets;
		}
	}

    if ( $nestable === true ) {
        $args['mode']            = 'preview';
        $args['supports']['jsx'] = true;
    } elseif ( is_array( $nestable ) ) {
		$args['parent'] = $nestable;
	}

    acf_register_block_type( $args );

}

/**
 * Register theme built-in blocks.
 * 
 * @since 2.0.0
 */
function pdg_acf_blocks() {

	pdg_add_acf_block( 'Section', false, false, false, true );
    pdg_add_acf_block( 'Container', false, false, false, true );
	pdg_add_acf_block( 'Row', false, false, false, true );
    pdg_add_acf_block( 'Column', false, false, false, true );

}
add_action( 'acf/init', 'pdg_acf_blocks' );

/**
 * Register block fields.
 * 
 * @since 2.0.0
 */
if ( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6152ba5d6a3e5',
	'title' => 'Column',
	'fields' => array(
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_6152bace7815b',
			'label' => 'Width',
			'name' => 'width',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bad97815c',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'acf_col_width',
						'id' => '',
					),
					'choices' => array(
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12',
					),
					'default_value' => 6,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bb0b7815d',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12',
					),
					'default_value' => 12,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bb1c7815e',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12',
					),
					'default_value' => 12,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_6152bb377815f',
			'label' => 'Offset',
			'name' => 'offset',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bb8478160',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => 'acf_col_offset',
						'id' => '',
					),
					'choices' => array(
						0 => '0',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
					),
					'default_value' => 0,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bb9a78161',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						0 => '0',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
					),
					'default_value' => 0,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_6152bbab78162',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						0 => '0',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
					),
					'default_value' => 0,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_column_order',
			'label' => 'Order',
			'name' => 'order',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_order_lg',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'default' => 'Default',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12'
					),
					'default_value' => 'default',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_order_md',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'default' => 'Default',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12'
					),
					'default_value' => 'default',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_order_sm',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'default' => 'Default',
						1 => '1',
						2 => '2',
						3 => '3',
						4 => '4',
						5 => '5',
						6 => '6',
						7 => '7',
						8 => '8',
						9 => '9',
						10 => '10',
						11 => '11',
						12 => '12'
					),
					'default_value' => 'default',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_column_margin',
			'label' => 'Margin',
			'name' => 'margin',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_margin_lg',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_margin_md',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_column_margin_sm',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_column_hide',
			'label' => 'Hide',
			'name' => 'hide',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'field_column_hide_lg',
					'label'             => 'LG ( Desktop )',
					'name'              => 'lg',
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
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'field_column_hide_md',
					'label'             => 'MD ( Tablet )',
					'name'              => 'md',
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
				),
				array(
					'wpml_cf_preferences' => 1,

					'key'               => 'field_column_hide_sm',
					'label'             => 'SM ( Mobile )',
					'name'              => 'sm',
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
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/column',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_row',
	'title' => 'Row',
	'fields' => array(
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_row_horizontal_alignment',
			'label' => 'Horizontal Alignment',
			'name' => 'horizontal_alignment',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_horizontal_alignment_lg',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'Inherit from smaller',
						'start' => 'Left',
						'center' => 'Center',
						'end' => 'Right',
						'between' => 'Space Between',
						'around' => 'Space Around',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_horizontal_alignment_md',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'Inherit from smaller',
						'start' => 'Left',
						'center' => 'Center',
						'end' => 'Right',
						'between' => 'Space Between',
						'around' => 'Space Around',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_horizontal_alignment_sm',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'start' => 'Left',
						'center' => 'Center',
						'end' => 'Right',
						'between' => 'Space Between',
						'around' => 'Space Around',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_row_vertical_alignment',
			'label' => 'Vertical Alignment',
			'name' => 'vertical_alignment',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_vertical_alignment_lg',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'Inherit from smaller',
						'start' => 'Top',
						'center' => 'Center',
						'end' => 'Bottom',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_vertical_alignment_md',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'Inherit from smaller',
						'start' => 'Top',
						'center' => 'Center',
						'end' => 'Bottom',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_vertical_alignment_sm',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'start' => 'Top',
						'center' => 'Center',
						'end' => 'Bottom',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'wpml_cf_preferences' => 1,

			'key' => 'field_row_margin',
			'label' => 'Margin',
			'name' => 'margin',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_margin_lg',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_margin_md',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'wpml_cf_preferences' => 1,

					'key' => 'field_row_margin_sm',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large'
					),
					'default_value' => 'none',
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/row',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_61d6c0d59fab1',
	'title' => 'Section',
	'fields' => array(
		array(
			'key' => 'field_61d6c6dda4d94',
			'label' => 'Stretch',
			'name' => 'stretch',
			'type' => 'true_false',
			'instructions' => 'Adds "js-stretch" class to section',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 0,
			'wpml_cf_preferences' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_61d6c6f9a4d95',
			'label' => 'Add Container',
			'name' => 'add_container',
			'type' => 'true_false',
			'instructions' => 'Append container as a child for this section',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 0,
			'wpml_cf_preferences' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_61d6c0e167db9',
			'label' => 'Background',
			'name' => 'bg',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'choices' => array(
				'none' => 'None',
				'color' => 'Color',
				'image' => 'Image',
			),
			'default_value' => 'none',
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_61d6c11267dbb',
			'label' => 'Image',
			'name' => 'bg_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_61d6c0e167db9',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_61d6c16eb3c67',
			'label' => 'Position',
			'name' => 'bg_position',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_61d6c0e167db9',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'center top' => 'Center / Top',
				'center center' => 'Center / Center',
				'center bottom' => 'Center / Bottom',
				'left top' => 'Left / Top',
				'left center' => 'Left / Center',
				'left bottom' => 'Left / Bottom',
				'right top' => 'Right / Top',
				'right center' => 'Right / Center',
				'right bottom' => 'Right / Bottom',
			),
			'default_value' => 'center center',
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'wpml_cf_preferences' => 1,
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_61d6c2257a64d',
			'label' => 'Size',
			'name' => 'bg_size',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_61d6c0e167db9',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'choices' => array(
				'default' => 'Default',
				'contain' => 'Contain',
				'cover' => 'Cover',
				'100% 100%' => '100%',
			),
			'default_value' => 'default',
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_61d6c3d74338a',
			'label' => 'Image Size',
			'name' => 'bg_image_size',
			'type' => 'text',
			'instructions' => 'WordPress image size or array containing width and height values.<br>Example 1: large<br>Example 2: [array]800,400[/array]',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_61d6c0e167db9',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'default_value' => 'full',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_61d6c12d67dbc',
			'label' => 'Color',
			'name' => 'bg_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_61d6c0e167db9',
						'operator' => '==',
						'value' => 'color',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'default_value' => '',
			'enable_opacity' => 0,
			'return_format' => 'string',
		),
		array(
			'key' => 'field_61d6c7de6e758',
			'label' => 'Margin',
			'name' => 'margin',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'wpml_cf_preferences' => 1,
			'sub_fields' => array(
				array(
					'key' => 'field_61d6c7e96e759',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'wpml_cf_preferences' => 1,
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c87f6e75a',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'wpml_cf_preferences' => 1,
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c88a6e75b',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'wpml_cf_preferences' => 1,
					'ajax' => 0,
					'placeholder' => '',
				),
			),
		),
		array(
			'key' => 'field_61d6c912730ea',
			'label' => 'Padding Top',
			'name' => 'padding_top',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_61d6c912730eb',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => '',
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c912730ec',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => '',
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c912730ed',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => '',
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
		),
		array(
			'key' => 'field_61d6c922730ee',
			'label' => 'Padding Bottom',
			'name' => 'padding_bottom',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'wpml_cf_preferences' => 1,
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_61d6c922730ef',
					'label' => 'LG ( Desktop )',
					'name' => 'lg',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => 1,
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c922730f0',
					'label' => 'MD ( Tablet )',
					'name' => 'md',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => 1,
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_61d6c922730f1',
					'label' => 'SM ( Mobile )',
					'name' => 'sm',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'wpml_cf_preferences' => 1,
					'choices' => array(
						'none' => 'None',
						'xs' => 'Extra Small',
						's' => 'Small',
						'm' => 'Medium',
						'l' => 'Large',
						'xl' => 'Extra Large',
						'xxl' => 'Extra Extra Large',
					),
					'default_value' => 'none',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/section',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;