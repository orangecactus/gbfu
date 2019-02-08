<?php
 
header( "Content-type: text/css; charset: UTF-8" );

	//Setup location of WordPress
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];

	// Access WordPress
	require_once( $path_to_wp . '/wp-load.php' );



  	if (!function_exists('eventr_hex2rgb')){
	function eventr_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
			}
			$rgb = array($r, $g, $b);
			return $rgb; // returns an array with the rgb values
		}
 	}

	$eventr_var = get_option('eventr_var');
	$nav_height = $eventr_var['logo_dimension']['height']/2 . 'px';
	$menu_button = $eventr_var['logo_dimension']['height']/4 . 'px';
	$prm_rgba = eventr_hex2rgb($eventr_var['primary_color']);

?>


<?php if ( is_admin_bar_showing() ) {?>
  .navbar-fixed-top { top: 46px !important; } /*wordpress adminbar height small screen */
   @media (min-width: 768px) {
    .navbar-fixed-top { top: 32px !important; } /*wordpress adminbar height big screen */
   }
<?php }?>

.navbar-custom .nav>li>a {
	padding-top: <?php echo esc_attr($nav_height); ?>;
	padding-bottom: <?php echo esc_attr($nav_height); ?>
}
.default .nav li.menu-button a {
	padding-top: <?php echo esc_attr($menu_button); ?>;
	padding-bottom: <?php echo esc_attr($menu_button); ?>;
	margin-top: <?php echo esc_attr($menu_button); ?>;
	margin-bottom: <?php echo esc_attr($menu_button); ?>;
	margin-left: 10px;
	-webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    -ms-transition: all 0.3s;
    transition: all 0.3s;
}
.wrap .overlay:before {
	background: none repeat scroll 0 0 rgba(<?php echo esc_attr($prm_rgba[0]); ?>,<?php echo esc_attr($prm_rgba[1]); ?>, <?php echo esc_attr($prm_rgba[2])?>, 0.7);
}	
.wrap .overlay:after {
	background: none repeat scroll 0 0 rgba(<?php echo esc_attr($prm_rgba[0]); ?>,<?php echo esc_attr($prm_rgba[1]); ?>, <?php echo esc_attr($prm_rgba[2])?>, 0.7);
}
figure.effect-zoe figcaption {
	background: rgba(<?php echo esc_attr($prm_rgba[0]); ?>,<?php echo esc_attr($prm_rgba[1]); ?>, <?php echo esc_attr($prm_rgba[2]); ?>, 0.7);
}


@media only screen and (max-width: 480px) {
	.container .navbar-collapse,
	.container-fluid .navbar-collapse {
		background-color: <?php echo esc_attr($eventr_var['nav_bg_color']['rgba']) ?> !important; 
	}
	.navbar-header {
		padding-top: <?php echo esc_attr($menu_button); ?>;
		padding-bottom: <?php echo esc_attr($menu_button); ?>
	}
	.navbar-custom img.logo {
		height: <?php echo esc_attr($eventr_var['logo_dimension_mobile']['height']); ?> !important;
	}
	.navbar-custom .nav>li>a {
		padding-top: <?php echo esc_attr($menu_button); ?>;
		padding-bottom: <?php echo esc_attr($menu_button); ?>
	}
	.default .nav li.menu-button a {
		margin-left: 0 !important;
	}
}
 
@media only screen and (min-device-width : 768px) and (max-device-width : 1023px) and (-webkit-min-device-pixel-ratio: 2) {
	.container .navbar-collapse,
	.container-fluid .navbar-collapse {
		background-color: <?php echo esc_attr($eventr_var['nav_bg_color']['rgba']) ?> !important; 
	}
	.navbar-header {
		padding-top: <?php echo esc_attr($menu_button); ?>;
		padding-bottom: <?php echo esc_attr($menu_button); ?>
	}
	.navbar-custom img.logo {
		height: <?php echo esc_attr($eventr_var['logo_dimension_mobile']['height']); ?> !important;
	}
	.navbar-custom .nav>li>a {
		padding-top: <?php echo esc_attr($menu_button); ?>;
		padding-bottom: <?php echo esc_attr($menu_button); ?>
	}
	.default .nav li.menu-button a {
		margin-left: 0 !important;
	}


}
