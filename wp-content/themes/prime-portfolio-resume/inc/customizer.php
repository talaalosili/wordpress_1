<?php
/**
 * Prime Portfolio Resume Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prime_portfolio_resume
 */

if( ! function_exists( 'prime_portfolio_resume_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prime_portfolio_resume_customize_register( $wp_customize ) {
    require get_parent_theme_file_path('/inc/controls/changeable-icon.php');
    

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'prime-portfolio-resume' );
    }
	
    /* Option list of all post */	
    $prime_portfolio_resume_options_posts = array();
    $prime_portfolio_resume_options_posts_obj = get_posts('posts_per_page=-1');
    $prime_portfolio_resume_options_posts[''] = esc_html__( 'Choose Post', 'prime-portfolio-resume' );
    foreach ( $prime_portfolio_resume_options_posts_obj as $prime_portfolio_resume_posts ) {
    	$prime_portfolio_resume_options_posts[$prime_portfolio_resume_posts->ID] = $prime_portfolio_resume_posts->post_title;
    }
    
    /* Option list of all categories */
    $prime_portfolio_resume_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $prime_portfolio_resume_option_categories = array();
    $prime_portfolio_resume_category_lists = get_categories( $prime_portfolio_resume_args );
    $prime_portfolio_resume_option_categories[''] = esc_html__( 'Choose Category', 'prime-portfolio-resume' );
    foreach( $prime_portfolio_resume_category_lists as $prime_portfolio_resume_category ){
        $prime_portfolio_resume_option_categories[$prime_portfolio_resume_category->term_id] = $prime_portfolio_resume_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'prime-portfolio-resume' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'prime-portfolio-resume' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */
    
    /** Site Title control */
    $wp_customize->add_setting( 
        'header_site_title', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_site_title',
        array(
            'label'       => __( 'Show / Hide Site Title', 'prime-portfolio-resume' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    /** Tagline control */
    $wp_customize->add_setting( 
        'header_tagline', 
        array(
            'default'           => false,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_tagline',
        array(
            'label'       => __( 'Show / Hide Tagline', 'prime-portfolio-resume' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('logo_width', array(
        'sanitize_callback' => 'absint', 
    ));

    // Add a control for logo width
    $wp_customize->add_control('logo_width', array(
        'label' => __('Logo Width', 'prime-portfolio-resume'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'min' => '50', 
            'max' => '500', 
            'step' => '5', 
    ),
        'default' => '100', 
    ));

    $wp_customize->add_setting( 'prime_portfolio_resume_site_title_size', array(
        'default'           => 30, // Default font size in pixels
        'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
    ) );

    // Add control for site title size
    $wp_customize->add_control( 'prime_portfolio_resume_site_title_size', array(
        'type'        => 'number',
        'section'     => 'title_tagline', // You can change this section to your preferred section
        'label'       => __( 'Site Title Font Size (px)', 'prime-portfolio-resume' ),
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
        ),
    ) );
    /** Post Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'prime-portfolio-resume' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_post_settings',
            'type'        => 'checkbox',
        )
    );
    /** Post ReadMore control */
     $wp_customize->add_setting( 'prime_portfolio_resume_read_more_setting`', array(
        'default'           => true,
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'prime_portfolio_resume_read_more_setting`', array(
        'type'        => 'checkbox',
        'section'     => 'prime_portfolio_resume_post_settings', 
        'label'       => __( 'Display Read More Button', 'prime-portfolio-resume' ),
    ) );

    /** Post Header Image control */

    // $wp_customize->add_setting( 'prime_portfolio_resume_default_image' , array(
    //     'default'   => '',
    //     'transport' => 'refresh',
    //     'sanitize_callback' => 'esc_url_raw',
    // ));

    // // Add control for the default image
    // $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'prime_portfolio_resume_default_image_control', array(
    //     'label'      => __( 'Header Image', 'prime-portfolio-resume' ),
    //     'section'    => 'prime_portfolio_resume_post_settings',
    //     'settings'   => 'prime_portfolio_resume_default_image',
    // )));

    /** Post Settings Ends */

     /** Single Post Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_single_post_settings',
        array(
            'title' => esc_html__( 'Single Post Settings', 'prime-portfolio-resume' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );

    /** Single Post Meta control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_single_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_single_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Meta', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Content control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_single_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_single_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Content', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Settings Ends */

     // Typography Settings Section
    $wp_customize->add_section('prime_portfolio_resume_typography_settings', array(
        'title'      => esc_html__('Typography Settings', 'prime-portfolio-resume'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
    ));

    // Array of fonts to choose from
    $font_choices = array(
        ''               => __('Select', 'prime-portfolio-resume'),
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Roboto'         => 'Roboto, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Montserrat'     => 'Montserrat, sans-serif',
        'Libre Baskerville' => 'Libre Baskerville',
    );

    // Heading Font Setting
    $wp_customize->add_setting('prime_portfolio_resume_heading_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_choicess',
    ));
    $wp_customize->add_control('prime_portfolio_resume_heading_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Heading', 'prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_typography_settings',
    ));

    // Body Font Setting
    $wp_customize->add_setting('prime_portfolio_resume_body_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_choicess',
    ));
    $wp_customize->add_control('prime_portfolio_resume_body_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Body', 'prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_typography_settings',
    ));

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_footer_scroll_to_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_footer_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** General Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_general_settings',
        array(
            'title' => esc_html__( 'General Settings', 'prime-portfolio-resume' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_footer_scroll_to_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_footer_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_general_settings',
            'type'        => 'checkbox',
        )
    );

     $wp_customize->add_setting('prime_portfolio_resume_scroll_icon',array(
        'default'   => 'fas fa-arrow-up',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Portfolio_Resume_Changeable_Icon(
        $wp_customize,'prime_portfolio_resume_scroll_icon',array(
        'label' => __('Scroll Top Icon','prime-portfolio-resume'),
        'transport' => 'refresh',
        'section'   => 'prime_portfolio_resume_general_settings',
        'type'      => 'icon'
    )));

    /** Preloader control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_preloader_setting', 
        array(
            'default'           => false,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_preloader_setting',
        array(
            'label'       => __( 'Show / Hide Preloader', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_general_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('prime_portfolio_resume_sidebar_text_align', array(
        'default'           => 'left',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add Sidebar Text Align Control
    $wp_customize->add_control('prime_portfolio_resume_sidebar_text_align', array(
        'label'    => __('Sidebar Heading Text Align', 'prime-portfolio-resume'),
        'section'  => 'prime_portfolio_resume_general_settings',
        'settings' => 'prime_portfolio_resume_sidebar_text_align',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left', 'prime-portfolio-resume'),
            'center' => __('Center', 'prime-portfolio-resume'),
        ),
    ));

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_general_settings',
            'type'        => 'checkbox',
        )
    );

    // Add Setting for Menu Font Weight
    $wp_customize->add_setting( 'prime_portfolio_resume_menu_font_weight', array(
        'default'           => '700',
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_font_weight',
    ) );

    // Add Control for Menu Font Weight
    $wp_customize->add_control( 'prime_portfolio_resume_menu_font_weight', array(
        'label'    => __( 'Menu Font Weight', 'prime-portfolio-resume' ),
        'section'  => 'prime_portfolio_resume_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '100' => __( '100 - Thin', 'prime-portfolio-resume' ),
            '200' => __( '200 - Extra Light', 'prime-portfolio-resume' ),
            '300' => __( '300 - Light', 'prime-portfolio-resume' ),
            '400' => __( '400 - Normal', 'prime-portfolio-resume' ),
            '500' => __( '500 - Medium', 'prime-portfolio-resume' ),
            '600' => __( '600 - Semi Bold', 'prime-portfolio-resume' ),
            '700' => __( '700 - Bold', 'prime-portfolio-resume' ),
            '800' => __( '800 - Extra Bold', 'prime-portfolio-resume' ),
            '900' => __( '900 - Black', 'prime-portfolio-resume' ),
        ),
    ) );

    // Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'prime_portfolio_resume_menu_text_transform', array(
        'default'           => 'uppercase',
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_text_transform',
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'prime_portfolio_resume_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'prime-portfolio-resume' ),
        'section'  => 'prime_portfolio_resume_general_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'prime-portfolio-resume' ),
            'capitalize' => __( 'Capitalize', 'prime-portfolio-resume' ),
            'uppercase'  => __( 'Uppercase', 'prime-portfolio-resume' ),
            'lowercase'  => __( 'Lowercase', 'prime-portfolio-resume' ),
        ),
    ) );

    $wp_customize->add_setting('prime_portfolio_resume_theme_width',array(
        'default' => 'full-width',
        'sanitize_callback' => 'prime_portfolio_resume_sanitize_theme_width'
    ));
    $wp_customize->add_control('prime_portfolio_resume_theme_width',array(
        'type' => 'select',
        'label' => __('Theme Width Option','prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_general_settings',
        'choices' => array(
            'full-width' => __('Fullwidth','prime-portfolio-resume'),
            'container' => __('Container','prime-portfolio-resume'),
            'container-fluid' => __('Container Fluid','prime-portfolio-resume'),
        ),
    ) );

    /** Header Section Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'prime-portfolio-resume' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting( 
        'prime_portfolio_resume_show_hide_search', 
        array(
            'default' => false ,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_show_hide_search',
        array(
            'label'       => __( 'Show Search Icon', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_header_section_settings',
            'type'        => 'checkbox',
        )
    );
    $wp_customize->add_setting('prime_portfolio_resume_search_icon',array(
        'default'   => 'fas fa-search',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Portfolio_Resume_Changeable_Icon(
        $wp_customize,'prime_portfolio_resume_search_icon',array(
        'label' => __('Search Icon','prime-portfolio-resume'),
        'transport' => 'refresh',
        'section'   => 'prime_portfolio_resume_header_section_settings',
        'type'      => 'icon'
    )));

    /** Header Section Settings End */

    /** Socail Section Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_social_section_settings',
        array(
            'title' => esc_html__( 'Social Media Section Settings', 'prime-portfolio-resume' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Socail Section control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_social_icon_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_social_icon_setting',
        array(
            'label'       => __( 'Show Social Icon', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_social_section_settings',
            'type'        => 'checkbox',
        )
    );

    /**  Social Link 1 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_1',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_1',
        array(
            'label' => esc_html__( 'Add Facebook Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 2 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_2',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_2',
        array(
            'label' => esc_html__( 'Add Twitter Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 3 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_3',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_3',
        array(
            'label' => esc_html__( 'Add Instagram Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 4 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_4',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_4',
        array(
            'label' => esc_html__( 'Add Pintrest Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 5 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_5',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_5',
        array(
            'label' => esc_html__( 'Add Linkedln Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 6 */
    $wp_customize->add_setting(
        'prime_portfolio_resume_social_link_6',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_social_link_6',
        array(
            'label' => esc_html__( 'Add Youtube Link', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_social_section_settings',
            'type' => 'url',
        )
    );

    /** Socail Section Settings End */

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'prime_portfolio_resume_home_page_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'prime-portfolio-resume' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'prime-portfolio-resume' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'prime_portfolio_resume_slider_section_settings',
        array(
            'title' => esc_html__( 'Banner Section Settings', 'prime-portfolio-resume' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_portfolio_resume_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_slider_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_slider_setting',
        array(
            'label'       => __( 'Show Slider', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_slider_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Banner Title
    $wp_customize->add_setting(
        'prime_portfolio_resume_banner_heading', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_banner_heading', 
        array(
            'label'       => __('Banner Title', 'prime-portfolio-resume'),
            'section'     => 'prime_portfolio_resume_slider_section_settings',
            'settings'    => 'prime_portfolio_resume_banner_heading',
            'type'        => 'text'
        )
    );

     // Banner Text
    $wp_customize->add_setting(
        'prime_portfolio_resume_banner_content', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_banner_content', 
        array(
            'label'       => __('Banner Content', 'prime-portfolio-resume'),
            'section'     => 'prime_portfolio_resume_slider_section_settings',
            'settings'    => 'prime_portfolio_resume_banner_content',
            'type'        => 'text'
        )
    );

     /** Email */
    $wp_customize->add_setting(
        'prime_portfolio_resume_header_email',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_header_email',
        array(
            'label' => esc_html__( 'Add Email', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_slider_section_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting('prime_portfolio_resume_mail_icon',array(
        'default'   => 'far fa-envelope',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Portfolio_Resume_Changeable_Icon(
        $wp_customize,'prime_portfolio_resume_mail_icon',array(
        'label' => __('Mail Icon','prime-portfolio-resume'),
        'transport' => 'refresh',
        'section'   => 'prime_portfolio_resume_slider_section_settings',
        'type'      => 'icon'
    )));

    /** Phone */
    $wp_customize->add_setting(
        'prime_portfolio_resume_header_phone',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_header_phone',
        array(
            'label' => esc_html__( 'Add Phone', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_slider_section_settings',
            'type' => 'text',
        )
    );
    $wp_customize->add_setting('prime_portfolio_resume_phone_icon',array(
        'default'   => 'fas fa-phone-volume',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Portfolio_Resume_Changeable_Icon(
        $wp_customize,'prime_portfolio_resume_phone_icon',array(
        'label' => __('Phone Icon','prime-portfolio-resume'),
        'transport' => 'refresh',
        'section'   => 'prime_portfolio_resume_slider_section_settings',
        'type'      => 'icon'
    )));

    /** Banner Button URL */
     $wp_customize->add_setting(
        'prime_portfolio_resume_slide_btn_url',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_slide_btn_url',
        array(
            'label' => esc_html__( 'Add Banner Button URL', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_slider_section_settings',
            'type' => 'url',
        )
    );

    /*Main Banner Image*/
    $wp_customize->add_setting(
        'prime_portfolio_resume_banner_image',
        array(
            'capability'    => 'edit_theme_options',
            'default'       => '',
            'transport'     => 'postMessage',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 
            'prime_portfolio_resume_banner_image', 
            array(
                'label' => __('Edit Banner Image ', 'prime-portfolio-resume'),
                'description' => __('Edit the Banner image.', 'prime-portfolio-resume'),
                'section' => 'prime_portfolio_resume_slider_section_settings',
            )
        )
    );
    /** About Section Settings */
    
    $wp_customize->add_section( 'prime_portfolio_resume_blog_section',
        array(
        'title'      => __( 'Blog Section', 'prime-portfolio-resume' ),
        'priority'   => 110,
        'capability' => 'edit_theme_options',
        'panel'      => 'prime_portfolio_resume_home_page_settings',
        )
    );

    /** Blog Section control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_about_setting', 
        array(
            'default' => true ,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_about_setting',
        array(
            'label'       => __( 'Show Blog', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_blog_section',
            'type'        => 'checkbox',
        )
    );

    // Section Title
    $wp_customize->add_setting('prime_portfolio_resume_blog_section_title', 
        array(
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('prime_portfolio_resume_blog_section_title', 
        array(
        'label'       => __('Section Title', 'prime-portfolio-resume'),
        'section'     => 'prime_portfolio_resume_blog_section',   
        'settings'    => 'prime_portfolio_resume_blog_section_title',
        'type'        => 'text'
        )
    );

    // Post Categories
    $categories = get_categories();
    $cat_posts = array();
    $default = '';
    $cat_posts[] = 'Select';
    foreach ($categories as $category) {
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'prime_portfolio_resume_blog_args_',
        array(
            'default'            => 'select',
            'sanitize_callback'  => 'prime_portfolio_resume_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'prime_portfolio_resume_blog_args_',
        array(
            'type'     => 'select',
            'choices'  => $cat_posts,
            'label'    => __('Select Category to Display Blogs', 'prime-portfolio-resume'),
            'section'  => 'prime_portfolio_resume_blog_section',
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'prime_portfolio_resume_section_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_section_title', 
        array(
            'label'       => __('Section Title', 'prime-portfolio-resume'),
            'section'     => 'prime_portfolio_resume_classes_section_settings',
            'settings'    => 'prime_portfolio_resume_section_title',
            'type'        => 'text'
        )
    );

    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'prime_portfolio_resume_footer_section',
        array(
            'title' => __( 'Footer Settings', 'prime-portfolio-resume' ),
            'priority' => 70,
        )
    );

    /** Footer Copyright control */
    $wp_customize->add_setting( 
        'prime_portfolio_resume_footer_setting', 
        array(
            'default' => true,
            'sanitize_callback' => 'prime_portfolio_resume_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_portfolio_resume_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'prime-portfolio-resume' ),
            'section'     => 'prime_portfolio_resume_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'prime_portfolio_resume_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'prime_portfolio_resume_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'prime-portfolio-resume' ),
            'section' => 'prime_portfolio_resume_footer_section',
            'type' => 'text',
        )
    );  
$wp_customize->add_setting('footer_background_image',
        array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_control(
         new WP_Customize_Cropped_Image_Control($wp_customize, 'footer_background_image',
            array(
                'label' => esc_html__('Footer Background Image', 'prime-portfolio-resume'),
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'prime-portfolio-resume'), 1024, 800),
                'section' => 'prime_portfolio_resume_footer_section',
                'width' => 1024,
                'height' => 800,
                'flex_width' => true,
                'flex_height' => true,
                'priority' => 100,
            )
        )
    );

    /* Footer Background Color*/
    $wp_customize->add_setting(
        'footer_background_color',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'prime-portfolio-resume'),
                'section' => 'prime_portfolio_resume_footer_section',
                'type' => 'color',
            )
        )
    );

    // 404 PAGE SETTINGS
    $wp_customize->add_section(
        'prime_portfolio_resume_404_section',
        array(
            'title' => __( '404 Page Settings', 'prime-portfolio-resume' ),
            'priority' => 70,
        )
    );
   
    $wp_customize->add_setting('404_page_image', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw', // Sanitize as URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, '404_page_image', array(
        'label' => __('404 Page Image', 'prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_404_section',
        'settings' => '404_page_image',
    )));

    $wp_customize->add_setting('404_pagefirst_header', array(
        'default' => __('404', 'prime-portfolio-resume'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_pagefirst_header', array(
        'type' => 'text',
        'label' => __('Heading', 'prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_404_section',
    ));

    // Setting for 404 page header
    $wp_customize->add_setting('404_page_header', array(
        'default' => __('Sorry, that page can\'t be found!', 'prime-portfolio-resume'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_page_header', array(
        'type' => 'text',
        'label' => __('Heading', 'prime-portfolio-resume'),
        'section' => 'prime_portfolio_resume_404_section',
    ));
    function prime_portfolio_resume_sanitize_choices( $input, $setting ) {
        global $wp_customize; 
        $control = $wp_customize->get_control( $setting->id ); 
        if ( array_key_exists( $input, $control->choices ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }

    function prime_portfolio_resume_sanitize_choicess($input) {
    $valid = array(
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Roboto'         => 'Roboto, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Montserrat'     => 'Montserrat, sans-serif',
    );

    return (array_key_exists($input, $valid)) ? $input : '';
}

}
add_action( 'customize_register', 'prime_portfolio_resume_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prime_portfolio_resume_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $prime_portfolio_resume_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $prime_portfolio_resume_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'prime_portfolio_resume_customizer', get_template_directory_uri() . '/js' . $prime_portfolio_resume_build . '/customizer' . $prime_portfolio_resume_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'prime_portfolio_resume_customize_preview_js' );