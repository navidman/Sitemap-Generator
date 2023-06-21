<?php
/**
 * Plugin Name: sitemap-generator
 * Description: Sitemap Generator.
 * Version: 0.1
 * Author: Navid Mansouri
 **/

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( '', 'Sitemap Generator', 'manage_options', 'sitemap-generator/admin-page.php', 'admin_page', 'dashicons-tickets', 'last'  );
}
function admin_page()
{
	include ('admin-page.php');
}
