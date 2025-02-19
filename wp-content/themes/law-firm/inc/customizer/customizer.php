<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * 
 * @package Law_Firm
 */

 /**
 * Customizer Whole Control.
 */
require get_template_directory() . '/inc/customizer/customizer-controls/customizer-controls.php';

/**
 * Customizer Settings Enqueue.
 */
require get_template_directory() . '/inc/customizer/settings/customizer-settings.php';

/**
 * Sanitization functions
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

function law_firm_customize_register( $wp_customize ){

	$wp_customize->remove_section( 'background_image' );

	$wp_customize->get_section( 'colors' )->panel     = 'appearance_settings';
	
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	$wp_customize->get_section( 'title_tagline' )->panel     = 'appearance_settings';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'law_firm_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'law_firm_customize_partial_blogdescription',
			)
		);
	}

}
add_action('customize_register', 'law_firm_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function law_firm_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function law_firm_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function law_firm_customize_preview_js(){
	wp_enqueue_script('law_firm-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), LAW_FIRM_VERSION, true);
}
add_action('customize_preview_init', 'law_firm_customize_preview_js');

function law_firm_control_inline_scripts(){
	
	wp_enqueue_script( 'law-firm-customize', get_template_directory_uri() . '/js/unminify/customize.js', array( 'jquery', 'customize-controls' ), LAW_FIRM_VERSION, true );

}
add_action( 'customize_controls_enqueue_scripts', 'law_firm_control_inline_scripts', 100 );