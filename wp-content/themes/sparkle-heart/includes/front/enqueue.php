<?php

function sp_enqueue(){
    wp_register_style(
        'sp_font_montserrat_and_oswald',
        'https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@500&display=swap',
        [],
        null
    );

    wp_register_style(
        'sp_normalize_css',
        'https://necolas.github.io/normalize.css/8.0.1/normalize.css'
    );
    wp_register_style(
        'sp_theme',
        get_theme_file_uri('assets/css/style.css')
    );

    wp_enqueue_style('sp_font_montserrat_and_oswald');
    wp_enqueue_style('sp_normalize_css');
    wp_enqueue_style('sp_theme');
}