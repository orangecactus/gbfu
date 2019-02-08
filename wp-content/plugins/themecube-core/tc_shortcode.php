<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}



// Speakers shortcode
add_shortcode('speakers', 'shortcode_speakers');
function shortcode_speakers($atts, $content=null){
    global $eventr_var;
    $atts = vc_map_get_attributes( 'speakers', $atts );
    $atts = shortcode_atts(
        array(        
        'filter_tag'  => '',
        'speaker_row_items' => '',
        'sort_speaker' => '',
        'zero_gap' => '',
        'load_more' => '',
    ), $atts);

    $speaker_row_items = '';
    if($atts['speaker_row_items'] == 'col-md-4') $speaker_row_items = 'col-md-4 col-sm-4 col-xs-12';
    if($atts['speaker_row_items'] == 'col-md-3') $speaker_row_items = 'col-md-3 col-sm-3 col-xs-12';
    if($atts['speaker_row_items'] == 'column-5') $speaker_row_items = 'column-5';
    if($atts['speaker_row_items'] == 'col-md-2') $speaker_row_items = 'col-md-2 col-sm-4 col-xs-12';

    $number = '';
    if($atts['speaker_row_items'] == 'col-md-4') $number = '3';
    if($atts['speaker_row_items'] == 'col-md-3') $number = '4';
    if($atts['speaker_row_items'] == 'column-5') $number = '5';
    if($atts['speaker_row_items'] == 'col-md-2') $number = '6';


    $sort_speaker = '';
    if($atts['sort_speaker'] == 'none') $sort_speaker = 'none';
    if($atts['sort_speaker'] == 'title') $sort_speaker = 'title';
    if($atts['sort_speaker'] == 'rand') $sort_speaker = 'rand';

    $zero_gap = '';
    if($atts['zero_gap'] == 'yes') {
        $zero_gap = 'no-padding';
    }


    $html ='';
    $html .= '<section id="speakers-grid">';
    $html .= '<div class="row">';
        $args = array('post_type' => 'speaker', 'posts_per_page'=> '-1', 'orderby' => $sort_speaker,  'tag'=> $atts['filter_tag'], 'order' =>'ASC');
        $speakers = new WP_QUery($args);
        global $post; 
        if($speakers->have_posts()):
            while($speakers->have_posts()): $speakers->the_post();

            $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id());
            $attachment_id = wp_get_attachment_image( get_the_ID());
            $image_alt = get_the_title($attachment_id);

            $speaker_job = get_post_meta($post->ID, "tc_speaker_job", true);
            $speaker_company = get_post_meta($post->ID, "tc_speaker_company", true);
            $speaker_website = get_post_meta($post->ID, "tc_speaker_website", true);
            $featured_speaker = get_post_meta($post-> ID, "tc_featured_speaker", true);
            

                $html .= '<div class="'.$speaker_row_items.' '.$zero_gap.'">

                            <div class="speaker-thumb">
                                <figure class="effect-ming">
                                    <img class="img-responsive" src="'.$thumbnail_url.'" alt="'.$image_alt.'">
                                    <figcaption>
                                        <span><a class="html-popup" href="'.get_permalink().'"><img class="img-responsive" src="'.get_template_directory_uri().'/img/plus.png" alt="plus"></a></span>
                                    </figcaption>           
                                </figure>

                                <div class="caption text-center">
                                    <h4>'.get_the_title().'</h4>
                                    <p class="company">'.$speaker_company.'</p>
                                </div>

                            </div>
                        </div>';

            endwhile;
        endif;

        if ($atts['load_more'] == 'yes') { 

        $html .='<br><div class="col-lg-12 loadmore text-center">
            <a href="#" id="load-more" class="button button-line-dark button-small">'.__('LOAD MORE', 'eventr').'</a>
          </div>';

        $html .='
            <script>
            jQuery(document).ready(function($){
                "use strict";
                 $("#speakers-grid .speaker-thumb").css({"display":"none"});
                $("div.speaker-thumb").slice(0, '.$number.').show();
                $("#load-more").on("click", function (e) {
                    e.preventDefault();
                    $("div.speaker-thumb:hidden").slice(0, '.$number.').slideDown();
                    if ($("div.speaker-thumb:hidden").length === 0) {
                        $("#load-more").replaceWith(\'<p id="load-more" class="common-button common-button-dark passed">No More</p>\');
                        $("#load-more").css("visibility", "hidden").fadeOut("slow");
                    }
                });
            });                                  
            </script>';
    ;} 

    $html .= '</div></section>';
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Speakers List", 'eventr'),
   "base" => "speakers",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_speaker.png',
   "description" => __('Add speakers','eventr'),
   "params" => array(
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("How many items in a row?",'eventr'),
        "param_name" => "speaker_row_items",
        "value" => array(   
            __('3 items', 'eventr') => 'col-md-4',
            __('4 items', 'eventr') => 'col-md-3',
            __('5 items', 'eventr') => 'column-5',
            __('6 items', 'eventr') => 'col-md-2',
        ),
        "std" => "col-md-4",
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Sort items by",'eventr'),
        "param_name" => "sort_speaker",
        "value" => array(   
            __('None', 'eventr') => 'none',
            __('Name', 'eventr') => 'title',
            __('Random', 'eventr') => 'rand',
        ),
        "std" => "col-md-4",
    ),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Show load more button', 'eventr' ),
        'param_name' => 'load_more',
        'value' => array( __( 'Yes', 'eventr' ) => 'yes' ),
    ),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Zero gap between items?', 'eventr' ),
        'param_name' => 'zero_gap',
        'value' => array( __( 'Yes', 'eventr' ) => 'yes' ),
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Filter by tag",'eventr'),
        "param_name" => "filter_tag",
        "value" => "",
        "description" => __('Such as speaker, chair, keynote','eventr'),
    )
     
   )
) );

}

// End Speakers shortcode


