<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prime_portfolio_resume
 */
$prime_portfolio_resume_preloader_setting  = get_theme_mod( 'prime_portfolio_resume_preloader_setting' , false );


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
     	if ( $prime_portfolio_resume_preloader_setting ){ ?>
        <div class="preloader">
            <div class="load">
              <div class="loader"></div>
            </div>
        </div>
     <?php } ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e('Skip to content (Press Enter)', 'prime-portfolio-resume'); ?></a>
        <?php
        /**
         * prime_portfolio_resume Header
         * 
         * @hooked prime_portfolio_resume_header - 20
         */
        do_action('prime_portfolio_resume_header');
        echo '<div id="acc-content"><!-- done for accessibility purpose -->';

        echo '<div class="single-header-img">';

		if (!is_front_page() || is_home()) {
			if (is_single() || is_page() || (function_exists('is_shop') && is_shop()) || is_archive() || is_search() || is_404() || is_home()) {
				if (!is_page_template('template-homepage.php')) {
					echo '<div class="post-thumbnail">';
					if (function_exists('is_shop') && (is_shop() || function_exists('is_product') && is_product())) {
						$prime_portfolio_resume_default_image_url = get_template_directory_uri() . '/images/default-header.png'; 
						echo '<img src="' . esc_url($prime_portfolio_resume_default_image_url) . '" alt="Default Image" itemprop="image">';
					} else {
						if (has_post_thumbnail()) {
							(is_active_sidebar('right-sidebar')) ? the_post_thumbnail('prime-portfolio-resume-with-sidebar', array('itemprop' => 'image')) : the_post_thumbnail('prime-portfolio-resume-without-sidebar', array('itemprop' => 'image'));
						} else {
							$prime_portfolio_resume_default_image_url = get_template_directory_uri() . '/images/default-header.png'; 
							echo '<img src="' . esc_url($prime_portfolio_resume_default_image_url) . '" alt="Default Image" itemprop="image">';
						}
					}
					echo '</div>';
					echo '<div class="single-header-heading">';
					prime_portfolio_resume_custom_blog_banner_title();
					echo '</div>';
				}
			}
		}
	
		echo '</div>';
        echo '<div class="wrapper">';
        echo '<div class="container home-container">';
        echo '<div id="content" class="site-content">';
        ?>