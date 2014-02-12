<?php

add_shortcode( 'ninja_forms_save_table', 'ninja_forms_save_table_shortcode' );
function ninja_forms_save_table_shortcode( $atts ){
	extract( $atts );
	if ( !isset( $user_id ) ) {
		$user_id = get_current_user_id();		
	}

	if( isset( $cols ) ){
		$cols = explode( ',', $cols );
	}

	$table = ninja_forms_return_echo( 'ninja_forms_save_progress_output_table', $user_id, $form_id, $cols, $url );

	return $table;
}