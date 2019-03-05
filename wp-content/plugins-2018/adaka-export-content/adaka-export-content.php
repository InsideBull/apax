<?php

/*
Plugin Name: Adaka Export Content
Version: 1.0.0
Author: ADaKa
Author URI: http://www.adaka.fr
*/


require_once 'includes/post_submit.php';
require_once 'includes/export-plugin.php';

// menu item
function a_export_register_admin_page() {
	add_menu_page('Exports des contenus', 'Exports', 'read', 'a_export_content', "a_display_form", 'dashicons-download', 50);
}
add_action('admin_menu', 'a_export_register_admin_page');
