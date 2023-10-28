<?php

function sp_enqueue(){
    wp_register_style(
        'sp_normalize_css',
        'https://necolas.github.io/normalize.css/8.0.1/normalize.css'
    );
    wp_register_style(
        'sp_style_css',
        get_theme_file_uri('assets/css/style.css')
    );

    wp_enqueue_style('sp_normalize_css');
    wp_enqueue_style('sp_style_css');
}