// Countdown Shortcode
add_shortcode('countdown', 'shortcode_countdown');
function shortcode_countdown($atts, $content=null){
     $atts = shortcode_atts(
        array(
        'date'                  =>'',
        'field_days'            =>'',
        'color_field_days'      =>'',
        'field_hours'           =>'',
        'color_field_hours'     =>'',
        'field_minutes'         =>'',
        'color_field_minutes'   =>'',
        'field_seconds'         =>'',
        'color_field_seconds'   =>'',
        'number_color'          =>'',
        'text_color'            =>'',
        
    ), $atts);

    $html ='';
    
    $html .='<div id="DateCountdown" data-date="'.$atts['date'].'" style="width: 100%;">';
    $html .='</div>';
    $html .='<script>
            jQuery(document).ready(function($){
                $("#DateCountdown").TimeCircles({
                    "animation": "smooth",
                    "use_background": false,
                    "bg_width": 0.0001,
                    "fg_width": 0.0001,
                    
                    "time": {
                        "Days": {
                            "text": "'.$atts['field_days'].'",
                            "color": "",
                            "show": true
                        },
                        "Hours": {
                            "text": "'.$atts['field_hours'].'",
                            "color": "",
                            "show": true
                        },
                        "Minutes": {
                            "text": "'.$atts['field_minutes'].'",
                            "color": "",
                            "show": true
                        },
                        "Seconds": {
                            "text": "'.$atts['field_seconds'].'",
                            "color": "",
                            "show": true
                        }
                    }
                });
                $(".time_circles div span").css({"color":"'.$atts['number_color'].'"});
                $(".time_circles div h4").css({"color":"'.$atts['text_color'].'"});
                });                                   
            ';
    $html .='</script>';
    
                
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Countdown", 'eventr'),
   "base" => "countdown",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_countdown.png',
   "params" => array(
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Date",'eventr'),
        "param_name" => "date",
        "value" => "",
                "description" => __('Please enter a date like this format 2020/12/18 00:00:00','eventr'),
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Numbers Color",'eventr'),
        "param_name" => "number_color",
        "value" => "#545454",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Text Color",'eventr'),
        "param_name" => "text_color",
        "value" => "#545454",
    ),
    array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Days field label",'eventr'),
        "param_name" => "field_days",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Days Circle Color",'eventr'),
        "param_name" => "color_field_days",
        "value" => "#257AEC",
    ),
    array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Hours field label",'eventr'),
        "param_name" => "field_hours",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Hours Circle Color",'eventr'),
        "param_name" => "color_field_hours",
        "value" => "#3D9AF0",
    ),
    array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Minutes field label",'eventr'),
        "param_name" => "field_minutes",
        "value" => " ",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Minutes Circle Color",'eventr'),
        "param_name" => "color_field_minutes",
        "value" => "#58BBF4",
    ),
    array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Seconds field label",'eventr'),
        "param_name" => "field_seconds",
        "value" => " ",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Seconds Circle Color",'eventr'),
        "param_name" => "color_field_seconds",
        "value" => "#73DCF8",
    ),
    
   )
) );

}

// End Countdown Shortcode


// Pricing Shortcode
add_shortcode('pricing', 'shortcode_pricing');
function shortcode_pricing($atts, $content=null){
    $atts = vc_map_get_attributes( 'pricing', $atts );
    $atts = shortcode_atts(
        array(
            'title'         =>'',
            'title_color'   =>'',
            'price'         =>'',
            'price_color'   =>'',
            'bg_color'      =>'',
            'class'         =>'',
            'link'          =>'',
            'iconfont'      =>'',
    ), $atts);



    $link = $atts['link'];
    
    $href = '';
    $href = vc_build_link( $link );

    $target ='';
    if($href['target']){ 
        $target = 'target= "'.$href['target'].'"';}

    $url ='';
    if($href['url']){ 
        $url = 'href= "'.$href['url'].'"';}

    $title ='';
    if($href['title']){ 
        $title = ''.$href['title'].'';}

    $button = '';
    if($atts['link'] != null) {
        $button = '<a class="button button-line-dark button-sm" '.$url.' '.$target.'>'.$title.'</a>';}



    $html ='';
    $html .='<div class="price-table" style="background-color:'.$atts['bg_color'].'">

                <div class="icon">
                    <i class="pe-5x '.$atts['iconfont'].'"></i> 
                </div>
                     
                <h5 style="color:'.$atts['title_color'].'">'.$atts['title'].'</h5>
                <p style="color:'.$atts['price_color'].'" class="price">'.$atts['price'].'</p>

                          
                <div class="content">'.do_shortcode($content).'</div>

                '.$button.'';
                                    
    $html .='</div>';
    
        
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Price table", 'eventr'),
   "base" => "pricing",
   "content_element" => true,
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_pricetable.png',
   "description" => __('Add price table','eventr'),
   "params" => array(
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title",'eventr'),
        "param_name" => "title",
        "value" => "Title",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Title Color",'eventr'),
        "param_name" => "title_color",
        "value" => "",
    ),      
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Price",'eventr'),
        "param_name" => "price",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Price Color",'eventr'),
        "param_name" => "price_color",
        "value" => "",
    ),     
    array(
        "type" => "textarea_html",
        "class" => "",
        "heading" => __("Content",'eventr'),
        "param_name" => "content",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Background Color",'eventr'),
        "param_name" => "bg_color",
        "value" => "",
    ),
    array(
        'type' => 'vc_link',
        'heading' => __( 'URL (Link)', 'eventr' ),
        'param_name' => 'link',
        'description' => __( 'Add link to custom heading.', 'eventr' ),
    ),
    array(
        'type'          => 'iconpicker',
        'class'         => '',
        'holder'        =>'i',
        'heading'       => __( 'Background Icon', 'eventr' ),
        'param_name'    => 'iconfont',
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => '',
            'source' => $eventr_font_icons,                    
        ),
        'description' => __( 'Select icon from library.', 'eventr'),                    
    ),
     

   )

) );

}

// End Pricing Shortcode


