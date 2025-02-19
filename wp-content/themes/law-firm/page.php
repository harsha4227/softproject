<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Law_Firm
 */

get_header();

	/**
	 * Before Posts hook
	 * @hooked law_firm_content_wrapper_start
	*/
	do_action( 'law_firm_before_posts_content' );

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			law_firm_comment();

		endwhile; // End of the loop.
	
	/**
	 * After Posts hook
	 * @hooked law_firm_content_wrapper_end - 10
	*/
	do_action( 'law_firm_after_posts_content' );
get_footer();
