<?php

add_action( 'init', 'ninja_forms_save_progress_register_check_save' );
function ninja_forms_save_progress_register_check_save(){
	add_filter( 'ninja_forms_field', 'ninja_forms_save_progress_check_save', 11, 2 );
}

function ninja_forms_save_progress_check_save( $data, $field_id ){
	global $current_user, $ninja_forms_processing;

	if ( $field_id ) {
		get_currentuserinfo();

		$form_row = ninja_forms_get_form_by_field_id( $field_id );
		$form_id = $form_row['id'];
		$form_data = $form_row['data'];
		
		if( isset( $current_user ) ){
			$user_id = $current_user->ID;	
		}else{
			$user_id = '';
		}

		if( isset( $form_data['multi_save'] ) ){
			$multi_save = $form_data['multi_save'];
		}else{
			$multi_save = 0;
		}

		if( isset( $_REQUEST['save_id'] ) AND isset( $_REQUEST['ninja_forms_action'] ) AND $_REQUEST['ninja_forms_action'] == 'edit_save' ){
			$save_id = $_REQUEST['save_id'];
		}else{
			$save_id = '';
		}

		if( !is_admin() ){
			if( ( !is_object( $ninja_forms_processing ) OR $ninja_forms_processing->get_action() == 'login' OR $ninja_forms_processing->get_form_ID() != $form_id ) AND $user_id != '' ){
				
				if( $multi_save == 1 ){
					if( $save_id != '' ){
						$sub_row = ninja_forms_get_sub_by_id( $save_id );
						if( $sub_row['user_id'] == $user_id AND isset( $sub_row['saved'] ) AND $sub_row['saved'] == 1 ){
							$sub_id = $save_id;
						}else{
							$sub_id = '';
						}				
					}else{
						$sub_id = '';
					}
					if( $sub_id != '' ){
						$sub_row = ninja_forms_get_sub_by_id( $sub_id );
					}else{
						$sub_row = array();
					}
				}else{
					$sub_row = ninja_forms_get_saved_form( $user_id, $form_id );
				}

				if( is_array( $sub_row ) AND !empty( $sub_row ) ){
					$sub_data = $sub_row['data'];
					if( is_array( $sub_data ) AND !empty( $sub_data ) ){
						foreach( $sub_data as $row ){
							if( $row['field_id'] == $field_id ){
								$data['default_value'] = $row['user_value'];
								break;
							}
						}
					}
				}
			}else if( is_object( $ninja_forms_processing ) AND $ninja_forms_processing->get_error( '_save_progress' ) ){
				$clear_saved = $ninja_forms_processing->get_form_setting( 'clear_saved' );
				if( $clear_saved == 1 ){
					$data['default_value'] = '';
				}
			}	
		}		
	}
		
	return $data;
}