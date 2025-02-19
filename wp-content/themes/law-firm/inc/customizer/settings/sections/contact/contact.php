<?php 

if( ! function_exists( 'law_firm_customize_register_contactpg_contact' ) ) :
/**
 * Contactpage Contact
 *
 * @param [type] $wp_customize
 * @return void
 */
function law_firm_customize_register_contactpg_contact( $wp_customize ){
    $wp_customize->add_section(
        'contactpg_section',
        array(
            'title'  => __( 'Contact Section', 'law-firm' ),
            'priority'   => 20,
            'panel'  => 'contact_page_settings',
        )
    );

    $wp_customize->add_setting(
        'toggle_contactpg_contact', 
        array(
            'default'           => false,
            'sanitize_callback' => 'law_firm_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Law_Firm_Toggle_Control(
            $wp_customize,
            'toggle_contactpg_contact', 
            array(
                'label'       => __( 'Show/Hide Contact Section', 'law-firm' ),
                'description' => __( 'Enable to show the contact section', 'law-firm' ),
                'section'     => 'contactpg_section',
                'type'        => 'checkbox',
            )
        )
    );

    /* features image*/
    $wp_customize->add_setting(
        'contpg_contact_bg_img', 
        array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 
            'contpg_contact_bg_img', 
            array(
                'label'       => __( 'Upload Image', 'law-firm' ),
                'section'     => 'contactpg_section',
                'active_callback' => 'law_firm_contactpg_contact_callback',
            )
        )
    );

    $wp_customize->add_setting(
        'contactpg_contact_headings',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contactpg_contact_headings', 
        array(
        'selector'        => '.contactpg-contact h2.section-header__title',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contactpg_contact_headings' ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'contactpg_contact_headings',
        array(
            'label'   => __( 'Heading', 'law-firm' ),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    $wp_customize->add_setting(
        'contactpg_contact_desc',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contactpg_contact_desc', 
        array(
        'selector'        => '.contactpg-contact .section-header__description',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contactpg_contact_desc' ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'contactpg_contact_desc',
        array(
            'label'   => __( 'Sub Heading', 'law-firm' ),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    //setting and control for email Heading
     $wp_customize->add_setting(
        'contpg_contact_email_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_contact_email_heading', 
        array(
        'selector'        => '.page-template-contact .card-title.email-heading',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_contact_email_heading' ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'contpg_contact_email_heading',
        array(
            'label'   => __( 'Email Title', 'law-firm' ),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

     //Setting and control for Email 1 inputbox
     $wp_customize->add_setting(
        'contpg_contact_email', 
        array(
            'default'           => '',             
            'sanitize_callback' => 'sanitize_email',
        )   
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_contact_email', 
        array(
        'selector'        => '.contactpg-contact .c-email',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_contact_email' ) );
            },  
        ) 
    );


    $wp_customize->add_control(
        'contpg_contact_email', 
        array(
            'label'     => __( 'Email', 'law-firm' ),
            'section'   => 'contactpg_section',
            'type'      => 'email',  
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    //Add settings for the phone title
    $wp_customize->add_setting(
        'contpg_contact_phone_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    //Add control for the phone title
    $wp_customize->add_control(
        'contpg_contact_phone_title',
        array(
            'label'   => esc_html( 'Phone Title', 'law-firm' ),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    //Add settings for the phone number 
    $wp_customize->add_setting(
        'contpg_contact_phone_num',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_contact_phone_num', 
        array(
        'selector'        => '.contactpg-contact .c-phone',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_contact_phone_num' ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'contpg_contact_phone_num',
        array(
            'label'   => __( 'Phone', 'law-firm'),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    //setting and control for location  title
    $wp_customize->add_setting(
        'contpg_contact_location_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_contact_location_title', 
        array(
        'selector'        => '.page-template-contact .card-title.location-heading',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_contact_location_title' ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'contpg_contact_location_title',
        array(
            'label'   => __( 'Loaction Title', 'law-firm' ),
            'section' => 'contactpg_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    //Setting and control for Location 
    $wp_customize->add_setting(
        'contpg_contact_location', 
        array(
            'default'           => '',             
            'sanitize_callback' => 'sanitize_text_field',
        )   
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_contact_location', 
        array(
        'selector'        => '.contactpg-contact .c-location',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_contact_location' ) );
            },  
        ) 
    );


    $wp_customize->add_control(
        'contpg_contact_location', 
        array(
            'label'    => __( 'Location', 'law-firm' ),
            'section'  => 'contactpg_section',
            'type'     => 'text',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );

    /** Shortcode*/
    $wp_customize->add_setting(
        'contpg_contactform_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'contpg_contactform_shortcode',
        array(
            'label'   => __( 'Shortcode', 'law-firm' ),
            'type'    => 'text',
            'section' => 'contactpg_section',
            'active_callback' => 'law_firm_contactpg_contact_callback',
        )
    );
}
endif;
add_action('customize_register', 'law_firm_customize_register_contactpg_contact');

if( ! function_exists( 'law_firm_contactpg_contact_callback' ) ) :
    function law_firm_contactpg_contact_callback( $control ){     
        $toggle_section = $control->manager->get_setting( 'toggle_contactpg_contact' )->value();

        $id = $control->id;

        if( $id == 'contpg_contact_bg_img' && $toggle_section ) return true;
        if( $id == 'contactpg_contact_headings' && $toggle_section ) return true;
        if( $id == 'contactpg_contact_desc' && $toggle_section ) return true;
        if( $id == 'contpg_contact_email_heading' && $toggle_section ) return true;
        if( $id == 'contpg_contact_email' && $toggle_section ) return true;
        if( $id == 'contpg_contact_phone_title' && $toggle_section ) return true;
        if( $id == 'contpg_contact_phone_num' && $toggle_section ) return true;
        if( $id == 'contpg_contact_location_title' && $toggle_section ) return true;
        if( $id == 'contpg_contact_location' && $toggle_section ) return true;
        if( $id == 'contpg_contactform_shortcode' && $toggle_section ) return true;

        return false;
    }
endif;