<?php 

if( ! function_exists( 'law_firm_customize_register_frontbanner' ) ) :
    /**
     * Frontbanner
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontbanner( $wp_customize ){
        $wp_customize->add_section(
            'banner_section', 
            array(
                'title'      => __( 'Banner Section', 'law-firm' ),
                'priority'   => 10,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        // Add the toggle control to the section
        $wp_customize->add_setting(
            'banner_toggle', 
            array(
                'default'           => true,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'banner_toggle', 
                array(
                    'label'       => esc_html__( 'Show/Hide Banner Section', 'law-firm' ),
                    'description' => esc_html__( 'Enable to show the banner section.', 'law-firm' ),
                    'section'     => 'banner_section',
                    'type'        => 'checkbox',
                    'priority'    => 10,
                )
            )
        );

        $wp_customize->get_control( 'header_image' )->section          = 'banner_section';
        $wp_customize->get_control( 'header_video' )->section          = 'banner_section';
        $wp_customize->get_control( 'external_header_video' )->section = 'banner_section';

        $wp_customize->get_control( 'header_image' )->active_callback          = 'law_firm_frontbanner_active_callback';
        $wp_customize->get_control( 'header_video' )->active_callback          = 'law_firm_frontbanner_active_callback';
        $wp_customize->get_control( 'external_header_video' )->active_callback = 'law_firm_frontbanner_active_callback';
        
        $wp_customize->get_control( 'header_image' )->priority          = 15;  // Set priority after banner toggle
        $wp_customize->get_control( 'header_video' )->priority          = 15;
        $wp_customize->get_control( 'external_header_video' )->priority = 15;

        //banner six
        // Add setting for banner six Section Heading
        $wp_customize->add_setting(
            'ban_six_subheading', 
            array(
                'default'           => esc_html__( 'Integrity. Expertise. results', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        // Add setting for banner six Section Heading
        $wp_customize->add_control(
            'ban_six_subheading', 
            array(
                'label'           => esc_html__( 'Sub Heading', 'law-firm' ),
                'section'         => 'banner_section',
                'type'            => 'text',   
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 20,
            )
        );

        // Add setting for banner three Section Heading
        $wp_customize->add_setting(
            'ban_three_heading', 
            array(
                'default'           => sprintf( esc_html__( '%sTrusted%s Legal Advisors %sFor All Your Needs%s', 'law-firm' ), '<span class="highlight">', '</span>', '<span class="highlight">', '</span>'),
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        // Add setting for banner three Section Heading
        $wp_customize->add_control(
            'ban_three_heading', 
            array(
                'label'   => esc_html__( 'Heading', 'law-firm' ),
                'section' => 'banner_section',
                'type'    => 'textarea',   
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 30,
            )
        );

        // Add setting for banner three Section SubHeading
        $wp_customize->add_setting(
            'ban_three_descs', 
            array(
                'default'           => esc_html__( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        // Add setting for banner three Section SubHeading
        $wp_customize->add_control(
            'ban_three_descs', 
            array(
                'label'   => esc_html__( 'Description', 'law-firm' ),
                'section' => 'banner_section',
                'type'    => 'text', 
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 40,
            )
        );

        // Add setting for banner three button text
        $wp_customize->add_setting(
            'ban_three_btn_text', 
            array(
                'default'           => esc_html__( 'Know More', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );


        // Add setting for banner three button text
        $wp_customize->add_control(
            'ban_three_btn_text', 
            array(
                'label'   => esc_html__( 'Button Text', 'law-firm' ),
                'section' => 'banner_section',
                'type'    => 'text', 
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 50,
            )
        );

        // Add setting for banner three  button link
        $wp_customize->add_setting(
            'ban_three_btn_link', 
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add setting for banner three button link
        $wp_customize->add_control(
            'ban_three_btn_link', 
            array(
                'label'   => esc_html__( 'Button Link', 'law-firm' ),
                'section' => 'banner_section',
                'type'    => 'url',  
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 60,
            )
        );

        $wp_customize->add_setting(
            'ban_six_contact_btn_text',
            array(
                'default'           => __( 'Contact Now', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'ban_six_contact_btn_text', 
            array(
            'selector'        => '.portal-link',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'ban_six_contact_btn_text', __( 'Contact Now', 'law-firm' ) ) );
                },  
            ) 
        );

        //add control for portal title
        $wp_customize->add_control(
            'ban_six_contact_btn_text',
            array(
                'label'           => __( 'Contact Button Text', 'law-firm' ),
                'section'         => 'banner_section',
                'type'            => 'text',
                'active_callback' => 'law_firm_frontbanner_active_callback',  
                'priority'        => 60,
            )
        );
        //adding setting for portal tile link
        $wp_customize->add_setting(
            'ban_six_contact_num',
            array(
                'default'           => __( '+1-800-111-2222', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        //add control for portal title link
        $wp_customize->add_control(
            'ban_six_contact_num',
            array(
                'label'           => __( 'Contact Button Number', 'law-firm' ),
                'section'         => 'banner_section',
                'type'            => 'text',
                'active_callback' => 'law_firm_frontbanner_active_callback',
                'priority'        => 70,
            )
        );
        
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontbanner');

if( ! function_exists( 'law_firm_frontbanner_active_callback' ) ) :
    function law_firm_frontbanner_active_callback( $control ){     
        $toggle_section = $control->manager->get_setting( 'banner_toggle' )->value();

        $id = $control->id;

        if( $id == 'header_image' && $toggle_section ) return true;
        if( $id == 'header_video' && $toggle_section ) return true;
        if( $id == 'external_header_video' && $toggle_section ) return true;
        if( $id == 'ban_three_heading' && $toggle_section ) return true;
        if( $id == 'ban_six_subheading' && $toggle_section ) return true;
        if( $id == 'ban_three_descs' && $toggle_section ) return true;
        if( $id == 'ban_three_btn_text' && $toggle_section ) return true;
        if( $id == 'ban_three_btn_link' && $toggle_section ) return true;
        if( $id == 'ban_six_contact_btn_text' && $toggle_section ) return true;
        if( $id == 'ban_six_contact_num' && $toggle_section ) return true;

        return false;
    }
endif;