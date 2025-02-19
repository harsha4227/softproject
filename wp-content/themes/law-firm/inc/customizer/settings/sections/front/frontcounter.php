<?php

if( ! function_exists( 'law_firm_customize_register_frontcounter' ) ) :
	/**
	 * Front counter
	 *
	 * @param [type] $wp_customize
	 * @return void
	 */
	function law_firm_customize_register_frontcounter($wp_customize){
		$wp_customize->add_section(
			'counter_section',
			array(
				'title'      => __('Counter Settings', 'law-firm'),
				'priority'   => 70,
				'panel'      => 'frontpage_settings_panel',
			)
		);

		$wp_customize->add_setting(
            'toggle_front_counter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'law_firm_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Law_Firm_Toggle_Control(
                $wp_customize,
                'toggle_front_counter', 
                array(
                    'label'       => __( 'Show/Hide Counter Section', 'law-firm' ),
                    'description' => __( 'Enable to show the counter section', 'law-firm' ),
                    'section'     => 'counter_section',
                    'type'        => 'checkbox'
                )
            )
        );

		/** Repeater Custom For Frontpage Counter Section */
		$wp_customize->add_setting(
			new Law_Firm_Repeater_Setting(
				$wp_customize,
				'front_counter_repeaters',
				array(
					'default'           => array(),
					'sanitize_callback' => array('Law_Firm_Repeater_Setting', 'sanitize_repeater_setting'),
				)
			)
		);

		$wp_customize->add_control(
			new Law_Firm_Control_Repeater(
				$wp_customize,
				'front_counter_repeaters',
				array(
					'section' => 'counter_section',
					'label'	  => __('Add Counter', 'law-firm'),
					'fields'  => array(
						'title'       => array(
							'type'    => 'text',
							'label'   => __('Add Title', 'law-firm'),
						),
						'counter'     => array(
							'type'    => 'text',
							'label'   => __('Add Count', 'law-firm'),
						),
						'prefix'      => array(
							'type'    => 'text',
							'label'   => __('Add Prefix', 'law-firm'),
						),
						'description' => array(
							'type'    => 'text',
							'label'   =>  __('Add Description', 'law-firm'),
						)
					),
					'row_label' => array(
						'type'  => 'field',
						'value' => __('Counter', 'law-firm'),
						'field' => 'title',
					),
					'choices'   => array(
                    	'limit' => 3
               	 	),
					'active_callback' => 'law_firm_front_counter_active_callback',
				)
			)
		);
	}
endif;
add_action('customize_register', 'law_firm_customize_register_frontcounter');

if( ! function_exists( 'law_firm_front_counter_active_callback' ) ) :
    function law_firm_front_counter_active_callback( $control ){
        $toggle_section = $control->manager->get_setting( 'toggle_front_counter' )->value();

        $id = $control->id;

        if( $id == 'front_counter_repeaters' && $toggle_section ) return true;

        return false;
    }
endif;