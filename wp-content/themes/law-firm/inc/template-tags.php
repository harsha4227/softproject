<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Law_Firm
 */

if (! function_exists('law_firm_header_style')) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see law_firm_custom_header_setup().
	 */
	function law_firm_header_style(){
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if (! display_header_text()) :
			?>.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
			// If the user has set a custom color for the text use that.
			else :
			?>.site-title a,
			.site-description {
				color: #<?php echo esc_attr($header_text_color); ?>;
			}

			<?php endif; ?>
		</style>
	<?php
	}
endif;

if (! function_exists('law_firm_header_title')) :
	/**
	 * Page Title
	 *
	 * @return void
	 */
	function law_firm_header_title(){ ?>
		<header class="entry-header">
			<?php
			if (is_home() && ! is_front_page()) {
				echo '<h1 class="entry-title">';
				single_post_title();
				echo '</h1>';
			}

			if (is_archive()) {
				the_archive_title('<h1 class="entry-title">', '</h1>');
			}

			if (is_search()) {
				echo '<h1 class="entry-title">';
				printf(esc_html__('Search Results for: %s', 'law-firm'), '<span>' . get_search_query() . '</span>');
				echo '</h1>';
			}

			if (is_singular()) {
				the_title('<h1 class="entry-title">', '</h1>');
			}
			if (is_404()) {
				echo '<h1 class="entry-title">';
				esc_html_e('Error Page', 'law-firm');
				echo '</h1>';
			}
			?>
		</header>
		<?php
	}
endif;


if (! function_exists('law_firm_mobile_ham_wrapper')) {
	function law_firm_mobile_ham_wrapper(){ ?>
		<button class="ham-bar" id="sideMenuOpener">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</button>
	<?php
	}
}


