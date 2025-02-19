<?php 

if( ! function_exists( 'law_firm_customize_register_frontquote' ) ) :
    /**
     * Frontquote
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontquote( $wp_customize ){
        $wp_customize->add_section(
            'message_section', 
            array(
                'title'      => __( 'Quotes Settings', 'law-firm' ),
                'priority'   => 40,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_quote', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_quote', 
                array(
                    'label'       => __( 'Show/Hide Quote Section', 'law-firm' ),
                    'description' => __( 'Enable to show the quote section', 'law-firm' ),
                    'section'     => 'message_section',
                    'type'        => 'checkbox',
                )
            )
        );

        /* background  image*/
        $wp_customize->add_setting(
            'quotes_bg_img', 
            array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                'quotes_bg_img', 
                array(
                    'label'       => __( 'Upload Background Image', 'law-firm' ),
                    'section'     => 'message_section',
                    'active_callback' => 'law_firm_front_quote_active_callback', 
                )
            )
        );

        // Add setting for Quotes Title
        $wp_customize->add_setting(
            'front_quotes_heading', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'front_quotes_heading', 
            array(
            'selector'        => 'section#front-quotes h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_quotes_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'front_quotes_heading', 
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'message_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_quote_active_callback', 
            )
        );
        
        // Add Setting for  Quotes signature image
        $wp_customize->add_setting(
            'front_quotes_img', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        //Add Control for Quotes signature Image
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'front_quotes_img',
                array(
                    'description' => __( 'Upload Author Profile of image size 60*60', 'law-firm' ),
                    'section'     => 'message_section',
                    'active_callback' => 'law_firm_front_quote_active_callback', 
                )
            )
        );

        // Add setting for Person Name
        $wp_customize->add_setting(
            'front_quotes_persons_name', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'front_quotes_persons_name', 
            array(
            'selector'        => 'section#front-quotes .fau-name',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_quotes_persons_name' ) );
                },  
            ) 
        );

        //Add Control for Person Name
        $wp_customize->add_control(
            'front_quotes_persons_name', 
            array(
                'label'   => __( 'Name', 'law-firm' ),
                'section' => 'message_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_quote_active_callback', 
            )
        );

        // Add setting for Person designation
        $wp_customize->add_setting(
            'front_quotes_persons_designation', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'front_quotes_persons_designation', 
            array(
            'selector'        => 'section#front-quotes .fau-desig',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_quotes_persons_designation' ) );
                },  
            ) 
        );

        //Add Control for Person designation
        $wp_customize->add_control(
            'front_quotes_persons_designation', 
            array(
                'label'   => __( 'Designation', 'law-firm' ),
                'section' => 'message_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_quote_active_callback', 
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontquote');

if( ! function_exists( 'law_firm_front_quote_active_callback' ) ) :
    function law_firm_front_quote_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_quote' )->value();

        $id = $control->id;

        if( $id == 'quotes_bg_img' && $toggle_section ) return true;
        if( $id == 'front_quotes_heading' && $toggle_section ) return true;
        if( $id == 'front_quotes_img' && $toggle_section ) return true;
        if( $id == 'front_quotes_persons_name' && $toggle_section ) return true;
        if( $id == 'front_quotes_persons_designation' && $toggle_section ) return true;

        return false;
    }
endif;