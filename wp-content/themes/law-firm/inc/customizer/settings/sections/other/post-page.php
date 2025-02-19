<?php

if( ! function_exists( 'law_firm_customize_register_postpage' ) ) :
    /**
     * Posts(Blog) & Pages Settings
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_postpage( $wp_customize ){
        /** Posts(Blog) & Pages Settings */
        $wp_customize->add_section(
            'post_page_settings',
            array(
                'title'    => __( 'Post & Pages Settings', 'law-firm' ),
                'priority' => 40,
                'panel'    => 'general_settings_panel',
            )
        );
        
        // Add the toggle control to the section
        $wp_customize->add_setting(
            'mp_author', 
            array(
                'default'           => true,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize, 
                'mp_author', 
                array(
                    'label'       => __( 'Show/Hide Author Section','law-firm' ),
                    'description' => __( 'Enable to show author section in the post.', 'law-firm' ),
                    'section'     => 'post_page_settings',
                    'type'        => 'checkbox'
                )
            )
        );

        //add settings and control for Related Post subheading settings
        $wp_customize->add_setting(
            'related_post_heading',
            array(
                'default'           => __( 'Related Posts', 'law-firm'),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'related_post_heading', 
            array(
            'selector'        => '.post-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'related_post_heading', __( 'Related Posts', 'law-firm') ) );
                },  
            ) 
        );
        $wp_customize->add_control(
            'related_post_heading',
            array(
                'label'           => __( 'Heading', 'law-firm' ),
                'section'         => 'post_page_settings',
                'type'            => 'text',
            )
        );

        //add settings and control for Readmore button
        $wp_customize->add_setting(
            'post_readmore_button',
            array(
                'default'           => __( 'Read More', 'law-firm'),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->selective_refresh->add_partial( 
            'post_readmore_button', 
            array(
            'selector'        => '.post-button',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'post_readmore_button',  __( 'Read More', 'law-firm') ) );
                },  
            ) 
        );
        $wp_customize->add_control(
            'post_readmore_button',
            array(
                'label'           => __( 'Button Label', 'law-firm' ),
                'section'         => 'post_page_settings',
                'type'            => 'text',
            )
        );

        /** Show/hide Expert of the related Post */
        $wp_customize->add_setting(
            'toggle_related_post_excerpt', 
            array(
                'default'           => true,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize, 
                'toggle_related_post_excerpt', 
                array(
                    'label'           => __( 'Show/Hide Excerpt', 'law-firm' ),
                    'description'     => __( 'Enable to show excerpts in related post.', 'law-firm' ),
                    'section'         => 'post_page_settings',
                    'type'            => 'checkbox',
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_postpage');