if (! function_exists('law_firm_site_branding')) :
	/**
	 * Site Branding
	 */
	function law_firm_site_branding( $is_desktop = false ){ ?>
		<div class="site-branding" itemscope itemtype="http://schema.org/Organization">
			<?php if (function_exists('has_custom_logo') && has_custom_logo()) {
				the_custom_logo();
			}
			if (is_front_page()) {
				if ($is_desktop) { ?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php esc_html(bloginfo('name')); ?></a></h1>
				<?php } else { ?>
					<h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php esc_html(bloginfo('name')); ?></a></h2>
				<?php }
			} else { ?>
				<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php esc_html(bloginfo('name')); ?></a></p>
			<?php
			}
			$description = get_bloginfo('description', 'display');
			if ($description || is_customize_preview()) : ?>
				<p class="site-description">
					<?php
					echo wp_kses_post($description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</p>
			<?php endif; ?>
		</div>
	<?php
	}
endif;

if (! function_exists('law_firm_front_header_one_button_consultant')) :
	/**
	 * Law_Firm Front Header One Appoinment
	 *
	 * @return void
	 */
	function law_firm_front_header_one_button_consultant(){
		$header_btn_text  = get_theme_mod( 'header_btn_text' );
		$header_btn_link  = get_theme_mod( 'header_btn_link' );

		if ( $header_btn_text && $header_btn_link ) { ?>
			<a href="<?php echo esc_url( $header_btn_link ); ?>" class="btn"><?php echo esc_html( $header_btn_text ); ?></a>
		<?php }
	}
endif;

if (!function_exists('law_firm_sidebar_layout')) {
	/**
	 * Sidebar Layout 
	 *
	 * @return void
	 */
	function law_firm_sidebar_layout(){
		$sidebar_layout = get_post_meta( get_the_ID(), 'law_firm_sidebar_layout', true );
		
		$default_layout = 'gl-right-wrap';

		if ( is_page() ) {
			$default_layout = get_theme_mod('single_page_layouts', 'gl-right-wrap');
		}
		if ( is_single() ) {
			$default_layout = get_theme_mod('single_post_layouts', 'gl-right-wrap');
		}

		if ( is_archive() || is_search() || is_home() ) {
			if (is_author()) {
				$default_layout = 'gl-full-wrap';
			} else {
				$default_layout = get_theme_mod('archive_page_layouts', 'gl-right-wrap');
			}
		}

		if( is_singular() ) {
			if (isset($sidebar_layout) && !empty($sidebar_layout)) {
				if ($sidebar_layout == 'default') {
					if (!is_active_sidebar('primary-sidebar')) {
						$layout = 'gl-full-wrap';
					} else {
						$layout = $default_layout;
					}
				} elseif ($sidebar_layout == 'left-sidebar') {
					if (!is_active_sidebar('primary-sidebar')) {
						$layout = 'gl-full-wrap';
					} else {
						$layout = 'gl-left-wrap';
					}
				} elseif ($sidebar_layout == 'right-sidebar') {
					if (!is_active_sidebar('primary-sidebar')) {
						$layout = 'gl-full-wrap';
					} else {
						$layout = 'gl-right-wrap';
					}
				} elseif ($sidebar_layout == 'full-width') {
					if (!is_active_sidebar('primary-sidebar')) {
						$layout = 'gl-full-wrap';
					} else {
						$layout = 'gl-full-wrap';
					}
				} else {
					$layout = $default_layout;
				}
				return esc_attr($layout);
			} else {
				if (!is_active_sidebar('primary-sidebar')) {
					return esc_attr('gl-full-wrap');
				} else {
					return $default_layout;
				}
			}
		} else {
			if (is_archive() || is_search() || is_home()) {
				if (!is_active_sidebar('primary-sidebar')) {
					$layout = 'gl-full-wrap';
				} else {
					$layout = $default_layout;
				}
				return $layout;
			}
			return false;
		}
	}
}

if ( ! function_exists( 'law_firm_google_fonts_url' ) ) :	
	/**
	 * Google Fonts url
	 */
	function law_firm_google_fonts_url() {
		$fonts_url = '';
	
		/* Translators: If there are characters in your language that are not
		* supported by respective fonts, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$opensans_font = _x( 'on', 'Open Sans font: on or off', 'law-firm' );
	
		if ( 'off' !== $opensans_font ) {
			$font_families = array(
				'Montserrat:400,400i,500,500i,600,600i,700,700i',
				'DM Sans:400,400i,500,500i,600,600i,700,700i'
			);
	
			$query_args = array(
				'family'  => urlencode( implode( '|', $font_families ) ),
				'subset'  => urlencode( 'latin,latin-ext' ),
				'display' => urlencode( 'fallback' ),
			);
	
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

			$toggle_localgoogle_fonts = get_theme_mod( 'toggle_localgoogle_fonts', false );

			if( $toggle_localgoogle_fonts ){
				$font_families = array(
					'Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
					'DM Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700'
				);
				
				$fonts_url = add_query_arg( array(
					'family' => implode( '&family=', $font_families ),
					'display' => 'swap',
				), 'https://fonts.googleapis.com/css2' );

				$fonts_url = law_firm_get_webfont_url( esc_url_raw( $fonts_url ) );
			} else{
				$fonts_url = $fonts_url;
			}
		}
		return esc_url( $fonts_url );
	}
endif;

if (!function_exists('law_firm_handle_all_svgs')) :
	/**
	 * Lists all the svg
	 *
	 * @param [type] $svg
	 * @return void
	 */
	function law_firm_handle_all_svgs( $svg ){
		switch ( $svg ) {
			case 'banner-two-contact':
				return '<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.86128 8.56921C6.96897 10.7461 8.75358 12.5231 10.9305 13.6384L12.6228 11.9461C12.8305 11.7384 13.1382 11.6692 13.4074 11.7615C14.269 12.0461 15.1997 12.2 16.1536 12.2C16.5767 12.2 16.9228 12.5461 16.9228 12.9692V15.6538C16.9228 16.0769 16.5767 16.4231 16.1536 16.4231C8.93051 16.4231 3.07666 10.5692 3.07666 3.34614C3.07666 2.92306 3.42281 2.5769 3.84589 2.5769H6.5382C6.96128 2.5769 7.30743 2.92306 7.30743 3.34614C7.30743 4.30767 7.46128 5.23075 7.74589 6.09229C7.83051 6.36152 7.76897 6.66152 7.55358 6.8769L5.86128 8.56921Z" fill="white"/>
				</svg>';
				break;
			case 'banner-video':
				return '<svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M11.2812 5.71973C11.7281 5.99477 12 6.47923 12 7.00119C12 7.52315 11.7281 8.00761 11.2812 8.25452L2.28219 13.7554C1.81906 14.0649 1.23938 14.0774 0.76625 13.8117C0.533715 13.6812 0.340149 13.4911 0.205472 13.2609C0.070795 13.0307 -0.000128368 12.7688 1.74417e-07 12.5021V1.50028C3.81792e-05 1.23374 0.0710405 0.972027 0.205709 0.742031C0.340377 0.512035 0.533853 0.322056 0.76625 0.19162C0.9987 0.0613135 1.26165 -0.00473463 1.52807 0.000264069C1.7945 0.00526276 2.05479 0.081128 2.28219 0.220062L11.2812 5.71973Z" fill="white"/>
				</svg>   ';
				break;

			case 'alert':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="exclamation"><g id="Group"><path id="Vector" d="M10 18.75C7.67936 18.75 5.45376 17.8281 3.81282 16.1872C2.17187 14.5462 1.25 12.3206 1.25 10C1.25 7.67936 2.17187 5.45376 3.81282 3.81282C5.45376 2.17187 7.67936 1.25 10 1.25C12.3206 1.25 14.5462 2.17187 16.1872 3.81282C17.8281 5.45376 18.75 7.67936 18.75 10C18.75 12.3206 17.8281 14.5462 16.1872 16.1872C14.5462 17.8281 12.3206 18.75 10 18.75ZM10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 7.34784 18.9464 4.8043 17.0711 2.92893C15.1957 1.05357 12.6522 0 10 0C7.34784 0 4.8043 1.05357 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C4.8043 18.9464 7.34784 20 10 20Z"fill="currentColor" /><path id="Vector_2"d="M8.75244 13.75C8.75244 13.5858 8.78477 13.4233 8.84759 13.2716C8.91041 13.12 9.00248 12.9822 9.11856 12.8661C9.23463 12.75 9.37243 12.658 9.52409 12.5952C9.67574 12.5323 9.83829 12.5 10.0024 12.5C10.1666 12.5 10.3291 12.5323 10.4808 12.5952C10.6325 12.658 10.7703 12.75 10.8863 12.8661C11.0024 12.9822 11.0945 13.12 11.1573 13.2716C11.2201 13.4233 11.2524 13.5858 11.2524 13.75C11.2524 14.0815 11.1207 14.3995 10.8863 14.6339C10.6519 14.8683 10.334 15 10.0024 15C9.67092 15 9.35298 14.8683 9.11856 14.6339C8.88414 14.3995 8.75244 14.0815 8.75244 13.75ZM8.87494 6.24375C8.8583 6.08605 8.87499 5.92662 8.92394 5.77579C8.97289 5.62496 9.05301 5.4861 9.15909 5.36824C9.26517 5.25037 9.39485 5.15612 9.53971 5.0916C9.68456 5.02709 9.84137 4.99375 9.99994 4.99375C10.1585 4.99375 10.3153 5.02709 10.4602 5.0916C10.605 5.15612 10.7347 5.25037 10.8408 5.36824C10.9469 5.4861 11.027 5.62496 11.0759 5.77579C11.1249 5.92662 11.1416 6.08605 11.1249 6.24375L10.6874 10.6275C10.6727 10.7997 10.5939 10.9601 10.4666 11.077C10.3393 11.194 10.1728 11.2588 9.99994 11.2588C9.8271 11.2588 9.66055 11.194 9.53325 11.077C9.40594 10.9601 9.32714 10.7997 9.31244 10.6275L8.87494 6.24375Z" fill="currentColor" /></g></g></svg>';
				break;

			case 'facebook':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path
				d    = "M5.55448 12.8333H8.01062V7.91491H10.2236L10.4668 5.47105H8.01062V4.23684C8.01062 4.07399 8.07531 3.91781 8.19047 3.80265C8.30562 3.6875 8.4618 3.62281 8.62466 3.62281H10.4668V1.16667H8.62466C7.81039 1.16667 7.02948 1.49013 6.45371 2.0659C5.87794 2.64167 5.55448 3.42258 5.55448 4.23684V5.47105H4.32641L4.08325 7.91491H5.55448V12.8333Z"
				fill = "currentColor" />
			</svg>';
				break;

			case 'instagram':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M7.00008 1.16667C8.585 1.16667 8.78275 1.1725 9.40458 1.20167C10.0258 1.23083 10.4487 1.32825 10.8209 1.47292C11.2059 1.62108 11.5302 1.82175 11.8546 2.1455C12.1512 2.43711 12.3807 2.78984 12.5272 3.17917C12.6712 3.55075 12.7692 3.97425 12.7984 4.5955C12.8258 5.21733 12.8334 5.41508 12.8334 7C12.8334 8.58492 12.8276 8.78267 12.7984 9.4045C12.7692 10.0257 12.6712 10.4487 12.5272 10.8208C12.3811 11.2104 12.1516 11.5632 11.8546 11.8545C11.5629 12.151 11.2102 12.3805 10.8209 12.5271C10.4493 12.6712 10.0258 12.7692 9.40458 12.7983C8.78275 12.8257 8.585 12.8333 7.00008 12.8333C5.41516 12.8333 5.21741 12.8275 4.59558 12.7983C3.97433 12.7692 3.55141 12.6712 3.17925 12.5271C2.78977 12.3809 2.43697 12.1514 2.14558 11.8545C1.8489 11.5629 1.61937 11.2102 1.473 10.8208C1.32833 10.4492 1.23091 10.0257 1.20175 9.4045C1.17433 8.78267 1.16675 8.58492 1.16675 7C1.16675 5.41508 1.17258 5.21733 1.20175 4.5955C1.23091 3.97367 1.32833 3.55133 1.473 3.17917C1.61897 2.7896 1.84855 2.43677 2.14558 2.1455C2.43706 1.84872 2.78983 1.61918 3.17925 1.47292C3.55141 1.32825 3.97375 1.23083 4.59558 1.20167C5.21741 1.17425 5.41516 1.16667 7.00008 1.16667ZM7.00008 4.08333C6.22653 4.08333 5.48467 4.39062 4.93769 4.9376C4.39071 5.48459 4.08341 6.22645 4.08341 7C4.08341 7.77355 4.39071 8.51541 4.93769 9.06239C5.48467 9.60938 6.22653 9.91667 7.00008 9.91667C7.77363 9.91667 8.51549 9.60938 9.06248 9.06239C9.60946 8.51541 9.91675 7.77355 9.91675 7C9.91675 6.22645 9.60946 5.48459 9.06248 4.9376C8.51549 4.39062 7.77363 4.08333 7.00008 4.08333ZM10.7917 3.9375C10.7917 3.74411 10.7149 3.55865 10.5782 3.4219C10.4414 3.28516 10.256 3.20833 10.0626 3.20833C9.86919 3.20833 9.68373 3.28516 9.54698 3.4219C9.41024 3.55865 9.33341 3.74411 9.33341 3.9375C9.33341 4.13089 9.41024 4.31635 9.54698 4.4531C9.68373 4.58984 9.86919 4.66667 10.0626 4.66667C10.256 4.66667 10.4414 4.58984 10.5782 4.4531C10.7149 4.31635 10.7917 4.13089 10.7917 3.9375ZM7.00008 5.25C7.46421 5.25 7.90933 5.43437 8.23752 5.76256C8.56571 6.09075 8.75008 6.53587 8.75008 7C8.75008 7.46413 8.56571 7.90925 8.23752 8.23744C7.90933 8.56563 7.46421 8.75 7.00008 8.75C6.53595 8.75 6.09083 8.56563 5.76264 8.23744C5.43446 7.90925 5.25008 7.46413 5.25008 7C5.25008 6.53587 5.43446 6.09075 5.76264 5.76256C6.09083 5.43437 6.53595 5.25 7.00008 5.25Z"
				fill = "currentColor" />
			</svg>';
				break;

			case 'linkedin':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M3.61491 2.97482C3.61475 3.2995 3.48562 3.61082 3.25592 3.84028C3.02622 4.06975 2.71478 4.19858 2.3901 4.19841C2.06542 4.19825 1.7541 4.06912 1.52463 3.83942C1.29516 3.60972 1.16634 3.29828 1.1665 2.9736C1.16667 2.64892 1.2958 2.3376 1.5255 2.10813C1.7552 1.87866 2.06664 1.74984 2.39132 1.75C2.716 1.75017 3.02732 1.8793 3.25678 2.109C3.48625 2.3387 3.61508 2.65014 3.61491 2.97482ZM3.65164 5.10494H1.20323V12.7685H3.65164V5.10494ZM7.52012 5.10494H5.08396V12.7685H7.49564V8.74694C7.49564 6.50665 10.4154 6.29854 10.4154 8.74694V12.7685H12.8332V7.91448C12.8332 4.13781 8.51173 4.2786 7.49564 6.13327L7.52012 5.10494Z"
				fill = "currentColor" />
		</svg>';
				break;

			case 'pinterest':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
			<path
				d    = "M5.27317 12.565C5.83317 12.7342 6.399 12.8333 6.99984 12.8333C8.54693 12.8333 10.0307 12.2188 11.1246 11.1248C12.2186 10.0308 12.8332 8.5471 12.8332 7C12.8332 6.23396 12.6823 5.47541 12.3891 4.76768C12.096 4.05995 11.6663 3.41689 11.1246 2.87521C10.583 2.33354 9.93989 1.90386 9.23216 1.6107C8.52442 1.31755 7.76588 1.16667 6.99984 1.16667C6.23379 1.16667 5.47525 1.31755 4.76752 1.6107C4.05978 1.90386 3.41672 2.33354 2.87505 2.87521C1.78109 3.96917 1.1665 5.4529 1.1665 7C1.1665 9.47917 2.724 11.6083 4.92317 12.4483C4.87067 11.9933 4.81817 11.2408 4.92317 10.7217L5.594 7.84C5.594 7.84 5.42484 7.50167 5.42484 6.965C5.42484 6.16 5.9265 5.55917 6.49817 5.55917C6.99984 5.55917 7.23317 5.92667 7.23317 6.39917C7.23317 6.90083 6.90067 7.61833 6.7315 8.30667C6.63234 8.87833 7.03484 9.38 7.61817 9.38C8.6565 9.38 9.4615 8.27167 9.4615 6.70833C9.4615 5.30833 8.45817 4.35167 7.01734 4.35167C5.37234 4.35167 4.404 5.57667 4.404 6.86583C4.404 7.3675 4.56734 7.875 4.83567 8.2075C4.88817 8.2425 4.88817 8.28917 4.87067 8.37667L4.7015 9.0125C4.7015 9.11167 4.63734 9.14667 4.53817 9.07667C3.7915 8.75 3.35984 7.68833 3.35984 6.83083C3.35984 4.9875 4.6665 3.31333 7.1865 3.31333C9.19317 3.31333 10.7565 4.75417 10.7565 6.6675C10.7565 8.67417 9.514 10.2842 7.73484 10.2842C7.169 10.2842 6.61484 9.98083 6.4165 9.625L6.02567 11.0075C5.8915 11.5092 5.524 12.18 5.27317 12.5825V12.565Z"
				fill = "currentColor" />
		</svg>';
				break;

			case 'location':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="location"><path id="Vector" d="M10.1273 10.1592C10.5944 10.1592 10.9944 9.99278 11.3273 9.65987C11.6596 9.32753 11.8258 8.92781 11.8258 8.46072C11.8258 7.99363 11.6596 7.59363 11.3273 7.26072C10.9944 6.92838 10.5944 6.76221 10.1273 6.76221C9.66022 6.76221 9.2605 6.92838 8.92816 7.26072C8.59525 7.59363 8.42879 7.99363 8.42879 8.46072C8.42879 8.92781 8.59525 9.32753 8.92816 9.65987C9.2605 9.99278 9.66022 10.1592 10.1273 10.1592ZM10.1273 16.4013C11.8541 14.816 13.1351 13.3757 13.9702 12.0803C14.8053 10.7854 15.2228 9.63553 15.2228 8.63057C15.2228 7.08776 14.7308 5.82435 13.7468 4.84034C12.7634 3.8569 11.5569 3.36518 10.1273 3.36518C8.69772 3.36518 7.49093 3.8569 6.50693 4.84034C5.52349 5.82435 5.03177 7.08776 5.03177 8.63057C5.03177 9.63553 5.44932 10.7854 6.28442 12.0803C7.11952 13.3757 8.40049 14.816 10.1273 16.4013ZM10.1273 18.3333C10.0141 18.3333 9.90084 18.3121 9.7876 18.2696C9.67437 18.2272 9.57529 18.1706 9.49036 18.0998C7.42384 16.2739 5.88102 14.5791 4.86191 13.0153C3.84281 11.451 3.33325 9.98939 3.33325 8.63057C3.33325 6.50743 4.01634 4.81599 5.38251 3.55626C6.74811 2.29653 8.32971 1.66667 10.1273 1.66667C11.9249 1.66667 13.5065 2.29653 14.8721 3.55626C16.2383 4.81599 16.9214 6.50743 16.9214 8.63057C16.9214 9.98939 16.4118 11.451 15.3927 13.0153C14.3736 14.5791 12.8308 16.2739 10.7643 18.0998C10.6793 18.1706 10.5802 18.2272 10.467 18.2696C10.3538 18.3121 10.2405 18.3333 10.1273 18.3333Z" fill="currentColor" /></g></svg>';
				break;

			case 'phone':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="phone"><path id="Vector"d="M16.6667 12.9167C15.6667 12.9167 14.5833 12.75 13.6667 12.4167H13.4167C13.1667 12.4167 13 12.5 12.8333 12.6667L11 14.5C8.66667 13.25 6.66667 11.3333 5.5 9L7.33333 7.16667C7.58333 6.91667 7.66667 6.58333 7.5 6.33333C7.25 5.41667 7.08333 4.33333 7.08333 3.33333C7.08333 2.91667 6.66667 2.5 6.25 2.5H3.33333C2.91667 2.5 2.5 2.91667 2.5 3.33333C2.5 11.1667 8.83333 17.5 16.6667 17.5C17.0833 17.5 17.5 17.0833 17.5 16.6667V13.75C17.5 13.3333 17.0833 12.9167 16.6667 12.9167ZM4.16667 4.16667H5.41667C5.5 4.91667 5.66667 5.66667 5.83333 6.33333L4.83333 7.33333C4.5 6.33333 4.25 5.25 4.16667 4.16667ZM15.8333 15.8333C14.75 15.75 13.6667 15.5 12.6667 15.1667L13.6667 14.1667C14.3333 14.3333 15.0833 14.5 15.8333 14.5V15.8333Z" fill="currentColor" /></g></svg>';
				break;

			case 'email':
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.3334 5C18.3334 4.08333 17.5834 3.33333 16.6667 3.33333H3.33341C2.41675 3.33333 1.66675 4.08333 1.66675 5V15C1.66675 15.9167 2.41675 16.6667 3.33341 16.6667H16.6667C17.5834 16.6667 18.3334 15.9167 18.3334 15V5ZM16.6667 5L10.0001 9.15833L3.33341 5H16.6667ZM16.6667 15H3.33341V6.66667L10.0001 10.8333L16.6667 6.66667V15Z" fill="currentColor" /> </svg>';
				break;


			case 'contact-ph':
				return '<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.86128 8.56921C6.96897 10.7461 8.75358 12.5231 10.9305 13.6384L12.6228 11.9461C12.8305 11.7384 13.1382 11.6692 13.4074 11.7615C14.269 12.0461 15.1997 12.2 16.1536 12.2C16.5767 12.2 16.9228 12.5461 16.9228 12.9692V15.6538C16.9228 16.0769 16.5767 16.4231 16.1536 16.4231C8.93051 16.4231 3.07666 10.5692 3.07666 3.34614C3.07666 2.92306 3.42281 2.5769 3.84589 2.5769H6.5382C6.96128 2.5769 7.30743 2.92306 7.30743 3.34614C7.30743 4.30767 7.46128 5.23075 7.74589 6.09229C7.83051 6.36152 7.76897 6.66152 7.55358 6.8769L5.86128 8.56921Z" fill="white"/>
                    </svg>';
				break;

			case 'header-search-icon':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M8.67635 0.666664C13.0929 0.666664 16.6854 4.17989 16.6854 8.49903C16.6854 10.5368 15.8857 12.3953 14.5771 13.7902L17.152 16.303C17.393 16.5387 17.3938 16.9199 17.1528 17.1556C17.0328 17.2746 16.874 17.3333 16.7161 17.3333C16.559 17.3333 16.4011 17.2746 16.2802 17.1572L13.6743 14.6158C12.3034 15.6894 10.5652 16.3322 8.67635 16.3322C4.25979 16.3322 0.666504 12.8182 0.666504 8.49903C0.666504 4.17989 4.25979 0.666664 8.67635 0.666664ZM8.67635 1.87313C4.93996 1.87313 1.90018 4.84505 1.90018 8.49903C1.90018 12.153 4.93996 15.1257 8.67635 15.1257C12.4119 15.1257 15.4517 12.153 15.4517 8.49903C15.4517 4.84505 12.4119 1.87313 8.67635 1.87313Z" fill="#101010" />
                        </svg>';
				break;

			case 'header-search-icon-close':
				return ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
							viewBox="0 0 24 24" fill="none">
							<path
								d="M21.5894 19.5675C21.854 19.8364 22.0015 20.1989 22 20.5761C21.9985 20.9532 21.8479 21.3145 21.5812 21.5812C21.3145 21.8479 20.9532 21.9985 20.5761 22C20.1989 22.0015 19.8364 21.854 19.5675 21.5894L12 14.022L4.43247 21.5894C4.1636 21.854 3.8011 22.0015 3.42393 22C3.04675 21.9985 2.68547 21.8479 2.41876 21.5812C2.15206 21.3145 2.00155 20.9532 2.00001 20.5761C1.99848 20.1989 2.14604 19.8364 2.41056 19.5675L9.97798 12L2.41056 4.43247C2.14604 4.1636 1.99848 3.8011 2.00001 3.42393C2.00155 3.04675 2.15206 2.68547 2.41876 2.41876C2.68547 2.15206 3.04675 2.00155 3.42393 2.00001C3.8011 1.99848 4.1636 2.14604 4.43247 2.41056L12 9.97798L19.5675 2.41056C19.8364 2.14604 20.1989 1.99848 20.5761 2.00001C20.9532 2.00155 21.3145 2.15206 21.5812 2.41876C21.8479 2.68547 21.9985 3.04675 22 3.42393C22.0015 3.8011 21.854 4.1636 21.5894 4.43247L14.022 12L21.5894 19.5675Z"
								fill="#101010" />
						</svg>';
				break;

			case 'comment':
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="path-1-inside-1_2572_8281" fill="white">
						<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z"/>
						</mask>
						<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z" fill="currentColor"/>
						<path d="M7.99991 1.3335V2.8335V1.3335ZM1.33324 8.00016L2.83324 8.00584V8.00016H1.33324ZM2.83991 12.2202L3.90057 13.2808L4.86423 12.3172L3.99713 11.2658L2.83991 12.2202ZM1.50658 13.5535L0.445894 12.4928L0.438856 12.4999L1.50658 13.5535ZM1.36658 14.2802L-0.0161439 14.8616L-0.00613952 14.8854L0.00467741 14.9088L1.36658 14.2802ZM1.99991 14.6668V13.1668H1.96835L1.93681 13.1682L1.99991 14.6668ZM7.99991 13.3335V14.8335L8.00109 14.8335L7.99991 13.3335ZM3.60658 13.3335L2.54592 12.2728L-0.014743 14.8335H3.60658V13.3335ZM4.22658 12.7135L5.28724 13.7742L5.29039 13.771L4.22658 12.7135ZM4.42044 12.2435H5.92044H4.42044ZM4.22658 11.7735L5.29039 10.716L5.28665 10.7122L4.22658 11.7735ZM7.99991 -0.166504C6.92745 -0.166504 5.86549 0.0447332 4.87466 0.455147L6.02271 3.22679C6.64956 2.96714 7.32141 2.8335 7.99991 2.8335V-0.166504ZM4.87466 0.455147C3.88384 0.86556 2.98355 1.46711 2.22521 2.22546L4.34653 4.34678C4.82629 3.86701 5.39586 3.48643 6.02271 3.22679L4.87466 0.455147ZM2.22521 2.22546C0.693658 3.757 -0.166756 5.83423 -0.166756 8.00016H2.83324C2.83324 6.62988 3.37759 5.31572 4.34653 4.34678L2.22521 2.22546ZM-0.166745 7.99448C-0.173899 9.88413 0.480388 11.7167 1.68269 13.1745L3.99713 11.2658C3.24049 10.3483 2.82873 9.19504 2.83323 8.00584L-0.166745 7.99448ZM1.77925 11.1595L0.445917 12.4928L2.56724 14.6142L3.90057 13.2808L1.77925 11.1595ZM0.438856 12.4999C0.138216 12.8046 -0.0654435 13.1915 -0.146421 13.6118L2.79941 14.1794C2.76826 14.3411 2.68993 14.4899 2.5743 14.607L0.438856 12.4999ZM-0.146421 13.6118C-0.227398 14.0322 -0.182066 14.467 -0.0161439 14.8616L2.7493 13.6987C2.81312 13.8505 2.83055 14.0177 2.79941 14.1794L-0.146421 13.6118ZM0.00467741 14.9088C0.184636 15.2987 0.47637 15.6263 0.842845 15.85L2.40611 13.2895C2.54706 13.3756 2.65926 13.5015 2.72848 13.6515L0.00467741 14.9088ZM0.842845 15.85C1.20932 16.0738 1.63401 16.1836 2.06301 16.1655L1.93681 13.1682C2.10181 13.1612 2.26515 13.2034 2.40611 13.2895L0.842845 15.85ZM1.99991 16.1668H7.99991V13.1668H1.99991V16.1668ZM7.99991 16.1668C10.1658 16.1668 12.2431 15.3064 13.7746 13.7749L11.6533 11.6535C10.6844 12.6225 9.3702 13.1668 7.99991 13.1668V16.1668ZM13.7746 13.7749C15.3062 12.2433 16.1666 10.1661 16.1666 8.00016H13.1666C13.1666 9.37045 12.6222 10.6846 11.6533 11.6535L13.7746 13.7749ZM16.1666 8.00016C16.1666 5.83423 15.3062 3.757 13.7746 2.22546L11.6533 4.34678C12.6222 5.31572 13.1666 6.62988 13.1666 8.00016H16.1666ZM13.7746 2.22546C12.2431 0.69391 10.1658 -0.166504 7.99991 -0.166504V2.8335C9.3702 2.8335 10.6844 3.37784 11.6533 4.34678L13.7746 2.22546ZM7.99991 11.8335H3.60658V14.8335H7.99991V11.8335ZM4.66724 14.3942L5.28724 13.7742L3.16592 11.6528L2.54592 12.2728L4.66724 14.3942ZM5.29039 13.771C5.69393 13.365 5.92044 12.8159 5.92044 12.2435H2.92044C2.92044 12.0233 3.00756 11.8121 3.16277 11.656L5.29039 13.771ZM5.92044 12.2435C5.92044 11.6711 5.69393 11.1219 5.29039 10.716L3.16277 12.831C3.00756 12.6749 2.92044 12.4636 2.92044 12.2435H5.92044ZM5.28665 10.7122C4.65922 10.0855 4.2685 9.26063 4.18106 8.37813L1.19568 8.67392C1.35155 10.2471 2.04805 11.7175 3.16651 12.8347L5.28665 10.7122ZM4.18106 8.37813C4.09362 7.49562 4.31487 6.6101 4.80711 5.87243L2.31168 4.20725C1.43421 5.52223 1.03981 7.10077 1.19568 8.67392L4.18106 8.37813ZM4.80711 5.87243C5.29935 5.13476 6.03213 4.59058 6.8806 4.33261L6.00791 1.46235C4.49541 1.92222 3.18915 2.89228 2.31168 4.20725L4.80711 5.87243ZM6.8806 4.33261C7.72907 4.07463 8.64075 4.11882 9.46029 4.45764L10.6065 1.68523C9.14555 1.08125 7.5204 1.00248 6.00791 1.46235L6.8806 4.33261ZM9.46029 4.45764C10.2798 4.79647 10.9566 5.40896 11.3751 6.19078L14.0199 4.77474C13.2737 3.38106 12.0674 2.28922 10.6065 1.68523L9.46029 4.45764ZM11.3751 6.19078C11.7937 6.97259 11.9283 7.87536 11.7559 8.74527L14.6987 9.3284C15.006 7.77769 14.7661 6.16841 14.0199 4.77474L11.3751 6.19078ZM11.7559 8.74527C11.5836 9.61518 11.1149 10.3984 10.4298 10.9615L12.3347 13.2791C13.556 12.2753 14.3914 10.8791 14.6987 9.3284L11.7559 8.74527ZM10.4298 10.9615C9.7447 11.5246 8.88555 11.8328 7.99873 11.8335L8.00109 14.8335C9.58195 14.8323 11.1135 14.2829 12.3347 13.2791L10.4298 10.9615Z" fill="currentColor" mask="url(#path-1-inside-1_2572_8281)"/>
						</svg>';
				break;


			default:
				# code...
				break;
		}
	}
endif;

if (! function_exists('law_firm_tags')) {
	/**
	 * Prints tags
	 */
	function law_firm_tags(){
		// Hide category and tag text for pages.
		if ('post' === get_post_type() && has_tag()) { ?>
			<div class="tags" itemprop="about">
				<span><?php esc_html_e('Tags:', 'law-firm'); ?></span>
				<?php
					$tags_list = get_the_tag_list('', ' ');
					if ($tags_list) {
						echo wp_kses_post($tags_list);
					}
				?>
			</div>
		<?php
		}
	}
}

if (! function_exists('law_firm_social_media_repeater')) :
	/**
	 * Social Media Links
	 *
	 * @return void
	 */
	function law_firm_social_media_repeater( $section_name ) {
		$socialmedia_toggle    = get_theme_mod('socialmedia_toggle', false);
		$social_media_heading  = get_theme_mod('socialmedia_heading', __('Follow Us:', 'law-firm'));
		$facebook_link  	   = get_theme_mod( 'social_facebook_link' );
		$instagram_link 	   = get_theme_mod( 'social_instagram_link' );
		$linkedin_link  	   = get_theme_mod( 'social_linkedin_link' );
		$pinterest_link 	   = get_theme_mod( 'social_pinterest_link' );
		$md_checkbox           = get_theme_mod( 'md_social_checkbox' );
		
		if ( $socialmedia_toggle && ( $facebook_link || $instagram_link ||$linkedin_link || $pinterest_link || $md_checkbox ) ) { ?>
			<div class="social-wrap <?php echo esc_attr( $section_name ); ?>">
				<?php if ( $social_media_heading ) { ?>
					<span class="social-label"><?php echo esc_html($social_media_heading); ?></span>
				<?php }
				?>
				<ul class="social-networks">
					<?php
						if( $facebook_link ){ ?>
							<li>
								<a class="social-link" href="<?php echo esc_url( $facebook_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
									<?php echo wp_kses( law_firm_handle_all_svgs( 'facebook' ), law_firm_get_kses_extended_ruleset() ); ?>
								</a>
							</li>
						<?php }
						if( $instagram_link ){ ?>
							<li>
								<a class="social-link" href="<?php echo esc_url( $instagram_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
									<?php echo wp_kses( law_firm_handle_all_svgs( 'instagram' ), law_firm_get_kses_extended_ruleset() ); ?>
								</a>
							</li>
						<?php }
						if( $linkedin_link ){ ?>
							<li>
								<a class="social-link" href="<?php echo esc_url( $linkedin_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
									<?php echo wp_kses( law_firm_handle_all_svgs( 'linkedin' ), law_firm_get_kses_extended_ruleset() ); ?>
								</a>
							</li>
						<?php }
						if( $pinterest_link ){ ?>
							<li>
								<a class="social-link" href="<?php echo esc_url( $pinterest_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
									<?php echo wp_kses( law_firm_handle_all_svgs( 'pinterest' ), law_firm_get_kses_extended_ruleset() ); ?>
								</a>
							</li>
						<?php }
					?>
				</ul>
			</div>
		<?php
		}
	}
endif;

if (!function_exists('law_firm_footer_copyright')) {
	/**
	 * Footer Copyright Section
	 * @return void
	 */
	function law_firm_footer_copyright(){
		$footer_copyright_setting = get_theme_mod('footer_copyright_setting');
		?>
		<div class="site-info footer">
			<?php
			if( $footer_copyright_setting ){
				echo wp_kses_post( $footer_copyright_setting );
			} else {
				echo '<span>';
				esc_html_e('&copy; Copyright ', 'law-firm');
				echo date_i18n(esc_html__('Y', 'law-firm'));
				echo '</span>';

				echo '<span>';
				echo ' <a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>. ';
				echo '</span>';
			}
			?>
		</div>
	<?php
	}
}

if (! function_exists('law_firm_footer_author_link')) :
	/**
	 * Show/Hide Author link in footer
	 * 
	 */
	function law_firm_footer_author_link() {
		echo '<div class="site-author">';
			echo '<span>';
				esc_html_e('&nbsp;Developed By ', 'law-firm');
			echo '</span>';
			echo '<span class="author-link"><a href="' . esc_url('https://glthemes.com/') . '" rel="nofollow" target="_blank">' . esc_html__('Good Looking Themes', 'law-firm') . '</a></span>.';
		echo '</div>';
	}
endif;

if (! function_exists('law_firm_wp_link')) :
	/**
	 * WordPress Link in the footer
	 */
	function law_firm_wp_link() {
		printf(esc_html__('&nbsp; %1$sPowered by %2$s%3$s', 'law-firm'), '<span class="wp-link">', '<a href="' . esc_url(__('https://wordpress.org/', 'law-firm')) . '" target="_blank">'. esc_html__( 'WordPress','law-firm' ) . '</a>', '</span>');
	}
endif;

if (! function_exists('law_firm_get_kses_extended_ruleset')) :
	/**
	 * Passes wpkses for svgs
	 *
	 * @return void
	 */

	function law_firm_get_kses_extended_ruleset(){
		$kses_defaults = wp_kses_allowed_html('post');

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array('fill' => true),
			'title' => array('title' => true),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
			'circle' => array(
				'cx'    => true,
				'cy'    => true,
				'r'     => true,
				'fill'  => true,
				'stroke' => true,
				'stroke-width' => true,
			),
		);
		return array_merge($kses_defaults, $svg_args);
	}
endif;


function law_firm_comment_list($comment, $args, $depth){
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment, 42); ?>
			</div>
			<div class="comment-body_wrap">
				<footer class="comment-meta">
					<div class="comment-metadata">
						<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
							<time datetime="<?php comment_time('c'); ?>">
								<?php printf(__('%1$s', 'law-firm'), get_comment_date()); ?>
							</time>
						</a>
						<b class="fn">
							<a href="<?php echo esc_url(get_comment_author_url()); ?>" class="url" rel="ugc"><?php comment_author(); ?></a>
						</b>
						<span class="says"><?php _e('says:', 'law-firm'); ?></span>
						<?php edit_comment_link(__('Edit', 'law-firm'), '<span class="edit-link">', '</span>'); ?>
					</div>
				</footer>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				<div class="reply">
					<?php comment_reply_link(
						array_merge(
							$args,
							array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => __('Reply', 'law-firm')
							)
						)
					); ?>
				</div>
			</div>
		</article>
		<?php if ('div' != $args['style']) : ?>
	</li>
	<?php endif; 
	// If the current comment has children, display them
	if ($comment->get_children()) {
		$child_args = array_merge($args, array('depth' => $depth + 1, 'style' => $args['style']));
		echo '<ol class="children">';
		wp_list_comments($child_args, $comment->get_children());
		echo '</ol>';
	}
