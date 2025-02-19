<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'law_firm_register_required_plugins' );
function law_firm_register_required_plugins() {
	$plugins = array(
        array(
			'name'      => __( 'Regenerate Thumbnails', 'law-firm' ),
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),
		array(
			'name'      => __( 'Contact Form 7', 'law-firm' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'law-firm',      		   // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
