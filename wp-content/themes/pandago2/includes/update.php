<?php if ( ! defined( 'ABSPATH' ) ) exit;

include PDG_PATH . '/includes/vendor/ThemeUpdateChecker.php';

$update_checker = new ThemeUpdateChecker(
    'PandaGo2',
    'http://developers.sem.lv/resources/pandago/update/update.json'
);