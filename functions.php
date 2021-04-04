<?php

include_once("include/classes.php");

load_theme_textdomain('lang_m_child', get_stylesheet_directory()."/lang");

$obj_theme_child = new mf_theme_child();

if(is_admin())
{
	add_filter('site_transient_update_plugins', array($obj_theme_child, 'site_transient_update_plugins'));

	add_action('admin_menu', array($obj_theme_child, 'admin_menu'));
	add_action('wp_dashboard_setup', array($obj_theme_child, 'add_widget')); //, 999
}

else
{
	add_action('wp_head', array($obj_theme_child, 'wp_head'), 0);
}