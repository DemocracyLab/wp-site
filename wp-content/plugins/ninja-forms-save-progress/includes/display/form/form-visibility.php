<?php

add_action( 'init', 'ninja_forms_save_progress_register_display_form_visibility' );
function ninja_forms_save_progress_register_display_form_visibility(){
	add_filter( 'ninja_forms_display_form_visibility', 'ninja_forms_save_progress_display_form_visibility', 10, 2 );
}

function ninja_forms_save_progress_display_form_visibility( $display, $form_id ){
	global $ninja_forms_processing;

	$form_row = ninja_forms_get_form_by_id( $form_id );
	$form_data = $form_row['data'];
	if( isset( $form_data['hide_saved'] ) ){
		$hide_saved = $form_data['hide_saved'];
	}else{
		$hide_saved = 0;
	}

	//If the plugin setting 'hide complete' has been set and a success message exists, hide the form.
 	if( $hide_saved == 1 AND ( isset( $ninja_forms_processing ) AND $ninja_forms_processing->get_action() == 'save' )  AND $ninja_forms_processing->get_form_ID() == $form_id ){
		$display = 0;
	}

	return $display;
}