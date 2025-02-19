<?php
/**
 * Law Firm Pro Custom functions and definitions
 *
 * @package Law_Firm
 */
 if ( ! function_exists( 'law_firm_mobile_header' ) ) {
    /**
     * Law_Firm Mobile Header
     */
    function law_firm_mobile_header(){ ?>
		<div class="mobile-header">
			<div class="container">
				<div class="header-wrapper">
					<div class="header-left">
						<?php law_firm_site_branding( false ); ?>
					</div>
					<div class="header-right">
						<?php law_firm_mobile_ham_wrapper() ?>
					</div>
				</div>
			</div>
		</div>
		<div class="sidebar" id="mobileSideMenu">
			<div class="sidebar-body">
				<div class="sidebar-top-wrap">
					<button class="close-sidebar-btn" id="mobileSideMenuClose">
						<span class="icon-close"></span>
					</button>
				</div>
				<?php law_firm_primary_nagivation(); ?>
			</div>
			<div class="sidebar-footer">
				<?php law_firm_front_header_one_button_consultant(); ?> 
			</div>
		</div>
		<!-- mobile header end -->   
    <?php
    }
}

if( ! function_exists( 'law_firm_header_contact_info' ) ){
	/**
     * Header Information i.e email, email title, phone, phone title
    */
	function law_firm_header_contact_info(){ 
		$email        = get_theme_mod( 'email', __( 'info@gllawfirm.com.np', 'law-firm' ) );	
		$email_title  = get_theme_mod( 'header_email_title', __( 'Mail Us:', 'law-firm' ) );
		$phone        = get_theme_mod( 'phone_number', __( '+1-800-111-2222', 'law-firm' ) );	
		$phone_title  = get_theme_mod( 'header_contact_title', __( 'Give A Call:', 'law-firm' ) );	
	
		if( ( $email && $email_title ) || ( $phone && $phone_title ) ){ ?>
			<div class="contact-info">
				<?php 
					if( $phone && $phone_title ){ ?>
						<div class="info tel">
							<a href="<?php echo esc_url('tel:' .  preg_replace('/[^\d+]/', '', $phone ) ); ?>">
								<strong><?php echo esc_html( $phone_title ); ?></strong>
								<?php echo esc_html( $phone ); ?>
							</a>
						</div>
				  <?php } if( $email && $email_title ){ ?>
						<div class="info email">
							<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>">
								<strong><?php echo esc_html( $email_title ); ?></strong>
								<?php echo esc_html( $email ); ?>
							</a>
						</div>
				<?php } ?>
			</div>
		<?php
		}
	}
}

if( ! function_exists( 'law_firm_breadcrumbs' ) ) :
    /**
     * Breadcrumb Trail wrapper
     *
     * @return void
     */
    function law_firm_breadcrumbs(){ ?>
		<div id="crumbs" class="breadcrumb-nav" itemscope="" itemtype="http://schema.org/BreadcrumbList">
			<?php law_firm_breadcrumb_trail(); ?>
		</div>
    <?php 
    }
endif;

