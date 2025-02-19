<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Law_Firm
 */

get_header();

/**
 * Before Posts hook
 * @hooked law_firm_content_wrapper_start
*/
do_action( 'law_firm_before_posts_content' );
?>	
<header class="page-header">
		<h2> <?php esc_html_e( '404', 'law-firm' ) ?> </h2>
		<h3 class="page-title"><?php esc_html_e( 'Page Not Found', 'law-firm' ); ?></h3>
		<h4> <?php esc_html_e( 'Ooops!', 'law-firm' ); ?></h4>
		<div class="subtitle">
			<h5><?php esc_html_e( 'The Page You Seek Doesn\'t Appear To Exist, At Least Not Yet.', 'law-firm' ); ?></h5>
		</div>
		<div class="error404-search">
			<?php echo get_search_form();  ?>
		</div>
		<strong>
			<?php esc_html_e( 'Or go back to', 'law-firm' ); ?> 
			<a href=<?php echo esc_url( get_home_url() ); ?>>
				<?php esc_html_e( 'homepage', 'law-firm' ) ?>
			</a>
		</strong>
</header>
<?php

/**
* After Posts hook
* @hooked law_firm_content_wrapper_end - 10
*/
do_action( 'law_firm_after_posts_content' );
    
get_footer();