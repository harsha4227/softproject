<?php 

if( ! function_exists( 'law_firm_customize_register_frontblog' ) ) :
    /**
     * Frontblog
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontblog( $wp_customize ){
        $wp_customize->add_section(
            'blog_section', 
            array(
                'title'      => __( 'Blog Settings', 'law-firm' ),
                'priority'   => 90,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_blog', 
            array(
                'default'           => true,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_blog', 
                array(
                    'label'       => __( 'Show/Hide Blog Section', 'law-firm' ),
                    'description' => __( 'Enable to show the blog section', 'law-firm' ),
                    'section'     => 'blog_section',
                    'type'        => 'checkbox',
                )
            )
        );

        // Add setting for Section Heading
        $wp_customize->add_setting(
            'front_blog_heading', 
            array(
                'default'           => __( 'Our Latest News Blogs', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'front_blog_heading', 
            array(
            'selector'        => '.latest__blog-section h2.section-header__title',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_blog_heading', __( 'Our Latest News Blogs', 'law-firm' ) ) );
                },  
            ) 
        );

        //Add Control for Section Heading
        $wp_customize->add_control(
            'front_blog_heading', 
            array(
                'label'   => __( 'Heading', 'law-firm' ),
                'section' => 'blog_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_blog_active_callback',
            )
        );

        // Add setting for Section Description
        $wp_customize->add_setting(
            'front_blog_description', 
            array(
                'default'           => __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'front_blog_description', 
            array(
            'selector'        => '.latest__blog-section .section-header__description',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_blog_description', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'law-firm' ) ) );
                },  
            ) 
        );

        //Add Control for Section Description
        $wp_customize->add_control(
            'front_blog_description', 
            array(
                'label'   => __( 'Description', 'law-firm' ),
                'section' => 'blog_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_blog_active_callback',
            )
        );

        // Add setting for blog button Text
        $wp_customize->add_setting(
            'front_blog_btn_text', 
            array(
                'default'           => __( 'View All Blogs', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 
            'front_blog_btn_text', 
            array(
            'selector'        => '.latest__blog-top a',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_blog_btn_text', __( 'View All Blogs', 'law-firm' ) ) );
                },  
            ) 
        );

        // Add control for blog button Text
        $wp_customize->add_control(
            'front_blog_btn_text', 
            array(
                'label'   => __( 'Button Text', 'law-firm' ),
                'section' => 'blog_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_blog_active_callback'
            )
        );

        // Add setting for Blog button Link
        $wp_customize->add_setting(
            'blog_btn_link_setting', 
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        // Add control for Blog butron Link
        $wp_customize->add_control(
            'blog_btn_link_setting', 
            array(
                'label'   => __( 'Button Link', 'law-firm' ),
                'section' => 'blog_section',
                'type'    => 'url',
                'active_callback' => 'law_firm_front_blog_active_callback'
            )
        );

        // Add setting for blog readmore Text
        $wp_customize->add_setting(
            'front_blog_readmore_text', 
            array(
                'default'           => __( 'Read More', 'law-firm' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 
            'front_blog_readmore_text', 
            array(
            'selector'        => '.front-blog .blog__bottom a.btn.btn-readmore',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'front_blog_readmore_text', __( 'Read More', 'law-firm' ) ) );
                },  
            ) 
        );

        // Add control for blog readmore Text
        $wp_customize->add_control(
            'front_blog_readmore_text', 
            array(
                'label'   => __( 'Readmore Text', 'law-firm' ),
                'section' => 'blog_section',
                'type'    => 'text',
                'active_callback' => 'law_firm_front_blog_active_callback'
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontblog');

if( ! function_exists( 'law_firm_front_blog_active_callback' ) ) :
    function law_firm_front_blog_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_blog' )->value();

        $id = $control->id;

        if( $id == 'front_blog_heading' && $toggle_section ) return true;
        if( $id == 'front_blog_description' && $toggle_section ) return true;
        if( $id == 'front_blog_btn_text' && $toggle_section ) return true;
        if( $id == 'blog_btn_link_setting' && $toggle_section ) return true;
        if( $id == 'front_blog_readmore_text' && $toggle_section ) return true;

        return false;
    }
endif;