<?php 
/**
 * Contact Template, FAQ Section
 * 
 * @package law-firm
 * 
 */

$toggle_front_contact = get_theme_mod( 'toggle_front_contact', false );
$heading_setting      = get_theme_mod( 'contpg_faq_heading' );
$description_setting  = get_theme_mod( 'contpg_faq_desc' );
$button_text_setting  = get_theme_mod( 'contpg_faq_btn_text' );
$button_link_setting  = get_theme_mod( 'contpg_faq_btn_link' );
$contact_faq_repeater = get_theme_mod( 'contpg_faqs_repeater');

law_firm_faq_section(
    'contact-faq',      // Section class/id 
    $toggle_front_contact,          
    $heading_setting, 
    $description_setting, 
    $button_text_setting, 
    $button_link_setting,
    $contact_faq_repeater
);