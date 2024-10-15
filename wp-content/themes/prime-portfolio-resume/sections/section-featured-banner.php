<?php
/**
 * Banner Section
 * 
 * @package prime_portfolio_resume
 */
$prime_portfolio_resume_social_icon  = get_theme_mod( 'prime_portfolio_resume_social_icon_setting', false);
$prime_portfolio_resume_phone        = get_theme_mod( 'prime_portfolio_resume_header_phone' );
$prime_portfolio_resume_email        = get_theme_mod( 'prime_portfolio_resume_header_email' ); ?>

<?php 
$prime_portfolio_resume_slider = get_theme_mod( 'prime_portfolio_resume_slider_setting',false );
if ( $prime_portfolio_resume_slider ){ ?>
  <div class="banner">
          <div class="banner_inner_box">
            <div class="container">
            <div class="row pt-3">
              <div class="col-xl-8 col-lg-8 col-md-7 align-self-center">  
                <div class="banner_box">
                  <?php if ( get_theme_mod('prime_portfolio_resume_banner_heading') ) : ?><h3><?php echo esc_html( get_theme_mod('prime_portfolio_resume_banner_heading') ); ?></h3><?php endif; ?>
                  <?php if ( get_theme_mod('prime_portfolio_resume_banner_content') ) : ?><p class="banner-content ms-lg-5 mb-3"><?php echo esc_html( get_theme_mod('prime_portfolio_resume_banner_content') ); ?></p><?php endif; ?>
                    <?php if ( $prime_portfolio_resume_phone ){?>
                        <span><a href="tel:<?php echo esc_attr($prime_portfolio_resume_phone);?>"><i class="<?php echo esc_attr(get_theme_mod('prime_portfolio_resume_phone_icon','fas fa-phone-volume')); ?>"></i>
                        <?php echo esc_html( $prime_portfolio_resume_phone);?></span></a></span>
                    <?php } ?>
                    <?php if ( $prime_portfolio_resume_email ){?>
                        <span class="mail"><a href="mailto:<?php echo esc_attr($prime_portfolio_resume_email);?>"><i class="<?php echo esc_attr(get_theme_mod('prime_portfolio_resume_mail_icon','far fa-envelope')); ?>"></i> <?php echo esc_html($prime_portfolio_resume_email);?></a></span><br>
                    <?php } ?>
                    <?php if ( $prime_portfolio_resume_social_icon ){?>
                      <div class="social-links">
                        <?php 
                          $prime_portfolio_resume_social_link1 = get_theme_mod( 'prime_portfolio_resume_social_link_1' );
                          $prime_portfolio_resume_social_link2 = get_theme_mod( 'prime_portfolio_resume_social_link_2' );
                          $prime_portfolio_resume_social_link3 = get_theme_mod( 'prime_portfolio_resume_social_link_3' );
                          $prime_portfolio_resume_social_link4 = get_theme_mod( 'prime_portfolio_resume_social_link_4' );
                          $prime_portfolio_resume_social_link5 = get_theme_mod( 'prime_portfolio_resume_social_link_5' );
                          $prime_portfolio_resume_social_link6 = get_theme_mod( 'prime_portfolio_resume_social_link_6' );

                          if ( ! empty( $prime_portfolio_resume_social_link1 ) ) {
                            echo '<a class="social1" href="' . esc_url( $prime_portfolio_resume_social_link1 ) . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                          }
                          if ( ! empty( $prime_portfolio_resume_social_link2 ) ) {
                            echo '<a class="social2" href="' . esc_url( $prime_portfolio_resume_social_link2 ) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
                          } 
                          if ( ! empty( $prime_portfolio_resume_social_link3 ) ) {
                            echo '<a class="social3" href="' . esc_url( $prime_portfolio_resume_social_link3 ) . '" target="_blank"><i class="fab fa-instagram"></i></a>';
                          }
                          if ( ! empty( $prime_portfolio_resume_social_link4 ) ) {
                            echo '<a class="social4" href="' . esc_url( $prime_portfolio_resume_social_link4 ) . '" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
                          }
                          if ( ! empty( $prime_portfolio_resume_social_link5 ) ) {
                            echo '<a class="social5" href="' . esc_url( $prime_portfolio_resume_social_link5 ) . '" target="_blank"><i class="fab fa-linkedin"></i></i></a>';
                          }
                          if ( ! empty( $prime_portfolio_resume_social_link6 ) ) {
                            echo '<a class="social6" href="' . esc_url( $prime_portfolio_resume_social_link6 ) . '" target="_blank"><i class="fab fa-youtube"></i></i></a>';
                          }
                        ?>
                      </div>
                    <?php } ?>
                  <?php if ( get_theme_mod('prime_portfolio_resume_slide_btn_url') ) : ?>    
                    <p class="btn-green mt-4">
                      <a href="<?php echo esc_url( get_theme_mod('prime_portfolio_resume_slide_btn_url') ); ?>"><?php esc_html_e('READ MORE','prime-portfolio-resume'); ?></a>
                    </p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-5 bannerr">
                <?php if ( get_theme_mod('prime_portfolio_resume_banner_image') ) : ?>
                    <img src="<?php echo esc_url( get_theme_mod('prime_portfolio_resume_banner_image') ); ?>">
                <?php endif; ?>
              </div>
        
            </div>
          </div>
          </div>
  </div>
<?php } ?>