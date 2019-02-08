<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eventr
 */

$eventr_var = get_option('eventr_var');

get_header('coming_soon'); ?>

	<div class="error404 fh">
		<div class="inner text-center">

		<?php if($eventr_var['tc_404_type'] == 1) { ?>
			<p class="t404"><?php echo esc_attr('404','xevent'); ?></p>
		<?php } ?>

		<?php if($eventr_var['tc_404_type'] != 1) { ?>
			<img class="img-responsive center-block" src="<?php echo esc_url($eventr_var['tc_404_image']['url']); ?>" alt="404"/>
		<?php } ?>



		<?php if($eventr_var['tc_404_header']) { ?>
			<h2 class="page-title"><?php echo esc_html($eventr_var['tc_404_header'] ); ?></h2>
		<?php } ?>

		<?php if($eventr_var['tc_404_text']) { ?>
			<p><?php echo esc_html($eventr_var['tc_404_text'] ); ?></p>
		<?php } ?>


		<a href="<?php echo esc_url(home_url('/')); ?>" class="button common-button button-line-dark"><?php echo esc_html('HOMEPAGE', 'eventr') ?></a>		

		</div>
	</div>

<?php
get_footer('coming_soon');
