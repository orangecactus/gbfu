<?php
/**
 * eventr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eventr
 */

if ( ! function_exists( 'eventr_setup' ) ) :
	
	function eventr_setup() {

		// Load the TGM init if it exists
	    if ( file_exists( get_template_directory() . '/inc/init/tgm/tgm-init.php' ) ) {
	        require_once get_template_directory() . '/inc/init/tgm/tgm-init.php';
	    }

		if ( class_exists('ReduxFrameworkPlugin') ) {
			//THEME OPTIONS
			require get_template_directory() . '/inc/init/admin-init.php';	
		}


		global $eventr_var;
		global $eventr_font_icons; 

		$eventr_var = get_option('eventr_var');

		//NAVIGATION
		require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


		//WOOCOMMERCE SUPPORT
		add_theme_support( 'woocommerce' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on eventr, use a find and replace
		 * to change 'eventr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eventr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'eventr' ),
			'footer'=> esc_html__('Footer', 'eventr'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eventr_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'eventr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eventr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eventr_content_width', 640 );
}
add_action( 'after_setup_theme', 'eventr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eventr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eventr' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'eventr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 1', 'eventr' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'eventr' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title uppercase">',
        'after_title' => '</h5>',
    ) );
 
    // Second Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 2', 'eventr' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'eventr' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title uppercase">',
        'after_title' => '</h5>',
    ) );
 
    // Third Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 3', 'eventr' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'eventr' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title uppercase">',
        'after_title' => '</h5>',
    ) );


}
add_action( 'widgets_init', 'eventr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eventr_scripts() {

	/* scripts */
	wp_enqueue_script("bootstrap-min", get_template_directory_uri()."/js/bootstrap.min.js",array('jquery'),false,true);
	wp_enqueue_script("mCustomScrollbar", get_template_directory_uri()."/js/jquery.mCustomScrollbar.min.js",array(),false,true);
	wp_enqueue_script("retina", get_template_directory_uri()."/js/retina.min.js",array(),false,true);
	wp_enqueue_script("owl-carousel", get_template_directory_uri()."/js/owl.carousel.min.js",array(),false,true);
	wp_enqueue_script("waypoints", get_template_directory_uri()."/js/jquery.waypoints.min.js",array(),false,true);
	wp_enqueue_script("countdown", get_template_directory_uri()."/js/jquery.countdown.js",array(),false,true);
	wp_enqueue_script("counterup", get_template_directory_uri()."/js/jquery.counterup.min.js",array(),false,true);
	wp_enqueue_script("magnific-popup", get_template_directory_uri()."/js/jquery.magnific-popup.min.js",array(),false,true);
	wp_enqueue_script("imagesloaded", get_template_directory_uri()."/js/imagesloaded.pkgd.min.js",array(),false,true);
	wp_enqueue_script("masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js",array(),false,true);
	wp_enqueue_script("masonry-ordered", get_template_directory_uri()."/js/masonry.ordered.js",array(),false,true);
	wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.js",array(),false,true);

	if ( is_rtl() ) {
	  wp_dequeue_script('owl-carousel');
	  wp_enqueue_script("owl-carousel-rtl", get_template_directory_uri()."/js/owl.carousel-rtl.js",array(),false,true);
	}

	wp_enqueue_script("eventr-scripts", get_template_directory_uri()."/js/scripts.js",array(),false,true);


	 if ( is_rtl() ) {
	   wp_dequeue_script('eventr-scripts');
	   wp_enqueue_script("eventr-scripts-rtl", get_template_directory_uri()."/js/scripts-rtl.js",array(),false,true);
	 }


	/* styles */ 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'pe-7-icon', get_template_directory_uri().'/css/pe-icon-7-stroke.css');
	wp_enqueue_style( 'linearicons', get_template_directory_uri().'/css/linear-icons.css');
	wp_enqueue_style( 'davicons', get_template_directory_uri().'/css/davicons.css');
	wp_enqueue_style( 'helper', get_template_directory_uri().'/css/helper.css');
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.min.css');
	wp_enqueue_style( 'mCustomScrollbar', get_template_directory_uri().'/css/jquery.mCustomScrollbar.min.css');
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');
	wp_style_add_data( 'owl-carousel', 'rtl', 'replace' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css');
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.min.css');
	wp_enqueue_style( 'countdown', get_template_directory_uri().'/css/jquery.countdown.css');

	wp_enqueue_style( 'eventr-style', get_stylesheet_uri() );

	wp_style_add_data( 'eventr-style', 'rtl', 'replace' );


	//if( function_exists( 'themecube_corepluginupdate' ) ) {
 
		wp_enqueue_style( 'dynamic-css', get_template_directory_uri().'/style.php');
	 
	//}




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eventr_scripts' );


//CUSTOM CSS
if (!function_exists('eventr_custom_css')) {
		function eventr_custom_css(){
			$eventr_var = get_option('eventr_var');

			if (!empty($eventr_var['css_editor'])){

				echo '<style type="text/css"> '.$eventr_var['css_editor'].'</style>';
			} else
				echo "";

		}
}

add_action('wp_enqueue_style','eventr_custom_css');

//CUSTOM JS
if (!function_exists('eventr_custom_js')) {
		function eventr_custom_js(){
			$eventr_var = get_option('eventr_var');

			if (!empty($eventr_var['js_editor'])){

				echo '<script> '.$eventr_var['js_editor'].'</script>';
			}

		}
}

add_action('wp_enqueue_script','eventr_custom_js');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function eventr_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}

