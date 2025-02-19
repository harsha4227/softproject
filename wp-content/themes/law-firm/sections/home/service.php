<?php

/**
 * Front Service Section
 * 
 * @package law-firm
 */

$toggle_section          = get_theme_mod( 'toggle_front_service', false );
$heading_setting         = get_theme_mod('service_headings');
$description             = get_theme_mod('service_descriptions');
$btn_text                = get_theme_mod('service_btn_text');
$btn_link                = get_theme_mod('service_btn_link');
$readmore_btn            = get_theme_mod('service_readmore_btn_text');
$front_services_repeater = get_theme_mod('front_services_repeater', array());

if( $toggle_section && ( $heading_setting || $description || ( $btn_text && $btn_link ) || $readmore_btn || $front_services_repeater ) ) { ?>
    <section class="services-section front-service" id="front-service">
        <div class="container">
            <div class="services-wrapper">
                <?php if ( $heading_setting || $description ) { ?>
                    <div class="section-header text-center">
                        <?php if ( $heading_setting ) { ?>
                            <h2 class="section-header__title"><?php echo wp_kses_post( $heading_setting ); ?></h2>
                        <?php }
                        if ( $description ) { ?>
                            <div class="section-header__description">
                                <p><?php echo wp_kses_post( $description ); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                if ( $front_services_repeater ) { ?>
                    <ul class="services">
                        <?php foreach ( $front_services_repeater as $repeater ) {
                            $title = ( ! empty( $repeater['service'] ) && isset( $repeater['service'] ) ) ? $repeater['service'] : '';
                            $descs = ( ! empty( $repeater['description'] ) && isset( $repeater['description'] ) ) ? $repeater['description'] : '';
                            $post_link = ( ! empty( $repeater['post_link'] ) && isset( $repeater['post_link'] ) ) ? $repeater['post_link'] : '';

                            if ( $title || $descs ) { ?>
                                <li class="service">
                                    <div class="service__card">
                                        <h3 class="service__title"><?php echo esc_html( $title ); ?></h3>
                                        <div class="service__description">
                                            <?php echo esc_html( $descs ); ?>
                                        </div>
                                        <?php if ( $readmore_btn && $post_link ) { ?>
                                            <a href="<?php echo esc_url( $post_link ); ?>" class="btn btn-readmore"><?php echo esc_html( $readmore_btn ); ?></a>
                                        <?php } ?>
                                    </div>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                <?php }
                if ( $btn_text && $btn_link ) { ?>
                    <div class="service-btn__wrap">
                        <a href="<?php echo esc_url( $btn_link ); ?>" class="btn"><?php echo esc_html( $btn_text ); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php }
