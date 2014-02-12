<?php

add_action('init', 'ninja_forms_register_save_progress');
function ninja_forms_register_save_progress(){
	add_action( 'ninja_forms_before_pre_process', 'ninja_forms_before_save_progress' );
	add_action( 'ninja_forms_pre_process', 'ninja_forms_save_progress', 1002 );	
}

function ninja_forms_before_save_progress(){
	global $ninja_forms_processing;
	
	if( $ninja_forms_processing->get_extra_value('_save_progress') ){
		$ninja_forms_processing->set_action( 'save' );
	}
}

function ninja_forms_save_progress(){
	global $ninja_forms_processing, $ninja_forms_fields;
	$save_msg = $ninja_forms_processing->get_form_setting( 'save_msg' );
	$hide_complete = $ninja_forms_processing->get_form_setting( 'hide_saved' );
	$clear_complete = $ninja_forms_processing->get_form_setting( 'clear_saved' );

	if( $ninja_forms_processing->get_action() == 'save' ){

		if( $ninja_forms_processing->get_form_setting( 'sub_id' ) ){
			$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		}else{
			$sub_id = '';
		}

		$action = 'save';
		$user_id = $ninja_forms_processing->get_user_ID();
		
		$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		$form_id = $ninja_forms_processing->get_form_ID();

		$field_data = $ninja_forms_processing->get_all_fields();

		$sub_data = array();

		if(is_array($field_data) AND !empty($field_data)){
			foreach($field_data as $field_id => $user_value){
				$field_row = ninja_forms_get_field_by_id($field_id);
				$field_type = $field_row['type'];
				$save_sub = $ninja_forms_fields[$field_type]['save_sub'];
				
				if($save_sub){
					ninja_forms_remove_from_array($sub_data, "field_id", $field_id, TRUE);
					$user_value = apply_filters('ninja_forms_save_sub', $user_value, $field_id);
					array_push( $sub_data, array( 'field_id' => $field_id, 'user_value' => $user_value ) );
				}
			}
		}

		$args = array(
			'form_id' => $form_id,
			'user_id' => $user_id,
			'action' => $action,
			'status' => 0,
			'saved' => 1,
			'data' => serialize( $sub_data ),
		);

		if($sub_id != ''){
			$args['sub_id'] = $sub_id;
			ninja_forms_update_sub($args);
			$ninja_forms_processing->update_form_setting( 'sub_id', $sub_id );
		}else{
			$sub_id = ninja_forms_insert_sub($args);
			$ninja_forms_processing->update_form_setting( 'sub_id', $sub_id );
		}
		
		$ninja_forms_processing->remove_all_errors();
		$ninja_forms_processing->add_error( '_save_progress', __( 'Saved', 'ninja-forms-save-progress'), 'save_progress' );
		$ninja_forms_processing->add_success_msg( '_save_progress', $save_msg );
		$ninja_forms_processing->update_form_setting( 'hide_complete', $hide_complete );
		$ninja_forms_processing->update_form_setting( 'clear_complete', $clear_complete );
		do_action( 'ninja_forms_save_progress' );
	}
}