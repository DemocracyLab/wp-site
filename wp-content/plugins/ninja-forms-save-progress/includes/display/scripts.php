<?php

add_action( 'init', 'ninja_forms_register_save_progress_display_js_css' );
function ninja_forms_register_save_progress_display_js_css(){
	add_action( 'ninja_forms_display_js', 'ninja_forms_save_progress_display_js', 10, 2 );
}

function ninja_forms_save_progress_display_js( $form_id ){
	wp_enqueue_script( 'ninja-forms-save-progress-display',
		NINJA_FORMS_SAVE_PROGRESS_URL .'/js/dev/ninja-forms-save-progress-display.js',
		array( 'jquery' ) );	
}