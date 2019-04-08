<?php

add_action('wp_head', 'head_child', 0);

function head_child()
{
	$theme_include_url = get_stylesheet_directory_uri()."/";
	$theme_version = get_theme_version();

	mf_enqueue_style('child-style', $theme_include_url."style.css", $theme_version);

	echo "<link rel='apple-touch-icon' sizes='180x180' href='".$theme_include_url."favicon/apple-touch-icon.png'>
	<link rel='icon' type='image/png' sizes='32x32' href='".$theme_include_url."favicon/favicon-32x32.png'>
	<link rel='icon' type='image/png' sizes='16x16' href='".$theme_include_url."favicon/favicon-16x16.png'>
	<link rel='manifest' href='".$theme_include_url."favicon/site.webmanifest'>
	<link rel='mask-icon' href='".$theme_include_url."favicon/safari-pinned-tab.svg' color='#5bbad5'>
	<link rel='shortcut icon' href='".$theme_include_url."favicon/favicon.ico'>
	<meta name='msapplication-TileColor' content='#ffffff'>
	<meta name='msapplication-config' content='".$theme_include_url."favicon/browserconfig.xml'>
	<meta name='theme-color' content='#ffffff'>";
}