/* Contact Page Template Contact Form sections */
if ( ! function_exists( 'law_firm_contact_section' ) ):
	/**
     * Contact Section
     *
     * @return void
    */
	function law_firm_contact_section(    
		$sec_name, 
		$toggle_section,
		$front_contact_bg_img, 
		$front_contact_heading, 
		$front_contact_description, 
		$front_email_heading, 
		$front_email, 
		$front_phone_heading, 
		$front_phone, 
		$front_location_heading, 
		$front_location, 
		$front_contact_form_shortcode 
	) { if( $toggle_section && ( $front_contact_bg_img || $front_contact_heading || $front_contact_description || $front_email_heading || $front_email || $front_phone_heading || $front_phone || $front_location_heading || $front_location || $front_contact_form_shortcode ) ){

		// Show the image if user uploade other show the fallback color
		$background_style = $front_contact_bg_img 
							? 'background-image: url(' . esc_url( $front_contact_bg_img ) . ');' 
							: 'background-color: var(--law-fallback-bg-color);';
		?>
		<section class="contact-section <?php echo esc_attr( $sec_name ); ?>" id="<?php echo esc_attr( $sec_name ); ?>" style="<?php echo esc_attr( $background_style ); ?>" >
			<div class="container">
				<div class="contact-wrapper">
					<div class="contact-left">
						<?php if( $front_contact_heading || $front_contact_description ){ ?>
							<div class="section-header">
								<?php if( $front_contact_heading ){ ?>
                                    <h2 class="section-header__title">
                                        <?php echo esc_html( $front_contact_heading ); ?>
                                    </h2>
                                <?php } if( $front_contact_description ){ ?>
									<div class="section-header__description">
										<?php echo wpautop( esc_html( $front_contact_description ) ); ?>
									</div>
								<?php } ?>
							</div>
						<?php } if( ( $front_email_heading && $front_email ) || ( $front_phone_heading && $front_phone ) || ( $front_location_heading && $front_location ) ){ ?>
							<div class="contact-grid">
								<?php if( $front_email_heading && $front_email ){ ?>
									<div class="contact c-email">
										<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $front_email ) ); ?>">
											<?php echo esc_html( $front_email ); ?>
										</a><br>
										<strong><?php echo esc_html( $front_email_heading ); ?></strong>
									</div>
								<?php } if( $front_phone_heading && $front_phone ){ ?>
									<div class="contact c-phone">
										<a href="<?php echo esc_url('tel:' .  preg_replace('/[^\d+]/', '', $front_phone ) ); ?>">
											<?php echo esc_html( $front_phone ); ?>
										</a><br>
										<strong><?php echo esc_html( $front_phone_heading ); ?></strong>
									</div>
								<?php } if( $front_location_heading && $front_location ){ ?>
									<div class="contact c-location">
										<p><?php echo esc_html( $front_location ); ?></p><br>
										<strong><?php echo esc_html( $front_location_heading ); ?></strong>
									</div>
								<?php } ?>
								<div class="contact">
									<?php law_firm_social_media_repeater( 'contact-social' ); ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if( $front_contact_form_shortcode ){ ?>
						<div class="contact-right">
							<div class="contact-form">
								<?php echo do_shortcode( $front_contact_form_shortcode ); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php
		}
	}
endif;

if( ! function_exists( 'law_firm_faq_section' ) ):
	/**
     * FAQ Section
	 * 
    */

	function law_firm_faq_section( $sec_name, $toggle_section, $heading_setting, $description_setting, $button_text_setting, $button_link_setting, $faq_repeater ){
		if ( $toggle_section && ( $heading_setting || $description_setting ||  ( $button_text_setting && $button_link_setting ) || $faq_repeater ) ) { ?>
			<section class="faq-section bg-gray" id="<?php echo esc_attr( $sec_name ); ?>" >
				<div class="container">
					<?php if( $heading_setting || $description_setting || ( $button_text_setting && $button_link_setting ) ){ ?>
						<div class="faq__top-wrapper">
							<div class="section-header">
								<?php if( $heading_setting ){ ?>
									<h2 class="section-header__title"><?php echo esc_html( $heading_setting ); ?></h2>
								<?php } if( $description_setting ){ ?>
									<div class="section-header__description">
										<p><?php echo esc_html( $description_setting ); ?></p>
									</div>
								<?php }
								?>
							</div>
							<?php if( $button_text_setting && $button_link_setting ){ ?>
								<a href="<?php echo esc_url( $button_link_setting ); ?>" class="btn">
									<?php echo esc_html( $button_text_setting ); ?>
								</a>
							<?php } ?> 
						</div>
					<?php }
						law_firm_get_faqs_details( $faq_repeater ); 
					?>
				</div>
			</section>
		<?php
		}
	}
endif;

if (! function_exists('law_firm_related_posts')) :
	/**
	 * Related Posts
	 */
	function law_firm_related_posts($post_type)
	{
		global $post;
		
		$title           = get_theme_mod( 'related_post_heading', __('Related Posts', 'law-firm') );
		$readmore        = get_theme_mod( 'post_readmore_button', __('Read More', 'law-firm') );
		$toggle_excerpt  = get_theme_mod( 'toggle_related_post_excerpt', true );

		$args = array(
			'post_type'           => $post_type,
			'posts_status'        => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'	  => 2,
			'post__not_in'		  => array($post->ID)
		);

		$query = new WP_Query($args);

		if ( $query->have_posts() ) { ?>
			<div class="related-post">
				<?php if ($title) { ?>
					<div class="section-header">
						<h2 class="section-header__title">
							<?php echo esc_html( $title ) ?>
						</h2>
					</div>
				<?php } ?>
				<div class="row related-posts">
					<?php while ($query->have_posts()) {
						$query->the_post(); ?>
						<article class="post">
							<div class="blog__card">
								<figure class="blog__img">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="post-thumbnail">
										<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('medium');
										} else {
											law_firm_get_fallback_svg('medium');
										}
										?>
									</a>
									<?php law_firm_posted_on(); ?>
								</figure>
								<div class="blog__info">
									<header class="entry-header blog__top">
										<div class="entry-meta">
											<div class="entry-categories">
												<?php law_firm_category(); ?>
											</div>
											<div class="comment">
												<?php law_firm_get_comment_count(); ?>
											</div>
										</div>
										<h3 class="entry-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</header>
									<?php
									if ($toggle_excerpt) {
										if (has_excerpt()) {
											echo the_excerpt();
										} else {
											echo wpautop( wp_trim_words(get_the_content(), 15 ) );
										}
									}
									if( $readmore ) { ?>
										<div class="blog__bottom">
											<a class="btn btn-readmore" href="<?php the_permalink(); ?>">
												<?php echo esc_html( $readmore ); ?>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
						</article>
					<?php } ?>
				</div>
			</div>
			<?php wp_reset_postdata();
		}
	}
