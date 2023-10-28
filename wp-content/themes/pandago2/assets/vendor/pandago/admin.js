function set_column_width() {
    jQuery( '.acf-block-column' ).each( function( i, block ) {
        jQuery( block ).closest( '[data-type="acf/column"]' ).attr( {
            'data-width' : this.dataset.width,
            'data-offset': this.dataset.offset
        } );
    } );
}

jQuery( window ).on( 'load', set_column_width );

jQuery( document ).ready( function( $ ) {
    $( document ).on( 'change', '.acf_col_width select', function() {
        $( '[data-type="acf/column"].is-selected' ).attr( 'data-width', this.value );
    } );

    $( document ).on( 'change', '.acf_col_offset select', function() {
        $( '[data-type="acf/column"].is-selected' ).attr( 'data-offset', this.value );
    } );
} );