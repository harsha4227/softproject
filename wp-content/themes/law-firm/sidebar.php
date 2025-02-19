<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Law_Firm
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

if( law_firm_sidebar_layout() === 'gl-full-wrap' ){
	return;
}
?>
<aside id="secondary" class="widget-area sidebar-main" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #secondary -->