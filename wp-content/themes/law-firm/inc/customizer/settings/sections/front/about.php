<?php 

if( ! function_exists( 'law_firm_customize_register_frontabout' ) ) :
    /**
     * Front aboutus
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontabout( $wp_customize ){
        $wp_customize->add_section(
            'about_section', 
            array(
                'title'      => esc_html__( 'About Settings', 'law-firm' ),
                'priority'   => 20,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_about', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_about', 
                array(
                    'label'       => esc_html__( 'Show/Hide About Section', 'law-firm' ),
                    'description' => esc_html__( 'Enable to show the about section', 'law-firm' ),
                    'section'     => 'about_section',
                    'type'        => 'checkbox'
                )
            )
        );

        // Add setting for about us Image
        $wp_customize->add_setting(
            'about_image',
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        //Add Control for about us Image
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'about_image',
                array(
                    'description' => esc_html__( 'Upload Image', 'law-firm' ),
                    'section'     => 'about_section',
                    'active_callback' => 'law_firm_front_about_active_callback'
                )
            )
        );

        // Add setting for Section image quotes
        $wp_customize->add_setting(
            'about_img_quotes', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'about_img_quotes', 
            array(
            'selector'        => 'section#front-about .img-quote',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'about_img_quotes' ) );
                },  
            ) 
        );

        //Add Control for Section image quote
        $wp_customize->add_control(
            'about_img_quotes', 
            array(
                'label'   => esc_html__( 'Image Quote', 'law-firm' ),
                'section' => 'about_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_about_active_callback'
            )
        );

        // Add setting for Section Heading
        $wp_customize->add_setting(
            'about_headings', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'about_headings', 
            array(
            'selector'        => 'section#front-about h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'about_headings' ) );
                },  
            ) 
        );

        //Add Control for Section Heading
        $wp_customize->add_control(
            'about_headings', 
            array(
                'label'   => esc_html__( 'Heading', 'law-firm' ),
                'section' => 'about_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_about_active_callback'
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'about_descriptions', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'about_descriptions', 
            array(
            'selector'        => 'section#front-about .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'about_descriptions' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'about_descriptions', 
            array(
                'label'       => esc_html__( 'Description', 'law-firm' ),
                'section'     => 'about_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_about_active_callback'
            )
        );

    
        // Add setting for Why us Button Text
        $wp_customize->add_setting(
            'about_btn_txt', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'about_btn_txt', 
            array(
            'selector'        => 'section#front-about .about-right a',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'about_btn_txt' ) );
                },  
            ) 
        );

        // Add control for why us Button Text
        $wp_customize->add_control(
            'about_btn_txt', 
            array(
                'label'   => esc_html__( 'Button Text', 'law-firm' ),
                'section' => 'about_section',
                'type'    => 'text',     
                'active_callback' => 'law_firm_front_about_active_callback'                                     
            )
        );

        // Add setting for why us Button link
        $wp_customize->add_setting(
            'about_btn_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for why us Button link
        $wp_customize->add_control(
            'about_btn_link', 
            array(
                'label'   => esc_html__( 'Button Link', 'law-firm' ),
                'section' => 'about_section',
                'type'    => 'url',    
                'active_callback' => 'law_firm_front_about_active_callback'                                     
            )
        );

        /** Dynamic Services whyus Section */
        $wp_customize->add_setting( 
            new Law_Firm_Repeater_Setting( 
                $wp_customize, 
                'front_about_repeaters', 
                array(
                    'default'           => '',
                    'sanitize_callback' => array( 'Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),                             
                ) 
            ) 
        );

        $wp_customize->add_control(
            new Law_Firm_Control_Repeater(
                $wp_customize,
                'front_about_repeaters',
                array(
                    'section' => 'about_section',				
                    'label'	  => __( 'Add Features', 'law-firm' ),
                    'fields'  => array(
                        'text' => array(
                            'type'  => 'text', 
                            'label' => __( 'Add Title', 'law-firm' ),                
                        ),
                        'description' => array(
                            'type'  => 'text', 
                            'label' => __( 'Add Description', 'law-firm' ),                
                        ),
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'Features', 'law-firm' ),
                        'field' => 'title',
                    ),  
                    'choices'   => array(
                        'limit' => 2
                    ),   
                    'active_callback' => 'law_firm_front_about_active_callback'                                       
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontabout');

if( ! function_exists( 'law_firm_front_about_active_callback' ) ) :

    function law_firm_front_about_active_callback( $control ){
        $toggle_about = $control->manager->get_setting( 'toggle_about' )->value();

        $id = $control->id;

        if( $id == 'about_image' && $toggle_about ) return true;
        if( $id == 'about_img_quotes' && $toggle_about ) return true;
        if( $id == 'about_headings' && $toggle_about ) return true;
        if( $id == 'about_descriptions' && $toggle_about ) return true;
        if( $id == 'about_btn_txt' && $toggle_about ) return true;
        if( $id == 'about_btn_link' && $toggle_about ) return true;
        if( $id == 'front_about_repeaters' && $toggle_about ) return true;
        
        return false;
    }
endif;