<?php
/**
 *  Contact Template, Contact Form Section
 * 
 *  @package law-firm
 */

$toggle_section               = get_theme_mod( 'toggle_contactpg_contact', false );
$front_contact_bg_img         = get_theme_mod( 'contpg_contact_bg_img' );
$front_contact_heading        = get_theme_mod( 'contactpg_contact_headings' );
$front_contact_description    = get_theme_mod( 'contactpg_contact_desc' );
$front_email_heading          = get_theme_mod( 'contpg_contact_email_heading' );
$front_email                  = get_theme_mod( 'contpg_contact_email' );
$front_phone_heading          = get_theme_mod( 'contpg_contact_phone_title' );
$front_phone                  = get_theme_mod( 'contpg_contact_phone_num' );
$front_location_heading       = get_theme_mod( 'contpg_contact_location_title' );
$front_location               = get_theme_mod( 'contpg_contact_location' );
$front_contact_form_shortcode = get_theme_mod( 'contpg_contactform_shortcode' );

law_firm_contact_section( 
    'contactpg-contact',
    $toggle_section,
    $front_contact_bg_img, 
    $front_contact_heading, 
    $front_contact_description, 
    $front_email_heading, 
    $front_email, 
    $front_phone_heading, 
    $front_phone, 
    $front_location_heading, 
    $front_location, 
    $front_contact_form_shortcode 
);