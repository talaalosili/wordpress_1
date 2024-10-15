<?php 
/**
 * Template part for displaying Featured Blog Section
 *
 * @package prime_portfolio_resume
 */

$prime_portfolio_resume_about = get_theme_mod( 'prime_portfolio_resume_about_setting',true );?>

<?php if ( $prime_portfolio_resume_about ){?>
<div id="about-section" class="section-content py-5">
    <div class="container">
        <?php
         $prime_portfolio_resume_blog_section_title = get_theme_mod( 'prime_portfolio_resume_blog_section_title' );?>
            <div class="section-title mb-5 text-center">
                <?php if( $prime_portfolio_resume_blog_section_title ) { ?>
                    <h3><?php echo esc_html($prime_portfolio_resume_blog_section_title); ?></h3>
                <?php } ?>
            </div>
            <div class="owl-carousel">
                <?php 
                    $prime_portfolio_resume_catergory_name = get_theme_mod('prime_portfolio_resume_blog_args_');
                    $args = array(
                        'post_type'           => 'post',
                        'category_name'       => $prime_portfolio_resume_catergory_name,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true,
                    );?>
                    <?php
                    $loop = new WP_Query($args);
                    if ( $loop->have_posts() ) :
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class=" align-self-center px-0">
                                <div class="box">
                                    <?php
                                        if ( has_post_thumbnail() ) : ?>
                                            <div class="image-blog">
                                          <?php the_post_thumbnail();?>
                                          </div>
                                        <?php else:
                                          ?>
                                          <div class="image-blog">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/images/default-header.png'; ?>">
                                          </div>
                                          <?php
                                        endif;
                                      ?>
                                    <div class="box-content text-center">
                                        <h4 class="title mb-2">
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                        </h4>
                                    </div>
                                </div>
                                </div>
                        <?php endwhile;
                    endif;
                ?>
            </div>
    </div>
</div>
<?php } ?>