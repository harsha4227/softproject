<?php 

if( ! function_exists( 'law_firm_customize_register_frontopbar' ) ) :
    /**
     * Headers
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontopbar( $wp_customize ){

        // Create a new section top bar settings----------
        $wp_customize->add_section('top_bar_section', 
            array(
                'title'    => esc_html__( 'Header Settings', 'law-firm' ),
                'priority' => 20,
                'panel'    => 'general_settings_panel',
            )
        );
        
        // Add the toggle control to the section
        $wp_customize->add_setting(
            'topbar_toggle', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'topbar_toggle', 
                array(
                    'label'       => esc_html__( 'Show/Hide Header', 'law-firm' ),
                    'description' => esc_html__( 'Enable to show the header.', 'law-firm' ),
                    'section'     => 'top_bar_section',
                    'type'        => 'checkbox'
                )
            )
        );
        //adding setting for email title-->header 2,4
        $wp_customize->add_setting(
            'header_email_title',
            array(
                'default'           => __( 'Mail Us:', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'header_email_title', 
            array(
                'selector'        => '.mail-title',
                'render_callback' => function() {
                    return esc_html( get_theme_mod( 'header_email_title', __( 'Mail Us:', 'law-firm' ) ) );
                },  
            ) 
        );
        
        $wp_customize->add_control(
            'header_email_title',
            array(
                'section'           => 'top_bar_section',
                'label'             => __( 'Email Title', 'law-firm' ),
                'type'              => 'text',
                'active_callback' => 'lawfirm_frontheader_active_callback'
            )
        );
        
        //add setting and control for email
        $wp_customize->add_setting(
            'email',
            array(
                'default'           => __( ' info@gllawfirm.com.np', 'law-firm' ),
                'sanitize_callback' => 'sanitize_email',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'email', 
            array(
            'selector'        => '.email',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'email', __( ' info@gllawfirm.com.np', 'law-firm' ) ) );
                },
            ) 
        );

        $wp_customize->add_control(
            'email',
            array(
                'label'           => __( 'Email', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'email',
                'active_callback' => 'lawfirm_frontheader_active_callback'
            )
        );

        //adding setting for phone title and phone desc-->header 2,4
        $wp_customize->add_setting(
            'header_contact_title',
            array(
                'default'           => __( 'Give A Call:', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 
            'header_contact_title', 
            array(
            'selector'        => '.contact_title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'header_contact_title', __( 'Give A Call:', 'law-firm' ) ) );
                },  
            ) 
        );
        
        $wp_customize->add_control(
            'header_contact_title',
            array(
                'section'         => 'top_bar_section',
                'label'           => __( 'Contact Title', 'law-firm' ),
                'type'            => 'text',
                'active_callback' => 'lawfirm_frontheader_active_callback'
            )
        );

        //add setting and control for ph number
        $wp_customize->add_setting(
            'phone_number',
            array(
                'default'           => __( '+1-800-111-2222', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'phone_number', 
            array(
            'selector'        => '.tel',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'phone_number', __( '+1-800-111-2222', 'law-firm' ) ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'phone_number',
            array(
                'label'           => __( 'Phone Number', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'text',
                'active_callback' => 'lawfirm_frontheader_active_callback'
            )
        );


        $wp_customize->add_setting(
            'header_btn_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'header_btn_text', 
            array(
            'selector'        => '.header-right a.btn',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'header_btn_text') );
                },  
            ) 
        );

        //add control for portal title
        $wp_customize->add_control(
            'header_btn_text',
            array(
                'label'           => __( 'Button Text', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'text',
            )
        );
        //adding setting for portal tile link
        $wp_customize->add_setting(
            'header_btn_link',
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        //add control for portal title link
        $wp_customize->add_control(
            'header_btn_link',
            array(
                'label'           => __( 'Button Link', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'url',
            )
        );
        //

        $wp_customize->add_setting(
            'header_contact_btn_text',
            array(
                'default'           => __( 'Contact Now', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'header_contact_btn_text', 
            array(
            'selector'        => '.portal-link',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'header_contact_btn_text', __( 'Contact Now', 'law-firm' ) ) );
                },  
            ) 
        );

        //add control for portal title
        $wp_customize->add_control(
            'header_contact_btn_text',
            array(
                'label'           => __( 'Contact Button Text', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'text',
                'active_callback' => 'lawfirm_frontheader_active_callback',
            )
        );
        //adding setting for portal tile link
        $wp_customize->add_setting(
            'header_contact_number',
            array(
                'default'           => __( '+1-800-111-2222', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        //add control for portal title link
        $wp_customize->add_control(
            'header_contact_number',
            array(
                'label'           => __( 'Contact Button Number', 'law-firm' ),
                'section'         => 'top_bar_section',
                'type'            => 'text',
                'active_callback' => 'lawfirm_frontheader_active_callback',
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontopbar');

function lawfirm_frontheader_active_callback( $control ){

    $topbar_toggle = $control->manager->get_setting( 'topbar_toggle' )->value();

    $id = $control->id;

    if( $id == 'header_email_title' && $topbar_toggle ) return true;
    if( $id == 'email' && $topbar_toggle ) return true;
    if( $id == 'header_contact_title' && $topbar_toggle ) return true;
    if( $id == 'phone_number' && $topbar_toggle ) return true;
    if( $id == 'header_contact_btn_text' && $topbar_toggle ) return true;
    if( $id == 'header_contact_number' && $topbar_toggle ) return true;
    
    return false;
}