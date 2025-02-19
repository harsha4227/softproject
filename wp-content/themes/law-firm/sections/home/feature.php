<?php
/**
 * Front Feature Section
 * 
 * @package law-firm
 */
$front_features_repeater = get_theme_mod( 'front_features_repeater', array() );
$toggle_section          = get_theme_mod( 'toggle_front_feature', false );

if ( $toggle_section && $front_features_repeater ) { ?>
    <section class="feature-section bg-primary" id="front-features">
        <div class="feature-wrapper">
            <?php foreach ( $front_features_repeater as $repeater ) {
                $heading    = (! empty($repeater['heading']) && isset($repeater['heading'])) ? $repeater['heading'] : "";
                $subheading = (! empty($repeater['subheading']) && isset($repeater['subheading'])) ? $repeater['subheading'] : "";
                $image      = (! empty($repeater['image']) && isset($repeater['image'])) ? $repeater['image'] : "";
                $url        = (! empty($repeater['url']) && isset($repeater['url'])) ? $repeater['url'] : "";

                if ( $heading || $subheading || $image || $url ) { ?>
                    <div class="feature__card text-center">
                        <a href="<?php echo esc_url( $url ); ?>">
                            <?php if ( $image ) { ?>
                                <div class="feature-image">
                                    <?php echo wp_get_attachment_image( $image, 'thumbnail', true ) ?>
                                </div>
                            <?php } if ( $heading || $subheading ) { ?>
                                <h2 class="feature__title">
                                    <span class="feature__stitle"><?php echo esc_html( $subheading ); ?></span>
                                    <br>
                                    <?php echo esc_html( $heading ); ?>
                                </h2>
                            <?php } ?>
                        </a>
                    </div>
                <?php
                }
            } ?>
        </div>
    </section>
<?php
}