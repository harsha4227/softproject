<?php
/**
 * Customizer Settings
*/
/**
 * Customizer Panel.
 */
require get_template_directory() . '/inc/customizer/settings/customizer-panel.php';

$law_firm_all_sections = apply_filters( 
    'law_firm_customizer_sections',
    [
        'front'        => ['frontbanner','about','frontservices','frontquote','frontcounter', 'fronttestimonial','frontblog','frontfaq', 'frontpartner', 'frontfeatures', 'frontcontact'],
        'header'       => ['header', 'socialmedia'],
        'contact'      => ['contact','contactfaq','contactmap'],
        'footer'       => ['footer'],
        'other'        => ['post-page', 'layout', 'typography', 'theme-info' ],
    ] 
);

/*
* Breaking everything into folder
*/
foreach( $law_firm_all_sections as $foldername => $sectionslist ){ 
    foreach( $sectionslist as $ind ){        
        require get_template_directory() . '/inc/customizer/settings/sections/' . $foldername . '/' . $ind . '.php';
    }
}