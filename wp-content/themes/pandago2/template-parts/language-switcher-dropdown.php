<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<select class="lang-switch" onchange="window.location.href = this.value">
    <?php foreach ( $args['languages'] as $language ): ?>
        <?php $current = ( $language['active'] == 1 ) ? 'selected' : ''; ?>

        <option <?php echo $current; ?> value="<?php echo $language['url']; ?>">
            <?php echo $language[$args['lang_display']]; ?>
        </option>

    <?php endforeach; ?>
</select>