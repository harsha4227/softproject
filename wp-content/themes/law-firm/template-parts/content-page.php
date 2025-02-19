<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Law_Firm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 

		/**
		* @hooked law_firm_post_thumbnail - 10
		* @hooked law_firm_entry_content_wrapper_start - 20
		* @hooked law_firm_entry_header   - 30 
		*/
		do_action( 'law_firm_before_post_entry_content' );
					
		/**
		 * Entry Content
		 * @hooked law_firm_entry_content - 40
		 * @hooked law_firm_entry_footer  - 50
		 * @hooked law_firm_entry_content_wrapper_start  - 60
		*/
		do_action( 'law_firm_post_entry_content' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
