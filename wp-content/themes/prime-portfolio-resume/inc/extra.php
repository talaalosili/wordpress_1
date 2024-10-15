<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prime_portfolio_resume
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function prime_portfolio_resume_body_classes( $classes ) {
  global $prime_portfolio_resume_post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog ';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( prime_portfolio_resume_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
        $classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'prime_portfolio_resume_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function prime_portfolio_resume_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'prime_portfolio_resume_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function prime_portfolio_resume_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'prime_portfolio_resume_excerpt_more' );


if( ! function_exists( 'prime_portfolio_resume_footer_credit' ) ):
/**
 * Footer Credits
*/
function prime_portfolio_resume_footer_credit() {
    $prime_portfolio_resume_copyright_text = get_theme_mod('prime_portfolio_resume_footer_copyright_text');

    $prime_portfolio_resume_text = '<div class="site-info"><div class="container"><span class="copyright">';
    if ($prime_portfolio_resume_copyright_text) {
        $prime_portfolio_resume_text .= wp_kses_post($prime_portfolio_resume_copyright_text); 
    } else {
        $prime_portfolio_resume_text .= esc_html__('&copy; ', 'prime-portfolio-resume') . date_i18n(esc_html__('Y', 'prime-portfolio-resume')); 
        $prime_portfolio_resume_text .= ' <a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'prime-portfolio-resume');
    }
    $prime_portfolio_resume_text .= '</span>';
    $prime_portfolio_resume_text .= '<span class="by"> <a href="' . esc_url('https://www.themeignite.com/products/free-portfolio-wordpress-theme') . '" rel="nofollow" target="_blank">' . PRIME_PORTFOLIO_RESUME_THEME_NAME . '</a>' . esc_html__(' By ', 'prime-portfolio-resume') . '<a href="' . esc_url('https://themeignite.com/') . '" rel="nofollow" target="_blank">' . esc_html__('Themeignite', 'prime-portfolio-resume') . '</a>.';
    $prime_portfolio_resume_text .= sprintf(esc_html__(' Powered By %s', 'prime-portfolio-resume'), '<a href="' . esc_url(__('https://wordpress.org/', 'prime-portfolio-resume')) . '" target="_blank">WordPress</a>.');
    if (function_exists('the_privacy_policy_link')) {
        $prime_portfolio_resume_text .= get_the_privacy_policy_link();
    }
    $prime_portfolio_resume_text .= '</span></div></div>';
    echo apply_filters('prime_portfolio_resume_footer_text', $prime_portfolio_resume_text);
}
add_action('prime_portfolio_resume_footer', 'prime_portfolio_resume_footer_credit');
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'prime_portfolio_resume_woocommerce_activated' ) ) {
  function prime_portfolio_resume_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'prime_portfolio_resume_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function prime_portfolio_resume_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $prime_portfolio_resume_commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $prime_portfolio_resume_aria_req = ( $req ? " aria-required='true'" : '' );
    $prime_portfolio_resume_required = ( $req ? " required" : '' );
    $prime_portfolio_resume_author   = ( $req ? __( 'Name*', 'prime-portfolio-resume' ) : __( 'Name', 'prime-portfolio-resume' ) );
    $prime_portfolio_resume_email    = ( $req ? __( 'Email*', 'prime-portfolio-resume' ) : __( 'Email', 'prime-portfolio-resume' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'prime-portfolio-resume' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $prime_portfolio_resume_author ) . '" type="text" value="' . esc_attr( $prime_portfolio_resume_commenter['comment_author'] ) . '" size="30"' . $prime_portfolio_resume_aria_req . $prime_portfolio_resume_required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'prime-portfolio-resume' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $prime_portfolio_resume_email ) . '" type="text" value="' . esc_attr(  $prime_portfolio_resume_commenter['comment_author_email'] ) . '" size="30"' . $prime_portfolio_resume_aria_req . $prime_portfolio_resume_required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'prime-portfolio-resume' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'prime-portfolio-resume' ) . '" type="text" value="' . esc_attr( $prime_portfolio_resume_commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'prime_portfolio_resume_change_comment_form_default_fields' );

