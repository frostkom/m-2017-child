<?php

add_action('wp_head', 'head_child', 0);

function head_child()
{
	mf_enqueue_style('child-style', get_stylesheet_directory_uri()."/style.css", get_theme_version()); //, array('style')
}