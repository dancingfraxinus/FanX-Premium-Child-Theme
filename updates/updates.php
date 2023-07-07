<?php

function df_register_widgets() {
	global $wp_meta_boxes;

	wp_add_dashboard_widget('widget_themeupdates', __('Latest FanX Theme Updates', 'df'), 'df_create_my_rss_box');
}
add_action('wp_dashboard_setup', 'df_register_widgets');
//RSS Feed
function df_create_my_rss_box() {
echo '<p><i>All updates to the FanX Premium Child Theme code are logged here when the webdev uploads the code to the Github repository. Keep in mind that updates to the repository may not reflect the current status of the live site at all times.</i></p>';
	// Get RSS Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');

	// My feeds list
	$my_feeds = array(
				'https://github.com/dancingfraxinus/fanx-divi-child-theme/commits.atom'
				);

	// Loop through Feeds
	foreach ( $my_feeds as $feed) :

		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( $feed );
		if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly
		    // Figure out how many total items there are, and choose a limit
		    $maxitems = $rss->get_item_quantity( 5 );

		    // Build an array of all the items, starting with element 0 (first element).
		    $rss_items = $rss->get_items( 0, $maxitems );

		    // Get RSS title
		    $rss_title = '<a href="'.$rss->get_permalink().'" target="_blank">'.strtoupper( $rss->get_title() ).'</a>';
		endif;

		// Display the container
		echo '<div class="rss-widget">';
		echo '<strong>'.$rss_title.'</strong>';
		echo '<hr style="border: 0; background-color: green; height: 1px;">';

		// Starts items listing within <ul> tag
		echo '<ul>';

		// Check items
		if ( $maxitems == 0 ) {
			echo '<li>'.__( 'No item', 'df').'.</li>';
		} else {
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss_items as $item ) :
				// Uncomment line below to display non human date
				//$item_date = $item->get_date( get_option('date_format').' @ '.get_option('time_format') );

				// Get human date (comment if you want to use non human date)
				$item_date = human_time_diff( $item->get_date('U'), current_time('timestamp')).' '.__( 'ago', 'df' );

				// Start displaying item content within a <li> tag
				echo '<li>';
				// create item link
				echo '<a href="'.esc_url( $item->get_permalink() ).'" title="'.$item_date.'">';
				// Get item title
				echo esc_html( $item->get_title() );
				echo '</a>';
				// Display date
				echo ' <span class="rss-date">'.$item_date.'</span><br />';
				// Get item content
				$content = $item->get_content();
				// Shorten content
				$content = wp_html_excerpt($content, 200) . ' [...]';
				// Display content
				echo $content;
				// End <li> tag
				echo '</li>';
			endforeach;
		}
		// End <ul> tag
		echo '</ul></div>';

	endforeach; // End foreach feed
}

//Use When Needed:
//remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
flush_rewrite_rules(); //Flush Rules