if( ! function_exists( 'prime_portfolio_resume_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function prime_portfolio_resume_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'prime-portfolio-resume' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'prime-portfolio-resume' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'prime_portfolio_resume_change_comment_form_defaults' );

if( ! function_exists( 'prime_portfolio_resume_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function prime_portfolio_resume_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
    /**
     * Triggered after the opening <body> tag.
    */
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'prime_portfolio_resume_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function prime_portfolio_resume_get_fallback_svg( $prime_portfolio_resume_post_thumbnail ) {
    if( ! $prime_portfolio_resume_post_thumbnail ){
        return;
    }
    
    $prime_portfolio_resume_image_size = prime_portfolio_resume_get_image_sizes( $prime_portfolio_resume_post_thumbnail );
     
    if( $prime_portfolio_resume_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $prime_portfolio_resume_image_size['width'] ); ?> <?php echo esc_attr( $prime_portfolio_resume_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $prime_portfolio_resume_image_size['width'] ); ?>" height="<?php echo esc_attr( $prime_portfolio_resume_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function prime_portfolio_resume_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';


    wp_enqueue_style(
            'google-fonts-libre-baskerville',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
            'google-fonts-montserrat',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
            'google-fonts-courgette',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Courgette&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'prime_portfolio_resume_enqueue_google_fonts' );


if( ! function_exists( 'prime_portfolio_resume_site_branding' ) ) :
/**
 * Site Branding
*/
function prime_portfolio_resume_site_branding(){
    $prime_portfolio_resume_logo_site_title = get_theme_mod( 'header_site_title', 1 );
    $prime_portfolio_resume_tagline = get_theme_mod( 'header_tagline', false );
    $prime_portfolio_resume_logo_width = get_theme_mod('logo_width', 100); // Retrieve the logo width setting

    ?>
    <div class="site-branding" style="max-width: <?php echo esc_attr(get_theme_mod('logo_width', '-1'))?>px;">
        <?php 
        // Check if custom logo is set and display it
        if (function_exists('has_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        }
        if ($prime_portfolio_resume_logo_site_title):
             if (is_front_page()): ?>
            <h1 class="site-title" style="font-size: <?php echo esc_attr(get_theme_mod('prime_portfolio_resume_site_title_size', '30')); ?>px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
            <?php else: ?>
                <p class="site-title" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>
        <?php endif; 
    
        if ($prime_portfolio_resume_tagline) :
            $prime_portfolio_resume_description = get_bloginfo('description', 'display');
            if ($prime_portfolio_resume_description || is_customize_preview()) :
        ?>
                <p class="site-description" itemprop="description"><?php echo $prime_portfolio_resume_description; ?></p>
            <?php endif;
        endif;
        ?>
    </div>
    <?php
}
endif;
if( ! function_exists( 'prime_portfolio_resume_navigation' ) ) :
/**
 * Site Navigation
*/
function prime_portfolio_resume_navigation(){
    ?>
    <nav class="main-navigation" id="site-navigation"  role="navigation">
        <?php 
        wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_id' => 'primary-menu' 
        ) ); 
        ?>
    </nav>
    <?php
}
endif;


if( ! function_exists( 'prime_portfolio_resume_header' ) ) :
/**
 * Header Start
*/
function prime_portfolio_resume_header(){
      $prime_portfolio_resume_header_image = get_header_image();
      $prime_portfolio_resume_sticky_header = get_theme_mod('prime_portfolio_resume_sticky_header');
    ?>
    <div id="page-site-header">
        <header id="masthead" data-sticky="<?php echo $prime_portfolio_resume_sticky_header; ?>" class="site-header header-inner" role="banner" style="background-image: url('<?php echo esc_url( $prime_portfolio_resume_header_image ); ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 align-self-center">
                        <?php prime_portfolio_resume_site_branding(); ?>
                    </div>
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <div class="mobile-nav">
                            <button class="toggle-button" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                                <span class="toggle-bar"></span>
                                <span class="toggle-bar"></span>
                                <span class="toggle-bar"></span>
                            </button>
                            <div class="mobile-nav-wrap">
                                <nav class="main-navigation" id="mobile-navigation"  role="navigation">
                                    <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                                        <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                                        <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'prime-portfolio-resume' ); ?>">
                                            <?php
                                                wp_nav_menu( array(
                                                    'theme_location' => 'primary',
                                                    'menu_id'        => 'mobile-primary-menu',
                                                    'menu_class'     => 'nav-menu main-menu-modal',
                                                ) );
                                            ?>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <?php prime_portfolio_resume_navigation(); ?>
                    </div>
                    <?php if( get_theme_mod('prime_portfolio_resume_show_hide_search',false) != ''){ ?>
                        <div class="col-lg-1 col-md-12 align-self-center">
                            <div class="search-body text-center align-self-center text-lg-end">
                                <button type="button" class="search-show"><i class="<?php echo esc_attr(get_theme_mod('prime_portfolio_resume_search_icon','fas fa-search')); ?>"></i></button>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="searchform-inner">
                        <?php get_search_form(); ?>
                        <button type="button" class="close"aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>  
                    </div>
                </div>
            </div>
        </header>
    </div>
    <?php
}
endif;
add_action( 'prime_portfolio_resume_header', 'prime_portfolio_resume_header', 20 );
