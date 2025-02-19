<?php 

if( ! function_exists( 'law_firm_customize_register_frontfaq' ) ) :
    /**
     * Front FAQ Section
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontfaq( $wp_customize ){
        
        $wp_customize->add_section(
            'faqs_section', 
            array(
                'title'      => __( 'FAQ Settings', 'law-firm' ),
                'priority'   => 70,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_faq', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_faq', 
                array(
                    'label'       => __( 'Show/Hide FAQ Section', 'law-firm' ),
                    'description' => __( 'Enable to show the faq section', 'law-firm' ),
                    'section'     => 'faqs_section',
                    'type'        => 'checkbox',
                )
            )
        );

        // Add setting for Section Heading
        $wp_customize->add_setting(
            'faq_heading_settings', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'faq_heading_settings', 
            array(
            'selector'        => 'section#front-faq h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'faq_heading_settings' ) );
                },  
            ) 
        );

        //Add Control for Section Heading
        $wp_customize->add_control(
            'faq_heading_settings', 
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'faqs_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_faq_active_callback',
            )
        );
        // Add setting for Section Description
        $wp_customize->add_setting(
            'faq_descriptions', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'faq_descriptions', 
            array(
            'selector'        => 'section#front-faq .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'faq_descriptions' ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'faq_descriptions', 
            array(
                'label'   => __( 'Description', 'law-firm' ),
                'section' => 'faqs_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_faq_active_callback',
            )
        );


        // Add setting for FAQ Text
        $wp_customize->add_setting(
            'faq_btn_text_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'faq_btn_text_setting', 
            array(
            'selector'        => 'section#front-faq a.btn',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'faq_btn_text_setting' ) );
                },  
            ) 
        );

        // Add control for FAQ Text
        $wp_customize->add_control(
            'faq_btn_text_setting', 
            array(
                'label'   => __( 'Button Text', 'law-firm' ),
                'section' => 'faqs_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_faq_active_callback',
            )
        );

        // Add setting for FAQs button Link
        $wp_customize->add_setting(
            'faq_btn_link_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for FAQs butron Link
        $wp_customize->add_control(
            'faq_btn_link_setting', 
            array(
                'label'   => __( 'Button Link', 'law-firm' ),
                'section' => 'faqs_section',
                'type'    => 'url',
                'active_callback' => 'law_firm_front_faq_active_callback',
            )
        );

        /** Slider Custom For Frontpage Faqs Section */
        $wp_customize->add_setting( 
            new Law_Firm_Repeater_Setting( 
                $wp_customize, 
                'faqs_links_repeater', 
                array(
                    'default'           => array(),
                    'sanitize_callback' => array( 'Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),                             
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Law_Firm_Control_Repeater(
                $wp_customize,
                'faqs_links_repeater',
                array(
                    'section' => 'faqs_section',				
                    'label'	  => __( 'Add FAQ', 'law-firm' ),
                    'fields'  => array(
                        'question' => array(
                            'type'  => 'text', 
                            'label' => __( 'Add Question', 'law-firm' ),                
                        ),
                        'answer' => array(
                            'type'  => 'text', 
                            'label' => __( 'Add Answer', 'law-firm' ),                
                        ),
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'FAQ', 'law-firm' ),
                        'field' => 'title',
                    ),
                    'choices'   => array(
                        'limit' => 4
                    ), 
                    'active_callback' => 'law_firm_front_faq_active_callback',
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontfaq');

if( ! function_exists( 'law_firm_front_faq_active_callback' ) ) :
    function law_firm_front_faq_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_faq' )->value();

        $id = $control->id;

        if( $id == 'faq_heading_settings' && $toggle_section ) return true;
        if( $id == 'faq_descriptions' && $toggle_section ) return true;
        if( $id == 'faq_btn_text_setting' && $toggle_section ) return true;
        if( $id == 'faq_btn_link_setting' && $toggle_section ) return true;
        if( $id == 'faqs_links_repeater' && $toggle_section ) return true;

        return false;
    }
endif;