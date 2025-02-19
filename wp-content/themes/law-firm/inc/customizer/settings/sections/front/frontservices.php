<?php 

if( ! function_exists( 'law_firm_customize_register_frontservice' ) ) :
    /**
     * FrontService
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontservice( $wp_customize ){
        $wp_customize->add_section(
            'service_section', 
            array(
                'title'      => __( 'Service Settings', 'law-firm' ),
                'priority'   => 30,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_service', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_service', 
                array(
                    'label'       => __( 'Show/Hide Service Section', 'law-firm' ),
                    'description' => __( 'Enable to show the service section', 'law-firm' ),
                    'section'     => 'service_section',
                    'type'        => 'checkbox',
                )
            )
        );

        // Add setting for Service Section Heading
        $wp_customize->add_setting(
            'service_headings', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'service_headings', 
            array(
            'selector'        => 'section#front-service h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'service_headings' ) );
                },  
            ) 
        );

        // Add setting for Service Section Heading
        $wp_customize->add_control(
            'service_headings', 
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'service_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_service_service_active_callback',   
            )
        );

        // Add setting for Service Section SubHeading
        $wp_customize->add_setting(
            'service_descriptions', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'service_descriptions', 
            array(
            'selector'        => 'section#front-service .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'service_descriptions' ) );
                },  
            ) 
        );

        // Add setting for Service Section SubHeading
        $wp_customize->add_control(
            'service_descriptions', 
            array(
                'label'   => __( 'Description', 'law-firm' ),
                'section' => 'service_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_service_service_active_callback',     
            )
        );

        // Add setting for Service View All Services  button
        $wp_customize->add_setting(
            'service_btn_text', 
            array(
                'default'           => '' ,
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'service_btn_text', 
            array(
            'selector'        => 'section#front-service .service-btn__wrap',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'service_btn_text' ) );
                },  
            ) 
        );

        // Add setting for Service View All Services button
        $wp_customize->add_control(
            'service_btn_text', 
            array(
                'label'   => __( 'Button Text', 'law-firm' ),
                'section' => 'service_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_service_service_active_callback',   
            )
        );

        // Add setting for Service View All Services  button link
        $wp_customize->add_setting(
            'service_btn_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

    // Add setting for Service View All Services button link
        $wp_customize->add_control(
            'service_btn_link', 
            array(
                'label'   => __( 'Button Link', 'law-firm' ),
                'section' => 'service_section',
                'type'    => 'url',
                'active_callback' => 'law_firm_service_service_active_callback', 
            )
        );

        // Add setting for Service readmore  button text
        $wp_customize->add_setting(
            'service_readmore_btn_text', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        // Add setting for Service readmore  button text
        $wp_customize->add_control(
            'service_readmore_btn_text', 
            array(
                'label'   => __( 'Readmore Button Text', 'law-firm' ),
                'section' => 'service_section',
                'type'    => 'text',   
                'active_callback' => 'law_firm_service_service_active_callback', 
            )
        );

        /** Dynamic Services Section */
        $wp_customize->add_setting( 
            new Law_Firm_Repeater_Setting( 
                $wp_customize, 
                'front_services_repeater', 
                array(
                    'default'           => array(),
                    'sanitize_callback' => array( 'Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),                             
                ) 
            ) 
        );

        $wp_customize->add_control(
            new Law_Firm_Control_Repeater(
                $wp_customize,
                'front_services_repeater',
                array(
                    'section' => 'service_section',				
                    'label'	  => __( 'Add Services', 'law-firm' ),
                    'fields'  => array(
                        'service' => array(
                            'type'  => 'text', 
                            'label' => __( 'Service', 'law-firm' ),                
                        ),
                        'description' => array(
                            'type'  => 'text', 
                            'label' => __( 'Description', 'law-firm' ),                
                        ),
                        'post_link' => array(
                            'type'  => 'url', 
                            'label' => __( 'Service Link', 'law-firm' ),                
                        ),
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'services', 'law-firm' ),
                        'field' => 'title',
                    ),
                    'choices'   => array(
                    	'limit' => 4
               	 	),
                    'active_callback' => 'law_firm_service_service_active_callback',                                     
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontservice');

if( ! function_exists( 'law_firm_service_service_active_callback' ) ) :
    function law_firm_service_service_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_service' )->value();

        $id = $control->id;

        if( $id == 'service_headings' && $toggle_section ) return true;
        if( $id == 'service_descriptions' && $toggle_section ) return true;
        if( $id == 'service_btn_text' && $toggle_section ) return true;
        if( $id == 'service_btn_link' && $toggle_section ) return true;
        if( $id == 'service_readmore_btn_text' && $toggle_section ) return true;
        if( $id == 'front_services_repeater' && $toggle_section ) return true;

        return false;
    }
endif;