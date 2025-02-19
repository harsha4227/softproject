<?php
/**
 * Front Counter Section
 * 
 * @package law-firm
 */

$toggle_front_counter    = get_theme_mod( 'toggle_front_counter', false ); 
$front_counter_repeaters = get_theme_mod( 'front_counter_repeaters', array() );

if( $toggle_front_counter && $front_counter_repeaters ){ ?>
    <section class="counter-section bg-primary" id="front-counter" >
        <div class="counter-wrapper">
            <?php foreach( $front_counter_repeaters as $repeater ){ 
                $counter_title  = ( ! empty($repeater['title']) && isset( $repeater['title'] ) ) ? $repeater['title'] : "";
                $counter_count  = ( ! empty($repeater['counter']) && isset( $repeater['counter'] ) ) ? $repeater['counter'] : "";
                $counter_prefix = ( ! empty($repeater['prefix']) && isset( $repeater['prefix'] ) ) ? $repeater['prefix'] : "";
                $counter_desc   = ( ! empty($repeater['description']) && isset( $repeater['description'] ) ) ? $repeater['description'] : "";
                
                if( $counter_title || ( $counter_count && $counter_prefix ) || $counter_desc ){ ?>
                    <div class="counter__card text-center">
                        <?php if( $counter_count && $counter_prefix ){ ?>
                            <span class="counter__number" data-count="<?php echo esc_attr( $counter_count )?>" data-prefix="<?php echo esc_attr( $counter_prefix )?>"></span>
                        <?php } if( $counter_title ){ ?>
                            <h2 class="counter__title"><?php echo esc_html( $counter_title );?></h2>
                        <?php } if( $counter_desc ){ ?>
                            <div class="counter__description">
                                <p><?php echo esc_html( $counter_desc );?> </p>
                            </div>  
                        <?php } ?>  
                    </div>
                <?php } 
            } ?>
        </div>
    </section>
<?php }