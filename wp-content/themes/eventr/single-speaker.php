<?php

/*
Single Post Template: [Speaker]
*/


get_header("speaker"); ?>

<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-ready" tabindex="-1" >
    <div class="mfp-container mfp-ajax-holder mfp-s-ready"><div class="mfp-content"><div class="container">
        <div class="row">
            	
            <div id="speaker-detail" class="col-lg-10 col-lg-offset-1">
                <div class="row">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'speaker' ); ?>


                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>

                    <?php endwhile; // End of the loop. ?>
                  
                </div>
            </div>

            <?php get_footer("speaker"); ?>
            
        </div>
    </div>
</div>