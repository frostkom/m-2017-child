<?php

class mf_theme_child
{
	function __construct(){}

	function site_transient_update_plugins($value)
	{
		$arr_plugins = array('google-calendar-events/google-calendar-events.php');
		$arr_plugins = array('wp-live-chat-support/wp-live-chat-support.php');

		foreach($arr_plugins as $plugin)
		{
			if(isset($value->response[$plugin]))
			{
				unset($value->response[$plugin]);
			}
		}

		return $value;
	}

	function admin_menu()
	{
		$setting_base_template_site = get_option('setting_base_template_site');

		if($setting_base_template_site != '' && $_SERVER['REMOTE_ADDR'] == "2.71.84.174")
		{
			$menu_link = str_replace("mall.", "", $setting_base_template_site)."/manual/";
			$menu_title = __("Manual", 'lang_m_2017_child');
			add_menu_page("", $menu_title, 'read', $menu_link, '', 'dashicons-sos', 100);
		}
	}

	function wp_head()
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
}