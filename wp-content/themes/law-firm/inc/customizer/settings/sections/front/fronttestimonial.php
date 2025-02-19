<?php 

if( ! function_exists( 'law_firm_customize_register_frontestimonial' ) ) :
    /**
     * Fronttestimonial
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontestimonial( $wp_customize ){
    
        $wp_customize->add_section(
            'testimonial_section', 
            array(
                'title'      => __( 'Testimonial Settings', 'law-firm' ),
                'priority'   => 50,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_testimonial', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_testimonial', 
                array(
                    'label'       => esc_html__( 'Show/Hide Testimonial Section', 'law-firm' ),
                    'description' => esc_html__( 'Enable to show the testimonial section', 'law-firm' ),
                    'section'     => 'testimonial_section',
                    'type'        => 'checkbox',
                )
            )
        );

        // Add setting for Section Heading
        $wp_customize->add_setting(
            'testimonial_headings', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_headings', 
            array(
            'selector'        => '.fronttestimonial h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_headings' ) );
                },  
            ) 
        );

        //Add Control for Section Heading
        $wp_customize->add_control(
            'testimonial_headings', 
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'testimonial_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'testimonial_descriptions', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_descriptions', 
            array(
            'selector'        => '.fronttestimonial .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_descriptions' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'testimonial_descriptions', 
            array(
                'label'       => __( 'Description', 'law-firm' ),
                'section'     => 'testimonial_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );


        // Add setting for Section Description
        $wp_customize->add_setting(
            'testimonial_title', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_title', 
            array(
            'selector'        => '.fronttestimonial .testimony',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_title' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'testimonial_title', 
            array(
                'label'       => __( 'Testimony', 'law-firm' ),
                'section'     => 'testimonial_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'testimonial_desc', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_desc', 
            array(
            'selector'        => '.fronttestimonial .testimonial__content .testimony-description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_desc' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'testimonial_desc', 
            array(
                'label'       => __( 'Testimony Description', 'law-firm' ),
                'section'     => 'testimonial_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'testimonial_author_designation', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_author_designation', 
            array(
            'selector'        => '.fronttestimonial .author span',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_author_designation' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'testimonial_author_designation', 
            array(
                'label'       => __( 'Designation', 'law-firm' ),
                'section'     => 'testimonial_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'testimonial_author', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'testimonial_author', 
            array(
            'selector'        => '.fronttestimonial .author h6',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'testimonial_author' ) );
                },  
            ) 
        );
        $wp_customize->add_control(
            'testimonial_author', 
            array(
                'label'       => __( 'Author', 'law-firm' ),
                'section'     => 'testimonial_section',
                'type'        => 'text',
                'active_callback' => 'law_firm_front_testimonial_active_callback',
            )
        );

        $wp_customize->add_setting(
            'testimonial_testimony_img', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                'testimonial_testimony_img', 
                array(
                    'label'       => __( 'Upload Image', 'law-firm' ),
                    'section'     => 'testimonial_section',
                    'active_callback' => 'law_firm_front_testimonial_active_callback',
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontestimonial');

if( ! function_exists( 'law_firm_front_testimonial_active_callback' ) ) :
    function law_firm_front_testimonial_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_testimonial' )->value();

        $id = $control->id;

        if( $id == 'testimonial_headings' && $toggle_section ) return true;
        if( $id == 'testimonial_descriptions' && $toggle_section ) return true;
        if( $id == 'testimonial_title' && $toggle_section ) return true;
        if( $id == 'testimonial_desc' && $toggle_section ) return true;
        if( $id == 'testimonial_author_designation' && $toggle_section ) return true;
        if( $id == 'testimonial_author' && $toggle_section ) return true;
        if( $id == 'testimonial_testimony_img' && $toggle_section ) return true;

        return false;
    }
endif;