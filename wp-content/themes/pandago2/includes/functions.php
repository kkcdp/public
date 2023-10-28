<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get YouTube video ID from URL.
 * 
 * @since 2.0.0
 * 
 * @param string $url
 * @return string
 */
function pdg_get_youtube_video_id( $url ) {

    parse_str( parse_url( $url, PHP_URL_QUERY ), $vars );

    if ( isset( $vars['v'] ) ) {
        return $vars['v'];
    }

    return '';

}

/**
 * Get YouTube video thumbnail.
 * 
 * @since 2.0.0
 * 
 * @param string $id      YouTube video ID or link
 * @param string $quality Thumbnail quality ( low | medium | high | max )
 * @return string
 */
function pdg_get_youtube_video_thumbnail( $id, $quality = 'max' ) {

    if ( strpos( $id, 'youtube' ) !== false ) {
        $id = pdg_get_youtube_video_id( $id );
    }

    $q = array(
        'low'    => 'sddefault.jpg',
        'medium' => 'mqdefault.jpg',
        'high'   => 'hqdefault.jpg',
        'max'    => 'maxresdefault.jpg'
    );

    return 'https://img.youtube.com/vi/' . $id . '/' . $q[$quality];

}

/**
 * Retrieves source and dimensions of a given image.
 * 
 * @since 2.0.0
 * @param int/array $image Image ID or ACF image array
 * @param string    $size  Predefined image size
 * @param bool      $fly   Whether to use "Fly Dynamic Image Resizer" functions
 * @param bool      $crop  Whrther to crop image ( only when using $fly )
 * @return array
 */
function pdg_get_image_info( $image, $size = 'full', $fly = true, $crop = true ) {

    $arr = array(
        'src'    => '',
        'width'  => 0,
        'height' => 0
    );

    if ( is_array( $image ) ) {
        $image = $image['ID'];
    }

    if ( $fly && function_exists( 'fly_get_attachment_image_src' ) ) {
        $image_arr = fly_get_attachment_image_src( $image, $size, $crop );

        if ( is_array( $image_arr ) ) {
            if ( isset( $image_arr['src'] ) ) {
                $arr['src']    = $image_arr['src'];
                $arr['width']  = $image_arr['width'];
                $arr['height'] = $image_arr['height'];
            } elseif ( isset( $image_arr[0] ) ) {
                $arr['src']    = $image_arr[0];
                $arr['width']  = $image_arr[1];
                $arr['height'] = $image_arr[2];
            }
        }
    } else {
        $image_arr = wp_get_attachment_image_src( $image, $size );

        $arr['src']    = $image_arr[0];
        $arr['width']  = $image_arr[1];
        $arr['height'] = $image_arr[2];
    }

    return $arr;

}

/**
 * Retrieves image source.
 * 
 * @since 2.0.0
 * 
 * @param int/array $image Image ID or ACF image array
 * @param string    $size  Predefined image size
 * @param bool      $fly   Whether to use "Fly Dynamic Image Resizer" functions
 * @param bool      $crop  Whrther to crop image ( only when using $fly )
 * @return string
 */
function pdg_get_image_src( $image, $size = 'full', $fly = true, $crop = true ) {

    $arr = pdg_get_image_info( $image, $size, $fly, $crop );

    return esc_url( $arr['src'] );

}

/**
 * Retrieves image dimensions.
 * 
 * @since 2.0.0
 * 
 * @param int/array $image Image ID or ACF image array
 * @param string    $size  Predefined image size
 * @param bool      $fly   Whether to use "Fly Dynamic Image Resizer" functions
 * @param bool      $crop  Whrther to crop image ( only when using $fly )
 * @return array
 */
function pdg_get_image_dimensions( $image, $size = 'full', $fly = true, $crop = true ) {

    $arr = pdg_get_image_info( $image, $size, $fly );

    return array(
        'width'  => $arr['width'],
        'height' => $arr['height']
    );

}

/**
 * Generates <img> with all necessary attributes based on given options.
 * 
 * @since 2.0.0
 * @param int/array $image Image ID or ACF image array
 * @param string    $size  Predefined image size
 * @param bool      $fly   Whether to use "Fly Dynamic Image Resizer" functions
 * @return string If not echoed
 */
