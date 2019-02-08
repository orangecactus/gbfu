<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eventr
 */

$eventr_var = get_option('eventr_var');
$url = esc_url( get_post_meta( get_the_ID(), 'media_embed', 1 ) );

$eventr_blog_loop_content_type = 1; // Default show the content
 if ( isset( $eventr_var['tc-blog-loop-content-type'] ) ) {
    $eventr_blog_loop_content_type = $eventr_var['tc-blog-loop-content-type'];
	}
 $the_excerpt_max_chars = isset( $eventr_var['excerpt-max-char-length'] ) ? max( 1, intval( $eventr_var['excerpt-max-char-length'] ) ) : 300;

 $url = esc_url( get_post_meta( get_the_ID(), 'media_embed', 1 ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="tc_media">
		<?php if(has_post_format('image')){ ?>
			<?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
	        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>">
	    <?php } else if(has_post_format('audio')){ ?>
	        <div class="post-format-audio">
				<?php echo wp_oembed_get( $url ); ?>
	            <div style="clear:both;"></div>
	        </div>
	    <?php } else if(has_post_format('video')){ ?>
	        <div class="post-format-video">
				<?php echo wp_oembed_get( $url ); ?>
	            <div style="clear:both;"></div>
	        </div>
	    <?php } else if(has_post_format('link')){ ?>
	           
	    <?php } else { ?>	                                   
	        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
	        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>">
	    <?php } ?>
	</div>

	<div class="content">  
		<header class="entry-header">
			<div class="entry-meta">
				<?php eventr_posted_on(); ?>
			</div><!-- .entry-meta -->

			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			
			<?php
			endif; ?>
			
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if ( $eventr_blog_loop_content_type == 1 ): // Show the content ?>
                <?php the_content(); ?>
            <?php else: // Show the excerpt ?>
                <div class="content-post the-excerpt-content">
                    <p><?php echo function_exists( 'eventr_get_the_excerpt_max_charlength' ) ? eventr_get_the_excerpt_max_charlength( $the_excerpt_max_chars ): get_the_excerpt(); ?></p>
                </div>
                <?php
                    $read_more_text = isset( $eventr_var['blog-continue-reading'] ) ? sanitize_text_field( $eventr_var['blog-continue-reading'] ) : esc_html__( 'Read more', 'eventr' );
                    echo '<p>' . eventr_modify_read_more_link() . '</p>' 
                ?>
            <?php endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php eventr_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->
