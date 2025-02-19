<?php
/**
 * Front Partner Section
 * 
 * @package law-firm
 */
$toggle_section   = get_theme_mod( 'toggle_front_partner', false );
$partner_repeater = get_theme_mod( 'front_partner_repeater', array() );

if( $toggle_section && $partner_repeater ){?>
    <section class="sponsers__section bg-gray" id="front-partner" >
        <div class="container">
            <?php foreach( $partner_repeater as $partner ){
                $partner_thumb = ( isset( $partner['thumbnail'] ) && !empty( $partner['thumbnail'] ) ) ? $partner['thumbnail'] : false;  
                if( $partner_thumb ){ ?>
                    <div class="partner-box">
                        <div class="sponser__img">
                            <?php echo wp_get_attachment_image( $partner_thumb,'full' ); ?>
                        </div>
                    </div>
                <?php 
                }
            } ?>
        </div>
    </section>
<?php }