function pdg_img( $image, $size = 'full', $atts = array() ) {

    /*
     * Set function attributes.
     * 
     * SVG modes:
     * 0 - viewbox / aspect ratio
     * 1 - viewbox / fixed size
     * 2 - no viewbox
     */
    $defaults = array(
        'class'      => array(),
        'fly'        => true,
        'crop'       => true,
        'dimensions' => false,
        'svg_mode'   => 0,
        'echo'       => true
    );

    $atts = array_merge( $defaults, $atts );

    $before = '';
    $after  = '';

    $width  = '';
    $height = '';

    $atts['class'][] = 'pdg-img';

    // Set "fly" attribute by checking if plugin is active.
    if ( ! function_exists( 'fly_get_attachment_image_src' ) ) {
        $atts['fly'] = false;
    }

    // Prepare image data.
    if ( is_array( $image ) ) {
        $data = $image;
    } else {
        $attachment = get_post( $image );

        $data = array(
            'ID'      => $attachment->ID,
            'title'   => ( $attachment->post_excerpt ) ? $attachment->post_excerpt : $attachment->post_title,
            'alt'     => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'subtype' => $attachment->post_mime_type
        );
    }

    $image_info = pdg_get_image_info( $image, $size, $atts['fly'], $atts['crop'] );

    // Add image dimensions
    if ( $atts['dimensions'] ) {
        $width  = 'width="' . $image_info['width'] . '"';
        $height = 'height="' . $image_info['height'] . '"';
    }

    // Prepare viewbox if given image is svg.
    if ( $data['subtype'] == 'svg+xml' || $data['subtype'] == 'image/svg+xml' ) {
        if ( $atts['svg_mode'] !== 2 ) {
            $path     = get_attached_file( $data['ID'] );
            $contents = file_get_contents( $path );
        
            preg_match( '/viewBox=".*?"/', $contents, $matches );
        
            if ( $matches ) {
                $viewbox_parts = explode( ' ', $matches[0] );
                $image_w       = floatval( str_replace( '"', '', $viewbox_parts[2] ) );
                $image_h       = floatval( str_replace( '"', '', $viewbox_parts[3] ) );
        
                $atts['class'][] = 'pdg-img--has-viewbox';

                if ( $atts['svg_mode'] === 0 ) {
                    $ar = ( $image_h / $image_w ) * 100;

                    $atts['class'][] = 'pdg-img--has-viewbox-ar ar-img__img';
    
                    $before = '<div class="ar-img" style="max-width: ' . $image_w . 'px;"><div class="ar-img__inner" style="padding-bottom:' . $ar . '%;">';
                    $after  = '</div></div>';
                } else {
                    $before = '<div style="width: ' . $image_w . 'px; height: ' . $image_h . 'px;">';
                    $after  = '</div>';
                }
            }
        }
    }

    // Get image source.
    $src = $image_info['src'];

    // Prepare final markup.
    $html = $before . '<img class="' . implode( ' ', $atts['class'] ) . '" src="' . $src . '" title="' . $data['title'] . '" alt="' . $data['alt'] . '" ' . $width . ' ' . $height . '>' . $after;

    if ( $atts['echo'] ) {
        echo $html;
    } else {
        return $html;
    }

}

/**
 * Outputs a pagination for given query.
 * 
 * @link http://pandago.sem.lv/funkcijas/pdg_pager/
 * @since 2.0.0
 * @param object  $query   WP query to paginate
 * @param array   $strings Strings used for navigation
 * @param integer $range   How many additional pages to show on each side
 */
function pdg_pager( $query, $strings = array(), $range = 2 ) {

    // Get current page.
    global $paged;

    if ( empty( $paged ) ) {
        $paged = 1;
    }

    // Prepare navigation strings.
    if ( is_array( $strings ) && empty( $strings ) ) {
        $strings = array(
            'first' => '<span>&laquo;</span>',
            'prev'  => '<span>&lsaquo;</span>',
            'last'  => '<span>&raquo;</span>',
            'next'  => '<span>&rsaquo;</span>'
        );
    }

    // Calculate how many items to show.
    $showitems = ( $range * 2 ) + 1;

    // Get page count.
    $pages = $query->max_num_pages;

    if ( ! $pages ) {
        $pages = 1;
    }

    // Exit if page count is less then 2.
    if ( $pages <= 1 ) {
        return;
    }

    $args = array(
        'paged'     => $paged,
        'pages'     => $pages,
        'range'     => $range,
        'showitems' => $showitems,
        'strings'   => $strings
    );

    if ( 1 != $pages ) {
        get_template_part( 'template-parts/pager', null, $args );
    }

}

