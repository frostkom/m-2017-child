<?php

class mf_theme_child
{
	function __construct()
	{
		$this->lang_key = 'lang_m_child';
	}

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

		if($setting_base_template_site != '')
		{
			$menu_link = str_replace("mall.", "", $setting_base_template_site)."/manual/";
			$menu_title = __("Manual", $this->lang_key);
			add_menu_page("", $menu_title, 'read', $menu_link, '', 'dashicons-sos', 100);
		}
	}

	function add_widget()
	{
		if(is_plugin_active("postie/postie.php"))
		{
			$widget_title = __("Create posts by sending e-mail message", $this->lang_key);

			//add_meta_box("custom_dashboard_widget_postie", $widget_title, array($this, 'display_widget'), 'dashboard', 'normal', 'default'); //, $post_id
			wp_add_dashboard_widget("custom_dashboard_widget_postie", $widget_title, array($this, 'display_widget')); //, '', $post_id
		}
	}

	function display_widget($post) //, $args
	{
		$postie_settings = get_option('postie-settings');
		$postie_address = (is_array($postie_settings) && isset($postie_settings['mail_userid']) ? $postie_settings['mail_userid'] : "");

		//echo var_export($postie_settings, true);

		if($postie_address != '')
		{
			$user_data = get_userdata(get_current_user_id());
			$profile_email = $user_data->user_email;

			echo "<p>".sprintf(__("If you want to create a post directly from your e-mail client you can send a message to %s and it will be created as soon as the server has received the message. It is important that you send the message from your address %s and the message should only contain exactly the text that you want the post to contain. If you attach an image it will also be published with the post.", $this->lang_key), "<a href='mailto:".$postie_address."'>".$postie_address."</a>", "<a href='mailto:".$profile_email."'>".$profile_email."</a>")."</p>";
		}

		else if(IS_ADMIN)
		{
			echo "<p>".sprintf(__("There is no e-mail address set. Please go to the settings and enter the correct e-mail address and corresponding server settings.", $this->lang_key), "<a href='".admin_url("admin.php?page=postie-settings")."'>", "</a>")."</p>";
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