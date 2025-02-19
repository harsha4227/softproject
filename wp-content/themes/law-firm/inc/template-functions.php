<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Law_Firm
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

if (! function_exists('law_firm_doctype')) :
	/**
	 * Doctype Declaration
	 */
	function law_firm_doctype()
	{ ?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action('law_firm_doctype', 'law_firm_doctype');

if (! function_exists('law_firm_head')) :
	/**
	 * Before wp_head 
	 */
	function law_firm_head()
	{ ?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	}
endif;
add_action('law_firm_before_wp_head', 'law_firm_head');

if (! function_exists('law_firm_page_start')) :
	/**
	 * Page Start
	 */
	function law_firm_page_start()
	{ ?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#gl-content"><?php esc_html_e('Skip to content', 'law-firm'); ?></a>
		<?php
	}
endif;
add_action('law_firm_before_header', 'law_firm_page_start', 20);

if (! function_exists('law_firm_header_inclusion')) :
	/**
	 * Top Header Function
	 */
	function law_firm_header_inclusion()
	{
		$toggle_header = get_theme_mod('topbar_toggle', false);

		?>
			<header class="site-header style-one" itemscope itemtype="http://schema.org/WPHeader">
				<?php if ($toggle_header) { ?>
					<div class="header-top">
						<div class="container">
							<div class="header-top__wrapper">
								<div class="top-left">
									<?php law_firm_header_contact_info(); ?>
								</div>
								<div class="top-right">
									<div class="header-search__wrap">
										<a href="#" id="headerSearchBtn">
											<span class="icon search-icon">
												<?php echo wp_kses(law_firm_handle_all_svgs('header-search-icon'), law_firm_get_kses_extended_ruleset()); ?>
											</span>
											<span class="icon search-close">
												<?php echo wp_kses(law_firm_handle_all_svgs('header-search-icon-close'), law_firm_get_kses_extended_ruleset()); ?>
											</span>
										</a>
										<div class="search-wrapper" id="headerSearch">
											<?php get_search_form(); ?>
										</div>
									</div>
									<?php law_firm_social_media_repeater('header-one-social'); ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="desktop-header">
					<div class="container">
						<div class="header-wrapper">
							<div class="header-left">
								<?php
								law_firm_site_branding(true);
								law_firm_primary_nagivation();
								?>
							</div>
							<div class="header-right">
								<?php law_firm_front_header_one_button_consultant(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php law_firm_mobile_header(); ?>
			</header>
		<?php
		}
endif;
add_action('law_firm_header', 'law_firm_header_inclusion', 10);

if (! function_exists('law_firm_background_header')) :
	/**
	 * Breadcrumbs section
	 *
	 * @return void
	 */
	function law_firm_background_header()
	{
		if (! is_front_page()) {
			$breadcrumb_bg_color = '#0F5299';
			$background_style = 'background: ' . $breadcrumb_bg_color . ';';
				?>
			<!-- breadcrumb start -->
			<div class="breadcrumb-wrapper" style="<?php echo esc_attr($background_style); ?>">
				<div class="container">
					<div class="breadcrumb-text">
						<?php law_firm_breadcrumbs(); ?>
						<header class="entry-header">
							<?php law_firm_header_title(); ?>
						</header>
					</div>
				</div>
			</div>
			<!-- breadcrumb end -->
		<?php
		}
	}
endif;
add_action('law_firm_after_header', 'law_firm_background_header', 10);

if (! function_exists('law_firm_skip_content_div')) :
	/**
	 * Breadcrumbs section
	 *
	 * @return void
	 */
	function law_firm_skip_content_div(){
		echo '<div id="gl-content">';
	}
endif;
add_action('law_firm_after_header', 'law_firm_skip_content_div', 20);

if (! function_exists('law_firm_post_thumbnail')) :
	/**
	 * Displays the post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function law_firm_post_thumbnail()
	{
		if (! is_singular()) {
			echo '<figure class="blog__img"><a href="' . esc_url(get_permalink()) . '" class="post-thumbnail">';
			if (has_post_thumbnail()) {
				the_post_thumbnail('blog_card_image');
			} else {
				law_firm_get_fallback_svg('blog_card_image');
			}
			echo '</a>';
			law_firm_posted_on();
			echo '</figure>';
		} else {
			if (! has_post_thumbnail()) return;
		?>
			<div class="post-thumbnail">
				<?php
				$thumbnail_id = get_post_thumbnail_id();

				// Get all the images metas
				$alt     = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
				$caption = wp_get_attachment_caption($thumbnail_id);
				$title   = get_the_title($thumbnail_id);

				echo '<div class=img-date-wrap>';
				the_post_thumbnail(
					'full',
					array(
						'alt'     => esc_attr($alt ? $alt : $title),
						'caption' => esc_attr($caption ? $caption : $title),
						'title'   => esc_attr($title),
					)
				);
				law_firm_posted_on();
				echo '</div>';
				if ($caption) {
					echo '<figcaption>' . $caption . '</figcaption>';
				}
				?>
			</div>
		<?php
		}
	}
endif;
add_action('law_firm_before_post_entry_content', 'law_firm_post_thumbnail', 10);

if (! function_exists('law_firm_entry_content_wrapper_start')) :
	/**
	 * Post Content wrapper Starts
	 */
	function law_firm_entry_content_wrapper_start()
	{
		if (! is_singular()) {
			echo '<div class="blog__info">';
		}
	}
endif;
add_action('law_firm_before_post_entry_content', 'law_firm_entry_content_wrapper_start', 20);

if (! function_exists('law_firm_entry_header')) :
	/**
	 * Meta Details
	 */
	function law_firm_entry_header()
	{
		if (! is_singular(array('page'))) { ?>
			<header class="entry-header blog__top">
				<?php if (is_single()) echo law_firm_posted_by(); ?>
				<div class="entry-meta">
					<div class="entry-categories">
						<?php law_firm_category(); ?>
					</div>
					<div class="comment">
						<?php law_firm_get_comment_count(); ?>
					</div>
				</div>
				<?php if (! is_single()) { ?>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>
				<?php } ?>
			</header>
		<?php
		}
	}
endif;
add_action('law_firm_before_post_entry_content', 'law_firm_entry_header', 30);

if (! function_exists('law_firm_entry_content')) :
	/**
	 * Entry Content
	 */
	function law_firm_entry_content()
	{
		if (is_singular()) { ?>
			<div class="entry-content" itemprop="text">
				<?php 
					the_content(); 
					echo '<div class="numbered">';
						wp_link_pages( 
							array(
							'before'      => '<nav class="navigation pagination"><div class="nav-links">',
							'after'       => '</div></nav>',
							) 
						);
					echo '</div>';
				?>
			</div>
			<?php } elseif (is_home() || is_archive() || is_author() || is_search()) {
			if (has_excerpt()) {
				echo the_excerpt();
			} else {
				echo wpautop(wp_trim_words(get_the_content(), 15, '..'));
			}
		}
	}
endif;
add_action('law_firm_post_entry_content', 'law_firm_entry_content', 40);

if (! function_exists('law_firm_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function law_firm_entry_footer()
	{
		$readmore_button = get_theme_mod('archive_readmore_button', esc_html__('Read More', 'law-firm'));

		if (! is_singular()) {
			if ( $readmore_button ) { ?>
				<div class="blog__bottom">
					<a class="btn btn-readmore" href="<?php the_permalink(); ?>">
						<?php echo esc_html( $readmore_button ); ?>
					</a>
				</div>
		<?php
			}
		}
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'law-firm'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
add_action('law_firm_post_entry_content', 'law_firm_entry_footer', 50);

if (! function_exists('law_firm_entry_content_wrapper_start')) :
	/**
	 * Post Content wrapper Starts
	 */
	function law_firm_entry_content_wrapper_start(){
		if (! is_singular()) {
			echo '</div>';
		}
	}
endif;
add_action('law_firm_post_entry_content', 'law_firm_entry_content_wrapper_start', 60);

if (! function_exists('law_firm_content_wrapper_start')) {
	/**
	 * Content Wrapper
	 * 
	 * @return void
	 */
	function law_firm_content_wrapper_start(){ ?>
		<div class="content-area" id="primary">
			<div class="container">
				<?php if (is_author()) law_firm_author_box(); ?>
				<div class="page-grid">
					<main class="site-main" id="main">
						<?php if ( is_404() ) echo '<section class="error-404 not-found">'; ?>
					<?php
					if (is_search()) echo '<h2>Search Results For ' . esc_html(get_search_query())  .  '</h2>';
					if ( ! is_singular() && ! is_404() ) echo '<div class="grid-layout">';
	}
}
add_action('law_firm_before_posts_content', 'law_firm_content_wrapper_start');

if (! function_exists('law_firm_single_entry_footer_sections')) :
	/**
	 * Entry Footer
	 */
	function law_firm_single_entry_footer_sections(){
		$post_type = get_post_type(get_the_ID());

		if ( is_singular('post') ) {
			law_firm_pagination();
			law_firm_post_footer_meta();
			law_firm_author_box();
			law_firm_comment();
			law_firm_related_posts($post_type);
		}
	}
endif;
add_action('law_firm_after_posts_content', 'law_firm_single_entry_footer_sections', 5);

if (! function_exists('law_firm_content_wrapper_end')) :
	/**
	 * Content Wrapper
	 */
	function law_firm_content_wrapper_end(){
					if ( ! is_singular() && ! is_404() ) echo '</div>'; //End grid-layout
					if (is_archive() || is_home()) law_firm_pagination();
					if ( is_404() ) echo '</section>'; ?>
				</main> <!-- End main -->
				<?php if( ! is_404() ) get_sidebar(); //dont' show sidebar in 404 ?>
			</div> <!-- End page-grid -->
		</div> <!-- End container -->
		</div> <!-- End content area -->
	<?php }
endif;
add_action('law_firm_after_posts_content', 'law_firm_content_wrapper_end', 10);

if (! function_exists('law_firm_footer_start')) {
	/**
	 * Footer Start
	 */
	function law_firm_footer_start(){ ?>
		<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
		<?php
	}
}
add_action('law_firm_footer', 'law_firm_footer_start', 20);

if (! function_exists('law_firm_footer_main')) {
	/**
	 * Footer containing three Widgets Section
	 *
	 * @return void
	 */

	function law_firm_footer_main(){
		$footer_one    = 'footer-one';
		$footer_two    = 'footer-two';
		$footer_three  = 'footer-three';

		if (is_active_sidebar($footer_three) || is_active_sidebar($footer_one) || is_active_sidebar($footer_two)) { ?>
			<div class="main-footer">
				<div class="container">
					<div class="main-footer__wrapper">
						<?php
						$footer_widgets = array($footer_one, $footer_two, $footer_three);
						foreach ($footer_widgets as $widget) {
							if (is_active_sidebar($widget)) { ?>
								<div class="footer-group">
									<?php dynamic_sidebar($widget); ?>
								</div>
						<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php
		}
	}
}
add_action('law_firm_footer', 'law_firm_footer_main', 30);

if (! function_exists('law_firm_footer_bottom')) {
	/**
	 * Footer Bottom has footer left and right 
	 *
	 * @package Law_Firm
	 */
	function law_firm_footer_bottom(){ ?>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom__wrapper">
					<?php
					echo '<div class="footer-bottom__left">';
					law_firm_footer_copyright();
					law_firm_footer_author_link();
					law_firm_wp_link();
					echo '</div>';

					echo '<div class="footer-bottom__right">';
					law_firm_footer_navigation();
					if (function_exists('the_privacy_policy_link')) {
						the_privacy_policy_link();
					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
	<?php
	}
}
add_action('law_firm_footer', 'law_firm_footer_bottom', 40);

if (! function_exists('law_firm_footer_end')) {
	/**
	 * Footer end
	 */
	function law_firm_footer_end(){ ?>
		</footer>
	<?php
	}
}
add_action('law_firm_footer', 'law_firm_footer_end', 50);

if (! function_exists('law_firm_page_end')) {
	/**
	 * Page End
	 *
	 * @return void
	 */
	function law_firm_page_end(){ ?>
			<span id="sideMenuOverlay"></span>
		</div><!-- #page -->
	<?php
	}
}
add_action('law_firm_after_footer', 'law_firm_page_end', 10);