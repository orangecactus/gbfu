<?php

/**
 * Plugin Name: ThemeCube Core
 * Plugin URI: http://themecube.net
 * Description: Eventr Wordpress Theme shortcodes.
 * Version: 2.0
 * Author: themecube
 * Author URI: http://themeforest.net/user/themecube
 * Text Domain: eventr
 * License: GPLv3
 */




if ( !function_exists( 'themecube_corepluginupdate' ) ) {

	function themecube_corepluginupdate() {

		$current_dir = plugin_dir_path(dirname(__FILE__));
		$plugin_name = current(explode("/", plugin_basename( __FILE__ )));

		//POST TYPE
		require $current_dir . $plugin_name . '/post_type.php';

		//GLOBAL
		require $current_dir . $plugin_name . '/vc_global.php';

		//POST CONNECTION
		require $current_dir . $plugin_name . '/posts-to-posts/posts-to-posts.php';

		//SHORTCODES
		require $current_dir . $plugin_name . '/tc_shortcode.php';

		//CMB2
		require $current_dir . $plugin_name . '/metabox-functions.php';

		//COLOR PICKER
		require $current_dir . $plugin_name . '/rgba-picker/rgba-colorpicker.php';

		//RECENT POSTS WIDGET
		require $current_dir . $plugin_name . '/recent-posts/widget-recent-posts.php';


			
	}

	add_action( 'plugins_loaded', 'themecube_corepluginupdate' );

}

