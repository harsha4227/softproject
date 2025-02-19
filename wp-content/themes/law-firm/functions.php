<?php
/**
 * Law_Firm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Law_Firm
 */

if (!defined('LAW_FIRM_VERSION')) define('LAW_FIRM_VERSION', '1.0.0');
/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Load Google Fonts Locally
 */
require get_template_directory() . '/inc/local-google-font-loader.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';
/**
 * WordPress Hooks for this theme.
 */
require get_template_directory() . '/inc/wp-hooked.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 *  WooCommerce compatibility file.
 */
if (law_firm_woo_boolean()) {
	require get_template_directory() . '/inc/woo.php';
}

