<?php  //For Tweaks to ACF Fields 

//Allow Unsafe HTML 
apply_filters( 'acf/shortcode/allow_unsafe_html', true, $attributes, $field_type, $field_object );

//Allow iframe Tags:  
add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 10, 2 );
function acf_add_allowed_iframe_tag( $tags, $context ) {
    if ( $context === 'acf' ) {
        $tags['iframe'] = array(
            'src'             => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
            'name'            => true,
        );
    }

    return $tags;
}

//Allow iframe Guest Schedule
add_filter( 'acf/shortcode/allow_unsafe_html', 
function ( $allowed, $atts ) {
    if ( $atts['field'] === 'sched_url' ) {
        return true;
    }
    return $allowed;
}, 10, 2 );


//Allow SVG & Path Tags:
add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_svg_tag', 10, 2 );
function acf_add_allowed_svg_tag( $tags, $context ) {
    if ( $context === 'acf' ) {
        $tags['svg']  = array(
            'xmlns'       => true,
            'fill'        => true,
            'viewbox'     => true,
            'role'        => true,
            'aria-hidden' => true,
            'focusable'   => true,
        );
        $tags['path'] = array(
            'd'    => true,
            'fill' => true,
        );
    }

    return $tags;
}

//Disable HTML Escaping Security Feature - uneeded
add_filter('acf/shortcode/allow_unsafe_html', '__return_true'); //Allow 'Unsafe' HTML 
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' ); //Disable Notices 