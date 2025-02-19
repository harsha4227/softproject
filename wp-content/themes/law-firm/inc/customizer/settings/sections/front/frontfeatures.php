<?php

if( ! function_exists( 'law_firm_customize_register_frontfeatures' ) ) :
	/**
	 * Front Features
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function law_firm_customize_register_frontfeatures($wp_customize){
		$wp_customize->add_section(
			'features_section',
			array(
				'title'      => __('Features Settings', 'law-firm'),
				'priority'   => 80,
				'panel'      => 'frontpage_settings_panel',
			)
		);

		$wp_customize->add_setting(
            'toggle_front_feature', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_feature', 
                array(
                    'label'       => __( 'Show/Hide Feature Section', 'law-firm' ),
                    'description' => __( 'Enable to show the feature section', 'law-firm' ),
                    'section'     => 'features_section',
                    'type'        => 'checkbox'
                )
            )
        );

		/** Repeater Custom For Frontpage Features Section */
		$wp_customize->add_setting(
			new Law_Firm_Repeater_Setting(
				$wp_customize,
				'front_features_repeater',
				array(
					'default'         => array(),
					'sanitize_callback' => array('Law_Firm_Repeater_Setting', 'sanitize_repeater_setting' ),
				)
			)
		);

		$wp_customize->add_control(
			new Law_Firm_Control_Repeater(
				$wp_customize,
				'front_features_repeater',
				array(
					'section' => 'features_section',
					'label'	  => __('Add Features', 'law-firm'),
					'fields'  => array(
						'heading'       => array(
							'type'  => 'text',
							'label' => __('Add Heading', 'law-firm'),
						),
						'subheading'       => array(
							'type'  => 'text',
							'label' => __('Add Sub Heading', 'law-firm'),
						),
						'image'       => array(
							'type'  => 'image',
							'label' => __('Upload Image', 'law-firm'),
						),
						'url'       => array(
							'type'  => 'url',
							'label' => __('Add Url', 'law-firm'),
						),
						
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __('Features', 'law-firm'),
						'field' => 'title',
					),
					'choices'   => array(
                        'limit' => 3
                    ),
					'active_callback' => 'law_firm_front_feature_active_callback',
				)
			)
		);
	}
endif;
add_action('customize_register', 'law_firm_customize_register_frontfeatures');

if( ! function_exists( 'law_firm_front_feature_active_callback' ) ) :
    function law_firm_front_feature_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_feature' )->value();

        $id = $control->id;

        if( $id == 'front_features_repeater' && $toggle_section ) return true;

        return false;
    }
endif;