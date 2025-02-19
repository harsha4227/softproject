<?php 

if( ! function_exists( 'law_firm_customize_register_footer' )  ){
    /**
     * Footer Copyright settings cutomizers section
     */
    function law_firm_customize_register_footer( $wp_customize ){
        $wp_customize->add_section(
            'footer_section', 
            array(
                'title'      => esc_html__( 'Copyright Section', 'law-firm' ),
                'priority'   => 20,
                'panel'      => 'footer_settings',
            )
        );
        //Add settings for Copyright settings
        $wp_customize->add_setting(
            'footer_copyright_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_textarea_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'footer_copyright_setting', 
            array(
            'selector'        => '.site-info.footer',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'footer_copyright_setting' ) );
                },  
            ) 
        );

        //Add Control for Copyright control
        $wp_customize->add_control(
            'footer_copyright_setting', 
            array(
                'label'           => esc_html__( 'Footer Copyright Text', 'law-firm' ),
                'description'     => esc_html__( 'Write your copyright text here.', 'law-firm' ),
                'section'         => 'footer_section',
                'type'            => 'textarea',
            )
        );
    }
}
add_action('customize_register', 'law_firm_customize_register_footer');