/**
 * Outputs a language switcher based on given
 * parameters.
 * 
 * @since 2.0.0
 * @param string $style        Style of the switcher. Either 'default' or 'dropdown'
 * @param string $lang_display How to display language. Either 'code', 'native_name' or 'translated_name'
 * @param bool   $active_first Whether to display active language as first one
 */
function pdg_language_switcher( $style = 'default', $lang_display = 'code', $active_first = false ) {

    if ( ! function_exists( 'icl_get_languages' ) ) {
        return;
    }

    $args = array(
        'languages'    => icl_get_languages( 'skip_missing=0' ),
        'lang_display' => $lang_display
    );

    if ( $style == 'default' ) {
        if ( $active_first ) {
            usort( $args['languages'], 'pdg_language_switcher_sort' );
        }

        get_template_part( 'template-parts/language-switcher', null, $args );
    } elseif ( $style == 'dropdown' ) {
        get_template_part( 'template-parts/language-switcher', 'dropdown', $args );
    }

}

/**
 * Helper function for pdg_language_switcher() which sorts
 * $languages array if $active_first is set to true.
 * 
 * @since 2.0.0
 * @param array $a
 * @param array $b
 * @return array
 */
function pdg_language_switcher_sort( $a, $b ) {

    return $b['active'] - $a['active'];

}

/**
 * Register nav menus. Using this here so that you don't
 * have to add_action in child theme.
 */
function pdg_register_nav() {

    $menus = [
        'header' => 'Header navigation'
    ];

    $menus = apply_filters( 'pdg_menus', $menus );

    register_nav_menus( $menus );

}
add_action( 'init', 'pdg_register_nav' );

/**
 * Output menu.
 * 
 * @since 2.0.0
 * @param string $location Menu location
 * @param string $class    Menu class
 * @param int    $depth    Menu depth
 * @param object $walker   Menu walker class
 */
function pdg_nav( $location, $class = '', $a_class = '', $depth = 0, $walker = '' ) {

    $items_wrap = '<ul>%3$s</ul>';

    if ( ! empty( $class ) ) {
        $items_wrap = '<ul class="' . $class . '">%3$s</ul>';
    }

    return wp_nav_menu(
        array(
            'theme_location'  => $location,
            'menu'            => '',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => $items_wrap,
            'depth'           => $depth,
            'walker'          => $walker,
            'add_a_class'     => $a_class
        )
    );
}

/**
 * Get words from content.
 * 
 * @since 2.0.0
 * @param string $content Content from which words are extracted
 * @param int    $words   Word count
 * @param mixed  $dots    Dots which will be appended at the end of string
 * 
 * @return string
 */
function pdg_get_words( $content, $words = 20, $dots = false ) {

    $str = trim( strip_tags( $content ) );
    $str = implode( ' ', array_slice( explode( ' ', $str ), 0, $words ) );
    $str = trim( $str );

    if ( $dots ) {
        if ( strlen( $content ) > strlen( $str ) ) {
            $str .= $dots;
        }
    }

    return $str;

}

/**
 * Add class to <a> element in menu if add_a_class is present.
 */
function pdg_nav_link_class( $classes, $item, $args ) {

    if ( isset( $args->add_a_class ) ) {
        $classes['class'] = $args->add_a_class;
    }

    return $classes;

}
add_filter( 'nav_menu_link_attributes', 'pdg_nav_link_class', 1, 3 );

/**
 * Add last class to menu items.
 */
function pdg_menu_item_last_class( $items, $args ) {

    if ( $items[count( $items )] ) {
        $items[count( $items )]->classes[] = 'menu-item--is-last';
    }

    return $items;

}
add_filter( 'wp_nav_menu_objects', 'pdg_menu_item_last_class', 10, 3 );