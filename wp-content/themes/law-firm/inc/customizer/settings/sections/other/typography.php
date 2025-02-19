<?php 

if( ! function_exists( 'law_firm_customize_register_typography' ) ) :
    /**
     * Typography Settings
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_typography( $wp_customize ){
        // Create a new section top bar settings----------
        $wp_customize->add_section(
            'typography_section', 
            array(
                'title'    => __( 'Typography Settings', 'law-firm' ),
                'priority' => 30,
                'panel'    => 'appearance_settings',
            )
        );

        $wp_customize->add_setting(
            'toggle_localgoogle_fonts', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );
    
        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize, 
                'toggle_localgoogle_fonts', 
                array(
                    'label'   => __( 'Enable to load the google fonts locally.', 'law-firm' ),
                    'section' => 'typography_section',
                    'type'    => 'checkbox'
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_typography');