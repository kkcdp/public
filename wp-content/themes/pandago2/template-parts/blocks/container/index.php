<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if ( is_admin() ): ?>
    <div class="acf-block-container">
        <InnerBlocks />
    </div>
<?php else: ?>
    <?php
    $class = ['container', 'editor'];

    if ( isset( $block['className'] ) ) {
        $class[] = $block['className'];
    }
    ?>

    <div class="<?php echo implode( ' ', $class ); ?>">
        <InnerBlocks />
    </div>
<?php endif; ?>