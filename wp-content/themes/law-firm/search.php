<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Law_Firm
 */

get_header();

	/**
	 * Before Posts hook
	 * @hooked law_firm_content_wrapper_start - 10
	*/
	do_action( 'law_firm_before_posts_content' );
		if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			echo get_template_part( 'template-parts/content', 'search' );

		endwhile;

		law_firm_pagination();

		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	<?php
	/**
	 * After Posts hook
	 * @hooked law_firm_content_wrapper_end - 10
	*/
	do_action( 'law_firm_after_posts_content' );

get_footer();