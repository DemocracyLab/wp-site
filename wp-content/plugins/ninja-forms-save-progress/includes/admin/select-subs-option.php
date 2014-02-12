<?php

add_action( 'init', 'ninja_forms_save_progress_register_select_sub_option', 20 );
function ninja_forms_save_progress_register_select_sub_option(){
	$args = array(
		'page' => 'ninja-forms-subs',
		'tab' => 'view_subs',
		'sidebar' => 'select_subs',
		'type' => '',
		'name' => 'add_incomplete',
		'display_function' => 'ninja_forms_save_progress_select_sub_option',
		'label' => __( 'Include Incomplete Submissions?', 'ninja-forms' ),
	);
	if( function_exists( 'ninja_forms_register_sidebar_option' ) ){
		ninja_forms_register_sidebar_option( 'add_incomplete', $args );
	}
	add_filter( 'ninja_forms_view_subs_results', 'ninja_forms_save_progress_filter_subs_results' );
	add_filter( 'ninja_forms_download_all_subs_results', 'ninja_forms_save_progress_filter_subs_results' );
	add_filter( 'ninja_forms_export_subs_label_array', 'ninja_forms_save_progress_filter_export_subs_label' );
	add_filter( 'ninja_forms_export_subs_value_array', 'ninja_forms_save_progress_filter_export_subs_value', 10, 2 );
}

function ninja_forms_save_progress_select_sub_option( $slug, $data ){
	if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] == '' ){
		unset( $_SESSION['ninja_forms_add_incomplete'] );
		$add_incomplete = '';
	}else if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] != '' ){
		$_SESSION['ninja_forms_add_incomplete'] = $_REQUEST['add_incomplete'];
		$add_incomplete = $_REQUEST['add_incomplete'];
	}else if( isset( $_SESSION['ninja_forms_add_incomplete']) AND $_SESSION['ninja_forms_add_incomplete'] != '' ){
		$add_incomplete = $_SESSION['ninja_forms_add_incomplete'];
	}else{
		$add_incomplete = '';
	}
	?>
	<input type="hidden" name="add_incomplete" value="0">
	<label>
		<input type="checkbox" name="add_incomplete" value="1" <?php checked( $add_incomplete, 1 );?>>
		<?php _e( 'Include incomplete submissions?', 'ninja-forms' );?>
	</label>
	<br />
	<?php
}

function ninja_forms_save_progress_filter_subs_results( $sub_results ){
	if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] == '' ){
		unset( $_SESSION['ninja_forms_add_incomplete'] );
		$add_incomplete = '';
	}else if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] != '' ){
		$_SESSION['ninja_forms_add_incomplete'] = $_REQUEST['add_incomplete'];
		$add_incomplete = $_REQUEST['add_incomplete'];
	}else if( isset( $_SESSION['ninja_forms_add_incomplete']) AND $_SESSION['ninja_forms_add_incomplete'] != '' ){
		$add_incomplete = $_SESSION['ninja_forms_add_incomplete'];
	}else{
		$add_incomplete = '';
	}
	if( is_array( $sub_results ) AND !empty( $sub_results ) ){
		$tmp_array = array();
		for ($i=0; $i < count( $sub_results ); $i++) { 
			if( $sub_results[$i]['status'] == 1 ){
				$tmp_array[] = $sub_results[$i];
			}
			if( $add_incomplete == 1 ){
				if( $sub_results[$i]['status'] == 0 && $sub_results[$i]['saved'] == 1 ){
					$tmp_array[] = $sub_results[$i];
				}
			}
		}
		$sub_results = $tmp_array;
	}

	return $sub_results;
}

function ninja_forms_save_progress_filter_export_subs_label( $label_array ){
	array_splice($label_array[0], 1, 0, __( 'Status', 'ninja-forms' ) );
	return $label_array;
}

function ninja_forms_save_progress_filter_export_subs_value( $value_array, $sub_id_array ){
	if( is_array( $value_array ) AND !empty( $value_array ) ){
		for ($i=0; $i < count( $value_array ); $i++) {
			if( isset( $sub_id_array[$i] ) ){
				$sub_row = ninja_forms_get_sub_by_id( $sub_id_array[$i] );
				$status = $sub_row['status'];
				if( $status == 1 ){
					$status = __( 'Complete', 'ninja-forms' );
				}else{
					$status = __( 'Incomplete', 'ninja-forms' );
				}
			}
			array_splice($value_array[$i], 1, 0, $status );
		}
	}
	
	return $value_array;
}