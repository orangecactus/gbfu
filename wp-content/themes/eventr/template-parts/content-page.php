<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eventr
 */



?>

<div id="post-<?php the_ID(); ?>" <?php post_class('sidebar-page'); ?>>
	


    <div id="header-<?php the_ID(); ?>" class="header">
      <div class="inner">

        <div class="container">
          <div class="row">
            
            <div class="col-lg-12">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container">
    	<div class="row">

			<div class="entry-content col-lg-9 col-md-9">
				<?php
					the_content();

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
              comments_template();
          endif;

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eventr' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			
			<div class="col-lg-3 col-md-3">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div>
</div><!-- #post-## -->
