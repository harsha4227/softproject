<?php
/**
 * Template Name: Contact Us
 * @package Law_Firm
 */ 
get_header(); 

$contact_sections = apply_filters( 
    'law_firm_contact_sections',
    array( 'contact_map', 'contact_form', 'faq' )
);

echo '<div class="inner-page contact-page">';
    foreach( $contact_sections as $section ){
        get_template_part( 'sections/contact/' . $section );
    }
echo '</div>';

get_footer();