<?php 

if( ! function_exists( 'law_firm_customize_register_contactmap' ) ) :
/**
 * ContactPage Map Section
 *
 * @param [type] $wp_customize
 * @return void
 */
function law_firm_customize_register_contactmap( $wp_customize ){
    $wp_customize->add_section(
        'contact_map_section',
        array(
            'title'  => __( 'Map Section', 'law-firm' ),
            'priority'   => 10,
            'panel'  => 'contact_page_settings',
        )
    );

    $wp_customize->add_setting(
        'toggle_contactpg_map', 
        array(
            'default'           => false,
            'sanitize_callback' => 'law_firm_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Law_Firm_Toggle_Control(
            $wp_customize,
            'toggle_contactpg_map', 
            array(
                'label'       => __( 'Show/Hide Map Section', 'law-firm' ),
                'description' => __( 'Enable to show the map section', 'law-firm' ),
                'section'     => 'contact_map_section',
                'type'        => 'checkbox'
            )
        )
    );

    //Google map iframe
    $wp_customize->add_setting(
        'contact_map_iframe',
        array(
            'default'           => '',
            'sanitize_callback' => 'law_firm_sanitize_code',
        )
    );

    $wp_customize->add_control(
        'contact_map_iframe',
        array(
            'label'   => __( 'Google Map Iframe', 'law-firm' ),
            'section' => 'contact_map_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contact_map_active_callback',
        )
    );
}
endif;
add_action('customize_register', 'law_firm_customize_register_contactmap');

if( ! function_exists( 'law_firm_contact_map_active_callback' ) ) :
    function law_firm_contact_map_active_callback( $control ){     
        $toggle_section = $control->manager->get_setting( 'toggle_contactpg_map' )->value();

        $id = $control->id;

        if( $id == 'contact_map_iframe' && $toggle_section ) return true;

        return false;
    }
endif;