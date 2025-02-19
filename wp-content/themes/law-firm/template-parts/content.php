<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Law_Firm
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php if( ! is_single() ) echo '<div class="blog__card">'; 
		
		/**
		* @hooked law_firm_post_thumbnail - 10
		* @hooked law_firm_entry_header   - 15 
		*/
		do_action( 'law_firm_before_post_entry_content' );
	 
		/**
		 * Entry Content
		 * @hooked law_firm_entry_content - 15
		 * @hooked law_firm_entry_footer  - 20
		*/
		do_action( 'law_firm_post_entry_content' );
	?> 
</article>