/* Visual Composer */
if(function_exists('vc_add_param')){
 
  vc_add_param('vc_row',array(
        "type" => "dropdown",
        "heading" => esc_html__('Fullwidth', 'eventr'),
        "param_name" => "fullwidth",
        "value" => array(   
                esc_html__('No', 'eventr') => 'no',  
                esc_html__('Yes', 'eventr') => 'yes',                                                                                
                ),
        "description" => esc_html__("Select Fullwidth or not", 'eventr'), 
        'weight' => 1,     
      ) 
    );
	
	vc_add_param('vc_row_inner',array(
        "type" => "dropdown",
        "heading" => esc_html__('Fullwidth', 'eventr'),
        "param_name" => "fullwidth",
        "value" => array(   
                esc_html__('No', 'eventr') => 'no',  
                esc_html__('Yes', 'eventr') => 'yes',                                                                                
                ),
        "description" => esc_html__("Select Fullwidth or not", 'eventr'),
        'weight' => 1,     
      ) 
    );
	

} 

if (!function_exists('connect_speaker_program')) {

	function connect_speaker_program() {
	    p2p_register_connection_type( array(
	        'name' => 'speaker_program',
	        'from' => 'speaker',
	        'to' => 'schedule'
	    ) );
	}

	add_action( 'p2p_init', 'connect_speaker_program' );

}



//Backend CSS
if ( !function_exists( 'eventr_backend_css' ) ) {
	
	function eventr_backend_css() {	                           		
		wp_enqueue_style( 'pe-7-icon', get_template_directory_uri().'/css/pe-icon-7-stroke.css', false, '', 'all');
		wp_enqueue_style( 'linearicons', get_template_directory_uri().'/css/linear-icons.css');
		wp_enqueue_style( 'davicons', get_template_directory_uri().'/css/davicons.css');
		wp_enqueue_style( 'admin-css', get_template_directory_uri().'/css/admin.css', false, '', 'all' );
		wp_style_add_data( 'admin-css', 'rtl', 'replace' );
		wp_enqueue_script("cmb2-conditionals", get_template_directory_uri()."/js/cmb2-conditionals.js",array('jquery'),false,true);

        }
		        
	// Pe Icon fonts for backend
    add_action( 'admin_enqueue_scripts', 'eventr_backend_css' );                   
}

/* Read More */
if ( !function_exists( 'eventr_modify_read_more_link' ) ) {
    function eventr_modify_read_more_link() {

        global $eventr_var;
        $read_more_text = isset( $eventr_var['blog-continue-reading'] ) ? sanitize_text_field( $eventr_var['blog-continue-reading'] ) : esc_html__( 'Read more', 'eventr' );
        return '<a class="read-more-button common-button common-button-dark button-sm" href="' . get_permalink() . '">' . $read_more_text . '</a>';
    }
    add_filter( 'the_content_more_link', 'eventr_modify_read_more_link' );
  }
  
/*  */
if ( !function_exists( 'eventr_get_the_excerpt_max_charlength' ) ) {
    function eventr_get_the_excerpt_max_charlength( $charlength ) {
    	$excerpt = get_the_excerpt();
        
    	$charlength++;
    
    	if ( mb_strlen( $excerpt ) > $charlength ) {
    		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
    		$exwords = explode( ' ', $subex );
    		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
    		if ( $excut < 0 ) {
    			$subex = mb_substr( $subex, 0, $excut );
    		} 
    		$subex .= '...';
            $excerpt = $subex;
    	} 
        
        return $excerpt;
    }   
}

function eventr_shortcode_empty_paragraph_fix( $content ) {

    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr( $content, $array );

    return $content;
}

add_filter( 'the_content', 'eventr_shortcode_empty_paragraph_fix' );


//Demo Extended Settings
if ( !function_exists( 'eventr_demo_import_extended' ) ) {
	function eventr_demo_import_extended( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'main' => 'mainslider.zip', //Set slider zip name
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		$wbc_menu_array = array( 'main' );

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$primary = get_term_by( 'name', 'primary', 'nav_menu' );
			

		//	if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'primary' => $primary->term_id,
					)
				);
		//	}

		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'main' => 'Homepage',
			
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}


	}


	// Uncomment the below
	 add_action( 'wbc_importer_after_content_import', 'eventr_demo_import_extended', 10, 2 );
}




