<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add attributes to html or body element if filter
 * is added.
 * @since 2.0.6
 * 
 * @param string $element Either html or body
 */
function pdg_element_attributes( $element ) {

    $atts_raw = apply_filters( 'pdg_' . $element . '_attributes', [] );

    if ( ! is_array( $atts_raw ) || empty( $atts_raw ) ) {
        return;
    }

    $atts = [];

    foreach ( $atts_raw as $name => $value ) {
        if ( $element == 'body' && $name == 'class' ) {
            continue;
        }

        $atts[] = $name . '="' . $value . '"';
    }

    echo implode( ' ', $atts );

}