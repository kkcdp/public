<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if ( is_admin() ): ?>
    <div class="acf-block-column" data-width="<?php the_field( 'width_lg' ); ?>" data-offset="<?php the_field( 'offset_lg' ); ?>">
        <InnerBlocks />
    </div>
<?php else: ?>
    <?php
    $class = ['editor'];

    if ( isset( $block['className'] ) ) {
        $class[] = $block['className'];
    }

    if ( $width_lg = get_field( 'width_lg' ) ) {
        $class[] = 'col-lg-' . $width_lg;
    } else {
        $class[] = 'col-lg-6';
    }

    if ( $width_md = get_field( 'width_md' ) ) {
        $class[] = 'col-md-' . $width_md;
    }

    if ( $width_sm = get_field( 'width_sm' ) ) {
        $class[] = 'col-' . $width_sm;
    }

    $offset_lg = get_field( 'offset_lg' );
    if ( $offset_lg || $offset_lg === '0' ) {
        $class[] = 'offset-lg-' . $offset_lg;
    }

    $offset_md = get_field( 'offset_md' );
    if ( $offset_md || $offset_md === '0' ) {
        $class[] = 'offset-md-' . $offset_md;
    }

    $offset_sm = get_field( 'offset_sm' );
    if ( $offset_sm || $offset_sm === '0' ) {
        $class[] = 'offset-sm-' . $offset_sm;
    }

    $order_lg = get_field( 'order_lg' );
    if ( $order_lg && $order_lg != 'default' || $order_lg === '0' ) {
        $class[] = 'order-lg-' . $order_lg;
    }

    $order_md = get_field( 'order_md' );
    if ( $order_md && $order_md != 'default' || $order_md === '0' ) {
        $class[] = 'order-md-' . $order_md;
    }

    $order_sm = get_field( 'order_sm' );
    if ( $order_sm && $order_sm != 'default' || $order_sm === '0' ) {
        $class[] = 'order-' . $order_sm;
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

    $hide = [
        'lg' => get_field( 'hide_lg' ),
        'md' => get_field( 'hide_md' ),
        'sm' => get_field( 'hide_sm' )
    ];

    if ( $hide['lg'] ) {
        $class[] = 'd-lg-none';
    }

    if ( $hide['md'] ) {
        $class[] = 'd-md-none';

        if ( ! $hide['lg'] ) {
            $class[] = 'd-lg-block';
        }
    }

    if ( $hide['sm'] ) {
        $class[] = 'd-none';

        if ( ! $hide['lg'] ) {
            $class[] = 'd-lg-block';
        }

        if ( ! $hide['md'] ) {
            $class[] = 'd-md-block';
        }
    }
    ?>

    <div class="<?php echo implode( ' ', $class ); ?>">
        <InnerBlocks />
    </div>
<?php endif; ?>