?>

<?php if ('div' != $args['style']) : ?>
	<li>
	<?php endif; ?>
	<?php }

if (! function_exists('law_firm_get_image_sizes')) :
	/**
	 * Get information about available image sizes
	 */
	function law_firm_get_image_sizes($size = '') {
		global $_wp_additional_image_sizes;

		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ($get_intermediate_image_sizes as $_size) {
			if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large', 'full'))) {
				$sizes[$_size]['width'] = get_option($_size . '_size_w');
				$sizes[$_size]['height'] = get_option($_size . '_size_h');
				$sizes[$_size]['crop'] = (bool) get_option($_size . '_crop');
			} elseif (isset($_wp_additional_image_sizes[$_size])) {
				$sizes[$_size] = array(
					'width' => $_wp_additional_image_sizes[$_size]['width'],
					'height' => $_wp_additional_image_sizes[$_size]['height'],
					'crop' =>  $_wp_additional_image_sizes[$_size]['crop']
				);
			}
		}
		// Get only 1 size if found
		if ($size) {
			if (isset($sizes[$size])) {
				return $sizes[$size];
			} else {
				return false;
			}
		}

		return $sizes;
	}
endif;

if (! function_exists('law_firm_get_fallback_svg')) :
	/**
	 * Get Fallback SVG
	 */
	function law_firm_get_fallback_svg($post_thumbnail){
		if (! $post_thumbnail) {
			return;
		}
		$fallback_svg = get_theme_mod('fallback_bg_color', '#003262');
		$image_size = law_firm_get_image_sizes($post_thumbnail);

		if ($image_size) { ?>
			<div class="svg-holder">
				<svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr($image_size['width']); ?> <?php echo esc_attr($image_size['height']); ?>" preserveAspectRatio="none">
					<rect width="<?php echo esc_attr($image_size['width']); ?>" height="<?php echo esc_attr($image_size['height']); ?>" style="fill:<?php echo esc_attr($fallback_svg); ?>;"></rect>
				</svg>
			</div>
		<?php
		}
	}
