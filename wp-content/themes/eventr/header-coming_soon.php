<?php


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php $eventr_var = get_option('eventr_var'); ?>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link rel="shortcut icon" href="<?php if(isset($eventr_var['favicon']['url'])){ echo esc_url($eventr_var['favicon']['url']);}else{} ?>" type="image/x-icon"/>
<?php } ?>

<link rel="apple-touch-icon" sizes="76x76" href="<?php if(isset($eventr_var['ipad_icon']['url'])){ echo esc_url($eventr_var['ipad_icon']['url']);}else{} ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php if(isset($eventr_var['iphone_retina_icon']['url'])){ echo esc_url($eventr_var['iphone_retina_icon']['url']);}else{} ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php if(isset($eventr_var['ipad_retina_icon']['url'])){ echo esc_url($eventr_var['ipad_retina_icon']['url']);}else{} ?>">

<?php eventr_custom_css(); ?>
<?php eventr_custom_js(); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php if (true == $eventr_var['preload']): ?>
	 <!-- PRELOADER -->
    <div id="preload" class="gradient-bg">
      <div class="preload-inner">
        <div class="loader"></div>
      </div>
    </div>
    <?php endif; ?>

<div id="page" class="site">



	

				

               


            



