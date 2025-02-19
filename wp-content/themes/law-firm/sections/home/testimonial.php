<?php
/**
 * Front Testimonial Section
 * 
 * @package law-firm
 */

$toggle_section                = get_theme_mod( 'toggle_front_testimonial', false );
$front_testimonial_heading     = get_theme_mod( 'testimonial_headings' );
$front_testimonial_description = get_theme_mod( 'testimonial_descriptions' );
$front_testimony               = get_theme_mod( 'testimonial_title' );
$front_testimony_desc          = get_theme_mod( 'testimonial_desc' );
$front_author_designation      = get_theme_mod( 'testimonial_author_designation' );
$front_testimonial_author      = get_theme_mod( 'testimonial_author' );
$front_testimonial_img         = get_theme_mod( 'testimonial_testimony_img' );
$testimonial_image_id          = attachment_url_to_postid( $front_testimonial_img ); 
    
if( $toggle_section && ( $front_testimonial_heading || $front_testimonial_description || $front_testimony || $front_testimony_desc || $front_author_designation || $front_testimonial_author || $testimonial_image_id ) ){ ?>
    <section class="testimonial-section bg-gray fronttestimonial" id="front-testimonial">
        <div class="container">
            <?php if( $front_testimonial_heading || $front_testimonial_description ){ ?>
                <div class="section-header text-center">
                    <?php if( $front_testimonial_heading ){ ?>
                        <h2 class="section-header__title"><?php echo esc_html( $front_testimonial_heading ); ?></h2>
                    <?php } if( $front_testimonial_description ){ ?>
                        <div class="section-header__description">
                            <p><?php echo esc_html( $front_testimonial_description ); ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } if( $front_testimony || $front_testimony_desc || $front_author_designation || $front_testimonial_author || $testimonial_image_id ){ ?>
                <div class="testimonial__card">
                    <?php if( $front_testimony || $front_testimony_desc || $front_author_designation || $front_testimonial_author ){ ?>
                        <div class="testimonial__card-left">
                            <div class="testimonial__content">
                                <?php
                                    if( $front_testimony ) echo '<h5 class="testimony">' . esc_html( $front_testimony ) . '</h5>'; 
                                    if( $front_testimony_desc )  echo '<p class="testimony-description">' . esc_html( $front_testimony_desc ) . '</p>';

                                    if( $front_author_designation || $front_testimonial_author ){ ?>
                                        <div class="author"> 
                                            <?php 
                                                if( $front_author_designation ) echo '<span>' . esc_html( $front_author_designation ). '</span>' ;
                                                if( $front_testimonial_author ) echo '<h6>'. esc_html( $front_testimonial_author ). '</h6>' ;?>
                                        </div>
                                    <?php 
                                    } 
                                ?>
                            </div>
                        </div>
                    <?php } if( $testimonial_image_id ){?>
                        <div class="testimonial__card-right">
                            <figure class="author__img"> 
                                <?php echo wp_get_attachment_image( $testimonial_image_id, 'testimonial_img' ); ?>
                            </figure>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?> 
        </div>
    </section>
<?php }