// Sponsor item Shortcode
add_shortcode('sponsor', 'shortcode_sponsor');
function shortcode_sponsor($atts, $content=null){
    $atts = vc_map_get_attributes( 'sponsor', $atts );
    $atts = shortcode_atts(
        array(
            'sponsor_logo'  =>'',
            'image_align'   =>'',
            'sponsor_title' =>'',
            'description'   =>'',
            'link'          =>'',
            'show_button'   =>'',
            'button_style'  =>'',

    ), $atts);

    $image_align = '';
    if($atts['image_align'] == 'left') $image_align = '';
    if($atts['image_align'] == 'center') $image_align = 'center-block';
    if($atts['image_align'] == 'right') $image_align = 'center-right';

    $layout_align = '';
    if($atts['image_align'] == 'center') $layout_align = 'text-center';
    if($atts['image_align'] == 'right') $layout_align = 'text-right';

    $button_style = '';
    if($atts['button_style'] == 'default') $button_style = 'button-line-dark';
    if($atts['button_style'] == 'light') $button_style = 'button-line-light';

    $link = $atts['link'];
    
    $href = '';
    $href = vc_build_link( $link );

    $target ='';
    if($href['target']){ 
        $target = 'target= "'.$href['target'].'"';}

    $url ='';
    if($href['url']){ 
        $url = 'href= "'.$href['url'].'"';}

    $title ='';
    if($href['title']){ 
        $title = ''.$href['title'].'';}


    if(wp_get_attachment_image_src($atts['sponsor_logo'], 'full')){
        $obj_thumbnail = wp_get_attachment_image_src($atts['sponsor_logo'], 'full');
        $thumbnail = $obj_thumbnail['0'];
    }else if($atts['sponsor_logo']!= ''){
        $thumbnail = $atts['sponsor_logo'];
    }


    $html ='';
    $html .='<div class="sponsor-item '.$layout_align.'">';
            if ($atts['link']) {
                $html .='<a '.$url.' '.$target.'><img class="img-responsive '.$image_align.'" src="'.$thumbnail.'" alt="sponsor"></a>';
            } else {
                $html .= '<img class="img-responsive '.$image_align.'" src="'.$thumbnail.'" alt="sponsor">'; 
            }

            if ($atts['sponsor_title']) {
                $html .='<h3>'.$atts['sponsor_title'].'</h3>';
            }

            if ($atts['description']) {
                $html .='<p>'.$atts['description'].'</p>';
            }
 
              
            if($atts['show_button'] == 'yes') {
                $html .='<a class="common-button '.$button_style.' button-sm" '.$url.' '.$target.'>'.$title.'</a>';
            }    
                                    
    $html .='</div>';
    
        
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Sponsor", 'eventr'),
   "base" => "sponsor",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_sponsor.png',
   "description" => __('Add Sponsor','eventr'),
   "params" => array(
    array(
        "type" => "attach_image",
        "holder" => "img",
        "class" => "",
        "heading" => __("Sponsor Logo",'eventr'),
        "param_name" => "sponsor_logo",
        "value" => ""
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Image Align",'eventr'),
        "param_name" => "image_align",
        "value" => array(   
            __('Left', 'eventr') => 'left',
            __('Center', 'eventr') => 'center',
            __('Right', 'eventr') => 'right',
        ),
        "std" => "col-md-4",
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title (Optional)",'eventr'),
        "param_name" => "sponsor_title",
        'description' => __( 'Optional', 'eventr' ),

    ),       
    array(
        "type" => "textarea",
        "class" => "",
        "heading" => __("Short Info (Optional)",'eventr'),
        "param_name" => "description",
        "value" => "",
    ),
    array(
        'type' => 'vc_link',
        'heading' => __( 'Sponsor URL (Optional)', 'eventr' ),
        'param_name' => 'link',
        'description' => __( 'Add link to the sponsor logo and button.', 'eventr' ),
    ),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Show Button (Optional)', 'eventr' ),
        'param_name' => 'show_button',
        'description' => __( 'Add a button for sponsor website link.', 'eventr' ),
        'value' => array( __( 'Yes', 'eventr' ) => 'yes' ),
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Button Style",'eventr'),
        "param_name" => "button_style",
        "value" => array(   
            __('Default', 'eventr') => 'default',
            __('Light', 'eventr') => 'light',
        ),
        "dependency" => array("element" => "show_button","value" => array("yes")),
        "std" => "default",
        "description" => __( 'Add style for button.', 'eventr' ),
        
    ),
     

   )

) );

}

// End Sponsor item Shortcode


// Hotel item Shortcode
add_shortcode('hotel', 'shortcode_hotel');
function shortcode_hotel($atts, $content=null){
    $atts = vc_map_get_attributes( 'hotel', $atts );
    $atts = shortcode_atts(
        array(
            'hotel_image'  =>'',
            'hotel_name'   =>'',
            'hotel_name_color' =>'',
            'description'   =>'',
            'link'          =>'',
            'show_button'   =>'',
            'button_style'  =>'',
            'hotel_rating'  =>'',

    ), $atts);

    $hcolor = '';
    if ($atts['hotel_name_color']) {
        $hcolor = 'style="color:'.$atts['hotel_name_color'].'"';
    }

    $one_star       = '<i class="fa fa-star"></i>';
    $two_stars      = '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
    $three_stars    = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
    $four_stars     = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
    $five_stars     = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';


    $button_style = '';
    if($atts['button_style'] == 'dark') $button_style = 'button-line-dark';
    if($atts['button_style'] == 'light') $button_style = 'button-line-light';

    $link = $atts['link'];
    
    $href = '';
    $href = vc_build_link( $link );

    $target ='';
    if($href['target']){ 
        $target = 'target= "'.$href['target'].'"';}

    $url ='';
    if($href['url']){ 
        $url = 'href= "'.$href['url'].'"';}

    $title ='';
    if($href['title']){ 
        $title = ''.$href['title'].'';}


    if(wp_get_attachment_image_src($atts['hotel_image'], 'full')){
        $obj_thumbnail = wp_get_attachment_image_src($atts['hotel_image'], 'full');
        $thumbnail = $obj_thumbnail['0'];
    }else if($atts['hotel_image']!= ''){
        $thumbnail = $atts['hotel_image'];
    }


    $html ='';
    $html .='<div class="hotel">';
            

            $html .= '<img class="img-responsive" src="'.$thumbnail.'" alt="'.$atts['hotel_name'].'">
            
                      <div class="hotel-desc">
                        <h5 '.$hcolor.'>'.$atts['hotel_name'].'</h5>
                       <p class="small">'.$atts['description'].'</p>
                        <span class="rating">';
    
                        
                            if ($atts['hotel_rating'] === 'one_star'){ 
                            $html .=''.$one_star.'';
                            };
                            
                            if ($atts['hotel_rating'] === 'two_stars'){ 
                            $html .=''.$two_stars.'';
                            };
                            
                            if ($atts['hotel_rating'] === 'three_stars'){ 
                            $html .=''.$three_stars.'';
                            };
                            
                            if ($atts['hotel_rating'] === 'four_stars'){ 
                            $html .=''.$four_stars.'';
                            };
                            
                            if ($atts['hotel_rating'] === 'five_stars'){ 
                            $html .=''.$five_stars.'';
                            };
                          
    $html .=            '</span>
                      </div>';
            
            $html .= '<div>';
 
              
            if($atts['show_button'] == 'yes') {
                $html .='<a class="button '.$button_style.' button-xs text-center" '.$url.' '.$target.'>'.$title.'</a>';
            }

            $html .= '</div>';
                                    
    $html .='</div>';
    
        
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Hotel", 'eventr'),
   "base" => "hotel",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_hotel.png',
   "description" => __('Add Hotel Alternative','eventr'),
   "params" => array(
    array(
        "type" => "attach_image",
        "holder" => "img",
        "class" => "",
        "heading" => __("Hotel Image",'eventr'),
        "param_name" => "hotel_image",
        "value" => ""
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Hotel Name",'eventr'),
        "param_name" => "hotel_name",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Hotel Name Color",'eventr'),
        "param_name" => "hotel_name_color",
    ),       
    array(
        "type" => "textarea_html",
        "class" => "",
        "heading" => __("Hotel Info",'eventr'),
        "param_name" => "description",
        "value" => "",
    ),
    array(
        'type' => 'checkbox',
        'heading' => __( 'Show Button (Optional)', 'eventr' ),
        'param_name' => 'show_button',
        'description' => __( 'Add a button for hotel website link.', 'eventr' ),
        'value' => array( __( 'Yes', 'eventr' ) => 'yes' ),
    ),
    array(
        'type' => 'vc_link',
        'heading' => __( 'Hotel URL (Optional)', 'eventr' ),
        'param_name' => 'link',
        'description' => __( 'Add link to the sponsor logo and button.', 'eventr' ),
        "dependency" => array("element" => "show_button","value" => array("yes")),
    ),  
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Button Style",'eventr'),
        "param_name" => "button_style",
        "value" => array(   
            __('Dark', 'eventr') => 'dark',
            __('Light', 'eventr') => 'light',
        ),
        "dependency" => array("element" => "show_button","value" => array("yes")),
        "std" => "dark",
        "description" => __( 'Add style for button.', 'eventr' ),
    ),
    
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Hotel rating",'eventr'),
        "param_name" => "hotel_rating",
        "value"       => array(
            '1*'   => 'one_star',
            '2*'   => 'two_stars',
            '3*'    => 'three_stars',
            '4*'    => 'four_stars',
            '5*'    => 'five_stars',
            
        ),
    ),
     

   )

) );

}

