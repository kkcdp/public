<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if ( is_admin() ): ?>
    <div class="acf-block-section">
        <InnerBlocks />
    </div>
<?php else: ?>
    <?php
    $class = ['section', 'editor'];

    if ( isset( $block['className'] ) ) {
        $class[] = $block['className'];
    }

    $style = [];
    $style_att = '';

    // Prepare classes.
    if ( get_field( 'stretch' ) ) {
        $class[] = 'js-stretch';
    }

    $margin_lg = get_field( 'margin_lg' );
    if ( $margin_lg && $margin_lg != 'none' ) {
        $class[] = 'mgb--' . $margin_lg;
    }

    $margin_md = get_field( 'margin_md' );
    if ( $margin_md && $margin_md != 'none' ) {
        $class[] = 'mgb-md--' . $margin_md;
    }

    $margin_sm = get_field( 'margin_sm' );
    if ( $margin_sm && $margin_sm != 'none' ) {
        $class[] = 'mgb-sm--' . $margin_sm;
    }

    $padding_top_lg = get_field( 'padding_top_lg' );
    if ( $padding_top_lg && $padding_top_lg != 'none' ) {
        $class[] = 'pdt--' . $padding_top_lg;
    }

    $padding_top_md = get_field( 'padding_top_md' );
    if ( $padding_top_md && $padding_top_md != 'none' ) {
        $class[] = 'pdt-md--' . $padding_top_md;
    }

    $padding_top_sm = get_field( 'padding_top_sm' );
    if ( $padding_top_sm && $padding_top_sm != 'none' ) {
        $class[] = 'pdt-sm--' . $padding_top_sm;
    }

    $padding_bottom_lg = get_field( 'padding_bottom_lg' );
    if ( $padding_bottom_lg && $padding_bottom_lg != 'none' ) {
        $class[] = 'pdb--' . $padding_bottom_lg;
    }

    $padding_bottom_md = get_field( 'padding_bottom_md' );
    if ( $padding_bottom_md && $padding_bottom_md != 'none' ) {
        $class[] = 'pdb-md--' . $padding_bottom_md;
    }

    $padding_bottom_sm = get_field( 'padding_bottom_sm' );
    if ( $padding_bottom_sm && $padding_bottom_sm != 'none' ) {
        $class[] = 'pdb-sm--' . $padding_bottom_sm;
    }

    // Prepare style.
    $bg = get_field( 'bg' );

    if ( $bg && $bg != 'none' ) {
        $class[] = 'section--has-bg';
        $class[] = 'section--has-bg-' . $bg;

        if ( $bg == 'image' && get_field( 'bg_image' ) ) {
            $image_size = get_field( 'bg_image_size' );

            if ( strpos( $image_size, '[array]' ) !== false ) {
                $image_size = str_replace( ['[array]', '[/array]'], '', $image_size );
                $image_size = explode( ',', $image_size );
                $image_size = [intval( $image_size[0] ), intval( $image_size[1] )];
            }

            $style['background-image'] = 'url(' . pdg_get_image_src( get_field( 'bg_image' ), $image_size ) . ')';
            $style['background-position'] = get_field( 'bg_position' );

            if ( get_field( 'bg_size' ) != 'default' ) {
                $style['background-size'] = get_field( 'bg_size' );
            }
        } elseif ( $bg == 'color' && get_field( 'bg_color' ) ) {
            $style['background-color'] = get_field( 'bg_color' );
        }
    }

    if ( $style ) {
        $style_att = 'style="';

        foreach ( $style as $key => $value ) {
            $style_att .= $key . ': ' . $value . ';';
        }

        $style_att .= '"';
    }

    $class = implode( ' ', $class );
    ?>
    <section class="<?php echo $class; ?>" <?php echo $style_att; ?>>
        <?php if ( get_field( 'add_container' ) ): ?>
            <div class="container editor">
                <InnerBlocks />
            </div>
        <?php else: ?>
            <InnerBlocks />
        <?php endif; ?>
    </section>
<?php endif; ?>