<?php

if( ! function_exists( 'law_firm_customize_register_panels' ) ):
    /**
     * Registering Panel
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_panels( $wp_customize ){
        $wp_customize->add_panel(
            'appearance_settings', 
            array(
                'title'          => esc_html__('Appearance Settings', 'law-firm'),
                'priority'       => 10,
            )
        );

        $wp_customize->add_panel(
            'frontpage_settings_panel', 
            array(
                'title'          => esc_html__('Front Page Settings', 'law-firm'),
                'description'    => esc_html__('Static Home Page Settings.', 'law-firm'),
                'priority'       => 10,
            )
        );

        $wp_customize->add_panel(
            'general_settings_panel',
            array(
                'title'          => esc_html__('General Settings', 'law-firm'),
                'description'    => esc_html__('General Desc', 'law-firm'),
                'priority'       => 10
            )
        );

        //----contact page settings panel----
        $wp_customize->add_panel(
            'contact_page_settings',
            array(
                'title'          => esc_html__('Contact Page Settings', 'law-firm'),
                'description'    => esc_html__('Contact Page Desc', 'law-firm'),
                'priority'       => 10
            )
        );
        //----------------------------Footer panel------------------------
        $wp_customize->add_panel(
            'footer_settings', 
            array(
                'title'          => esc_html__('Footer Settings', 'law-firm'),
                'description'    => esc_html__('Footer Desc', 'law-firm'),
                'priority'       => 10
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_panels');