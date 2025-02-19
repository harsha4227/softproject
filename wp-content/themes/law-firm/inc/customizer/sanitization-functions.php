<?php
/**
 * Sanitization Functions
 * 
 * @package law_firm
*/
if( ! function_exists( 'law_firm_sanitize_empty_absint' ) ) :
    /**
     * Sanitizes Empty Absint
     */
	function law_firm_sanitize_empty_absint( $input ) {
		if ( '' == $input ) {
			return '';
		}
		return absint( $input );
	}
endif;

if( ! function_exists( 'law_firm_sanitize_checkbox' ) ) :
    /**
     * Sanitize Checkbox
     */
	function law_firm_sanitize_checkbox( $checked ){
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;


if ( ! function_exists( 'law_firm_radio_sanitization_header' ) ) {
	/**
	 * Function for Sanitization Header
	 */
    function law_firm_radio_sanitization_header( $input, $setting ) {
        //get the list of possible radio box or select options
        $choices = $setting->manager->get_control( $setting->id )->choices;
            if ( array_key_exists( $input, $choices ) ) {
                return $input;
            } else {
                return $setting->default;
            }
        }
}


if( ! function_exists( 'law_firm_sanitize_code' ) ) :
	/**
	 * Function for Sanitizing Code
	 */
	function law_firm_sanitize_code( $value ){
		return htmlspecialchars_decode( stripslashes( $value ) );
	}
endif;