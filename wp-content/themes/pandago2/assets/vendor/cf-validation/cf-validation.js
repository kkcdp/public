/**
 * Check if given string is an email.
 *
 * @param {string} email
 *
 * @returns {boolean}
 */
 function is_email( email ) {

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    return regex.test( email );

}

/**
 * Check if given string is a phone number.
 *
 * @param {string} phone
 *
 * @returns {boolean}
 */
function is_phone( phone ) {

    var regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;

    return regex.test( phone );

}

jQuery( document ).ready( function( $ ) {

    var $cf = $( '[data-pdg-cf7] .wpcf7' );
    var cf;

    if ( $cf.length ) {
        cf = $cf[0];

        /**
         * Add 'has-error' classs to invalid inputs wrap
         * for custom styling.
         */
        cf.addEventListener( 'wpcf7invalid', function( e ) {
            $cf.find( '.has-error' ).removeClass( 'has-error' );

            $( '.wpcf7-not-valid', cf ).each( function( i, el ) {
                $( el ).closest( '.cf-vld-wrap' ).addClass( 'has-error' );
            } );
        } );

        /**
         * Add classes to response output.
         */
        cf.addEventListener( 'wpcf7invalid', function( event ) {
            $( '.wpcf7-response-output', cf ).addClass( 'cf-response cf-response--is-error' );
        }, false );
        cf.addEventListener( 'wpcf7spam', function( event ) {
            $( '.wpcf7-response-output', cf ).addClass( 'cf-response cf-response--is-error' );
        }, false );
        cf.addEventListener( 'wpcf7mailfailed', function( event ) {
            $( '.wpcf7-response-output', cf ).addClass( 'cf-response cf-response--is-error' );
        }, false );
        cf.addEventListener( 'wpcf7mailsent', function( event ) {
            $( '.wpcf7-response-output', cf ).addClass( 'cf-response cf-response--is-success' );

            console.log($( '.cf-vld-wrap', cf ).length)
            $( '.cf-vld-wrap', cf ).removeClass( 'has-error has-filled' );
            $( '.wpcf7-not-valid-tip', cf ).remove();
        }, false );

        /**
         * Main validation function.
         * @param object field
         */
        function validate_field( field ) {

            var $input = $( field );
            var $wrap  = $input.closest( '.cf-vld-wrap' );

            if ( $input.hasClass( 'wpcf7-validates-as-required' ) ) {
                if ( field.value ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'has-filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'has-filled' ).addClass( 'has-error' );

                    if ( ! $wrap.find( '.wpcf7-not-valid-tip' ).length ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pdg_strings.cf_messages.invalid_required + '</span>' ).insertAfter( $input );
                    }
                }
            }

            if ( $input.hasClass( 'wpcf7-validates-as-tel' ) ) {
                if ( is_phone( field.value ) ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'has-filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'has-filled' ).addClass( 'has-error' );

                    if ( ! $wrap.find( '.wpcf7-not-valid-tip' ).length ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pdg_strings.cf_messages.invalid_tel + '</span>' ).insertAfter( $input );
                    }
                }
            }

            if ( $input.hasClass( 'wpcf7-validates-as-email' ) ) {
                if ( is_email( field.value ) ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'has-filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'has-filled' ).addClass( 'has-error' );

                    if ( ! $wrap.find( '.wpcf7-not-valid-tip' ).length ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pdg_strings.cf_messages.invalid_email + '</span>' ).insertAfter( $input );
                    }
                }
            }

            if ( $input.hasClass( 'cf-no-vld' ) ) {
                if ( field.value ) {
                    $wrap.addClass( 'has-filled' );
                } else {
                    $wrap.removeClass( 'has-filled' );
                }
            }

        }

        /**
         * Validate contact form inputs on blur event.
         */
        $( document ).on( 'blur', '.cf-vld, .cf-no-vld', function() {
            validate_field( this );
        } );

        $( document ).on( 'click', '[data-pdg-cf7] [type="submit"]', function() {
            var $form = $( this ).closest( '.wpcf7' );

            $( this ).addClass( 'loading' );

            $( '.wpcf7-response-output', $form ).removeClass( 'cf-response--is-error cf-response--is-success' );
        } );

        cf.addEventListener( 'wpcf7submit', function(e) {
            $( '[data-pdg-cf7] [type="submit"]' ).removeClass( 'loading' );
        } );

        cf.addEventListener( 'wpcf7invalid', function(e) {
            setTimeout( function() {
                $( '.cf-vld', e.srcElement ).each( function( i, field ) {
                    validate_field( field );
                } );
            }, 0 );
        } );
    }

} );