// End Hotel item Shortcode


// Button shortcode
add_shortcode('button', 'shortcode_button');
function shortcode_button($atts, $content = null) {
    $atts = vc_map_get_attributes( 'button', $atts );
    $atts = shortcode_atts(
        array(
        'link'    => '',
		'size'    => '',
		'button_style'   => '',     
    ), $atts);
    $html ='';

	$size = '';
    if($atts['size'] == 'xsmall') $size = 'button-xs';
    if($atts['size'] == 'small') $size  = 'button-sm';
	if($atts['size'] == 'medium') $size  = '';
    if($atts['size'] == 'big') $size  = 'button-lg';
	

    $button_style = '';
    if($atts['button_style'] == 'dark') $button_style = 'button-line-dark';
    if($atts['button_style'] == 'light') $button_style = 'button-line-light';

    $link = $atts['link'];
    
    $href = '';
    $href = vc_build_link( $link );

    $target ='';
    if($href['target']){ 
        $target = 'target= "'.$href['target'].'"';}

    $url ='';
    if($href['url']){ 
        $url = 'href= "'.$href['url'].'"';}

    $title ='';
    if($href['title']){ 
        $title = ''.$href['title'].'';}



    $html .= '<a class="button '.$button_style.' '.$size.'" '.$url.' '.$target.'>'.$title.'</a>';
    return $html;
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Button", 'eventr'),
   "base" => "button",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_button.png',
   "description" => __('Add button','eventr'),
   "params" => array(
    array(
        'type' => 'vc_link',
        'heading' => __( 'Sponsor URL (Optional)', 'eventr' ),
        'param_name' => 'link',
        'description' => __( 'Add link to the sponsor logo and button.', 'eventr' ),
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Button Style",'eventr'),
        "param_name" => "button_style",
        "value" => array(   
            __('Dark', 'eventr') => 'dark',
            __('Light', 'eventr') => 'light',
        ),
        "std" => "default",
        "description" => __( 'Add style for button.', 'eventr' ),
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Button Size",'eventr'),
        "param_name" => "size",
        "value" => array(   
            __('xsmall', 'eventr') => 'xsmall',
            __('small', 'eventr') => 'small',
            __('medium', 'eventr') => 'medium',
            __('big', 'eventr') => 'big',
        ),
    ),

   )
) );

}

// End Button shortcode



// Schedule shortcode
add_shortcode('schedule', 'shortcode_schedule');
function shortcode_schedule($atts, $content=null){
    global $eventr_var;
    $atts = shortcode_atts(
        array(
        'class'     => '',
    ), $atts);
    $html ='';
    $html .='<div class="schedule">';
    $html .= '<ul id="myTab" class="nav nav-tabs" role="tablist">';
                        
    $args_term = array('order' =>'ASC');
    $schedules_date = get_terms('date', $args_term);
    
    $i = 0;
    foreach($schedules_date as $schedule_date) {
        $schedule_active = '';
        if($i == 0){$schedule_active = 'active'; $i++;}
        $html .='<li role="presentation" class="'.$schedule_active.'">
                        <a href="#'.$schedule_date->slug.'" id="'.$schedule_date->slug.'-tab" role="tab" data-toggle="tab" aria-controls="'.$schedule_date->slug.'" aria-expanded="true">
                            '.$schedule_date->name.'
                        </a>
                </li>';
    }
    $html .='</ul>';
    
    $html .= '<div id="myTabContent" class="tab-content">'; //content başlangıcı
    $d = 0;
    foreach($schedules_date as $schedule_date) {

        $schedule_active1 = '';
        $k = 0;
        if($d == 0){$schedule_active1 = 'active'; $d++;}

        $html .= '<div role="tabpanel" class="tab-pane fade in '.$schedule_active1.'" id="'.$schedule_date->slug.'" aria-labelledby="'.$schedule_date->slug.'-tab">
                <div id="accordion-'.$schedule_date->slug.'" class="panel-group" role="tablist" aria-multiselectable="true">';

                $args = array('post_type' => 'schedule','date'=>$schedule_date->slug, 'meta_key'=> 'tc_program_time', 'posts_per_page'=>'-1', 'orderby'=>'meta_value', 'order'=>'ASC');
                $schedule = new WP_QUery($args);
                global $post;

                if($schedule->have_posts()):
                    while($schedule->have_posts()): $schedule->the_post();

                    $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id());
                    $program_time = get_post_meta($post->ID, "tc_program_time", true);
                    $program_duration = get_post_meta($post->ID, "tc_program_duration", true);
                    $program_location = get_post_meta($post->ID, "tc_program_location", true);
                    $program_level = get_post_meta($post->ID, "tc_program_level", true);
                    // $speaker_short_bio = get_post_meta($post->ID, "tc_speaker_short_bio", true);
                    $content = get_the_content();
                    $title = get_the_title();


                    

        $html .= '<div class="panel panel-default">
                    
                    <div class="panel-heading" role="tab" id="heading-'.get_the_ID().'">
                        <div class="row">

                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <p class="date">'.$program_time.'</p>
                            </div>
                            
                            <div class="col-lg-11 col-md-11 col-sm-11">
                                
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#'.get_the_ID().'" aria-expanded="true" aria-controls="'.get_the_ID().'">
                                    '.get_the_title().'
                                    </a>
                                </h4>

                            </div>

                        </div>
                    </div>';

          $html .= '<div id="'.get_the_ID().'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.get_the_ID().'">
          
                                        
                        <div class="panel-body">
                            <div class="row">';

                            $connected = new WP_Query( array(
                              'connected_type' => 'speaker_program',
                              'connected_items' => $post,
                              'nopaging' => true,
                            ) );  

                             
                            if ( $connected->have_posts() ) :
                                while ( $connected->have_posts() ) : $connected->the_post();

                                    $speaker_job = get_post_meta($post->ID, "tc_speaker_job", true);
                                    $speaker_company = get_post_meta($post->ID, "tc_speaker_company", true);
                                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                                    $image = $thumbnail_url[0];
                                    $speaker_name = get_the_title();
                                    $speaker_content = get_the_content();
                                    $speaker_excerpt = get_the_excerpt();
                                    $speaker_url = get_post_meta($post->ID, "tc_speaker_website", true);
                                    $link = get_permalink();

                                endwhile; 
                               //wp_reset_postdata(); 
                            endif;  

                                
                            
                           if($thumbnail_url){ 
                                $html .= '<div class="col-lg-2 col-md-2 col-sm-2">';
                            if ( $connected->have_posts() ) :
                                while ( $connected->have_posts() ) : $connected->the_post();
                                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                                    $image = $thumbnail_url[0]; 
                                
                                    $html .= '<img class="img-responsive img-circle" src="'.$image.'" alt="">';
                                endwhile; 
                                wp_reset_postdata(); 
                            endif; 
                               $html .= '</div>'; }
                                
                        $html .= '<div class="col-lg-7 col-md-7 col-sm-10">
                                    <h4>'.$title.'</h4>
                                    <p>'.$content.'</p>';
                                    
                                    if($program_duration){
                                        $html .= '<p><i class="fa fa-lg fa-clock-o"></i> <span class="small">'.$program_duration.'</span></p>';}
                                    if($program_location){
                                        $html .= '<p><i class="fa fa-lg fa-map-marker"></i> <span class="small">'.$program_location.'</span></p>';}
                                    if($program_level){
                                        $html .= '<p><i class="fa fa-lg fa-signal"></i> <span class="small">'.$program_level.'</span></p>';}                    
                                $html .= '  
                                                                                            
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-10">';

                                     if ( $connected->have_posts() ) :
                                while ( $connected->have_posts() ) : $connected->the_post();
                                    $speaker_name = get_the_title();
                                    $speaker_excerpt = get_the_excerpt();
                                    $speaker_url = get_post_meta($post->ID, "tc_speaker_website", true);

                                    if($speaker_name){
                                    $html .= '<h5>'.$speaker_name.'</h5>';}
                                    
                                    if($speaker_excerpt){
                                    $html .= '<p class="small">'.$speaker_excerpt.'</p>';}
                                    
                                    if($speaker_url){
                                        $html .= '<span class="about-speaker"><i class="fa fa-lg fa-globe"></i> <a class="small" href="'.$speaker_url.'" target="_blank">'.$speaker_url.'</a></span>';}

                                     endwhile; 
                                wp_reset_postdata(); 
                            endif; 
                          
                                                        
            $html .= '</div>
                                
                            </div>
                        </div>';
                                                                   
                           
             $html .= '</div></div>';

                endwhile;
                endif;

       
        $html .= '</div></div>';

    }   $html .= '</div>';  
    
    return $html;                      
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Schedule", 'eventr'),
   "base" => "schedule",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_sch_list.png',
   "description" =>__( 'Add schedule layout','eventr'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'eventr'),
         "param_name" => "class",
         "value" => "",
      )
     
   )
) );

}

