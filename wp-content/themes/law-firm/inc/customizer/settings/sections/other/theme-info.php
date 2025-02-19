<?php
/**
 * Law Firm Theme Information Link Section
 *
 * @package Law_Firm
 */

if( ! function_exists( 'law_firm_theme_info' ) ) :
    function law_firm_theme_info( $customizer_manager ) {
        $customizer_manager->add_section( 
            'theme_info', 
            array(
                'title'    => esc_html__( 'Information Links', 'law-firm' ),
                'priority' => 6,
            )
        );

        /** Important Links */
        $customizer_manager->add_setting( 
            'theme_info_theme',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $theme_info = '<ul>';
        $theme_info .= sprintf( __( '<li>View documentation: %1$sClick here.%2$s</li>', 'law-firm' ),  '<a href="' . esc_url( 'https://glthemes.com/documentation/law-firm/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>Theme info: %1$sClick here.%2$s</li>', 'law-firm' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/law-firm/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>Support ticket: %1$sClick here.%2$s</li>', 'law-firm' ),  '<a href="' . esc_url( 'https://glthemes.com/support/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>More WordPress Themes: %1$sClick here.%2$s</li>', 'law-firm' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/' ) . '" target="_blank">', '</a>' );
        $theme_info .= '</ul>';

        $customizer_manager->add_control(
            new Law_firm_Note_Control( 
                $customizer_manager,
                'theme_info_theme',
                array(
                    'label'       => esc_html__( 'Important Links', 'law-firm' ),
                    'section'     => 'theme_info',
                    'description' => $theme_info
                )
            )
        );

        $customizer_manager->add_section(
            new Law_firm_Customize_Section_Pro(
                $customizer_manager,
                'law_firm_view_pro',
                array(
                    'title'    => esc_html__( 'Pro Available', 'law-firm' ),
                    'priority' => 5, 
                    'pro_text' => esc_html__( 'VIEW PRO THEME', 'law-firm' ),
                    'pro_url'  => 'https://glthemes.com/wordpress-theme/law-firm-pro/'
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'law_firm_theme_info',9999 );