<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eventr
 */

$image = wp_get_attachment_url( get_post_meta( get_the_ID(), 'tc_header_bg_id', 1 ), 'full' );
 $overlay_bg = get_post_meta( get_the_ID(), 'tc_overlay_bg', true );
 $subhead = get_post_meta( get_the_ID(), 'tc_subhead', true );
 $title_color = get_post_meta( get_the_ID(), 'tc_title_color', true );
 $align = get_post_meta ( get_the_ID(), 'tc_header_align', true );
 $dotted_bg = get_post_meta ( get_the_ID(), 'tc_dotted_bg', true );
 $bg_effect = get_post_meta( get_the_ID(), 'tc_bg_effect', true );
 $color1 = get_post_meta( get_the_ID(), 'tc_color1', true );
 $color2 = get_post_meta ( get_the_ID (), 'tc_color2', true );
 $degree = get_post_meta ( get_the_ID (), 'tc_degree', true );
 $opacity = get_post_meta ( get_the_ID (), 'tc_opacity', true );
 $blended_bg = get_post_meta ( get_the_ID (), 'tc_blended_bg', true );

 $html ='';

 $overlay_color ='';
 if($overlay_bg){$overlay_color = 'style=background-color:'.$overlay_bg.'';}

 $title_style = '';
 if($title_color){$title_style = 'style=color:'.$title_color.'';}

 $dotted = '';
 if($dotted_bg) {$dotted = 'dotted_bg';}

 $bg_image ='';
 if($image){$bg_image ='background-image:url('.$image.');';}

 $gradient_options ='';
 if(($bg_effect) == 'rainbow') {
  $gradient_options = 'data-type=linear data-degrees='.$degree.' data-color='.$color1.'-'.$color2.' data-opacity='.$opacity.'';}

 $blendcss = '';
 if(($bg_effect) == 'blended'){$blendcss = 'background-color:'.$blended_bg.';';}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

    <div id="header-<?php the_ID(); ?>" class="<?php echo esc_html($bg_effect); ?> header header-post" <?php echo esc_html($gradient_options); ?> style="<?php echo esc_html($bg_image); ?> <?php echo esc_html($blendcss); ?>" >
      <div class="inner <?php echo esc_html($dotted); ?>" <?php echo esc_html($overlay_color); ?>>

        <div class="container">
          <div class="row">
            
            <div class="col-lg-12 <?php echo esc_html($align) ?>">
                <?php the_title( '<h1 '.$title_style.' class="entry-title">', '</h1>' ); ?>
                    <?php if($subhead){ echo '<p '.$title_style.' class="subhead">'.$subhead.'</p>'; } 
                ?>
            </div>

          </div>
        </div>
      </div>
    </div>
        
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9 col-md-9 col-sm-8">
				<div class="tc_media">
					<?php if(has_post_format('image')){ ?>
                        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>">
                    <?php } else if(has_post_format('audio')){ ?>
                        <div class="post-format-audio">
                            <?php echo wp_oembed_get( $url ); ?>
                            <div style="clear:both;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    <?php } else if(has_post_format('video')){ ?>
                        <div class="post-format-video">
                            <?php echo wp_oembed_get( $url ); ?>
                            <div style="clear:both;"></div>
                        </div>
                    <?php } else if(has_post_format('link')){ ?>
                            <?php the_content(); ?>
                    <?php } else { ?>	                                   
                        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>">
                    <?php } ?>
                </div>
    
				<header class="entry-header">            
                    <div class="entry-meta">
                        <?php eventr_posted_on(); ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eventr' ),
                            'after'  => '</div>'
                        ) );
                    ?>
                </div><!-- .entry-content -->
                
                <footer class="entry-footer">
                    <?php eventr_entry_footer(); ?>
                </footer><!-- .entry-footer -->
                
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
                
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-4">
                <?php get_sidebar(); ?>
            </div>
             
        </div>
    </div>
    
    


</div>
