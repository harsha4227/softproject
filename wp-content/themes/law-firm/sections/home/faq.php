<?php
/**
 * Front FAQ Section
 * 
 * @package law-firm
 */
$toggle_front_faq     = get_theme_mod( 'toggle_front_faq', false );
$heading_setting      = get_theme_mod( 'faq_heading_settings' );
$description_setting  = get_theme_mod( 'faq_descriptions' );
$button_text_setting  = get_theme_mod( 'faq_btn_text_setting' );
$button_link_setting  = get_theme_mod( 'faq_btn_link_setting' );
$home_faq_repeater    = get_theme_mod( 'faqs_links_repeater', array() );

law_firm_faq_section( 
    'front-faq',
    $toggle_front_faq,            // Section class/id 
    $heading_setting, 
    $description_setting, 
    $button_text_setting, 
    $button_link_setting,
    $home_faq_repeater 
);