endif;

if( ! function_exists( 'law_firm_get_faqs_details' ) ) :
    /**
	* Function to get the FAQs section
    *
    * @param [type] $postid
    * @return void
    */
    function law_firm_get_faqs_details( $faq_repeater ){
        if( $faq_repeater ){ ?>
            <div class="faq-wrapper">
                <div class="accordion-wrapper ">
                    <ul class="accordion">
                        <?php foreach( $faq_repeater as $repeater ){
                            $question = ( ! empty( $repeater['question'] ) && isset( $repeater['question'] ) ) ? $repeater['question'] : "";
                            $answer   = ( ! empty( $repeater['answer'] ) && isset( $repeater['answer'] ) ) ? $repeater['answer'] : "";
                            
                            if( $question && $answer ){ ?>
                                <li class="accordion-item">
                                    <button class="accordion-button">
                                        <p><?php echo esc_html( $question ); ?></p>
                                    </button>
                                    <div class="accordion-content">
                                        <p><?php echo esc_html( $answer ); ?> </p>
                                    </div>
                                </li>
                            <?php } 
                        } ?>  
                    </ul>
                </div>
            </div>
        <?php
        }
    }
endif;

if( ! function_exists( 'law_firm_author_box' ) ) :
	/**
	 * Author Section
	*/
	function law_firm_author_box(){
		$author_description = get_the_author_meta( 'description' );
		$author_id          = get_the_author_meta('ID');
		$noofposts          = count_user_posts( $author_id );
		if( $noofposts == '1' ){
			$blogs_published = __( ' Blog Published','law-firm' );
		}else{
			$blogs_published = __( ' Blogs Published','law-firm' );
		}

		if( ! empty( $author_description ) ){ ?>
		 	<div class="author-section">
			 	<div class="author-wrapper">
					<?php if ( $author_id ) { ?>
						<figure class="author-img">
							<?php echo get_avatar( $author_id, 150 ); ?>
						</figure>
					<?php } ?>
					<div class="author-wrap">
						<h5 class="author-name"><?php the_author();?></h5>
						<div class="author-content">
							<?php echo wpautop( $author_description ); ?>
						</div>
						<div class="author-meta">
							<span class="author-count">
								<b><?php echo absint( $noofposts ); ?></b><?php echo $blogs_published; ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		<?php 
		}
	}
