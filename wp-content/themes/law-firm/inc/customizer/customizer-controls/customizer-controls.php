<?php 
function law_firm_customizer_controls_registration( $wp_customize ) {
    require_once get_template_directory() . '/inc/customizer/customizer-controls/note/note-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/toggle/toggle-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/radio/radio-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/settings.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/repeater.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/pro/pro-control.php';

    $wp_customize->register_control_type( 'Law_Firm_Toggle_Control' );
    $wp_customize->register_control_type( 'Law_firm_Customize_Section_Pro' );
}
add_action( 'customize_register', 'law_firm_customizer_controls_registration' );