//End Schedule Shortcode


// Infobox Shortcode ******
add_shortcode('tc_info_box', 'shortcode_tc_info_box');
function shortcode_tc_info_box($atts, $content=null){
    $atts = vc_map_get_attributes( 'tc_info_box', $atts );
    $atts = shortcode_atts(
        array(
        'iconfont'  => '',
        'select_icon_color'=>'',
        'icon_color'=>'',
        'select_icon_bg_color'=>'',
        'icon_bg_color'=>'#fdb713', 
        'iconsize'=>'',
        'title'     => 'The title',
        'title_color'=>'#2b2e34',
        'content_color'=>'#999999',
        'align' => 'center',  
        'class' => ''    
    ), $atts);
    $html ='';
    $align = '';
    if($atts['align'] == 'left') $align = 'text-left';
    if($atts['align'] == 'right') $align = 'text-right';
    if($atts['align'] == 'center') $align = 'text-center';


    $iconsize = '';
    if($atts['iconsize'] == '2x') $iconsize = 'pe-2x';
    if($atts['iconsize'] == '3x') $iconsize = 'pe-3x';
    if($atts['iconsize'] == '4x') $iconsize = 'pe-4x';
    if($atts['iconsize'] == '5x') $iconsize = 'pe-5x';
    
    $html .= '<div class="infobox '.$align.' '.$atts['class'].'">
                <div class="icon-box">
                    <i style="color:'.$atts['icon_color'].'" class="'.$atts['iconfont'].' '.$iconsize.'"></i>
                </div>
                <h4 style="color:'.$atts['title_color'].';">'.$atts['title'].'</h4>
                <p style="color:'.$atts['content_color'].';">'.do_shortcode($content).'</p>
              </div>';
    return $html;                        
}

if(function_exists('vc_map')){
    global $font_icons;

vc_map( array(
   "name" => __("Info Box", 'eventr'),
   "base" => "tc_info_box",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_infobox.png',
   "description" => __('Add an infobox','eventr'),
   "params" => array(
        array(
            'type'          => 'iconpicker',
            'class'         => '',
            'holder'        =>'i',
            'heading'       => __( 'Icon', 'eventr' ),
            'param_name'    => 'iconfont',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => '',
                'source' => $eventr_font_icons,                    
            ),
            'description' => __( 'Select icon from library.', 'eventr'),                    
        ),
        
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Color",'eventr'),
            "param_name" => "icon_color",
            "value" => "#fac42b",
        ),

        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Icon Size",'eventr'),
            "param_name" => "iconsize",
            "value" => array(   
                __('2x', 'eventr') => '2x',
                __('3x', 'eventr') => '3x',
                __('4x', 'eventr') => '4x',
                __('5x', 'eventr') => '5x',
            ),
        ),
        array(
            "type" => "textfield",
            "holder" => "h4",
            "class" => "",
            "heading" => __("Title",'eventr'),
            "param_name" => "title",
            "value" => "The title",
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color",'eventr'),
            "param_name" => "title_color",
            "value" => "#262626",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content",'eventr'),
            "param_name" => "content",
            "value" => "",
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Content Color",'eventr'),
            "param_name" => "content_color",
            "value" => "#666666",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Alignment",'eventr'),
            "param_name" => "align",
            "value" => array(   
                    __('center', 'eventr') => 'center',
                    __('left', 'eventr') => 'left',
                    __('right', 'eventr') => 'right',
            ),
        ),
      
   )
) );

}

// End Infobox Shortcode ******


