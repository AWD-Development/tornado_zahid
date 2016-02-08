<?php
    get_template_part( 'lib/main' );

    add_action( 'after_setup_theme', 	array( 'mythemes_setup', 	'support' ) );
    add_action( 'after_setup_theme',    array( 'mythemes_header',   'setup' ) );
	add_action( 'admin_init', 			array( 'mythemes_scripts', 	'backend' ) );
    
	add_action( 'admin_menu', 			array( 'mythemes_admin', 	'pageMenu' ) );

	add_action( 'widgets_init', 		array( 'mythemes_setup', 	'sidebars' ) );
	add_action( 'init', 				array( 'mythemes_setup', 	'menus' ) );
	
	add_action( 'wp_enqueue_scripts',  array( 'mythemes_scripts',  'frontend' ), 0 );
	add_action( 'wp_head', 				array( 'mythemes_header', 	'head' ) );
	
    add_filter( 'the_excerpt_rss', 		array( 'mythemes_tools', 	'rss_with_thumbnail' ) );
    add_filter( 'the_content_feed', 	array( 'mythemes_tools', 	'rss_with_thumbnail' ) );

    if( get_theme_mod( 'mythemes-gallery', true ) ){
        add_action( 'admin_init',           array( 'mythemes_gallery',  'admin_init' ) );
        add_filter( 'post_gallery',         array( 'mythemes_gallery',  'shortcode'), null, 2 );
    }

    /* CUSTOMIZER */
    function mythemes_customize_register( $wp_customize )
	{

        {   //- SITE IDENTITY -//

            $wp_customize -> add_section( 'title_tagline', array(
                'title'             => __( 'Site Identity', 'materialize' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 0
            ));

            $wp_customize -> add_setting( 'mythemes-blog-logo', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Upload_Control(
                $wp_customize,
                'mythemes-blog-logo',
                array(
                    'label'         => __( 'Preview Logo', 'materialize' ),
                    'section'       => 'title_tagline',
                    'settings'      => 'mythemes-blog-logo',
                )
            ));

            //- MARGIN TOP -//
            $wp_customize -> add_setting( 'mythemes-blog-logo-m-top', array(
                'default'           => 0,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_number',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-blog-logo-m-top', array(
                'label'             => __( 'Logo Margin Top', 'materialize' ),
                'section'           => 'title_tagline',
                'settings'          => 'mythemes-blog-logo-m-top',
                'type'              => 'range',
                'input_attrs'       => array(
                    'min'       => 0,
                    'max'       => 100,
                    'step'      => 1
                )
            ));


            //- MARGIN BOTTOM -//
            $wp_customize -> add_setting( 'mythemes-blog-logo-m-bottom', array(
                'default'           => 0,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_number',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-blog-logo-m-bottom', array(
                'label'             => __( 'Logo Marign Bottom', 'materialize' ),
                'section'           => 'title_tagline',
                'settings'          => 'mythemes-blog-logo-m-bottom',
                'type'              => 'range',
                'input_attrs'       => array(
                    'min'       => 0,
                    'max'       => 100,
                    'step'      => 1
                )
            ));

            $wp_customize -> add_setting( 'display_header_text' );
            $wp_customize -> add_control( 'display_header_text', array( 'theme_supports' => false ) );
        }


        {   //- COLORS -//

            $wp_customize -> add_section( 'colors', array(
                'title'             => __( 'Colors', 'materialize' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 1
            ));

            //- DISABLE UNSUPPORTED -//
            $wp_customize -> add_setting( 'header_textcolor' );
            $wp_customize -> add_control( 'header_textcolor', array( 'theme_supports' => false ) );
        }


        {   //- BACKGROUND IMAGE -//

            $wp_customize -> add_section( 'background_image', array(
                'title'             => __( 'Background Image', 'materialize' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 2
            ));
        }


        {   //- HEADER IMAGE -//

            $wp_customize -> add_section( 'header_image', array(
                'title'             => __( 'Header Image', 'materialize' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 3
            ));
        }


    	{   //- HEADER ELLEMENTS -//

            $header_panel_args = array(
                'title'         => __( 'Header Elements', 'materialize' ),
                'priority'      => 4,
                'capability'    => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $header_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'materialize' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faqs#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'materialize' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_panel( 'mythemes-header-panel', $header_panel_args );


            {   /* GENERAL */

            	$wp_customize -> add_section( 'mythemes-header', array(
                    'title'             => __( 'General' , 'materialize' ),
                    'priority'          => 30,
                    'panel'             => 'mythemes-header-panel',
                    'capability'        => 'edit_theme_options'
            	));

                /* FRONT PAGE */
                $wp_customize -> add_setting( 'mythemes-header-front-page', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-front-page', array(
                    'label'             => __( 'Display Header on Front Page', 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-front-page',
                    'type'              => 'checkbox',
                ));

                /* FRONT PAGE */
                $wp_customize -> add_setting( 'mythemes-header-blog-page', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-blog-page', array(
                    'label'             => __( 'Display Header on Blog Page', 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-blog-page',
                    'type'              => 'checkbox',
                ));

                /* TEMPLATES */
                $wp_customize -> add_setting( 'mythemes-header-templates', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-templates', array(
                    'label'             => __( 'Display Header on Templates', 'materialize' ),
                    'description'       => __( 'enabale / disable header on: Archives, Categories, Tags, Author, 404 and Search Results.' , 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-templates',
                    'type'              => 'checkbox',
                ));

                /* SINGLE POSTS */
                $wp_customize -> add_setting( 'mythemes-header-single-posts', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-posts', array(
                    'label'             => __( 'Display Header on Single Posts', 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-posts',
                    'type'              => 'checkbox',
                ));

                /* SINGLE PAGES */
                $wp_customize -> add_setting( 'mythemes-header-single-pages', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-pages', array(
                    'label'             => __( 'Display Header on Single Pages', 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-pages',
                    'type'              => 'checkbox'
                ));

                /* HEIGHT */
                $wp_customize -> add_setting( 'mythemes-header-height', array(
                    'default'           => 450,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-height', array(
                    'label'             => __( 'Header height ( in pixels )', 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-height',
                    'type'              => 'number',
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 500,
                        'step'  => 1
                    )
                ));

                /* HEADER BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-header-background-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-background-color',
                    array(
                        'label'         => __( 'Background Color', 'materialize' ),
                        'section'       => 'mythemes-header',
                        'settings'      => 'mythemes-header-background-color',
                    )
                ));

                /* MASK COLOR */
                $wp_customize -> add_setting( 'mythemes-header-mask-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-mask-color',
                    array(
                        'label'     => __( 'Mask Color', 'materialize' ),
                        'section'   => 'mythemes-header',
                        'settings'  => 'mythemes-header-mask-color',
                    )
                ));

                /* MASK OPACITY */
                $wp_customize -> add_setting( 'mythemes-header-mask-opacity', array(
                    'default'           => 75,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-mask-opacity', array(
                    'label'             => __( 'Mask Opacity ( % )', 'materialize' ),
                    'description'       => __( 'by default the mask is a dark transparent foil over the header background image.' , 'materialize' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-mask-opacity',
                    'type'              => 'range',
                    'input_attrs' => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ),
                ));
            }


            {   /* CONTENT */

                $wp_customize -> add_section( 'mythemes-header-content', array(
                    'title'             => __( 'Content' , 'materialize' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                ));

                /* DISPLAY TITLE ON HEADER */
                $wp_customize -> add_setting( 'mythemes-header-title', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-title', array(
                    'label'             => __( 'Display Header Headline', 'materialize' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-title',
                    'type'              => 'checkbox',
                ));

                /* HEADER TITLE LABEL */
                $wp_customize -> add_setting( 'mythemes-header-title-label', array(
                    'default'           => __( 'Best WordPress Theme based on Material Design' , 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-title-label', array(
                    'label'             => __( 'Header Header', 'materialize' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-title-label',
                    'type'              => 'text'
                ));

                /* HEADLINE COLOR */
                $wp_customize -> add_setting( 'mythemes-header-title-color', array(
                    'default'           => '#e53932',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-title-color',
                    array(
                        'label'         => __( 'Headline Color', 'materialize' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-title-color',
                    )
                ));

                /* DISPLAY DESCRIPTION ON HEADER */
                $wp_customize -> add_setting( 'mythemes-header-description', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-description', array(
                    'label'             => __( 'Display Header Description', 'materialize' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-description',
                    'type'              => 'checkbox',
                ));

                /* HEADER DESCRIPTION LABEL */
                $wp_customize -> add_setting( 'mythemes-header-description-label', array(
                    'default'           => __( 'free WordPress theme developed by myThem.es' , 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-description-label', array(
                    'label'             => __( 'Header Description', 'materialize' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-description-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION COLOR */
                $wp_customize -> add_setting( 'mythemes-header-description-color', array(
                    'default'           => '#000000',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-description-color',
                    array(
                        'label'         => __( 'Description Color', 'materialize' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-description-color',
                    )
                ));
            }


            {   /* FIRST BUTTON */

                $wp_customize -> add_section( 'mythemes-header-first-btn', array(
                    'title'             => __( 'First Button' , 'materialize' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                ));

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-first-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn', array(
                    'label'             => __( 'Display first button', 'materialize' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn',
                    'type'              => 'checkbox'
                ));

                /* COLOR */
                $wp_customize -> add_setting( 'mythemes-first-btn-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-color',
                    array(
                        'label'         => __( 'Text Color', 'materialize' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-color',
                    )
                ));

                /* BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-first-btn-bkg-color', array(
                    'default'           => '#4caf50',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-bkg-color',
                    array(
                        'label'         => __( 'Background Color', 'materialize' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-bkg-color',
                    )
                ));

                /* HOVER BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-first-btn-bkg-h-color', array(
                    'default'           => '#43a047',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-btn-bkg-h-color',
                    array(
                        'label'         => __( 'Background Color ( over )', 'materialize' ),
                        'description'   => __( 'When the mouse is over the button.' , 'materialize' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-bkg-h-color'
                    )
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-first-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-url', array(
                    'label'             => __( 'URL', 'materialize' ),
                    'description'       => __( 'Link for first button', 'materialize' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-url',
                    'type'              => 'url',
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-first-btn-label', array(
                    'default'           => __( 'First Button', 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-label', array(
                    'label'             => __( 'Label', 'materialize' ),
                    'description'       => __( 'Text for first button', 'materialize' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-first-btn-description', array(
                    'default'           => __( 'first button link description...', 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_textarea',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-description', array(
                    'label'             => __( 'Description', 'materialize' ),
                    'description'       => __( 'link description for first button', 'materialize' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-description',
                    'type'              => 'textarea',
                ));
            }


            {   /* SECOND BUTTON */

                $wp_customize -> add_section( 'mythemes-header-second-btn', array(
                    'title'             => __( 'Second Button' , 'materialize' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                ));

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-second-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn', array(
                    'label'             => __( 'Display second button', 'materialize' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn',
                    'type'              => 'checkbox'
                ));

                /* COLOR */
                $wp_customize -> add_setting( 'mythemes-second-btn-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-color',
                    array(
                        'label'         => __( 'Text Color', 'materialize' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-color',
                    )
                ));

                /* BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-second-btn-bkg-color', array(
                    'default'           => '#e53935',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-bkg-color',
                    array(
                        'label'         => __( 'Background Color', 'materialize' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-bkg-color',
                    )
                ));

                /* HOVER BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-second-btn-bkg-h-color', array(
                    'default'           => '#d32f2f',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-btn-bkg-h-color',
                    array(
                        'label'         => __( 'Background Color ( over )', 'materialize' ),
                        'description'   => __( 'When the mouse is over the button.' , 'materialize' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-bkg-h-color'
                    )
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-second-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-url', array(
                    'label'             => __( 'URL', 'materialize' ),
                    'description'       => __( 'Link for second button', 'materialize' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-url',
                    'type'              => 'url'
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-second-btn-label', array(
                    'default'           => __( 'Second Button', 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-label', array(
                    'label'             => __( 'Label', 'materialize' ),
                    'description'       => __( 'Text for second button', 'materialize' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-second-btn-description', array(
                    'default'           => __( 'second button link description...', 'materialize' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_textarea',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-description', array(
                    'label'             => __( 'Description', 'materialize' ),
                    'description'       => __( 'link description for second button', 'materialize' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-description',
                    'type'              => 'textarea'
                ));
            }
        }


        {   //- BREADCRUMBS -//

            $wp_customize -> add_section( 'mythemes-breadcrumbs', array(
                'title'             => __( 'Breadcrumbs' , 'materialize' ),
                'priority'          => 5,
                'capability'        => 'edit_theme_options'
            ));

            /* DISPLAY BREADCRUMBS */
            $wp_customize -> add_setting( 'mythemes-breadcrumbs', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs', array(
                'label'             => __( 'Display breadcrumbs', 'materialize' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs',
                'type'              => 'checkbox',
            ));

            /* LABEL */
            $wp_customize -> add_setting( 'mythemes-home-label', array(
                'default'           => __( 'Home', 'materialize' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-label', array(
                'label'             => __( '"Home" label', 'materialize' ),
                'description'       => __( 'breadcrumbs "Home" link label.', 'materialize' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-label',
                'type'              => 'text',
            ));

            /* DESCRIPTION */
            $wp_customize -> add_setting( 'mythemes-home-link-description', array(
                'default'           => __( 'go to home', 'materialize' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_textarea',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-link-description', array(
                'label'             => __( '"Home" link description', 'materialize' ),
                'description'       => __( 'breadcrumbs "Home" link description.', 'materialize' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-link-description',
                'type'              => 'textarea',
            ));

            /* SPACE */
            $wp_customize -> add_setting( 'mythemes-breadcrumbs-space', array(
                'default'           => 60,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_number',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs-space', array(
                'label'             => __( 'Space ( in pixels )', 'materialize' ),
                'description'       => __( 'inner top and bottom space allow you to change breadcrumbs height.', 'materialize' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs-space',
                'type'              => 'number',
                'input_attrs'       => array(
                    'min'   => 0,
                    'max'   => 100,
                )
            ));
        }
        

        {   /* ADDITIONAL */

            $wp_customize -> add_section( 'mythemes-additional', array(
                'title'             => __( 'Additional' , 'materialize' ),
                'priority'          => 6,
                'capability'        => 'edit_theme_options'
            ));

            /* LABEL "BLOG PAGE" */
            $wp_customize -> add_setting( 'mythemes-blog-title', array(
                'default'           => __( 'Blog', 'materialize' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-blog-title', array(
                'label'             => __( 'Title for Blog Page', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-blog-title',
                'type'              => 'text'
            ));

            /* DISPLAY DEFAULT CONTENT */
            $wp_customize -> add_setting( 'mythemes-default-content', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-default-content', array(
                'label'             => __( 'Display default content', 'materialize' ),
                'description'       => __( 'enable / disable default content from sidebars.', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-default-content',
                'type'              => 'checkbox'
            ));

            /* DISPLAY DEFAULT CONTENT */
            $wp_customize -> add_setting( 'mythemes-gallery', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gallery', array(
                'label'             => __( 'Enable myThem.es Gallery Effects', 'materialize' ),
                'description'       => __( 'you can disable this option to enable jetpack gallery', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-gallery',
                'type'              => 'checkbox'
            ));

            /* DISPLAY TOP META */
            $wp_customize -> add_setting( 'mythemes-top-meta', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-top-meta', array(
                'label'             => __( 'Display top meta', 'materialize' ),
                'description'       => __( 'enable / disable top meta from single posts ( all posts ).', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-top-meta',
                'type'              => 'checkbox'
            ));

            /* DISPLAY BOTTOM META */
            $wp_customize -> add_setting( 'mythemes-bottom-meta', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-bottom-meta', array(
                'label'             => __( 'Display bottom meta', 'materialize' ),
                'description'       => __( 'enable / disable bottom meta from single posts ( all posts ).', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-bottom-meta',
                'type'              => 'checkbox'
            ));

            /* HTML SUGGESTIONS */
            $wp_customize -> add_setting( 'mythemes-html-suggestions', array(
                'default'           => true,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-html-suggestions', array(
                'label'             => __( 'HTML Suggestions', 'materialize' ),
                'description'       => __( 'enable / disable HTML Suggestions after comments form ( all posts ).', 'materialize' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-html-suggestions',
                'type'              => 'checkbox'
            ));
        }


        {   /* LAYOUTS */

            $layout_panel = array(
                'title'             => __( 'Layout' , 'materialize' ),
                'priority'          => 7,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $layout_panel[ 'description' ] = sprintf( __( 'On the premium version for each page, post or / and portfolio you can overwrite the Layout options with custom settings. %s' , 'materialize' ) , '<br/><br/><a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '" target="_blank" title="' . __( 'Cannyon Premium Multipurpose Wordpress Theme' , 'materialize' ) . '">' . __( 'Upgrade to Premium' , 'materialize' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_panel( 'mythemes-layout-panel', $layout_panel );


            $sidebars   = array(
                'main'              => __( 'Main Sidebar' , 'materialize' ),
                'front-page'        => __( 'Front Page Sidebar' , 'materialize' ),
                'page'              => __( 'Page Sidebar' , 'materialize' ),
                'post'              => __( 'Post Sidebar' , 'materialize' ),
                'special-page'      => __( 'Special Page Sidebar' , 'materialize' )
            );


            {   /* DEFAULT */

                $wp_customize -> add_section( 'mythemes-layout', array(
                    'title'             => __( 'Default' , 'materialize' ),
                    'description'       => __( 'Default Layout is used for the next templates: Blog, Archives, Categories, Tags, Author and Search Results.' , 'materialize' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-layout', array(
                    'label'             => __( 'Layout' , 'materialize' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'materialize' ),
                        'full'  => __( 'Full Width', 'materialize' ),
                        'right' => __( 'Right Sidebar', 'materialize' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-sidebar', array(
                    'default'           => 'mythemes-main',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'materialize' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $sidebar_args[ 'description' ] = __( 'on the premium version you can create unlimited number of sidebars' , 'materialize' );
                }

                $wp_customize -> add_control( 'mythemes-sidebar', $sidebar_args );
            }


            {   /* FRONT PAGE */

                $wp_customize -> add_section( 'mythemes-front-page-layout', array(
                    'title'             => __( 'Front Page' , 'materialize' ),
                    'description'       => __( 'In order to use this option set you need to activate a staic page on Front Page from - "Static Front Page" tab' , 'materialize' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-front-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-front-page-layout', array(
                    'label'             => __( 'Layout' , 'materialize' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'materialize' ),
                        'full'  => __( 'Full Width', 'materialize' ),
                        'right' => __( 'Right Sidebar', 'materialize' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-front-page-sidebar', array(
                    'default'           => 'mythemes-front-page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $front_page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'materialize' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $front_page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'materialize' );
                }

                $wp_customize -> add_control( 'mythemes-front-page-sidebar', $front_page_sidebar_args);
            }
            

            {   /* SINGLE PAGE */

                $page_layout_args = array(
                    'title'             => __( 'Single Page' , 'materialize' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $page_layout_args[ 'description' ]  = __( 'On the premium version for the each page you can overwrite the Layout options with the custom settings.' , 'materialize' );
                }
                    
                $wp_customize -> add_section( 'mythemes-page-layout', $page_layout_args );

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-page-layout', array(
                    'default'           => 'full',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-page-layout', array(
                    'label'             => __( 'Layout' , 'materialize' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'materialize' ),
                        'full'  => __( 'Full Width', 'materialize' ),
                        'right' => __( 'Right Sidebar', 'materialize' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-page-sidebar', array(
                    'default'           => 'mythemes-page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'materialize' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'materialize' );
                }

                $wp_customize -> add_control( 'mythemes-page-sidebar', $page_sidebar_args );
            }
            

            {   /* SINGLE POST */

                $post_layout_args = array(
                    'title'             => __( 'Single Post' , 'materialize' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $page_sidebar_args[ 'description' ] = __( 'On the premium version for the each post you can overwrite the Layout options with the custom settings.' , 'materialize' );
                }

                $wp_customize -> add_section( 'mythemes-post-layout', $post_layout_args );

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-post-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-post-layout', array(
                    'label'             => __( 'Layout' , 'materialize' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'materialize' ),
                        'full'  => __( 'Full Width', 'materialize' ),
                        'right' => __( 'Right Sidebar', 'materialize' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-post-sidebar', array(
                    'default'           => 'mythemes-post',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $post_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'materialize' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $post_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'materialize' );
                }

                $wp_customize -> add_control( 'mythemes-post-sidebar', $post_sidebar_args );
            }
            

            {   /* SPECIAL PAGE */

                $special_page_layout_args = array(
                    'title'             => __( 'Special Page' , 'materialize' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $special_page_layout_args[ 'description' ] = __( 'On the premium version for each page you can overwrite the Layout options with custom settings.' , 'materialize' );
                }

                $wp_customize -> add_section( 'mythemes-special-page-layout', $special_page_layout_args );

                /* SPECIAL PAGE */
                $wp_customize -> add_setting( 'mythemes-special-page', array(
                    'default'           => 2,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page', array(
                    'label'             => __( 'Special page' , 'materialize' ),
                    'description'       => __( 'for selected page you can overwrite default page layout settings with special layout settings', 'materialize' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page',
                    'type'              => 'dropdown-pages'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-special-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page-layout', array(
                    'label'             => __( 'Layout' , 'materialize' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'materialize' ),
                        'full'  => __( 'Full Width', 'materialize' ),
                        'right' => __( 'Right Sidebar', 'materialize' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-special-page-sidebar', array(
                    'default'           => 'mythemes-special-page',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $special_page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'materialize' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $special_page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'materialize' );
                }

                $wp_customize -> add_control( 'mythemes-special-page-sidebar', $special_page_sidebar_args );
            }
        }


        {   /* SOCIAL */

            $wp_customize -> add_section( 'mythemes-social', array(
                'title'             => __( 'Social' , 'materialize' ),
                'priority'          => 35,
                'capability'        => 'edit_theme_options'
            ));

            /* VIMEO */
            $wp_customize -> add_setting( 'mythemes-vimeo', array(
                'default'           => 'http://vimeo.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vimeo', array(
                'label'             => __( 'Vimeo', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vimeo',
                'type'              => 'url',
            ));

            /* TWITTER */
            $wp_customize -> add_setting( 'mythemes-twitter', array(
                'default'           => 'http://twitter.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-twitter', array(
                'label'             => __( 'Twitter', 'materialize' ),
                'section'           => 'mythemes-social',
                'sanitize_callback' => 'esc_url_raw',
                'settings'          => 'mythemes-twitter',
                'type'              => 'url',
            ));

            /* SKYPE */
            $wp_customize -> add_setting( 'mythemes-skype', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-skype', array(
                'label'             => __( 'Skype', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-skype',
                'type'              => 'url',
            ));

            /* RENREN */
            $wp_customize -> add_setting( 'mythemes-renren', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-renren', array(
                'label'             => __( 'Renren', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-renren',
                'type'              => 'url',
            ));

            /* GITHUB */
            $wp_customize -> add_setting( 'mythemes-github', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-github', array(
                'label'             => __( 'Github', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-github',
                'type'              => 'url',
            ));

            /* RDIO */
            $wp_customize -> add_setting( 'mythemes-rdio', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rdio', array(
                'label'             => __( 'Rdio', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-rdio',
                'type'              => 'url'
            ));

            /* LINKEDIN */
            $wp_customize -> add_setting( 'mythemes-linkedin', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-linkedin', array(
                'label'             => __( 'Linkedin', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-linkedin',
                'type'              => 'url',
            ));

            /* BEHANCE */
            $wp_customize -> add_setting( 'mythemes-behance', array(
                'default'           => 'http://behance.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-behance', array(
                'label'             => __( 'Behance', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-behance',
                'type'              => 'url',
            ));

            /* DROPBOX */
            $wp_customize -> add_setting( 'mythemes-dropbox', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dropbox', array(
                'label'             => __( 'Dropbox', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dropbox',
                'type'              => 'url',
            ));

            /* FLICKR */
            $wp_customize -> add_setting( 'mythemes-flickr', array(
                'default'           => 'http://flickr.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flickr', array(
                'label'             => __( 'Flickr', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flickr',
                'type'              => 'url',
            ));

            /* TUMBLR */
            $wp_customize -> add_setting( 'mythemes-tumblr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-tumblr', array(
                'label'             => __( 'Tumblr', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-tumblr',
                'type'              => 'url',
            ));

            /* INSTAGRAM */
            $wp_customize -> add_setting( 'mythemes-instagram', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-instagram', array(
                'label'             => __( 'Instagram', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-instagram',
                'type'              => 'url',
            ));

            /* VKONTAKTE */
            $wp_customize -> add_setting( 'mythemes-vkontakte', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vkontakte', array(
                'label'             => __( 'Vkontakte', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vkontakte',
                'type'              => 'url',
            ));

            /* FACEBOOK */
            $wp_customize -> add_setting( 'mythemes-facebook', array(
                'default'           => 'http://facebook.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-facebook', array(
                'label'             => __( 'Facebook', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-facebook',
                'type'              => 'url',
            ));

            /* EVERNOTE */
            $wp_customize -> add_setting( 'mythemes-evernote', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-evernote', array(
                'label'             => __( 'Evernote', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-evernote',
                'type'              => 'url'
            ));

            /* FLATTR */
            $wp_customize -> add_setting( 'mythemes-flattr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flattr', array(
                'label'             => __( 'Flattr', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flattr',
                'type'              => 'url',
            ));

            /* PICASA */
            $wp_customize -> add_setting( 'mythemes-picasa', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-picasa', array(
                'label'             => __( 'Picasa', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-picasa',
                'type'              => 'url',
            ));

            /* DRIBBBLE */
            $wp_customize -> add_setting( 'mythemes-dribbble', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dribbble', array(
                'label'             => __( 'Dribbble', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dribbble',
                'type'              => 'url',
            ));

            /* MIXI */
            $wp_customize -> add_setting( 'mythemes-mixi', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-mixi', array(
                'label'             => __( 'Mixi', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-mixi',
                'type'              => 'url',
            ));

            /* STUMBLEUPON */
            $wp_customize -> add_setting( 'mythemes-stumbleupon', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-stumbleupon', array(
                'label'             => __( 'Stumbleupon', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-stumbleupon',
                'type'              => 'url',
            ));

            /* LASTFM */
            $wp_customize -> add_setting( 'mythemes-lastfm', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-lastfm', array(
                'label'             => __( 'Lastfm', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-lastfm',
                'type'              => 'url',
            ));

            /* GPLUS */
            $wp_customize -> add_setting( 'mythemes-gplus', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gplus', array(
                'label'             => __( 'GPlus', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-gplus',
                'type'              => 'url',
            ));

            /* GOOGLE CIRCLES */
            $wp_customize -> add_setting( 'mythemes-google-circles', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-google-circles', array(
                'label'             => __( 'Google circles', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-google-circles',
                'type'              => 'url',
            ));

            /* PINTEREST */
            $wp_customize -> add_setting( 'mythemes-pinterest', array(
                'default'           => 'http://pinterest.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-pinterest', array(
                'label'             => __( 'Pinterest', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-pinterest',
                'type'              => 'url',
            ));

            /* SMASHING */
            $wp_customize -> add_setting( 'mythemes-smashing', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-smashing', array(
                'label'             => __( 'Smashing', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-smashing',
                'type'              => 'url'
            ));

            /* SOUNDCLOUD */
            $wp_customize -> add_setting( 'mythemes-soundcloud', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-soundcloud', array(
                'label'             => __( 'Soundcloud', 'materialize' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-soundcloud',
                'type'              => 'url',
            ));

            /* RSS */
            $wp_customize -> add_setting( 'mythemes-rss', array(
                'default'           => esc_url( get_bloginfo('rss2_url') ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rss', array(
                'label'         => __( 'Rss', 'materialize' ),
                'section'       => 'mythemes-social',
                'settings'      => 'mythemes-rss',
                'type'          => 'url',
            ));
        }

        {   /* OTHERS */
            $wp_customize -> add_section( 'mythemes-others', array(
                'title'             => __( 'Others' , 'materialize' ),
                'priority'          => 36,
                'capability'        => 'edit_theme_options'
            ));

            /* CUSTOM CSS */
            $wp_customize -> add_setting( 'mythemes-custom-css', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_css',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-custom-css', array(
                'label'             => __( 'Custom css', 'materialize' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-custom-css',
                'type'              => 'textarea',
            ));

            /* COPYRIGHT */
            $wp_customize -> add_setting( 'mythemes-copyright', array(
                'default'           => sprintf( __( 'Copyright &copy; 2015. Powered by %s.' , 'materialize' ) , '<a href="http://wordpress.org/">WordPress</a>' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_copyright',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-copyright', array(
                'label'             => __( 'Copyright', 'materialize' ),
                'description'       => __( 'You can change only the first side of copyright. With the premium version you can change all the footer text.' , 'materialize' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-copyright',
                'type'              => 'textarea',
            ));
        }
	}
 
	add_action( 'customize_register' , 'mythemes_customize_register' );

	function mythemes_customizer_live_preview()
	{
        $mythemes_js_ajaxurl = esc_url( admin_url( '/admin-ajax.php' ) );
    	wp_register_script( 'mythemes-themecustomizer', get_template_directory_uri() . '/media/_backend/js/customizer.js', array( 'jquery', 'customize-preview' ), '',  true );
        wp_localize_script( 'mythemes-themecustomizer', 'mythemes_js_ajaxurl', $mythemes_js_ajaxurl );
        wp_enqueue_script( 'mythemes-themecustomizer' );
	}

	add_action( 'customize_preview_init', 'mythemes_customizer_live_preview' );

    if( is_user_logged_in() ){
        add_action( 'wp_ajax_mythemes_layout_load_sidebar' , array( 'mythemes_layout', 'load_sidebar' ), 100 );
    }

    /* FUNCTIONS FOR VALIDATE */
    function mythemes_validate_logic( $value )
    {
        $rett = true;

        if( absint( $value ) == 0 ){
            $rett = false;
        }

        return $rett;
    }

    function mythemes_validate_number( $value )
    {
        return absint( $value );
    }

    function mythemes_validate_layout( $value )
    {
        if( !in_array( $value , array( 'left' , 'full' , 'right' ) ) ){
            $value = 'right';
        }

        return $value;
    }

    function mythemes_validate_sidebar( $value )
    {
        if( !in_array( $value , array( 'main', 'front-page', 'page', 'post', 'special-page' ) ) ){
            $value = 'main';
        }

        return $value;
    }

    function mythemes_validate_copyright( $value )
    {
        return wp_kses( $value, array(
            'a' => array(
                'href'  => array(),
                'title' => array(),
                'class' => array(),
                'id'    => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'span'      => array()
        ));
    }

    function mythemes_validate_css( $value )
    {
        return stripslashes( strip_tags( $value ) );
    }
?>