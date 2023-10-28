<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<ul class="lang-switch flex">
    <?php foreach ( $args['languages'] as $language ): ?>
        <?php $current = ( $language['active'] == 1 ) ? ' lang-switch__link--is-active' : ''; ?>

        <li class="lang-switch__item">
            <a class="lang-switch__link<?php echo $current; ?>" href="<?php echo $language['url']; ?>" hreflang="<?php echo $language['code']; ?>"><?php echo $language[$args['lang_display']]; ?></a>
        </li>

    <?php endforeach; ?>
</ul>