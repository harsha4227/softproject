<?php
/**
 * Front Contact Section
 * 
 * @package law-firm
 */

$toggle_front_contact         = get_theme_mod( 'toggle_front_contact', false );
$front_contact_bg_img         = get_theme_mod( 'contact_background_image' );
$front_contact_heading        = get_theme_mod( 'contact_headings' );
$front_contact_description    = get_theme_mod( 'contact_descriptions' );
$front_email_heading          = get_theme_mod( 'contact_email_heading' );
$front_email                  = get_theme_mod( 'contact_email' );
$front_phone_heading          = get_theme_mod( 'contact_phone_title' );
$front_phone                  = get_theme_mod( 'contact_phone_number' );
$front_location_heading       = get_theme_mod( 'contact_location_title' );
$front_location               = get_theme_mod( 'contact_location' );
$front_contact_form_shortcode = get_theme_mod( 'contact_form_shortcode' );

law_firm_contact_section( 
    'front-contact',
    $toggle_front_contact,
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
