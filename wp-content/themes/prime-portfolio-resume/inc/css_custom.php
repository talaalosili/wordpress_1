<?php

$prime_portfolio_resume_custom_css = "";

/*-------------------- Container Width-------------------*/

$prime_portfolio_resume_theme_width = get_theme_mod( 'prime_portfolio_resume_theme_width','full-width');

if($prime_portfolio_resume_theme_width == 'full-width'){
$prime_portfolio_resume_custom_css .='body{';
	$prime_portfolio_resume_custom_css .='max-width: 100% !important;';
$prime_portfolio_resume_custom_css .='}';
}else if($prime_portfolio_resume_theme_width == 'container'){
$prime_portfolio_resume_custom_css .='body{';
	$prime_portfolio_resume_custom_css .='width: 80% !important; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';
$prime_portfolio_resume_custom_css .='}';
}else if($prime_portfolio_resume_theme_width == 'container-fluid'){
$prime_portfolio_resume_custom_css .='body{';
	$prime_portfolio_resume_custom_css .='width: 95% !important;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
$prime_portfolio_resume_custom_css .='}';
}