// InfoBox 2 shortcode *******
add_shortcode('tc_info_box_2', 'shortcode_tc_info_box_2');
function shortcode_tc_info_box_2($atts, $content=null){
    $atts = vc_map_get_attributes( 'tc_info_box_2', $atts );
    $atts = shortcode_atts(
        array(
        'iconfont'  => '',
		'select_icon_color'=>'',
        'icon_color'=>'',
		'iconsize'=>'',
        'title'     => 'The title',
		'title_color'=>'#2b2e34',
		'content_color'=>'#999999',
		'class' => ''    
    ), $atts);
    $html ='';

    $gradient = '';
    if($atts['select_icon_color'] == 'gradient') $gradient = 'gradient-text';
	
	$iconsize = '';
    if($atts['iconsize'] == '2x') $iconsize = 'pe-2x';
    if($atts['iconsize'] == '3x') $iconsize = 'pe-3x';
    if($atts['iconsize'] == '4x') $iconsize = 'pe-4x';
	if($atts['iconsize'] == '5x') $iconsize = 'pe-5x';
	
    $html .= '<div class="infobox-2 '.$atts['class'].'">
				<div class="icon-box-2">
					<i style="color:'.$atts['icon_color'].';"  class="'.$atts['iconfont'].' '.$iconsize.' '.$gradient.'"></i>
				</div>
                <div class="description">
				    <h5 style="color:'.$atts['title_color'].';">'.$atts['title'].'</h5>
				    <p style="color:'.$atts['content_color'].';">'.do_shortcode($content).'</p>
                </div>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){
	global $font_icons;

vc_map( array(
   "name" => __("Info Box 2", 'eventr'),
   "base" => "tc_info_box_2",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_infobox_alt.png',
   "description" => __('Add an infobox','eventr'),
   "params" => array(
        array(
    		'type'          => 'iconpicker',
    		'class'         => '',
    		'heading'       => __( 'Icon', 'eventr' ),
    		'param_name'    => 'iconfont',
    		'settings' => array(
    			'emptyIcon' => false, // default true, display an "EMPTY" icon?
    			'type' => '',
    			'source' => $font_icons, 					
    		),
    		'description' => __( 'Select icon from library.', 'eventr'),                    
    	),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon Color",'eventr'),
            "param_name" => "select_icon_color",
            "value" => array(   
                __('Solid Color', 'eventr') => 'solid',
                __('Gradient', 'eventr') => 'gradient',
            ),
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Color",'eventr'),
            "param_name" => "icon_color",
            "value" => "#2b2e34",
            "dependency" => array("element" => "select_icon_color","value" => array("solid")),
        ),  
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Icon Size",'eventr'),
            "param_name" => "iconsize",
            "value" => array(   
                __('2x', 'eventr') => '2x',
                __('3x', 'eventr') => '3x',
                __('4x', 'eventr') => '4x',
                __('5x', 'eventr') => '5x',
            ),
        ),
        array(
            "type" => "textfield",
            "holder" => "h5",
            "class" => "",
            "heading" => __("Title",'eventr'),
            "param_name" => "title",
            "value" => "The title",
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color",'eventr'),
            "param_name" => "title_color",
            "value" => "#2b2e34",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content",'eventr'),
            "param_name" => "content",
            "value" => "",
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Content Color",'eventr'),
            "param_name" => "content_color",
            "value" => "#999999",
        ),
	  
   )
) );

}

// End Infobox 2 Shortcode ******



// News Carousel Shortcode
add_shortcode('tc_news_carousel', 'shortcode_tc_news_carousel');
function shortcode_tc_news_carousel($atts, $content=null){
    global $eventr_var;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
    ), $atts);
    $html ='';
    $html .= '
	<div class="container">
	<div class="row">
	
		<div id="news-carousel" class="owl-carousel '.$atts['class'].' clearfix">';
	
		$args = array('post_type'=>'post','posts_per_page'=> '-1', 'category_name'=>'News');
		$project = new WP_Query($args);
		if($project->have_posts()):
			while($project->have_posts()):$project->the_post();
			$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'news-carousel-image');

			
			
			
			$html .= '<div class="news-item">
                      <div class="image">
                        <img class="img-responsive" src="'.$thumbnail_url[0].'" alt="">
                      </div>
                      <figcaption>
                        <h5>'.get_the_title().'</h5>
                        <p>'.get_the_excerpt().'</p>
                        <footer>
                          <div class="date">'.get_the_date().'</div>
                          <div class="icons">
                            <i class="pe-2x pe-7s-more"></i>
                          </div>
                        </footer>
                      </figcaption>
                      <a href="'.get_permalink().'"></a>
                    </div>';
                    
			endwhile;
		endif;
    $html .= '</div></div></div>';
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("News Carousel", 'eventr'),
   "base" => "tc_news_carousel",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_news_carousel.png',
   "description" => __('Add news carousel','eventr'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'eventr'),
         "param_name" => "class",
         "value" => "",
      )
     
   )
) );

}

// End News Carousel Shortcode



// Funfacts shortcode
add_shortcode('tc_funfact', 'shortcode_tc_funfact');
function shortcode_tc_funfact($atts, $content=null){
    $atts = shortcode_atts(
        array(
        'iconfont'  		=> '',
		'icon_color'  		=> '',
		'counter'  			=> '',
		'counter_color'		=> '',
		'countertitle'		=> '',
		'ct_title_color' 	=> '',
		'class'				=> '',
		      
    ), $atts);
	
    $html ='';
    $html .= '<div class="funfact-item '.$atts['class'].'">';
                if ($atts['iconfont']) {

        $html .= '<i style="color: '.$atts['icon_color'].'" class="pe pe-4x '.$atts['iconfont'].'"></i>'; }
		 $html .= '<div class="caption">
					<p class="counter" style="color:'.$atts['counter_color'].'">'.$atts['counter'].'</p>
					<p class="counter-title" style="color:'.$atts['ct_title_color'].'">'.$atts['countertitle'].'</p>';

                    
		$html .= '</div>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Funfact", 'eventr'),
   "base" => "tc_funfact",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_funfact.png',
   "description" => __('Add funfacts','eventr'),
   "params" => array(
  	array(
		'type'          => 'iconpicker',
		'class'         => '',
		'heading'       => __( 'Icon', 'eventr' ),
		'param_name'    => 'iconfont',
		'settings' => array(
			'emptyIcon' => true, // default true, display an "EMPTY" icon?
			'type' => '',
			'source' => $eventr_font_icons	
		),
		'description' => __( 'Select icon from library.', 'eventr'),                    
	),
	
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Color",'eventr'),
         "param_name" => "icon_color",
      //   "value" => "#fdb713",
      ),
	  
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Counter",'eventr'),
         "param_name" => "counter",
         "value" => "",
      ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Counter Color",'eventr'),
         "param_name" => "counter_color",
        // "value" => "#ffffff",
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Counter title",'eventr'),
         "param_name" => "countertitle",
         "value" => "",
      ),
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Counter Title Color",'eventr'),
         "param_name" => "ct_title_color",
         //"value" => "#ffffff",
      ), 
     
   )
) );

}

// End Funfacts shortcode


