<?php
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

// -- [tax_venue] -->

function tax_venue_df($atts){
   return get_the_terms( $post, 'venue' );
}
add_shortcode( 'tax_venue', 'tax_venue_df' );

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


//-- Shortcode for ACF Output --->>>

//** Remember to add shortcode to list on Readme.txt file **//
