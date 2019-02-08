<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "eventr_var";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'eventr_var',
        'use_cdn' => TRUE,
        'display_name' => 'Eventr Theme',
        'display_version' => '2.0',
        'page_slug' => '_options',
        'page_title' => 'Theme Options',
        'dev_mode'             => false,
        'update_notice'        => false,
        'templates_path'    => get_template_directory() . '/inc/panel/',
        'open_expanded' => false,
        'system_info' => false,
        'admin_bar' => true,
        //'admin_bar_icon' => get_template_directory() . '/img/themecube.svg',
        'menu_type' => 'submenu',
        'menu_title' => 'Theme Options',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'themes.php',
        'page_parent_post_type' => 'your_post_type',
        'default_mark' => '',
        'google_api_key' => 'AIzaSyCSrkdJP31DkXBF0s_99tgXv5tZeaDhJMs',
        'hints' => array(
            'icon' => 'el el-cog',
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        //'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'page_priority'        => null,
    );



    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'eventr' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'eventr' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'eventr' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'eventr' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'eventr' );
    Redux::setHelpSidebar( $opt_name, $content );


    if(!function_exists('redux_register_custom_extension_loader')) :
    function redux_register_custom_extension_loader($ReduxFramework) {

        if( function_exists( 'themecube_corepluginupdate' ) ) {

            $path = ABSPATH . 'wp-content/plugins/themecube-core/redux-extensions/';

            $folders = scandir( $path, 1 );

            foreach ( $folders as $folder ) {
                if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
                    continue;
                }
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if ( ! class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
                    if ( $class_file ) {
                        require_once( $class_file );
                    }
                }
                if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
                    $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
                }
            }

        }
    }


    // Modify {$eventr_var} to match your opt_name
    add_action("redux/extensions/".$opt_name ."/before", 'redux_register_custom_extension_loader', 0);
    endif;


    /*
     *
     * ---> START SECTIONS
     *
     */


    //GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General Settings', 'eventr' ),
        'id'    => 'basic',
        //'desc'  => esc_html__( 'Basic fields as subsections.', 'eventr' ),
        'icon'  => 'dv-davicons-gear',
        'fields'     => array(
                      
            array(
                'id'        => 'preload',
                'type'      => 'switch',
                'title'     => esc_html__('Display Preload', 'eventr'),
                'subtitle'  => esc_html__('Display preload', 'eventr'),
                'default'  => true,
            ),
            
            array(
                'id'        => 'tc_preload_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Preload Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the preload color', 'eventr'),
                'required'      => array('preload', '!=', '0'),
                'default'   => '#ffffff',
                'output'    => array('background-color' => '.spinner'),
            ),
            
            array(
                'id'        => 'tc_preload_bg_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Preload Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the preload background', 'eventr'),
                'default'   => '#fac42b',
                'required'      => array('preload', '!=', '0'),
                'output'    => array('background-color' => '#preload'),               
            ),
           
            array(
                'id'        => 'scroll_to_top',
                'type'      => 'switch',
                'title'     => esc_html__('Scroll to Top Button', 'eventr'),
                'subtitle'  => esc_html__('Toggle whether or not to enable a back to top button on your pages', 'eventr'),
                'default'  => true,
            ),

            array(
                'id'        => 'rtl_support',
                'type'      => 'switch',
                'title'     => esc_html__('RTL Support', 'eventr'),
                'subtitle'  => esc_html__('Right to left languages support', 'eventr'),
                'default'  => false,
            ),
                        
            array(
                'id'       => 'js_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('Custom JS Code', 'eventr'),
                'subtitle' => esc_html__('Paste your JS code here', 'eventr'),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
            ),
        )
    ) );

    //COLOR OPTIONS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Colors', 'eventr' ),
        'id'    => 'styling',
        'icon'  => 'dv-davicons-eyewear',
        'fields'     => array(
        
            array(
                'id'        => 'primary_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Select Primary Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the main color for the theme', 'eventr'),
                'default'   => '#fac42b',
                'output'    => array(
                    'color' => '.speaker-detail .title, .speaker-talks li a:hover, #ss-submit, #review_form .submit, .nav-previous, .nav-next, #ss-submit, #review_form .submit:hover, .nav-previous:hover, .nav-next:hover, .common-button:hover, .common-button-dark:hover, .common-button.gradient-bg:hover, .search-results a, .search-results .entry-meta a, .blog-posts article h1 a:hover, .blog-posts article h2 a:hover, article i, .byline a:hover, .posted-on a:hover, .cat-links a:hover, .tags-links a:hover, .comments-link a:hover, .comment-metadata a:hover, .comment-author a, .comment-author a:hover, .comment-reply-link:hover, #secondary a:hover, #secondary a:focus, .woocommerce ul.cart_list a, .woocommerce ul.product_list_widget a, .woocommerce ul.products li.product .price, .product_list_widget .woocommerce-Price-amount, .woocommerce ul.products li.product .caption h2:hover, .summary .price span.woocommerce-Price-amount, .woocommerce div.product p.price del, .woocommerce div.product span.price del, nav.woocommerce-MyAccount-navigation ul li a:hover, td.order-number a:hover, .product-name a, .product-name a:hover, .cart_totals h2, .woocommerce-error a:hover, .woocommerce-info a:hover, .woocommerce-message a:hover, .site-footer a:hover, #footer ul li a:hover',
                    'background-color' => '.header, .owl-theme .owl-controls .owl-page span, button.mfp-close, span.featured-speaker, #secondary aside h3:after, input.search-submit, h3.widget-title:after, .tagcloud a:hover, .tagcloud a:focus, #wp-calendar td > a, #wp-calendar td > a:hover, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .custom-pagination nav.woocommerce-pagination ul li a:focus, .custom-pagination nav.woocommerce-pagination ul li a:hover, .custom-pagination nav.woocommerce-pagination ul li span.current, .woocommerce span.onsale, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, #footer h5:after, h3.border-bottom:after, h2.border-bottom:after, #download h3:after, .speaker-thumb h4:after',
                    'border-color' => 'input.search-submit, .tagcloud a:hover, .tagcloud a:focus, .sponsor-item',
                )
            ),

            array(
                'id'        => 'light_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Light Color', 'eventr'),
                'subtitle'  => esc_html__('Pick a light color for the theme', 'eventr'),
                'default'   => '#ffffff',
                'output'    => array(
                        'color' => '.top-search input.form-control, .top-search .input-group-addon, .dark .infobox-2 .description h5, .single-program-details, .single-program-details-alt, .woocommerce span.onsale, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce a.added_to_cart, figure.effect-sadie figcaption, figure.effect-sadie:hover h2, .woocommerce ul.products li.product .button, .woocommerce .woocommerce-breadcrumb, .woocommerce .woocommerce-breadcrumb a',
                        'background-color' => '.navbar-custom .icon-bar, .hprogram ',
                        'border-color' => '', 
                    )
            ),
            
            array(
                'id'        => 'dark_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Dark Color', 'eventr'),
                'subtitle'  => esc_html__('Pick a dark color for the theme', 'eventr'),
                'default'   => '#262626',
                'output'    => array(
                    'color' => '.border-light:hover, .border-dark, .search-results a:hover, .comment-reply-link, .product_list_widget .product-title, .woocommerce ul.products li.product h3, h2.product_title, span[itemprop="author"], td.order-number a, .woocommerce-error a, .woocommerce-info a, .woocommerce-message a, .product_list_widget .product-title, .woocommerce ul.products li.product h3, .woocommerce ul.products li.product .woocommerce-loop-product__title, h2.product_title',
                    'background-color' => '.owl-theme .owl-nav [class*=owl-], body.search-no-results .navbar-custom, body.search-results .navbar-custom, #ss-submit, .common-button-dark, .border-dark:hover, .comment-reply-link:hover, .woocommerce ul.products li.product .button ',
                    'border-color' => '.border-dark, .comment-reply-link',
                    )
            ),
        
        )
    ) );
        
    //TYPOGRAPHY OPTIONS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Typography', 'eventr' ),
        'id'    => 'tc_typoptions',
        'icon'  => 'dv-davicons-pen',
        'fields'     => array(

            array(
                'id'          => 'typo_body',
                'type'        => 'typography', 
                'title'       => esc_html__('Body Font', 'eventr'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => true,
                'font-size'  => true,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => true,
                'line-height'  => true,
                'letter-spacing' => true,
                'all_styles'    => true,
                'output'      => array('body'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for body', 'eventr'),
                'default'     => array(
                    'font-family' => 'Open Sans',
                    'font-size'   => '14px',
                    'line-height' => '23px',
                    'google'      => true,
                    'color'       => '#545454',
                    'font-weight' => '400',
                ),
            ),
            
            array(
                'id'          => 'typo_heading',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading Font Family', 'eventr'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'font-size'  => false,
                'text-align'  => false,
                'font-weight'  => false,
                'font-style'  => false,
                'line-height'  => false,
                'letter-spacing' => false,
                'output'      => array('h1, h2, h3, h4, h5, h6, p.date, p.price, .price-table .content, .time_circles div span'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for heading', 'eventr'),
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'google'      => true,              
                ),
            ),

            array(
                'id'          => 'typo_subheading',
                'type'        => 'typography', 
                'title'       => esc_html__('Lead Class Font', 'eventr'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'font-size'  => true,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => false,
                'line-height'  => true,
                'letter-spacing' => true,
                'output'      => array('.lead, .woocommerce ul.products li.product .price'),
                //'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for lead class', 'eventr'),
                'default'     => array(
                    'font-family' => 'Open Sans', 
                    'google'      => true,
                    'font-weight' => '300',
                ),
            ),
            
            array(
                'id'          => 'typo_button',
                'type'        => 'typography', 
                'title'       => esc_html__('Button Font', 'eventr'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'font-size'  => false,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => true,
                'line-height'  => false,
                'letter-spacing' => false,
                'output'      => array('.button, .contact-form .wpcf7-submit, .wpcf7-submit, .read-more-button, a.button '),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for buttons', 'eventr'),
                'default'     => array(
                    'font-family' => 'Montserrat',
                    'google'      => true,
                    'font-weight' => '400',
                ),
            ),
            
    
        
        )
    ) );

    //LOGO AND FAVICON SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Logo and Favicon', 'eventr' ),
        'id'    => 'logofavicon',
        'icon'  => 'dv-davicons-vector1',
        'fields'     => array(
        
            
            array(
                'id'        => 'nav_logo_image',
                'type'      => 'media',
                'url'       => false,
                'title'     => esc_html__('Logo', 'eventr'),
                'subtitle'  => esc_html__('Upload a logo for navigation menu', 'eventr'),
                'default'   => array('url' => get_template_directory_uri().'/img/logo.png'),
            ),
            
            array(
                'id'        => 'nav_logo_image_retina',
                'type'      => 'media',
                'url'       => false,
                'title'     => esc_html__('Retina Logo', 'eventr'),
                'subtitle'  => esc_html__('Upload at exactly 2x the size of your standard logo. Supplying this will keep your logo crisp on screens with a higher pixel density', 'eventr'),
                //'default'   => array('url' => get_template_directory_uri().'/img/logo_transparent.png')
            ),

            array(
                'id'       => 'logo_dimension',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'title'    => esc_html__('Logo Height', 'eventr'),
                'subtitle' => esc_html__('Enter a height value for logo', 'eventr'),
                'width'    => false,
                'default'  => array(
                    'height'  => '45'
                ),
                'output' => array (
                        'height' => '.navbar-brand img.logo'
                    )
            ),

            array(
                'id'       => 'logo_dimension_mobile',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'title'    => esc_html__('Mobile Logo Height', 'eventr'),
                'subtitle' => esc_html__('Enter a logo height value for mobile devices', 'eventr'),
                'width'    => false,
                'default'  => array(
                    'height'  => '45'
                ),
            ),
            
            array(
                'id'        => 'favicon',
                'type'      => 'media',
                'url'       => false,
                'title'     => esc_html__('Favicon', 'eventr'),
                'subtitle'  => esc_html__('Upload a favicon', 'eventr'),
                'default'   => array('url' => get_template_directory_uri().'/img/favicon.ico'),
            ),
            
            array(
                'id'        => 'apple_touch_icon',
                'type'      => 'media',
                'url'       => false,
                'title'     => esc_html__('IPhone Retina Icon', 'eventr'),
                'subtitle'  => esc_html__('Upload IPhone retina icon 180x180px', 'eventr'),
                'default'   => array('url' => get_template_directory_uri().'/img/apple-touch-icon.png'),
            ),
             
        )
    ) );

    //NAVIGATION SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Navigation', 'eventr' ),
        'id'    => 'navigation',
      //'subsection'       => true,
        'icon'  => 'dv-davicons-align',
        'fields'     => array(

            array(
                'id'        => 'nav_bg_color_top',
                'type'      => 'color_rgba',
                'transparent' => true,                  
                'title'     => esc_html__('Top Navigation Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the top position navigation background', 'eventr'),
                'output'    => array('background-color' => '.default'),
            ),
        
            array(
                'id'        => 'nav_bg_color',
                'type'      => 'color_rgba',
                'transparent' => false,                  
                'title'     => esc_html__('Scroll Navigation Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the fixed top navigation background', 'eventr'),
                'default'   => array(
                    'color'     => '#262626',
                    'alpha'     => 1
                ),
                'output'    => array('background-color' => '.fixed'),
            ),

            array(
                'id'        => 'menu_item_hover',
                'type'      => 'color_rgba',
                'transparent' => true,                  
                'title'     => esc_html__('Menu Item Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the menu item background color when hover', 'eventr'),
                'default'   => array(
                   // 'color'     => '#262626',
                    'alpha'     => 1
                ),
                'output'    => array('background-color' => '.nav>li>a:hover, .nav>li>a:focus, li.dropdown:hover .dropdown-toggle, .nav .open>a, .nav .open>a:hover, .nav .open>a:focus'),
            ),

            array(
                'id'        => 'dropdown_bg_color',
                'type'      => 'color_rgba',
                'transparent' => false,                  
                'title'     => esc_html__('Dropdown Menu Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the navigation dropdown background', 'eventr'),
                'default'   => array(
                    'color'     => '#262626',
                    'alpha'     => 1
                ),
                'output'    => array('background-color' => '.dropdown-menu'),
            ),

            array(
                'id'       => 'nav_link_color',
                'type'     => 'link_color',
                'visited'  => false,
                'title'    => esc_html__('Navigation Links Color', 'eventr'),
                'subtitle' => esc_html__('Pick the colors for navigation links', 'eventr'),
                'default'  => array(
                    'regular'  => '#ffffff', 
                    'hover'    => '#fac42b', 
                    'active'   => '#ffffff',  
                ),
                'output'    => array('color' => '.navbar-custom .nav>li>a, .dropdown-menu>li>a, .dropdown-menu>li.active>a'),
            ),

            array(
                'id'          => 'typo_nav',
                'type'        => 'typography', 
                'title'       => esc_html__('Navigation Font', 'eventr'),
                'google'      => true, 
                'font-backup' => false,
                'color'       => false,
                'font-size'  => true,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => false,
                'font-options'    => 'true',
                'all_styles' => true,
                'text-transform' => true,
                'line-height'  => true,
                'letter-spacing' => true,
                'output'      => array('.navbar-custom, .navbar-nav>li>a'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for navigation', 'eventr'),
                'default'     => array(
                    'font-family' => 'Open Sans', 
                    'google'      => true,
                    'font-size'   => '12px',
                    'font-weight' => '400',
                    'letter-spacing' =>'1px',
                    'line-height'  => '20px',
                    'text-transform' => 'uppercase',
                ),
            ),

            array(
                'id'          => 'typo_nav_dropdown',
                'type'        => 'typography', 
                'title'       => esc_html__('Navigation Dropdown Menu Font', 'eventr'),
                'google'      => true, 
                'font-backup' => false,
                'color'       => false,
                'font-size'  => true,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => false,
                'font-options'    => 'true',
                'all_styles' => true,
                'text-transform' => true,
                'line-height'  => true,
                'letter-spacing' => true,
                'output'      => array('.navbar-custom .dropdown-menu, .dropdown-menu>li>a'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for dropdown menu', 'eventr'),
                'default'     => array(
                    'font-family' => 'Open Sans', 
                    'google'      => true,
                    'font-size'   => '12px',
                    'font-weight' => '400',
                    'letter-spacing' =>'1px',
                    'line-height'  => '18px',
                    'text-transform' => 'uppercase',
                ),
            ),

            array(
                'id'        => 'nav_fullwidth',
                'type'      => 'switch',
                'title'     => esc_html__('Fullwidth Navigation', 'eventr'),
                'subtitle'  => esc_html__('Enable or disable the fullwidth navigation', 'eventr'),
                'default'  => false,
            ),
            
            array(
                'id'        => 'menu_button_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Menu Button Text Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the menu button', 'eventr'),
                'default'   => '#ffffff',
                'output'    => array(
                    'color' => '.nav li.menu-button a',
                    'background-color' => '.nav li.menu-button a:hover'
                ),
            ),

            array(
                'id'        => 'menu_button_bg_color',
                'type'      => 'color',
                'transparent' => false,                  
                'title'     => esc_html__('Menu Button Background Color', 'eventr'),
                'subtitle'  => esc_html__('Pick the color for the menu button background', 'eventr'),
                'default'   => '#fac42b',
                'output'    => array(
                    'background-color' => '.nav li.menu-button a',
                    'color' => '.nav li.menu-button a:hover'
                ),
            ),
             
             
        )
    ) );

    //FOOTER SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'eventr' ),
        'id'    => 'footer',
        'icon'  => 'dv-davicons-download1',
        'fields'     => array(

        array(
            'id'        => 'footer_bg_color',
            'type'      => 'color',
            'transparent' => false,                  
            'title'     => esc_html__('Footer background color', 'eventr'),
            'subtitle'  => esc_html__('Pick the color for the footer background', 'eventr'),
            'default'   => '#262626',
            'output'    => array(
                    'background-color' => 'footer#footer'
                ),
        ),
        array(
            'id'          => 'typo_footer_header',
            'type'        => 'typography', 
            'title'       => esc_html__('Footer widget header', 'eventr'),
            'google'      => true, 
            'font-backup' => false,
            'color'       => true,
            'font-size'  => true,
            'text-align'  => false,
            'font-weight'  => true,
            'font-style'  => false,
            'font-options'    => true,
            'all_styles' => true,
            'text-transform' => false,
            'line-height'  => true,
            'letter-spacing' => true,
            'output'      => array('.site-footer h5'),
            'units'       =>'px',
            'subtitle'    => esc_html__('Choose font for footer widget headers', 'eventr'),
            'default'     => array(
                'font-family' => 'Montserrat', 
                'google'      => true,
                'font-weight' => '400',
                'color'       => '#ffffff',
                'font-size'   => '18px',
                'letter-spacing' =>'0',
            ),
        ),
        array(
            'id'          => 'typo_footer',
            'type'        => 'typography', 
            'title'       => esc_html__('Footer font', 'eventr'),
            'google'      => true, 
            'font-backup' => false,
            'color'       => true,
            'font-size'  => true,
            'text-align'  => false,
            'font-weight'  => true,
            'font-style'  => true,
            'line-height'  => true,
            'letter-spacing' => true,
            'all_styles'    => true,
            'output'      => array('.site-footer, .site-footer a'),
            'units'       =>'px',
            'subtitle'    => esc_html__('Choose font for footer', 'eventr'),
            'default'     => array(
                'font-family' => 'Open Sans', 
                'google'      => true,
                'color'       => '#b0b0b0',
                'font-weight' => '400',
                'font-size'   => '13px',
                'line-height' => '18px'
            ),
        ),
        array(
            'id' => 'copyright_display',
            'type' => 'switch',
            'title' => esc_html__('Subfooter', 'eventr'),
            'subtitle' => esc_html__('Display copyright or footer menu area at the bottom of page', 'eventr'),
            'default' => '1',
            'on' => esc_html__( 'Yes', 'eventr' ),
            'off' => esc_html__( 'No', 'eventr' ),                        
        ),
        array(
            'id'        => 'subfooter_bg',
            'type'      => 'color',
            'transparent' => false,                  
            'title'     => esc_html__('Subfooter background color', 'eventr'),
            'subtitle'  => esc_html__('Pick the bg color for the copyright area', 'eventr'),
            'required'      => array('copyright_display', '!=', '0'),
            'default'   => '#000000',
            'output'    => array(
                    'background-color' => '.subfooter'
                ),
        ),
        array(
            'id' => 'copyright_content',
            'type' => 'switch',
            'title' => esc_html__('Subfooter content', 'eventr'),
            'subtitle' => esc_html__('Copyright text or footer menu', 'eventr'),
            'default' => '1',
            'on' => esc_html__( 'Copyright text', 'eventr' ),
            'off' => esc_html__( 'Footer menu', 'eventr' ),
            'required'      => array('copyright_display', '!=', '0'),                        
        ),

        array(
            'id'            => 'copyright_text',
            'type'          => 'text',
            'title'         => esc_html__('Copyright text', 'eventr'),
            'subtitle' => esc_html__('Optional', 'eventr'),
            'default'       => esc_html__('Copyright 2018 Eventr.  All rights reserved', 'eventr'),
            'required'      => array('copyright_content', '!=', '0'),
        ),

        array(
            'id'        => 'copyright_text_color',
            'type'      => 'color',
            'transparent' => false,                  
            'title'     => esc_html__('Copyright text color', 'eventr'),
            'subtitle'  => esc_html__('Pick the color for the copyright text', 'eventr'),
            'required'      => array('copyright_content', '!=', '0'),
            'default'   => '#555555',
            'output'    => array(
                    'color' => '.subfooter span'
                ),
        ),

        array(
            'id'       => 'copyright_align',
            'type'     => 'select',
            'title'    => esc_html__('Subfooter align', 'eventr'), 
            //'subtitle' => esc_html__('No validation can be done on this field type', 'eventr'),
            // Must provide key => value pairs for select options,
            'required'      => array('copyright_display', '!=', '0'),
            'options'  => array(
                'text-left' => 'Left',
                'text-center' => 'Center',
                'text-right' => 'Right'
            ),
            'default'  => 'text-left',
        ),
        
    
        )
    ) );

    //404 SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( '404 Error Page', 'eventr' ),
        'id'    => '404',
        'icon'  => 'dv-davicons-hidden',
        'fields'     => array(
        
        array(
            'id' => 'tc_404_type',
            'type' => 'switch',
            'title' => esc_html__('404', 'eventr'),
            'subtitle' => esc_html__('Show text or image', 'eventr'),
            'default' => '1',
            'on' => esc_html__( 'Text', 'eventr' ),
            'off' => esc_html__( 'Image', 'eventr' ),
        ),

        array(
            'id'        => 'tc_404_image',
            'type'      => 'media',
            'url'       => false,
            'title'     => esc_html__('404 Image', 'eventr'),
            'subtitle'  => esc_html__('Upload a 404 image', 'eventr'),
            'required'      => array('tc_404_type', '!=', '1'),
        ), 

        array(
            'id'            => 'tc_404_header',
            'type'          => 'text',
            'title'         => esc_html__('404 Header', 'eventr'),
            'subtitle' => esc_html__('Optional', 'eventr'),
            'default'       => esc_html__('Oops! That page can not be found.', 'eventr'),
        ),

        array(
            'id'            => 'tc_404_text',
            'type'          => 'text',
            'title'         => esc_html__('404 Text', 'eventr'),
            'subtitle' => esc_html__('Optional', 'eventr'),
            'default'       => esc_html__('It looks like nothing was found at this location. Maybe go to our home page', 'eventr'),
        ),
                                               
        )
    ) );
    
    //BLOG SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog', 'eventr' ),
        'id'    => 'blog_settings',
        'icon'  => 'dv-davicons-pencil2',
        'fields'     => array(
                                 
        
        array(
                'id'          => 'blog_metas_typo',
                'type'        => 'typography', 
                'title'       => esc_html__('Blog Meta Font', 'eventr'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => true,
                'font-size'  => true,
                'text-align'  => false,
                'font-weight'  => true,
                'font-style'  => true,
                'letter-spacing' => true,
                'line-height'  => true,
                'output'      => array('.entry-footer, .entry-footer a, .entry-meta, .entry-meta a, .posted-on, .byline, .cat-links, .tags-links'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Choose font for Blog metas', 'eventr'),
                'default'     => array(
                    'google'      => true,
                ),
               
            ),             
        array(
            'id' => 'tc-blog-loop-content-type',
            'type' => 'switch',
            'title' => esc_html__('Blog list loop content', 'eventr'),
            'subtitle' => esc_html__('Show the blog content or the excerpt on loop', 'eventr'),
            'default' => '1',
            'on' => esc_html__( 'The content', 'eventr' ),
            'off' => esc_html__( 'The excerpt', 'eventr' ),                        
        ),                    
        array(
            'id'            => 'excerpt-max-char-length',
            'type'          => 'text',
            'title'         => esc_html__('The excerpt max chars length', 'eventr'),
            'default'       => 300,
            'validate'      => 'numeric',
            'required'      => array('tc-blog-loop-content-type', '!=', '1'),
        ),
        array(
            'id'            => 'blog-continue-reading',
            'type'          => 'text',
            'title'         => esc_html__('Continue reading', 'eventr'),
            'subtitle'      => esc_html__('Continue reading text', 'eventr'),
            'default'       => esc_html__( 'Read more', 'eventr' ),
            'required'      => array('tc-blog-loop-content-type', '!=', '1'),
        ),
        
    
        )
    ) );
    
    //SOCIAL MEDIA  SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Social Accounts', 'eventr' ),
        'id'    => 'tc_social_accounts',
        'icon'  => 'dv-davicons-share1',
        'fields'     => array(
            
            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'eventr' ),
                'subtitle' => esc_html__( 'Add facebook link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
               // 'validate'  => 'url',
             
               
            ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'eventr' ),
                'subtitle' => esc_html__( 'Add Twitter link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
              //  'validate'  => 'url',
            ),
            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'eventr' ),
                'subtitle' => esc_html__( 'Add Instagram link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
              //  'validate'  => 'url',
            ),
            array(
                'id'       => 'google-plus',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Plus', 'eventr' ),
                'subtitle' => esc_html__( 'Add Google+ link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
              //  'validate'  => 'url',
            ),
            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'eventr' ),
                'subtitle' => esc_html__( 'Add Pinterest link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
               // 'validate'  => 'url',
            ),
            array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'eventr' ),
                'subtitle' => esc_html__( 'Add Youtube link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
               // 'validate'  => 'url',
            ),
            array(
                'id'       => 'vimeo',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo', 'eventr' ),
                'subtitle' => esc_html__( 'Add Vimeo link', 'eventr' ),
                'placeholder' => esc_html__('http://','eventr'),
                'default' => '#',
              //  'validate'  => 'url',
              
            ),
                
        )
    ) );
        
    //GOOGLE MAP SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Map', 'eventr' ),
        'id'    => 'map',
        'icon'  => 'dv-davicons-pin1',
        'fields'     => array(
             
             array(
                'id'       => 'map-latitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Latitude', 'eventr' ),
                'desc'     => esc_html__( 'Find your coordinates at http://mapcoordinates.net/en', 'eventr' ),
                'default'  => '40.801485408197856',
            ),
            
            array(
                'id'       => 'map-longtitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Longtitude', 'eventr' ),
                'desc'     => esc_html__( 'Find your coordinates at mapcoordinates.net/en', 'eventr' ),
                'default'  => '-73.96745953467104',
            ),
            
             array(
                'id'        => 'map_zoom',
                'type'     => 'spinner', 
                'title'    => esc_html__('Zoom Level', 'eventr'),
                'subtitle' => esc_html__('Map zoom level','eventr'),
                'desc'     => esc_html__('Min:0, max: 40', 'eventr'),
                'default'  => '14',
                'min'      => '0',
                'step'     => '1',
                'max'      => '40',
             ),
        
             array(
                'id'       => 'scrollwheel',
                'type'     => 'radio',
                'title'    => esc_html__('Scroll-whell', 'eventr'), 
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'true' => 'On', 
                    'false' => 'Off', 
                ),
                'default' => 'false'
            ),
        
            array(
                'id'       => 'map_style',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Map Style', 'eventr' ),
                'subtitle' => esc_html__( 'Please visit snazzymaps.com for more styles', 'eventr' ),
                'default' => '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]',
            ),
            
            array(
                'id'       => 'map_type',
                'type'     => 'select',
                'title'    => esc_html__('Select Map Type', 'eventr'), 
                'options'  => array(
                    'ROADMAP' => 'Roadmap',
                    'HYBRID' => 'Hybrid',
                    'SATELLITE' => 'Satellite',
                    'TERRAIN' => 'Terrain'
                ),
                'default'  => 'ROADMAP',
            ),

            array(
                'id'       => 'map-api',
                'type'     => 'text',
                'title'    => esc_html__( 'Map API', 'eventr' ),
                'desc'     => esc_html__( 'Get an API Key from Google  https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key', 'eventr' ),
                'default'  => '',
            ),
            
             array(
                'id'        => 'marker_image',
                'type'      => 'media',
                'url'       => false,
                'title'     => esc_html__('Marker Image', 'eventr'),
                'subtitle'  => esc_html__('Upload a marker image', 'eventr'),               
            ),
            
            
        )
    ) );

    //GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Custom CSS', 'eventr' ),
        'id'    => 'custom-css',
        //'desc'  => esc_html__( 'Basic fields as subsections.', 'eventr' ),
        'icon'  => 'dv-davicons-code',
        'fields'     => array(  
            array(
                'id'       => 'css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('CSS Code', 'eventr'),
                'subtitle' => esc_html__('Enter your CSS code in the field below. Do not include any tags or HTML in the field. Custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.', 'eventr'),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'options'  => array(
                        'minLines'  =>  40,
                        'maxLines'  =>  500,
                    )
            ),
            
        )
    ) );
    
    //DEMO IMPORT
    Redux::setSection( $opt_name, array(
        'id' => 'wbc_importer_section',
        'title'  => esc_html__( 'Demo Content', 'eventr' ),
        'icon'   => 'dv-davicons-browser',
        'fields' => array(
                        array(
                            'id'   => 'wbc_demo_importer',
                            'type' => 'wbc_importer'
                            )
                    )
    ) );


    /*
     * <--- END SECTIONS
     */
