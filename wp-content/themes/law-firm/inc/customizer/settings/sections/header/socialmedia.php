<?php 

if( ! function_exists( 'law_firm_customize_register_socialmedia' ) ) :
    /**
     * Headers Socialmedia
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_socialmedia( $wp_customize ){
        // Create a new section top bar settings----------
        $wp_customize->add_section(
            'social_media_section', 
            array(
                'title'    => __( 'Social Media Settings', 'law-firm' ),
                'priority' => 20,
                'panel'    => 'general_settings_panel',
            )
        );

        // Add the toggle control to the section
        $wp_customize->add_setting(
            'socialmedia_toggle', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'socialmedia_toggle', 
                array(
                    'label'       => __( 'Show/Hide Social Media', 'law-firm' ),
                    'description' => __( 'Enable to show the social media.', 'law-firm' ),
                    'section'     => 'social_media_section',
                    'type'        => 'checkbox'
                )
            )
        );

        $wp_customize->add_setting(
            'socialmedia_heading',
            array(
                'default'           => __( 'Follow Us:', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',  
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'socialmedia_heading', 
            array(
                'selector'        => '.social-label',
                'render_callback' => function() {
                    return esc_html( get_theme_mod( 'socialmedia_heading', __( 'Follow Us:', 'law-firm' ) ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'socialmedia_heading',
            array(
                'label'           => __( 'Heading', 'law-firm' ),
                'section'         => 'social_media_section',
                'type'            => 'text',
                'active_callback' => 'law_firm_social_media_active_callback'
            )
        );
        

        /** Repeater Custom For social media Section */
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_facebook_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_facebook_link', 
            array(
                'label'           => esc_html__( 'Facebook Link', 'law-firm' ),
                'section'         => 'social_media_section',
                'type'            => 'url',      
                'active_callback' => 'law_firm_social_media_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_instagram_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_instagram_link', 
            array(
                'label'   => esc_html__( 'Instagram Link', 'law-firm' ),
                'section' => 'social_media_section',
                'type'    => 'url',
                'active_callback' => 'law_firm_social_media_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_linkedin_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_linkedin_link', 
            array(
                'label'   => esc_html__( 'Linkedin Link', 'law-firm' ),
                'section' => 'social_media_section',
                'type'    => 'url',
                    'active_callback' => 'law_firm_social_media_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_pinterest_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_pinterest_link', 
            array(
                'label'   => esc_html__( 'Pinterest Link', 'law-firm' ),
                'section' => 'social_media_section',
                'type'    => 'url',
                'active_callback' => 'law_firm_social_media_active_callback'      
            )
        );

            // Add the toggle control to the section
        $wp_customize->add_setting(
            'md_social_checkbox', 
            array(
                'default'           => true,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'md_social_checkbox', 
                array(
                    'label'       => esc_html__( 'Enable to open in new tab.', 'law-firm' ),
                    'section'     => 'social_media_section',
                    'type'        => 'checkbox',
                    'active_callback' => 'law_firm_social_media_active_callback'
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_socialmedia');

function law_firm_social_media_active_callback( $control ){

    $toggle_social_media = $control->manager->get_setting( 'socialmedia_toggle' )->value();

    $id = $control->id;

    if( $id == 'socialmedia_heading' && $toggle_social_media ) return true;    
    if( $id == 'social_facebook_link' && $toggle_social_media ) return true;
    if( $id == 'social_instagram_link' && $toggle_social_media ) return true;
    if( $id == 'social_linkedin_link' && $toggle_social_media ) return true;
    if( $id == 'social_pinterest_link' && $toggle_social_media ) return true;
    if( $id == 'md_social_checkbox' && $toggle_social_media ) return true;

    return false;
}