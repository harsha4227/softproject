<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Law_Firm
 */


    /**
     * Footer
     * 
     * @hooked law_firm_footer_start  - 20
     * @hooked law_firm_footer_main   - 30
     * @hooked law_firm_footer_bottom - 40
     * @hooked law_firm_footer_end    - 50
    */
    do_action( 'law_firm_footer' );

    /**
     * After Footer
     * 
     * @hooked law_firm_page_end        - 10
    */
    do_action( 'law_firm_after_footer' );
    
    wp_footer(); ?>

    </body>
</html>