<?php 

if( ! function_exists( 'law_firm_customize_register_contactpg_faq' ) ) :
/**
 * Contact Page FAQ
 *
 * @param [type] $wp_customize
 * @return void
 */
function law_firm_customize_register_contactpg_faq( $wp_customize ){
    $wp_customize->add_section(
        'contactpg_faqs_section', 
        array(
            'title'      => esc_html__( 'FAQ Settings', 'law-firm' ),
            'priority'   => 30,
            'panel'      => 'contact_page_settings',
        )
    );

    $wp_customize->add_setting(
        'toggle_contact_faq', 
        array(
            'default'           => false,
            'sanitize_callback' => 'law_firm_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Law_Firm_Toggle_Control(
            $wp_customize,
            'toggle_contact_faq', 
            array(
                'label'       => __( 'Show/Hide FAQ Section', 'law-firm' ),
                'description' => __( 'Enable to show the faq section', 'law-firm' ),
                'section'     => 'contactpg_faqs_section',
                'type'        => 'checkbox',
            )
        )
    );

    // Add setting for Section Heading
    $wp_customize->add_setting(
        'contpg_faq_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_faq_heading', 
        array(
        'selector'        => 'section#contact-faq h2.section-header__title',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_faq_heading' ) );
            },  
        ) 
    );

    //Add Control for Section Heading
    $wp_customize->add_control(
        'contpg_faq_heading', 
        array(
            'label'   => __( 'Heading', 'law-firm' ),
            'section' => 'contactpg_faqs_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_faq_active_callback', 
        )
    );
    // Add setting for Section Description
    $wp_customize->add_setting(
        'contpg_faq_desc', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_faq_desc', 
        array(
        'selector'        => 'section#contact-faq .section-header__description',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_faq_desc' ) );
            },  
        ) 
    );

    //Add Control for Section Description
    $wp_customize->add_control(
        'contpg_faq_desc', 
        array(
            'label'   => __( 'Description', 'law-firm' ),
            'section' => 'contactpg_faqs_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_faq_active_callback', 
        )
    );


    // Add setting for FAQ Text
    $wp_customize->add_setting(
        'contpg_faq_btn_text', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'contpg_faq_btn_text', 
        array(
        'selector'        => 'section#contact-faq a.btn',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'contpg_faq_btn_text' ) );
            },  
        ) 
    );

    // Add control for FAQ Text
    $wp_customize->add_control(
        'contpg_faq_btn_text', 
        array(
            'label'   => __( 'Button Text', 'law-firm' ),
            'section' => 'contactpg_faqs_section',
            'type'    => 'text',
            'active_callback' => 'law_firm_contactpg_faq_active_callback', 
        )
    );

    // Add setting for FAQs button Link
    $wp_customize->add_setting(
        'contpg_faq_btn_link', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    // Add control for FAQs butron Link
    $wp_customize->add_control(
        'contpg_faq_btn_link', 
        array(
            'label'   => __( 'Button Link', 'law-firm' ),
            'section' => 'contactpg_faqs_section',
            'type'    => 'url',
            'active_callback' => 'law_firm_contactpg_faq_active_callback', 
        )
    );

    /** Slider Custom For Frontpage Faqs Section */
	$wp_customize->add_setting( 
		new Law_Firm_Repeater_Setting( 
			$wp_customize, 
			'contpg_faqs_repeater', 
			array(
				'default'       => array(),
				'sanitize_callback' => array( 'Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),                             
			) 
		) 
	);
	
	$wp_customize->add_control(
		new Law_Firm_Control_Repeater(
			$wp_customize,
			'contpg_faqs_repeater',
			array(
				'section' => 'contactpg_faqs_section',				
				'label'	  => __( 'Add FAQ', 'law-firm' ),
				'fields'  => array(
					'question' => array(
						'type'  => 'text', 
						'label' => __( 'Add Question', 'law-firm' ),                
					),
					'answer' => array(
						'type'  => 'text', 
						'label' => __( 'Add Answer', 'law-firm' ),                
					),
				),
				'row_label' => array(
					'type'  => 'field',
					'value' => __( 'FAQs', 'law-firm' ),
					'field' => 'title',
				),    
                'choices'   => array(
                    'limit' => 4
                ),                 
                'active_callback' => 'law_firm_contactpg_faq_active_callback',             
			)
		)
	);
}
endif;
add_action('customize_register', 'law_firm_customize_register_contactpg_faq');

if( ! function_exists( 'law_firm_contactpg_faq_active_callback' ) ) :
    function law_firm_contactpg_faq_active_callback( $control ){     
        $toggle_section = $control->manager->get_setting( 'toggle_contact_faq' )->value();

        $id = $control->id;

        if( $id == 'contpg_faq_heading' && $toggle_section ) return true;
        if( $id == 'contpg_faq_desc' && $toggle_section ) return true;
        if( $id == 'contpg_faq_btn_text' && $toggle_section ) return true;
        if( $id == 'contpg_faq_btn_link' && $toggle_section ) return true;
        if( $id == 'contpg_faqs_repeater' && $toggle_section ) return true;
        
        return false;
    }
endif;