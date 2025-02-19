<?php 

if( ! function_exists( 'law_firm_customize_register_frontpartner' ) ) :
    /**
     * Front Partner Section
     *
     * @param [type] $wp_customize
     * @return void
     */
    function law_firm_customize_register_frontpartner( $wp_customize ){
        $wp_customize->add_section(
            'front_partner', 
            array(
                'title'      => __( 'Partner Settings', 'law-firm' ),
                'priority'   => 110,
                'panel'      => 'frontpage_settings_panel',
            )
        );

        $wp_customize->add_setting(
            'toggle_front_partner', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_partner', 
                array(
                    'label'       => esc_html__( 'Show/Hide Partner Section', 'law-firm' ),
                    'description' => esc_html__( 'Enable to show the partner section', 'law-firm' ),
                    'section'     => 'front_partner',
                    'type'        => 'checkbox'
                )
            )
        );

        /** Repeater for Front partner section */
        $wp_customize->add_setting( 
            new Law_Firm_Repeater_Setting(
                $wp_customize, 
                'front_partner_repeater', 
                array(
                    'default'           => array(),
                    'sanitize_callback' => array( 'Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),                             
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Law_Firm_Control_Repeater(
                $wp_customize,
                'front_partner_repeater',
                array(
                    'section' => 'front_partner',				
                    'label'	  => __( 'Add Partners', 'law-firm' ),
                    'fields'  => array(
                        'thumbnail' => array(
                            'type'  => 'image', 
                            'label' => __( 'Add Image', 'law-firm' ),                
                        ),
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'Partner', 'law-firm' ),
                        'field' => 'title'
                    ),   
                    'choices'   => array(
                        'limit' => 6
                    ),               
                    'active_callback' => 'law_firm_front_partner_active_callback',                         
                )
            )
        );
    }
endif;
add_action('customize_register', 'law_firm_customize_register_frontpartner');

if( ! function_exists( 'law_firm_front_partner_active_callback' ) ) :
    function law_firm_front_partner_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_partner' )->value();

        $id = $control->id;

        if( $id == 'front_partner_repeater' && $toggle_section ) return true;

        return false;
    }
endif;