<?php 
/**
 * Front Quote Section
 * 
 * @package law-firm
 */

$toggle_section     = get_theme_mod( 'toggle_front_quote', false );
$quotes_heading     = get_theme_mod( 'front_quotes_heading' );
$bg_img             = get_theme_mod( 'quotes_bg_img' );
$quotes_img         = get_theme_mod( 'front_quotes_img' );
$quotes_image_id    = attachment_url_to_postid( $quotes_img );
$person_name        = get_theme_mod( 'front_quotes_persons_name' );
$person_designation = get_theme_mod( 'front_quotes_persons_designation' );

// background image
$background_style = $bg_img 
    ? 'background-image : url("' . esc_url( $bg_img ) . '");'
    : 'background: var(--law-fallback-bg-color);';

if ( $toggle_section && ( $quotes_heading || $bg_img || $quotes_image_id || $person_name || $person_designation ) ) { ?>
    <section class="quote-section <?php echo ! $bg_img ? esc_attr('no-bg-img') : ''  ?>" id="front-quotes" style="<?php echo esc_attr( $background_style ); ?>">
        <div class="container">
            <?php if( $quotes_heading || $quotes_image_id || $person_name || $person_designation ){ ?>
                <div class="quote-wrapper">
                    <?php if( $quotes_heading ){ ?>
                        <div class="section-header text-center">
                            <h2 class="section-header__title"><?php echo esc_html( $quotes_heading ); ?></h2>
                        </div>
                    <?php } if( $quotes_image_id || $person_name || $person_designation ){ ?>
                        <div class="quote-author">
                            <?php if( $quotes_image_id ){ ?>
                                <div class="author-img">
                                    <?php if ( $quotes_image_id ){
                                        echo wp_get_attachment_image( $quotes_image_id, 'thumbnail', false, array('class'=>'profile-pic profile-md') );
                                    } ?>
                                </div>
                            <?php } if( $person_name ){ ?>
                                <cite class="fau-name"><?php echo esc_html( $person_name ); ?></cite>
                            <?php } if( $person_designation ){ ?>
                                <strong class="fau-desig"><?php echo esc_html( $person_designation ); ?></strong>
                            <?php } ?>  
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php }