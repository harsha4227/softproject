<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Law_Firm
 */
get_header();

	/**
	 * Before Posts hook
	 * @hooked law_firm_content_wrapper_start - 10
	*/
	do_action( 'law_firm_before_posts_content' );

		while ( have_posts() ) : the_post();
			
			get_template_part( 'template-parts/content','single' );
			
		endwhile; // End of the loop.
	
	/**
	 * After Posts hook
	 * @hooked law_firm_single_entry_footer_sections - 5
	 * @hooked law_firm_content_wrapper_end - 10
	*/
	do_action( 'law_firm_after_posts_content' );

get_footer();