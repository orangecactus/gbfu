<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function eventr_register_required_plugins() {

	$plugins = array(
		array(
			'name'               => 'Visual Composer', // The plugin name.
			'slug'               => 'js_composer', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/plugins/js_composer.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		array(
			'name'               => 'Slider Revolution', // The plugin name.
			'slug'               => 'revslider', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/plugins/revslider.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		array(
			'name'               => 'ThemeCube Core', // The plugin name.
			'slug'               => 'themecube-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/plugins/themecube-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),

		array(
			'name'      => 'CMB2',
			'slug'      => 'cmb2',
			'required'  => true,
		),

		array(
			'name'      => 'Mailchimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		// array(
		// 	'name'      => 'WooCommerce',
		// 	'slug'      => 'woocommerce',
		// 	'required'  => false,
		// ),
	);

	$config = array(
		'domain'       		=> 'eventr',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		//'parent_menu_slug' 	=> 'plugins.php', 				// Default parent menu slug
		//'parent_url_slug' 	=> 'plugins.php', 				// Default parent URL slug
                'parent_slug'           => 'plugins.php',
                'capability'            => 'manage_options',
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'eventr_register_required_plugins' );