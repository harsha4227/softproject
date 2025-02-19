<?php
/**
 * Front Banner Section
 * 
 * @package law-firm
 */
$banner_toggle        = get_theme_mod( 'banner_toggle', true );
$s_banner_subheading  = get_theme_mod( 'ban_six_subheading', __( 'Integrity. Expertise. Results', 'law-firm' ) );
$s_banner_heading     = get_theme_mod( 'ban_three_heading', sprintf( esc_html__( '%sTrusted%s Legal Advisors %sFor All Your Needs%s', 'law-firm' ), '<span class="highlight">', '</span>', '<span class="highlight">', '</span>') );
$s_banner_desc        = get_theme_mod( 'ban_three_descs', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'law-firm') );
$s_banner_btn         = get_theme_mod( 'ban_three_btn_text', __( 'Know More', 'law-firm') );
$s_banner_btn_link    = get_theme_mod( 'ban_three_btn_link', "#" );
$s_banner_contact_btn = get_theme_mod( 'ban_six_contact_btn_text', __( 'Contact Now', 'law-firm') );
$s_banner_contact_num = get_theme_mod( 'ban_six_contact_num', __( '+1-800-111-2222', 'law-firm' ) );

if( $banner_toggle && ( $s_banner_subheading || $s_banner_heading || $s_banner_desc || ( $s_banner_btn && $s_banner_btn_link ) || ( $s_banner_contact_btn && $s_banner_contact_num ) ) ) {?>
    <section id="banner-section" class="banner-six <?php if( has_header_video() ) echo esc_attr( ' banner-video ' ); ?>" >
        <?php the_custom_header_markup(); ?>
        <div class="banner__content">
            <div class="container">
                <div class="banner-content-wrap">
                    <?php if( $s_banner_subheading || $s_banner_heading || $s_banner_desc ){ ?>
                        <div class="banner__left">
                            <div class="banner-left-wrap">
                                <?php if( $s_banner_subheading ){ ?>
                                    <span class="banner-subheading"><?php echo esc_html( $s_banner_subheading ); ?></span>
                                <?php } ?>
                                <?php if( $s_banner_heading ){ ?>
                                    <div class="banner__title-wrapper">
                                        <h2 class="section-header__title"><?php echo wp_kses_post( $s_banner_heading ); ?></h2>
                                    </div>
                                <?php } ?>
                                <?php if( $s_banner_desc ){ ?>
                                    <div class="banner__description-wrapper">
                                        <span class="banner__description"><?php echo esc_html( $s_banner_desc ); ?></span>
                                    </div>
                                <?php } ?>
                                <?php if( ( $s_banner_btn && $s_banner_btn_link ) || ( $s_banner_contact_btn && $s_banner_contact_num ) ){ ?>
                                    <div class="banner__bottom">
                                            <?php if ( $s_banner_btn && $s_banner_btn_link ){ ?>
                                                <a href="<?php echo esc_url( $s_banner_btn_link ); ?>" class="btn btn-primary"><?php echo esc_html( $s_banner_btn ); ?></a>
                                            <?php } if( $s_banner_contact_btn && $s_banner_contact_num ){ ?>
                                                <a href="<?php echo esc_url('tel:' .  preg_replace('/[^\d+]/', '', $s_banner_contact_num ) ); ?>" class="btn btn-layout-two">
                                                    <span class="icon">
                                                    <?php echo wp_kses( law_firm_handle_all_svgs( 'contact-ph' ), law_firm_get_kses_extended_ruleset() ); ?>                                         
                                                    </span>                       
                                                    <?php echo esc_html( $s_banner_contact_btn ); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php }