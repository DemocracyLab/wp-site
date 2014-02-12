<?php
/**
 * Adds the sub_id to the form if a sub_id is set.
 *
**/
add_action('init', 'ninja_forms_register_display_sub_id');
function ninja_forms_register_display_sub_id(){
	add_action('ninja_forms_display_after_fields', 'ninja_forms_display_sub_id');
}

function ninja_forms_display_sub_id( $form_id ){
	global $current_user, $ninja_forms_processing;
	get_currentuserinfo();

	$form_row = ninja_forms_get_form_by_id( $form_id );
	$form_data = $form_row['data'];

	if( isset( $form_data['multi_save'] ) ){
		$multi_save = $form_data['multi_save'];
	}else{
		$multi_save = 0;
	}

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else{
		$save_id = '';
	}

	if( isset( $current_user ) ){
		$user_id = $current_user->ID;	
	}else{
		$user_id = '';
	}
	
	if($user_id  != ''){
		$sub_id = '';

		if( !is_admin() ){
			if( $multi_save == 1 ){
				if( $save_id != '' ){
					$sub_row = ninja_forms_get_sub_by_id( $save_id );
					if( $sub_row['user_id'] == $user_id AND isset( $sub_row['saved'] ) AND $sub_row['saved'] == 1 ){
						$sub_id = $save_id;
					}else{
						$sub_id = '';
					}				
				}else if( is_object( $ninja_forms_processing ) ){
					$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
				}
			}else{
				$sub_row = ninja_forms_get_saved_form( $user_id, $form_id );
				if(is_array($sub_row) AND !empty($sub_row)){
					$sub_id = $sub_row['id'];
				}else{
					$sub_id = '';
				}
			}
			
			if( $sub_id != '' ){
				?>
				<input type="hidden" name="_sub_id" value="<?php echo $sub_id;?>">
				<?php			
			}
		}
		
	}
}