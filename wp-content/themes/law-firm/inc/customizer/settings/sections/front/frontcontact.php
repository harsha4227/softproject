<?php 

if( ! function_exists( 'law_firm_customize_register_frontcontact' ) ) :
    /**
     * Frontcontact
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontcontact( $wp_customize ){
        $wp_customize->add_section(
            'contact_section',
            array(
                'title'  => __( 'Contact Settings', 'law-firm' ),
                'priority'   => 100,
                'panel'  => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_contact', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_contact', 
                array(
                    'label'       => __( 'Show/Hide Contact Section', 'law-firm' ),
                    'description' => __( 'Enable to show the contact section', 'law-firm' ),
                    'section'     => 'contact_section',
                    'type'        => 'checkbox',
                )
            )
        );

        /* features image*/
        $wp_customize->add_setting(
            'contact_background_image', 
            array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                'contact_background_image', 
                array(
                    'label'       => __( 'Upload Image', 'law-firm' ),
                    'section'     => 'contact_section',
                    'active_callback' => 'law_firm_front_contact_active_callback',
                )
            )
        );

        $wp_customize->add_setting(
            'contact_headings',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_headings', 
            array(
            'selector'        => '.front-contact h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_headings' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_headings',
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        $wp_customize->add_setting(
            'contact_descriptions',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_descriptions', 
            array(
            'selector'        => '.front-contact .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_descriptions' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_descriptions',
            array(
                'label'   => __( 'Sub Heading', 'law-firm' ),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //setting and control for email Heading
        $wp_customize->add_setting(
            'contact_email_heading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_email_heading', 
            array(
            'selector'        => '.page-template-contact .card-title.email-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_email_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_email_heading',
            array(
                'label'   => __( 'Email Title', 'law-firm' ),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //Setting and control for Email 1 inputbox
        $wp_customize->add_setting(
            'contact_email', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_email',
            )   
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_email', 
            array(
            'selector'        => '.front-contact .c-email',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_email' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_email', 
            array(
                'label'     => __( 'Email', 'law-firm' ),
                'section'   => 'contact_section',
                'type'      => 'email',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //Add settings for the phone title
        $wp_customize->add_setting(
            'contact_phone_title',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        //Add control for the phone title
        $wp_customize->add_control(
            'contact_phone_title',
            array(
                'label'   => __( 'Phone Title', 'law-firm' ),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //Add settings for the phone number 
        $wp_customize->add_setting(
            'contact_phone_number',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_phone_number', 
            array(
            'selector'        => '.front-contact .c-phone',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_phone_number' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_phone_number',
            array(
                'label'   => __( 'Phone', 'law-firm'),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //setting and control for location  title
        $wp_customize->add_setting(
            'contact_location_title',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'contact_location_title', 
            array(
            'selector'        => '.page-template-contact .card-title.location-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_location_title' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_location_title',
            array(
                'label'   => __( 'Location Title', 'law-firm' ),
                'section' => 'contact_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        //Setting and control for Location 
        $wp_customize->add_setting(
            'contact_location', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_text_field',
            )   
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_location', 
            array(
            'selector'        => '.front-contact .c-location',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_location' ) );
                },  
            ) 
        );


        $wp_customize->add_control(
            'contact_location', 
            array(
                'label'    => __( 'Location', 'law-firm' ),
                'section'  => 'contact_section',
                'type'     => 'text',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );

        /** Shortcode*/
        $wp_customize->add_setting(
            'contact_form_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_area',
            )
        );

        $wp_customize->add_control(
            'contact_form_shortcode',
            array(
                'label'   => __( 'Enter Shortcode', 'law-firm' ),
                'type'    => 'text',
                'section' => 'contact_section',
                'active_callback' => 'law_firm_front_contact_active_callback',
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontcontact');

if( ! function_exists( 'law_firm_front_contact_active_callback' ) ) :
    function law_firm_front_contact_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_contact' )->value();

        $id = $control->id;

        if( $id == 'contact_background_image' && $toggle_section ) return true;
        if( $id == 'contact_headings' && $toggle_section ) return true;
        if( $id == 'contact_descriptions' && $toggle_section ) return true;
        if( $id == 'contact_email_heading' && $toggle_section ) return true;
        if( $id == 'contact_email' && $toggle_section ) return true;
        if( $id == 'contact_phone_title' && $toggle_section ) return true;
        if( $id == 'contact_phone_number' && $toggle_section ) return true;
        if( $id == 'contact_location_title' && $toggle_section ) return true;
        if( $id == 'contact_location' && $toggle_section ) return true;
        if( $id == 'contact_form_shortcode' && $toggle_section ) return true;

        return false;
    }
endif;