<?php
/**
 * Template part for displaying page content in page fullwidth
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eventr
 */
  
 

 

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	


    <div id="header-<?php the_ID(); ?>" class="header">
      <div class="inner">

        <div class="container">
          <div class="row">
            
            <div class="col-lg-12 <?php echo esc_html($align) ?>">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                
            </div>

          </div>
        </div>
      </div>
    </div>

	
        
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eventr' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    
 
     
</div><!-- #post -->
