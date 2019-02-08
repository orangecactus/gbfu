<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eventr
 */

$eventr_var = get_option('eventr_var');

?>


		
		<?php if (true == $eventr_var['scroll_to_top']): ?>
	    	<a href="#" id="back-to-top" title="Back to top"><i class="pe-2x pe-va pe-7s-angle-up"></i></a>
	    <?php endif ?>

		<footer id="footer" class="site-footer">
	    	<div class="container">
	        	<div class="row">
	            	<div class="col-lg-3 col-md-3 col-sm-6">
	                	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('first-footer-widget-area') ) ?>
	                </div>
	                
	                <div class="col-lg-3 col-md-3 col-sm-6">
	                	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('second-footer-widget-area') ) ?>
	                </div>

	                <div class="col-lg-6 col-md-6 col-sm-12">
	                	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('third-footer-widget-area') ) ?>
	                </div>
	                
	                
	            </div>
	        </div>
			
		</footer><!-- #footer -->

		<?php if ($eventr_var['copyright_display'] == 1): ?>
	        <div class="subfooter <?php echo esc_html($eventr_var['copyright_align']); ?>">
		    	<div class="container">
		            <div class="row">
		                
		                <div class="col-lg-12">
		                	<?php if ($eventr_var['copyright_content'] == 1): ?>
								<span><?php echo esc_html($eventr_var['copyright_text']); ?></span>
							<?php endif; ?>

							<?php if ($eventr_var['copyright_content'] == 0): ?>

								<?php
									wp_nav_menu( array(
										'menu'              => 'footer-menu',
										'theme_location'    => 'Footer',
										'depth'             => 1,
										'container'         => 'ul',
										'container_class'   => '',
										'container_id'      => 'nav',
										'menu_class'        => 'list-unstyled list-inline uppercase',
										'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
										'walker'            => new wp_bootstrap_navwalker())
										);
		                        ?>

						    <?php endif; ?>
		                </div>
		                
		            </div>
		        </div>
		    </div>
		<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>