<?php

add_action( 'init', 'ninja_forms_save_progress_register_save_sub_filter' );
function ninja_forms_save_progress_register_save_sub_filter(){
	add_filter( 'ninja_forms_save_sub_args', 'ninja_forms_save_progress_save_sub_filter' );
}

function ninja_forms_save_progress_save_sub_filter( $args ){
	global $ninja_forms_processing;

	if( $ninja_forms_processing->get_action() == 'submit' ){
		$args['status'] = 1;
		$args['saved'] = 0;
	}
	return $args;
}