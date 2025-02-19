<?php

if( ! function_exists( 'law_firm_customize_register_layout_settings' ) ) :
    /**
     * Layout Settings
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_layout_settings( $wp_customize ){
        $wp_customize->add_section(
            'layout_settings',
            array(
                'title'    => __( 'Layout Settings', 'law-firm' ),
                'priority' => 60,
                'panel'    => 'general_settings_panel',
            )
        );

        $wp_customize->add_setting( 
            'single_page_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'law_firm_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Law_Firm_Radio_Image_Control( 
                $wp_customize, 
                'single_page_layouts',
                array(
                    'label'       => __( 'Page Layouts', 'law-firm' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name' => __( 'Full Width', 'law-firm' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name' => __( 'Right Sidebar', 'law-firm' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name' => __( 'Left Sidebar', 'law-firm' )
                        ),
                    )
                )
            ) 
        ); 


        $wp_customize->add_setting( 
            'single_post_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'law_firm_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Law_Firm_Radio_Image_Control( 
                $wp_customize, 
                'single_post_layouts',
                array(
                    'label'       => __( 'Post Layouts', 'law-firm' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name'  => __( 'Full Width', 'law-firm' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name'  => __( 'Right Sidebar', 'law-firm' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name'  => __( 'Left Sidebar', 'law-firm' )
                        ),
                    )
                )
            ) 
        );

        $wp_customize->add_setting( 
            'archive_page_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'law_firm_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Law_Firm_Radio_Image_Control( 
                $wp_customize, 
                'archive_page_layouts',
                array(
                    'label'       => __( 'Archive & Search Layouts', 'law-firm' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name' => __( 'Full Width', 'law-firm' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name' => __( 'Right Sidebar', 'law-firm' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name' => __( 'Left Sidebar', 'law-firm' )
                        ),
                    )
                )
            ) 
        ); 
    }
endif;
add_action('customize_register', 'law_firm_customize_register_layout_settings');