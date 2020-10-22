<?php

include_once("include/classes.php");

$obj_theme_child = new mf_theme_child();

if(is_admin())
{
	add_filter('site_transient_update_plugins', array($obj_theme_child, 'site_transient_update_plugins'));
}

else
{
	add_action('wp_head', array($obj_theme_child, 'wp_head'), 0);
}