endif;

if ( ! function_exists( 'law_firm_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function law_firm_posted_by() {
		echo '<span class="author-details">';
			$byline = sprintf(
				/* translators: %s: post author. */
				esc_html_x( 'AUTHOR %s', 'post author', 'law-firm' ),
				'<span><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><strong>' . esc_html( get_the_author() ) . '</strong></a></span>'
			);
			echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</span>';
		
	}
endif;

if ( ! function_exists( 'law_firm_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function law_firm_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on =  $time_string ;

		echo '<span class="blog__date">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'law_firm_category' ) ) :
	/**
	 * Show categories
	 */
	function law_firm_category(){
		$categories = get_the_category( get_the_ID() );
		if ( ! empty($categories) ) { ?>
			<ul class="category-list">
				<?php foreach ( $categories as $category ) { 
					$categories_url = get_category_link( $category->term_id ); ?>
					<li class="category">
						<a href=<?php echo esc_url( $categories_url ); ?>>
							<?php echo esc_html( $category->name ); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }
	}
endif;

if( ! function_exists( 'law_firm_post_footer_meta' ) ) :
	/**
	 * Post Footer Tags
	*/
	function law_firm_post_footer_meta(){ ?>
			<footer class="entry-footer">
				<?php law_firm_tags(); ?>
			</footer>
		<?php 
	}
endif;

function law_firm_woo_boolean(){
	return class_exists('woocommerce') ? true : false;
}
