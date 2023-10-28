<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<ul class="pager w-100 flex align-items-center justify-content-end">

    <?php if ( $args['paged'] > 1 ): ?>
        <?php if ( isset( $args['strings']['first'] ) && ! empty( $args['strings']['first'] ) ): ?>
            <li class="pager__arrow pager__arrow--first">
                <a class="pager__arrow-link" href="<?php echo get_pagenum_link( 1 ); ?>"><?php echo $args['strings']['first']; ?></a>
            </li>
        <?php endif; ?>

        <?php if ( isset( $args['strings']['prev'] ) && ! empty( $args['strings']['prev'] ) ): ?>
            <li class="pager__arrow pager__arrow--prev">
                <a class="pager__arrow-link" href="<?php echo get_pagenum_link( $args['paged'] - 1 ); ?>"><?php echo $args['strings']['prev']; ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    <?php for ( $i = 1; $i <= $args['pages']; $i++ ): ?>
        <?php if ( $args['paged'] <= $args['range'] / 2 + 1 ): ?>
            <?php if ( 1 != $args['pages'] && ( ! ( $i >= $args['showitems'] + 1 || $i <= $args['paged'] - $args['range'] - 1 ) || $args['pages'] <= $args['showitems'] ) ): ?>
                <?php if ( $args['paged'] == $i ): ?>
                    <li class="pager__item pager__item--is-current">
                        <span class="pager__item-link pager__item-link--is-current" data-page="<?php echo $i; ?>"><?php echo $i; ?></span>
                    </li>
                <?php else: ?>
                    <li class="pager__item">
                        <a class="pager__item-link" href="<?php echo get_pagenum_link( $i ); ?>" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if ( 1 != $args['pages'] && ( ! ( $i >= $args['paged'] + $args['range'] + 1 || $i <= $args['paged'] - $args['range'] - 1 ) || $args['pages'] <= $args['showitems'] ) ): ?>
                <?php if ( $args['paged'] == $i ): ?>
                    <li class="pager__item pager__item--is-current">
                        <span class="pager__item-link pager__item-link--is-current" data-page="<?php echo $i; ?>"><?php echo $i; ?></span>
                    </li>
                <?php else: ?>
                    <li class="pager__item">
                        <a class="pager__item-link" href="<?php echo get_pagenum_link( $i ); ?>" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ( $args['paged'] < $args['pages'] ): ?>
        <?php if ( isset( $args['strings']['next'] ) && ! empty( $args['strings']['next'] ) ): ?>
            <li class="pager__arrow pager__arrow--next">
                <a class="pager__arrow-link" href="<?php echo get_pagenum_link( $args['paged'] + 1 ); ?>"><?php echo $args['strings']['next']; ?></a>
            </li>
        <?php endif; ?>

        <?php if ( isset( $args['strings']['last'] ) && ! empty( $args['strings']['last'] ) ): ?>
            <li class="pager__arrow pager__arrow--last">
                <a class="pager__arrow-link" href="<?php echo get_pagenum_link( $args['pages'] ); ?>"><?php echo $args['strings']['last']; ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

</ul>