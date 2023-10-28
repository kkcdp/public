$( document ).ready( function() {

    var $d = $( document );

    /**
     * Back button.
     */
    $d.on( 'click', '.js-pdg-back', function() {
        window.history.back();
    } );

    /**
     * Load more.
     */
    var can_load = true;

    $d.on( 'click', '.js-pdg-load-more', function() {

        var $btn = $( this );

        var id    = this.dataset.lmId;
        var lm    = pdg_load_more[id];
        var $wrap = $( '[data-lm-wrap="' + id + '"]' );

        var data = {
            action: 'pdg_load_more',
            args: lm.args,
            page: lm.page,
            max : lm.max,
            tpl : lm.tpl
        };

        if ( 'lang' in lm ) {
            data.lang = lm.lang;
        }

        if ( 'tpl_args' in lm ) {
            data.tpl_args = lm.tpl_args;
        }

        if ( ! can_load ) {
            return;
        }

        $.ajax( {
            type: 'post',
            url : pdg_opts.ajax_url,
            data: data,

            beforeSend: function() {
                can_load = false;

                $btn.addClass( 'loading' );
            },
            complete: function() {
                can_load = true;

                $btn.removeClass( 'loading' );
            },
            success: function( res ) {

                if ( res ) {
                    $wrap.append( res );
                    lm.page++;

                    if ( lm.page == lm.max ) {
                        $btn.remove();
                    }
                }

            }
        } )
    } );

} );