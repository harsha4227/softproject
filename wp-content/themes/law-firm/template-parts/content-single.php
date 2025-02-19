<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Law_Firm
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if( ( 'post' == get_post_type() ) ) echo '<div class="post-frontmatter">';
		/**
		* @hooked law_firm_post_thumbnail 				- 10
		* @hooked law_firm_entry_content_wrapper_start  - 20
		* @hooked law_firm_entry_header   				- 30
		*/
		do_action( 'law_firm_before_post_entry_content' );

		if( ( 'post' == get_post_type() ) && is_single() ) echo '</div>';
	 
		/**
		 * Entry Content
		 * @hooked law_firm_entry_content 				- 40
		 * @hooked law_firm_entry_footer  				- 50
		*/
		do_action( 'law_firm_post_entry_content' );

    ?> 
</article>
<?php 