// Testimonial shortcode
add_shortcode('tc_testimonial', 'shortcode_tc_testimonial');
function shortcode_tc_testimonial($atts, $content=null){
    global $eventr_var;	
	$atts = vc_map_get_attributes( 'tc_testimonial', $atts );
    $atts = shortcode_atts(
        array( 
        'header'        => '',
        'header_color'  => '',
        'testimonial_content'       => '',
        'content_color' => '',
        'author_img'    => '',
        'author_name'   => '',
        'author_name_color'     => '',
        'author_title'          => '',
        'author_title_color'    => '',

    ), $atts);

    if(wp_get_attachment_image_src($atts['author_img'], 'speaker-mini-thumb')){
        $obj_thumbnail = wp_get_attachment_image_src($atts['author_img'], 'speaker-mini-thumb');
        $thumbnail = $obj_thumbnail['0'];
    }else if($atts['author_img']!= ''){
        $thumbnail = $atts['author_img'];
    }


    $html ='';
   
    $html .= '<div class="testimonial-item">
                <div class="author-img">';
                    if ($atts['author_img']) {
                    $html .= '<img class="img-circle" src="'.$thumbnail.'" alt="">'; }
      $html .= '</div>';

            if ($atts['header']) {

            $html .= '<h5 style="color:'.$atts['header_color'].';">'.$atts['header'].'</h5>'; }

            $html .= '<p class="lead" style="color:'.$atts['content_color'].';">'.$atts['testimonial_content'].'</p>

                        
                        <div class="author">';
                            if ($atts['author_name']) {
                            $html .= '<h5 style="color:'.$atts['author_name_color'].';" class="author-name">'.$atts['author_name'].'</p>' ;}
                            if($atts['author_title']) {
                            $html .= '<p style="color:'.$atts['author_title_color'].';" class="author-title">'.$atts['author_title'].'</p>'; }
              $html .= '</div>
                </div>';


    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Testimonials", 'eventr'),
   "base" => "tc_testimonial",
   "content_element" => true,
   "as_child" => array('only' => 'carousel'), 
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_testimonial.png',
   "description" => __('Add testimonial bubble','eventr'),
   "params" => array(
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Header",'eventr'),
        "param_name" => "header",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Header Color",'eventr'),
        "param_name" => "header_color",
        "value" => "#ffffff",
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content",'eventr'),
        "param_name" => "testimonial_content",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Content Color",'eventr'),
        "param_name" => "content_color",
        "value" => "#ffffff",
    ),
    array(
        "type" => "attach_image",
        "class" => "",
        "heading" => __("Author Image",'eventr'),
        "param_name" => "author_img",
        "value" => ""
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Author Name",'eventr'),
        "param_name" => "author_name",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Header Color",'eventr'),
        "param_name" => "author_name_color",
        "value" => "#ffffff",
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Author Title",'eventr'),
        "param_name" => "author_title",
        "value" => "",
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Header Color",'eventr'),
        "param_name" => "author_title_color",
        "value" => "#ffffff",
    ),

     
   )
) );

}

// End Testimonial shortcode


// Carousel shortcode
add_shortcode('carousel', 'shortcode_carousel');
function shortcode_carousel($atts, $content=null){
    global $eventr_var;
    $atts = shortcode_atts(
        array(        
        'id'    		=> '', 
        'slidecount'    => '5',
        'playdelay'     => 'false',
		'singleitem'	=> 'false',       
    ), $atts);
    $html ='';

    $html ='';
    $html .='<div id="'.$atts['id'].'-carousel">'.do_shortcode( $content ).'</div>';
    $html .='<script>
            jQuery(document).ready(function($){
                $("#'.$atts['id'].'-carousel").owlCarousel({';
                if ($eventr_var['rtl_support']){ $html .='direction:\'rtl\',';} 
          $html .='itemsCustom : [
						[0, 1],
						[450, 1],
						[600, 2],
						[700, 2],
						[1000, '.$atts['slidecount'].'],
						[1200, '.$atts['slidecount'].'],
						],
                    autoPlay: '.$atts['playdelay'].',                    
                    pagination: true
                });
            });
        </script>';
	return $html;
}

if(function_exists('vc_map')){

vc_map( array(
     "name" => __("ThemeCube Carousel", 'eventr'),
     "base" => "carousel",
     "as_parent" => array('only' => 'pricing, tc_testimonial, sponsor, hotel'),
     "js_view" => 'VcColumnView',
     "content_element" => true,
     "class" => "",
     "category" => __("ThemeCube Shortcodes", 'eventr'),
     "icon" => get_template_directory_uri().'/img/vc_icons/tc_carousel.png',
     "params" => array(

         array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("ID",'eventr'),
             "param_name" => "id",
             "value"  => '',
          ),
          array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Slide Count",'eventr'),
             "param_name" => "slidecount",
             "value"  => '5',
          ),
          array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Autoplay",'eventr'),
             "param_name" => "playdelay",
             "value"  => '',
			 "description" => __("Autoplay: true, false or ex. 3000",'eventr'),
          ),
		   array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Single Item",'eventr'),
             "param_name" => "singleitem",
             "value"  => 'false',
			 "description" => __("Single item: true or false",'eventr'),
          ),
           
)));



  
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_carousel extends WPBakeryShortCodesContainer {
      }
  }

}

// End Carousel shortcode



// Social Icons shortcode
add_shortcode('tc_social', 'shortcode_tc_social');
function shortcode_tc_social($atts, $content=null){
    global $eventr_var;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
    ), $atts);
    $html ='';
    $html .= '
	<ul class="social social-icons icon-circle list-unstyled list-inline">';
	
	if($eventr_var['facebook']){
	$html .= '<li><a href='.$eventr_var['facebook'].' target="_blank"><i class="fa fa-facebook"></i></a></li>';}
	if($eventr_var['twitter']){
	$html .= '<li><a href='.$eventr_var['twitter'].' target="_blank"><i class="fa fa-twitter"></i></a></li>';}
	if($eventr_var['instagram']){
	$html .= '<li><a href='.$eventr_var['instagram'].' target="_blank"><i class="fa fa-instagram"></i></a></li>';}
	if($eventr_var['google-plus']){
	$html .= '<li><a href='.$eventr_var['google-plus'].' target="_blank"><i class="fa fa-google-plus"></i></a></li>';}
	if($eventr_var['pinterest']){
	$html .= '<li><a href='.$eventr_var['pinterest'].' target="_blank"><i class="fa fa-pinterest"></i></a></li>';}
	if($eventr_var['youtube']){
	$html .= '<li><a href='.$eventr_var['youtube'].' target="_blank"><i class="fa fa-youtube"></i></a></li>';}
	if($eventr_var['vimeo']){
	$html .= '<li><a href='.$eventr_var['vimeo'].' target="_blank"><i class="fa fa-vimeo"></i></a></li>';}
                        
    $html .= '</ul>';
    
    return $html;                        
}

// End Social Icons shortcode



// Custom Google Map Shortcode
add_shortcode('googlemap', 'shortcode_googlemap');
function shortcode_googlemap($atts, $content=null){
	global $eventr_var;
     $atts = shortcode_atts(
        array(
        'map_id'			=>'',
		'map_coordinate'	=>'',
		'map_height'		=>'',
		
    ), $atts);

    $html ='';
    $html .='<div id="'.$atts['map_id'].'" style="height:'.$atts['map_height'].';">';
	$html .='</div>';
	$html .='
			<script>
			function initMap() {
        var customMapType = new google.maps.StyledMapType(
            '.$eventr_var['map_style'].',
           {
          
        });
        var customMapTypeId = "'.$eventr_var['map_type'].'";

        var map = new google.maps.Map(document.getElementById("'.$atts['map_id'].'"), {
          zoom: '.$eventr_var['map_zoom'].',
          scrollwheel: '.$eventr_var['scrollwheel'].',
          center: {lat: '.$eventr_var['map-latitude'].', lng: '.$eventr_var['map-longtitude'].'}, 
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.'.$eventr_var['map_type'].', customMapTypeId]
          }


        });

        var image = new google.maps.MarkerImage("'.$eventr_var['marker_image']['url'].'",

                    new google.maps.Size(112, 112),

                    new google.maps.Point(0,0),

                    new google.maps.Point(18, 42)
                );
                
                // Add Marker
                var marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng('.$eventr_var['map-latitude'].','.$eventr_var['map-longtitude'].'), 
                    map: map,       
                    icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
                }); 

        map.mapTypes.set(customMapTypeId, customMapType);
        map.setMapTypeId(customMapTypeId);
      }';
	$html .='</script>';
    $html .='<script src="https://maps.googleapis.com/maps/api/js?key='.$eventr_var['map-api'].'&callback=initMap"
    async defer></script>