endif;

/**
 * Sidebar Template Meta
 */
 function law_firm_add_sidebar_layout_box(){
    add_meta_box( 
        'law_firm_sidebar_layout',
        __( 'Sidebar Layout', 'law-firm' ),
        'law_firm_sidebar_layout_callback', 
        array( 'page','post' ),
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'law_firm_add_sidebar_layout_box' );

function law_firm_sidebar_layout_callback( $post ){
    $sidebar_layout = array(    
        'default'=> array(
            'value'     => 'default',
            'label'     => __( 'Default Sidebar', 'law-firm' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/default.png'
        ),
        'full-width'=> array(
            'value'     => 'full-width',
            'label'     => __( 'Full Width', 'law-firm' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/full-width.jpg'
        ),
        'left-sidebar' => array(
            'value'     => 'left-sidebar',
            'label'     => __( 'Left Sidebar', 'law-firm' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/left.jpg'         
        ),
        'right-sidebar' => array(
            'value'     => 'right-sidebar',
            'label'     => __( 'Right Sidebar', 'law-firm' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/sidebar/right.jpg'         
         )    
    );
    // Output the nonce field
    wp_nonce_field( 'law_firm_sidebar_nonce', 'law_firm_sidebar_nonce' );
    ?>     
    <div>
        <h4>
            <?php esc_html_e( 'Choose Sidebar Template', 'law-firm' ); ?>
        </h4>

        <div class="sidebar-layout" >
            <?php  
                foreach( $sidebar_layout as $layout ){
                    $value = get_post_meta( $post->ID, 'law_firm_sidebar_layout', true ); ?>
                    <div class="sidebar-option">
                        <input 
                            id="<?php echo esc_attr( $layout['value'] ); ?>" 
                            type="radio" 
                            name="lf_sidebar_layout" 
                            value="<?php echo esc_attr( $layout['value'] ); ?>" 
                            <?php 
                                checked( $layout['value'], $value ); 
                                if( empty( $value ) ){ 
                                    checked( esc_attr( $layout['value'] ), 'default' );
                                }
                            ?>
                        />
                        <label class="description" for="<?php echo esc_attr( $layout['value'] ); ?>">
                            <img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" />                               
                        </label>
                    </div>
                <?php 
                }
            ?>
        </div>
    </div>
 <?php 
}

function law_firm_save_sidebar_layout( $post_id ){
    
    // Verify the nonce before proceeding.
    if ( !isset( $_POST['law_firm_sidebar_nonce'] ) || !wp_verify_nonce( $_POST['law_firm_sidebar_nonce'], 'law_firm_sidebar_nonce' ) )
    return;

    // Check if the user has permission to edit the post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( isset( $_POST['lf_sidebar_layout'] ) ) {
        $selected_layout = sanitize_key( $_POST['lf_sidebar_layout'] ) ;

        $valid_layouts = array(
            'default',
            'full-width',
            'left-sidebar',
            'right-sidebar'
        );
    
        if ( in_array( $selected_layout, $valid_layouts ) ) {
            update_post_meta( $post_id, 'law_firm_sidebar_layout', $selected_layout );
        } else {
            // If the selected layout is not valid, default to 'full-width' or handle the error appropriately
            update_post_meta( $post_id, 'law_firm_sidebar_layout', 'full-width' );
        }
    } 
}
add_action( 'save_post' , 'law_firm_save_sidebar_layout' );