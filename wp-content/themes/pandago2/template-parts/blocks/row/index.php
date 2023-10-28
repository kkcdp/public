<?php if ( ! defined( 'ABSPATH' ) ) exit;

$allow = array( 'acf/column' );
?>

<?php if ( is_admin() ): ?>
    <div class="acf-block-row">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allow ) ); ?>" />
    </div>
<?php else: ?>

    <?php
    $class = ['row'];

    if ( isset( $block['className'] ) ) {
        $class[] = $block['className'];
    }

    $x_align = [
        'lg' => get_field( 'horizontal_alignment_lg' ),
        'md' => get_field( 'horizontal_alignment_md' ),
        'sm' => get_field( 'horizontal_alignment_sm' )
    ];

    if ( $x_align['sm'] != 'none' ) {
        $class[] = 'justify-content-' . $x_align['sm'];
    }

    if ( $x_align['md'] != 'none' ) {
        $class[] = 'justify-content-md-' . $x_align['md'];
    }

    if ( $x_align['lg'] != 'none' ) {
        $class[] = 'justify-content-lg-' . $x_align['lg'];
    }

    $y_align = [
        'lg' => get_field( 'vertical_alignment_lg' ),
        'md' => get_field( 'vertical_alignment_md' ),
        'sm' => get_field( 'vertical_alignment_sm' )
    ];

    if ( $y_align['sm'] != 'none' ) {
        $class[] = 'align-items-' . $y_align['sm'];
    }

    if ( $y_align['md'] != 'none' ) {
        $class[] = 'align-items-md-' . $y_align['md'];
    }

    if ( $y_align['lg'] != 'none' ) {
        $class[] = 'align-items-lg-' . $y_align['lg'];
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
    ?>

    <div class="<?php echo implode( ' ', $class ); ?>">
        <InnerBlocks />
    </div>
<?php endif; ?>