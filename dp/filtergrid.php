<?php

//Custom Content-->TROUBLESHOOTING<--

    //Price Grid Button --->
    function dpdfg_after_read_more($content, $props) {
if (isset($props['price_grid']) && $props['price_grid'] === 'custom-content') {
    echo do_shortcode('[divi_shortcode id="39649"]');
} }
    add_filter('dpdfg_after_read_more', 'dpdfg_after_read_more', 10, 2);

    //END Price Grid Button <---
//END Custom Content <--- 

//Use When Needed:
remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
flush_rewrite_rules(); //Flush Rules
