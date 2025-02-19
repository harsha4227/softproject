<?php 
/**
 * Front About Section
 * 
 * @package law-firm
 * 
 */
$toggle_about       = get_theme_mod( 'toggle_about', false );  
$abt_img            = get_theme_mod( 'about_image' );
$abtimg_quotes      = get_theme_mod( 'about_img_quotes' );
$abt_heading        = get_theme_mod( 'about_headings' );
$abt_descs          = get_theme_mod( 'about_descriptions' );
$abt_btn_txt        = get_theme_mod( 'about_btn_txt' );
$abt_btn_link       = get_theme_mod( 'about_btn_link' );
$front_abt_repeater = get_theme_mod( 'front_about_repeaters');

$image_id = attachment_url_to_postid( $abt_img ); 

if( $toggle_about && ( ( $image_id && $abtimg_quotes ) ||  $abt_heading || $abt_descs || ( $abt_btn_txt && $abt_btn_link ) || $front_abt_repeater ) ){ ?>
    <section class="about-section front-about" id="front-about" >
        <div class="container">
            <div class="about-wrapper">
                <?php if( $image_id && $abtimg_quotes ){ ?>
                    <div class="about-left">
                        <?php if( $image_id ){ 
                            echo wp_get_attachment_image( $image_id, 'about_image_size' );
                        } if(  $abtimg_quotes ){ ?>
                            <span class="img-quote"><?php echo esc_html( $abtimg_quotes ); ?></span>
                        <?php } ?>
                    </div>
                <?php } if( $abt_heading || $abt_descs || ( $abt_btn_txt && $abt_btn_link ) || $front_abt_repeater ){ ?>
                    <div class="about-right">
                        <?php if( $abt_heading || $abt_descs ){ ?>
                            <div class="section-header">
                                <?php if( $abt_heading ){ ?>
                                    <h2 class="section-header__title">
                                        <?php echo esc_html( $abt_heading ); ?>
                                    </h2>
                                <?php } if( $abt_descs ){ ?>
                                    <div class="section-header__description">
                                        <p><?php echo esc_html( $abt_descs ); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if( $front_abt_repeater ){ ?>
                            <div class="accordion-wrapper ">
                                <ul class="accordion style-two">
                                    <?php foreach ( $front_abt_repeater as $repeater ){
                                        $title = ( ! empty( $repeater['text'] ) && isset( $repeater['text'] ) ) ? $repeater['text'] : '';
                                        $descs = ( ! empty( $repeater['description'] ) && isset( $repeater['description'] ) ) ? $repeater['description'] : '';

                                        if( $title || $descs ){ ?>
                                            <li class="accordion-item">
                                                <?php if( $title ){ ?>
                                                    <button class="accordion-button">
                                                        <p><?php echo esc_html( $title ); ?></p>
                                                    </button>
                                                <?php }if( $descs ){ ?>
                                                    <div class="accordion-content">
                                                        <?php echo wpautop( esc_html( $descs ) ); ?>
                                                    </div>
                                                <?php } ?>
                                            </li>  
                                        <?php
                                        }
                                    } ?>
                                </ul>
                            </div>
                        <?php } if( $abt_btn_txt && $abt_btn_link ){ ?>
                            <a href="<?php echo esc_url( $abt_btn_link ); ?>" class="btn btn-primary"><?php echo esc_html( $abt_btn_txt ); ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php }