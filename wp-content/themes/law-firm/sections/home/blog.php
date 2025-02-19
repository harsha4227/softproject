<?php
/**
 * Front Blog Section
 * 
 * @package law-firm
 */

$toggle_front_blog        = get_theme_mod( 'toggle_front_blog', true );
$front_blog_heading       = get_theme_mod( 'front_blog_heading', __( 'Our Latest News Blogs', 'law-firm' ) );
$front_blog_description   = get_theme_mod( 'front_blog_description', __( 'Identifying the ideal legal strategy for you and your company. Reduce the price of your legal fees.', 'law-firm' ) );
$front_blog_btn_text      = get_theme_mod( 'front_blog_btn_text', __( 'View All Blogs', 'law-firm' ) );
$front_blog_btn_link      = get_theme_mod( 'blog_btn_link_setting', '#' );
$front_blog_readmore_text = get_theme_mod( 'front_blog_readmore_text', 'Read More' );

$args = array(
    'posts_status'        => 'publish',
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$posts = new WP_Query( $args );

if( $toggle_front_blog && ( $front_blog_heading || $front_blog_description || ( $front_blog_btn_text && $front_blog_btn_link ) || $front_blog_readmore_text ) ){ ?>
    <section class="latest__blog-section front-blog" id="front-blog">
        <div class="container">
            <?php if ( $front_blog_heading || $front_blog_description || ( $front_blog_btn_text && $front_blog_btn_link ) ){ ?>
                <div class="latest__blog-top">
                    <?php if( $front_blog_heading || $front_blog_description ){ ?>
                        <div class="section-header">
                            <?php if( $front_blog_heading ){ ?>
                                <h2 class="section-header__title"><?php echo esc_html( $front_blog_heading ); ?></h2>
                            <?php } if( $front_blog_description ){ ?>
                                <div class="section-header__description">
                                    <?php echo wpautop( esc_html( $front_blog_description ) ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } if( $front_blog_btn_text && $front_blog_btn_link ){ ?>
                        <a href="<?php echo esc_url( $front_blog_btn_link ); ?>" class="btn btn-primary"><?php echo esc_html( $front_blog_btn_text ); ?></a>
                    <?php } ?>
                </div>
            <?php } if( $posts->have_posts() ) { ?>
                    <div class="latest__blog-wrapper">
                        <?php while( $posts->have_posts() ){ 
                            $posts->the_post();
                            ?>
                            <article class="post">
                                <div class="blog__card">
                                    <?php 
                                        echo '<figure class="blog__img">
                                            <a href="' . esc_url( get_permalink() ) . '">';
                                            if( has_post_thumbnail() ){                                   
                                                the_post_thumbnail( 'blog_card_image' );               
                                            }else{
                                                law_firm_get_fallback_svg( 'blog_card_image' );
                                            }
                                        echo '</a>';
                                        law_firm_posted_on();
                                        echo '</figure>';
                                    ?>
                                    <div class="blog__info">
                                        <header class="entry-header blog__top">
                                            <div class="entry-meta">
                                                <div class="entry-categories">
                                                    <?php law_firm_category(); ?>
                                                </div> 
                                                <div class="comment">
                                                    <?php law_firm_get_comment_count(); ?>
                                                </div>
                                            </div>
                                            <h3 class="entry-title">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </header>
                                        <?php if( has_excerpt() ){
                                                the_excerpt();
                                            }else{
                                                echo wpautop( wp_trim_words( get_the_content(), 15, '..' ) );
                                            } if( $front_blog_readmore_text ) { ?>
                                                <div class="blog__bottom">
                                                    <a class="btn btn-readmore" href="<?php the_permalink(); ?>">
                                                        <?php echo esc_html( $front_blog_readmore_text ); ?>
                                                    </a>
                                                </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
            <?php } wp_reset_postdata(); ?>
        </div>
    </section>
<?php }