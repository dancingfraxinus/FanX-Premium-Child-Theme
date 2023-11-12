<?php

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );
include('updates/updates.php'); //GitHub Feed
include('shortcode.php'); //Custom Shortcode
include('white-label.php'); //Backend Personalization
include('alerts/alerts.php'); //DBW - Update website alert bar
include('dp/filtergrid.php'); //Divi Filtergrid Customizations

// --- Stylesheet Access --->
function my_enqueue_assets() {
  $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri().'/style.css' );
 wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets');
// --- Stylesheet Access <---

// Media --->

//Post Thumbs 
//add_theme_support( 'post-thumbnails' );
//add_image_size( 'sm-square', 300, 300, false ); <-- To add an image size


//END Media <---

//**Taxonomies --->

// -- add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// -- ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// -- tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');


//END Taxonomies <---

// Archives --->
  // Guest Archive Category Exclusions ---> //TROUBLESHOOTING
  function df_exclude_posts( $query ) {
      if ( $query->is_archive('guests') ) {
          $query->set( 'guest-type', array( -180, -205, -179 ) ); //Exclude in Memorium, Postponed, Alumni
    }
  }
  add_action( 'pre_get_posts', 'df_exclude_posts' );

  //END Guest Archives Category Exclusions <---

//END Archives <---

//Search Function

function tg_include_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'guest', 'feature', 'special_guest', 'exhibitor', 'event', 'ticket' ) );
    }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );


//END Search Function <----

//PROTECT THE THINGS --->
/*** Block User Enumeration*/
function df_block_user_enum_attempt() {
  if ( is_admin() ) return;
  $author_by_id = ( isset( $_REQUEST['author'] ) && is_numeric( $_REQUEST['author'] ) );
  if ( $author_by_id )
  wp_die( 'Author archives have been disabled.' );
}

  add_action( 'template_redirect', 'df_block_user_enum_attempt' );

//end protect the things <---

//TURN OFF THE THINGS -->
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

//REMOVE THE THINGS --->
// ---Remove Gutenberg Block Library CSS from loading on the frontend -->
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );



//Hide Divi Project CPT
function hide_diviproject_cpt_df() {

register_post_type( 'project',
	array(
	'has_archive'  => false,
	'public'       => false,
  'show_in_menu' => false,
));
    }

add_action( 'init', 'hide_diviproject_cpt_df' );


//END REMOVE THE THINGS <----


//Use When Needed:
remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
flush_rewrite_rules(); //Flush Rules
