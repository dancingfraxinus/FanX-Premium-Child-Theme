<?php
/* Update Divi Theme header alerts using ACF Fields.
*/

add_action('wp_dashboard_setup', 'alert_update_widgets');

function alert_update_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('db_alert_update_widget', 'Divi + ACF Header Alert Updates', 'dashboard_alert_forms');
}

function dashboard_alert_forms() {
echo '<p>
Warning! Any updates made to the fields below will update the alerts bar in the header of the live website.</p>';

}

//Use When Needed:
//remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
flush_rewrite_rules(); //Flush Rules
