<?php
/**
 *
 * @package eventr
 */

?>

<?php

global $post;
$eventr_var = get_option('eventr_var');

// Connect speakers with Program
 $connected = new WP_Query( array(
  'connected_type' => 'speaker_program',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

$speaker_job = get_post_meta($post->ID, "tc_speaker_job", true);
$speaker_company = get_post_meta($post->ID, "tc_speaker_company", true);
$speaker_website = get_post_meta($post->ID, "tc_speaker_website", true);
$featured_speaker = get_post_meta($post-> ID, "tc_featured_speaker", true);

$speaker_facebook_address = get_post_meta($post->ID, "tc_speaker_fb_address", true);
$speaker_tw = get_post_meta($post->ID, "tc_speaker_tw_address", true);
$speaker_googleplus_address = get_post_meta($post->ID, "tc_speaker_gplus_address", true);
$speaker_linkedin_address = get_post_meta($post->ID, "tc_speaker_linkedin_address", true);
$speaker_instagram_address = get_post_meta($post->ID, "tc_speaker_instagram_address", true);

?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <button title="Close (Esc)" type="button" class="mfp-close"><i class="pe-2x pe-va pe-7s-close mfp-close"></i></button>
                  
  <div class="col-md-5 col-lg-5 no-padding">
    <?php echo  get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-responsive' ) ); ?>
  </div>

  <div class="col-md-7 col-lg-7">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    <p class="lead"><?php echo esc_attr($speaker_job) ?> @ <strong><?php echo esc_attr($speaker_company) ?></strong></p>


    <ul class="social list-inline list-unstyled">
      <?php if ( $speaker_facebook_address ) : ?>
      <li><a href="<?php echo esc_url($speaker_facebook_address) ?>"><i class="fa fa-2x fa-facebook-square"></i></a></li>
      <?php endif; ?>

      <?php if ( $speaker_tw ) : ?>
      <li><a href="<?php echo esc_url($speaker_tw) ?>"><i class="fa fa-2x fa-twitter-square"></i></a></li>
      <?php endif; ?>

      <?php if ( $speaker_googleplus_address ) : ?>
      <li><a href="<?php echo esc_url($speaker_googleplus_address) ?>"><i class="fa fa-2x fa-google-plus-square"></i></a></li>
      <?php endif; ?>

      <?php if ( $speaker_linkedin_address ) : ?>
      <li><a href="<?php echo esc_url($speaker_linkedin_address) ?>"><i class="fa fa-2x fa-linkedin-square"></i></a></li>
      <?php endif; ?>

      <?php if ( $speaker_instagram_address ) : ?>
      <li><a href="<?php echo esc_url($speaker_instagram_address) ?>"><i class="fa fa-2x fa-instagram"></i></a></li>
      <?php endif; ?>

    </ul>

    <div id="contentz"  data-mcs-theme="dark-3">
      <?php the_content(); ?>
      <?php if ( $connected->have_posts() ) : ?>
          <h3><?php echo esc_html__('Talks','eventr') ;?></h3>
          <ul class="speaker-talks list-unstyled">
          <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          </ul>
      <?php wp_reset_postdata(); endif; ?>

    </div>
  </div>
    
</div>