';
	
				
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Custom Google Map", 'eventr'),
   "base" => "googlemap",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_google_map.png',
   "params" => array(
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map ID",'eventr'),
         "param_name" => "map_id",
         "value" => "",
      ),
	 
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map Height",'eventr'),
         "param_name" => "map_height",
         "value" => "",
         "description" => __("Ex. 230px",'eventr'),
      ),
   )
) );

}

// End Custom Google Map Shortcode

// Modal Box shortcode
add_shortcode('modalbox', 'shortcode_modalbox');
function shortcode_modalbox($atts, $content = null) {
    $atts = vc_map_get_attributes( 'modalbox', $atts );
    $atts = shortcode_atts(
        array(
        'modal_id' => '',
        'size' => '',
        'style' => '',
        'position' => 'center',
        'class' => '',
        'button_text' =>'',
        'form_title' => '',
        'form_desc' => '',       
    ), $atts);
    $html ='';
    $size = '';
    if($atts['size'] == 'xsmall') $size = 'button-xs';
    if($atts['size'] == 'small') $size  = 'button-sm';
    if($atts['size'] == 'medium') $size  = 'button-lg';
    $style = '';
    if($atts['style'] == 'light') $style = 'button-line-light';
    if($atts['style'] == 'dark') $style = 'button-line-dark';
    $position = '';
    if($atts['position'] == 'left') $position = 'pull-left';
    if($atts['position'] == 'right') $position = 'pull-right';
    if($atts['position'] == 'center') $position = 'text-center';
    

    $html .= '<div class="'.$position.'"><button class="button '.$size.' '.$style.' '.$atts['class'].'" data-toggle="modal" data-target="#modal-'.$atts['modal_id'].'" >'.$atts['button_text'].'</button></div>';
    $html .= '<div id="modal-'.$atts['modal_id'].'" class="modal contact-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h2 class="modal-title" id="myModalLabel">'.$atts['form_title'].'</h2>
                    <p>'.$atts['form_desc'].'</p>
                  </div>
                  <div class="modal-body">'.do_shortcode($content).'</div>
                </div>
              </div>';
    $html .= '</div>';
    
    
    return $html;
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Modal Box", 'eventr'),
   "base" => "modalbox",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_button.png',
   "description" => __('Add modal box','eventr'),
   "params" => array(
   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Modal ID",'eventr'),
         "param_name" => "modal_id",
         "value" => "",
    ),
    array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Button Size",'eventr'),
         "param_name" => "size",
         "value" => array(   
                __('xsmall', 'eventr') => 'xsmall',
                __('small', 'eventr') => 'small',
                __('medium', 'eventr') => 'medium',
                __('big', 'eventr') => 'big',
                ),
    ),
    array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Style",'eventr'),
         "param_name" => "style",
         "value" => array(   
                __('light', 'eventr') => 'light',
                __('dark', 'eventr') => 'dark',
                ),
    ),
    array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Position",'eventr'),
         "param_name" => "position",
         "value" => array(   
                __('center', 'eventr') => 'center',
                __('left', 'eventr') => 'left',
                __('right', 'eventr') => 'right',
                ),
    ),
     array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Form title",'eventr'),
         "param_name" => "form_title",
         "value" => "",
    ),
    array(
         "type" => "textarea",
         "class" => "",
         "heading" => __("Form description",'eventr'),
         "param_name" => "form_desc",
         "value" => "",
    ),
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button text",'eventr'),
         "param_name" => "button_text",
         "value" => "",
    ),
    array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content",'eventr'),
         "param_name" => "content",
         "value" => "",
    )

   )
) );

}

// ThemeCube Masonry Gallery
add_shortcode('tc_masonry_gallery', 'shortcode_tc_masonry_gallery');
function shortcode_tc_masonry_gallery($atts, $content=null){
    $atts = vc_map_get_attributes( 'tc_masonry_gallery', $atts );
    $atts = shortcode_atts(
        array(
        'item_per_row' => '',
        'zero_gap' => '',
        'images'    => '',
        'class' => '',
        
    ), $atts);
    
    $item_per_row = '';
    if($atts['item_per_row'] == 'col-md-4') $item_per_row = 'col-md-4 col-sm-4 col-xs-12';
    if($atts['item_per_row'] == 'col-md-3') $item_per_row = 'col-md-3 col-sm-3 col-xs-12';
    if($atts['item_per_row'] == 'col-md-2') $item_per_row = 'col-md-2 col-sm-4 col-xs-12';

    $zero_gap = '';
    if($atts['zero_gap'] == 'yes') {
        $zero_gap = 'no-padding';
    }

    $img = $atts['images']; 
    $images = explode( ',', $img );
        
    
    $html ='';
    $html .= '<div class="tc_masonry_gallery">';
    
     foreach ($images as $key => $value) {
         $image = wp_get_attachment_image_src(trim($value), 'full');
    
    $html .= '<div class="item '.$item_per_row.' '.$zero_gap.'">
                <div class="wrap">
                <img class="img-responsive"  src="'.$image[0].'" alt="gallery">
                <div class="overlay"></div>
                <div class="icon">
                    <a class="image-popup" href="'.$image[0].'" ><i class="pe-3x pe-7s-plus"></i></a>
                </div>
                </div>

            </div>';

    
     }
    $html .= '</div>';
    return $html;                      
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("ThemeCube Gallery", 'eventr'),
   "base" => "tc_masonry_gallery",
   "category" => __("ThemeCube Shortcodes", 'eventr'),
   "icon" => get_template_directory_uri().'/img/vc_icons/tc_sch_minimal.png',
   "description" => __('Add custom gallery','eventr'),
   "controls" => "full",
   "params" => array(
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("How many items in a row?",'eventr'),
            "param_name" => "item_per_row",
            "value" => array(   
                __('3 items', 'eventr') => 'col-md-4',
                __('4 items', 'eventr') => 'col-md-3',
                __('6 items', 'eventr') => 'col-md-2',
            ),
            "std" => "col-md-4",
        ),
        array(
            'type' => 'checkbox',
            'heading' => __( 'Zero gap between items?', 'eventr' ),
            'param_name' => 'zero_gap',
            'value' => array( __( 'Yes', 'eventr' ) => 'yes' ),
        ),
        array(
            "type" => "attach_images",
            "class" => "",
            "holder" => "",
            "heading" => __("Images",'eventr'),
            "param_name" => "images",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Class",'eventr'),
            "param_name" => "class",
            "value" => "",
        ),
        

     
   )
) );

}

