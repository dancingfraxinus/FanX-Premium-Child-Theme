<?php

//Admin Bar (Top) ------>

// --- Admin Bar Links ---->
function df_admin_bar_render() {
global $wp_admin_bar;

$cloudflareTAB = '/wp-admin/options-general.php?page=cloudflare#/home'; //ADD CLOUDFLARE
$wp_admin_bar->add_menu( array(
'parent' => false,
'id' => 'cloudflare',
'title' => __('☁︎  Cloudflare'),
'href' => $cloudflareTAB
));

$cfsettingsTAB = '/wp-admin/options-general.php?page=cloudflare#/more-settings'; // Submenu Item
$wp_admin_bar->add_menu(array(
'parent' => 'cloudflare',
'id' => 'cf_settings',
'title' => __('Cloudflare Settings (Dev Mode)'),
'href' => $cfsettingsTAB
));

$eventinfoTAB = '/wp-admin/admin.php?page=fanx-theme'; //ADD CLOUDFLARE
$wp_admin_bar->add_menu( array(
'parent' => false,
'id' => 'eventinfo',
'title' => __('ⓘ Event Info'),
'href' => $eventinfoTAB
));

}

add_action( 'wp_before_admin_bar_render', 'df_admin_bar_render' );
// <---- END Admin Bar Links ---

//Different Admin Themes for Multisite
add_filter('get_user_option_admin_color', 'change_admin_color');
function change_admin_color($result) {
//TampaBay
  if(get_current_blog_id() === 2) {
    return 'sunrise';
  }
//FanX
  elseif(get_current_blog_id() === 4) {
    return 'ectoplasm';
  }
  //Indiana
    elseif(get_current_blog_id() === 5) {
      return 'default';
    }
    //ATL
      elseif(get_current_blog_id() === 3) {
        return 'blue';
      }
      //Wisconsin
      elseif(get_current_blog_id() === 9) {
        return 'coffee';
      }
  else {
    return $result;
  }
}

//ADMIN COlUMS ---->>>

//Add Post ID
add_filter( 'manage_posts_columns', 'revealid_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'revealid_id_column_content', 5, 2 );


function revealid_add_id_column( $columns ) {
   $columns['revealid_id'] = 'ID';
   return $columns;
}

function revealid_id_column_content( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo $id;
  }
}

$custom_post_types = get_post_types(
   array(
      'public'   => true,
      '_builtin' => false
   ),
   'names'
);

foreach ( $custom_post_types as $post_type ) {
	add_action( 'manage_edit-'. $post_type . '_columns', 'revealid_add_id_column' );
	add_filter( 'manage_'. $post_type . '_custom_column', 'revealid_id_column_content' );
}

// --- Remove Yoast Filter Dropdown --->
add_action( 'admin_init', 'df_yoast_removal', 20 );
function df_yoast_removal() {
    global $wpseo_meta_columns ;
    if ( $wpseo_meta_columns  ) {
        remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns , 'posts_filter_dropdown' ) );
        remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns , 'posts_filter_dropdown_readability' ) );
    }
}

 // <-- END Remove Yoast Filter Dropdown --

// -- Remove Comments -->
 add_action( 'admin_menu', 'df_remove_admin_menus' ); // Remove from admin menu
 function df_remove_admin_menus() {
     remove_menu_page( 'edit-comments.php' );
 }

 add_action('init', 'df_remove_comment_support', 100);  // Remove from post and pages
 function df_remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
 }

 add_action( 'wp_before_admin_bar_render', 'df_remove_comments_admin_bar' );  // Remove from admin bar
 function df_remove_comments_admin_bar() {
     global $wp_admin_bar;
     $wp_admin_bar->remove_menu('comments');
 }
// <-- END Remove Comments



//Footer Text
function et_change_admin_footer_text () {
 return __('Powered by Dan Farr Productions. Premium Child Theme designed & coded with ♥ by <a href="https://www.dancingfraxinus.com/">Liz Moore</a>.');
}
add_filter( 'admin_footer_text', 'et_change_admin_footer_text' );


//Use When Needed:
remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
flush_rewrite_rules(); //Flush Rules
