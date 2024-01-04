<?php

//Shortcodes in ACF 
add_filter('acf/format_value/type=textarea', 'do_shortcode');
add_filter('acf/format_value/type=text', 'do_shortcode');
add_filter('acf/format_value/type=message', 'do_shortcode');
add_filter( 'wp_title', 'do_shortcode');
add_filter( 'the_title', 'do_shortcode');
add_filter( 'single_post_title', 'do_shortcode');
add_filter( 'wp_nav_menu', 'do_shortcode');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');


// -- [page_title] -->

function page_title_df( ){
   return get_the_title();
}
add_shortcode( 'page_title', 'page_title_df' );

// -- [page_content] -->

function page_content_df( ){
   return get_the_content();
}
add_shortcode( 'page_content', 'page_content_df' );

// --[sitemap] -->
function sitemap_df($atts){
   return get_template_part('sitemap');
 }
add_shortcode( 'sitemap', 'sitemap_df' );


// -- Shortcode in WRITING --->>>
// -- [br] -->
function linebreak_df() {
	return '<br />';
}
add_shortcode( 'br', 'linebreak_df' );

// -- [hr] -->
function thembreak_df() {
	return '<hr style="width:50%; text-align:left; ; margin: 3%; border-top: 1px solid gold;">';
}
add_shortcode( 'hr', 'thembreak_df' );

//--- [year] Used in Socket -->
function year_shortcode () {
   $year = date_i18n ('Y');
   return $year;
   }
   add_shortcode ('year', 'year_shortcode');


//-- Shortcode for ACF Output --->>>

//** Remember to add shortcode to list on Readme.txt file **//
