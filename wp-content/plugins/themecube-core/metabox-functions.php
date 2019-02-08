<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category eventr
 * @package  Custom Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function yourprefix_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo $classes; ?>">
		<p><label for="<?php echo $id; ?>"><?php echo $label; ?></label></p>
		<p><input id="<?php echo $id; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo $description; ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function yourprefix_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo $field->row_classes(); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo $field->args( 'description' ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'tc_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function tc_metabox() {
	$prefix = 'tc_';


	//Speaker
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_speaker',
		'title'         => esc_html__( 'Speaker Details', 'eventr' ),
		'object_types'  => array( 'speaker', ), // Post type
	) );

	$cmb->add_field( array(
		'name'       => esc_html__( 'Company', 'eventr' ),
		'id'         => $prefix . 'speaker_company',
		'type'       => 'text_medium',
	) );

	$cmb->add_field( array(
		'name'       => esc_html__( 'Job title', 'eventr' ),
		'id'         => $prefix . 'speaker_job',
		'type'       => 'text',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Website URL', 'eventr' ),
		'id'   => $prefix . 'speaker_website',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Facebook Address', 'eventr' ),
		'id'   => $prefix . 'speaker_fb_address',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Twitter Address', 'eventr' ),
		'id'   => $prefix . 'speaker_tw_address',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Instagram Address', 'eventr' ),
		'id'   => $prefix . 'speaker_instagram_address',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Google Plus Address', 'eventr' ),
		'id'   => $prefix . 'speaker_gplus_address',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Linkedin Address', 'eventr' ),
		'id'   => $prefix . 'speaker_linkedin_address',
		'type' => 'text_url',
	) );


	// Featured Speaker
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_speaker_featured',
		'title'         => esc_html__( 'Featured Speaker', 'eventr' ),
		'object_types'  => array( 'speaker', ), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'cmb_styles' => false, // false to disable the CMB stylesheet

	) );

	$cmb->add_field( array(
	  //'name' => 'Featured Speaker',
	    'desc' => 'Featured speaker',
	    'id'   => $prefix . 'featured_speaker',
	    'type' => 'checkbox'
	) );


	// Additional Info for Schedule
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_program_additional',
		'title'         => esc_html__( 'Additional Info', 'eventr' ),
		'object_types'  => array( 'schedule', ), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'cmb_styles' => false, // false to disable the CMB stylesheet

	) );

	$cmb->add_field( array(
	  //'name' => 'Additional Info',
	    'id'   => $prefix . 'additional_info',
	    'type'             => 'radio',
	    'options'          => array(
	        'coffee-break' 	=> __( 'Coffee break', 'eventr' ),
	        'lunch'   		=> __( 'Lunch', 'eventr' ),
	        'registration'	=> __( 'Registration', 'eventr' ),
	    ),
	) );


	//Schedule Metaboxes
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_program',
		'title'         => esc_html__( 'Program Details', 'eventr' ),
		'object_types'  => array( 'schedule', ), // Post type
	) );

	//Date
	$cmb->add_field( array(
		'name' => esc_html__( 'Program Date', 'eventr' ),
		'desc' => esc_html__( 'Pick a date for program', 'eventr' ),
		'id'   => $prefix . 'program_date',
		'type' => 'text_date',
		'date_format' => 'M j, Y',
	) );

	//Start Time
	$cmb->add_field( array(
		'name' => esc_html__( 'Start Time', 'eventr' ),
		'desc' => esc_html__( 'Select time for program', 'eventr' ),
		'id'   => $prefix . 'program_time',
		'type' => 'text_time',
		'time_format' => 'H:i', // Set to 24hr format
	) );

	//Duration
	$cmb->add_field( array(
		'name' => esc_html__( 'Duration', 'eventr' ),
		'id'   => $prefix . 'program_duration',
		'type' => 'text_small',
	) );

	//Location
	$cmb->add_field( array(
		'name' => esc_html__( 'Location', 'eventr' ),
		'id'   => $prefix . 'program_location',
		'type' => 'text_medium',
	) );

	//Level
	$cmb->add_field( array(
		'name' => esc_html__( 'Level', 'eventr' ),
		'desc' => esc_html__('Select level (beginner, intermediate, expert etc.)', 'eventr'),
		'id'   => $prefix . 'program_level',
		'type' => 'text_medium',
	) );

	
}
