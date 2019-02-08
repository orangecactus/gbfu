<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eventr
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php $eventr_var = get_option('eventr_var'); ?>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="<?php echo esc_attr($eventr_var['primary_color']);?>" />

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link rel="shortcut icon" href="<?php if(isset($eventr_var['favicon']['url'])){ echo esc_url($eventr_var['favicon']['url']);}else{} ?>" type="image/x-icon">
<?php } ?>

<link rel="apple-touch-icon" sizes="180x180" href="<?php if(isset($eventr_var['apple_touch_icon']['url'])){ echo esc_url($eventr_var['apple_touch_icon']['url']);}else{} ?>">

<?php eventr_custom_css(); ?>
<?php eventr_custom_js(); ?>

<?php wp_head(); ?>

<?php 

?>

</head>

<body <?php body_class(); ?>>

	<?php if (true == $eventr_var['preload']): ?>
	 <!-- PRELOADER -->
    <div id="preload">
      <div class="preload">
        <div class="spinner"></div>
      </div>
    </div>
  <?php endif; ?>

<div id="page" class="site">

	<?php 
	  if ($eventr_var['nav_fullwidth'] == true) { $navwidth = 'container-fluid'; };
	  if ($eventr_var['nav_fullwidth'] == false) { $navwidth = 'container'; };	
	?>


	  <!-- NAVIGATION -->
    <nav class="navbar navbar-custom default">

      <div class="<?php echo esc_attr($navwidth); ?>">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar topbar"></span>
            <span class="icon-bar middlebar"></span>
            <span class="icon-bar bottombar"></span>
          </button>

          <a href="<?php echo esc_url(home_url('/')); ?>"
		         title="<?php bloginfo('name'); ?>"
		         class="navbar-brand">
                
                	<h3 class="navhead">#GBFU</h3>
                
		      </a>
		    </div>

    		<div class="collapse navbar-collapse" id="navbar-collapse"> 
        		<?php wp_nav_menu( array(
		              'menu'			  => '',
		              'theme_location'    => 'primary',
		              'depth'             => 3,
		              'container'         => 'div',
		              'container_class'   => '',
		              'container_id'      => '',
		              'menu_class'        => 'nav navbar-nav no-float navbar-right',
		              'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		              'walker'            => new wp_bootstrap_navwalker())
	              );
	            ?>
    		</div>

      </div>
    </nav>