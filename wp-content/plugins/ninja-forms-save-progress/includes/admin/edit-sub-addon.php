<?php

add_action( 'init', 'ninja_forms_register_save_progress_edit_sub' );
function ninja_forms_register_save_progress_edit_sub(){
	if( is_admin() ){
		add_action( 'ninja_forms_display_after_open_form_tag', 'ninja_forms_save_progress_edit_sub' );
		add_filter( 'ninja_forms_edit_sub_args', 'ninja_forms_save_progress_edit_sub_args' );		
	}
}

function ninja_forms_save_progress_edit_sub( $form_id ){
	global $ninja_forms_processing;

	if( isset( $_REQUEST['sub_id'] ) ){
		$sub_id = $_REQUEST['sub_id'];
	}else{
		$sub_id = '';
	}
	if( $sub_id != '' ){
		$sub_row = ninja_forms_get_sub_by_id( $sub_id );
		$status = $sub_row['status'];
	
	_e( 'Submission Status', 'ninja-forms' );
	?>	
	<select name="_status" id="">
		<option value="0" <?php selected( $status, 0 );?>><?php _e( 'Incomplete', 'ninja-forms' );?></option>
		<option value="1" <?php selected( $status, 1 );?>><?php _e( 'Complete', 'ninja-forms' );?></option>
	</select>
	<?php
	}
}

function ninja_forms_save_progress_edit_sub_args( $args ){
	global $ninja_forms_processing;

	if( $ninja_forms_processing->get_extra_value( '_status' ) !== false ){
		
		$args['status'] = $ninja_forms_processing->get_extra_value( '_status' );
	}

	return $args;
}