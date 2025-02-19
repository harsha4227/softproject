<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Law_Firm
 */

?>

<article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo '<div class="blog__card">'; 
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
		*/
		do_action( 'law_firm_post_entry_content' );
	echo '</div>'; ?> 
</article>
