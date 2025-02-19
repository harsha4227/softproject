<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Law_Firm
 */
    /**
     * Doctype Hook
     * 
     * @hooked law_firm_doctype
    */
    do_action( 'law_firm_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
    <?php 
    /**
     * Before wp_head
     * 
     * @hooked law_firm_head
    */
    do_action( 'law_firm_before_wp_head' );

    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <?php wp_body_open(); ?>
    <?php 
    /**
     * Before Header
     * 
     * @hooked law_firm_page_start - 20 
    */
    do_action( 'law_firm_before_header' );
    
    /**
     * Header
     * 
     * @hooked law_firm_header_inclusion - 10     
    */
    do_action( 'law_firm_header' );
    
    /**
     * Before Content
     * 
     * @hooked law_firm_background_header   -10
     * @hooked law_firm_skip_content_div    -20
    */
    do_action( 'law_firm_after_header' );