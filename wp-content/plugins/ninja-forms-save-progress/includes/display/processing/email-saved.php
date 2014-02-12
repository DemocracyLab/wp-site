<?php

add_action( 'init', 'ninja_forms_register_save_progress_email_user' );
function ninja_forms_register_save_progress_email_user(){
	add_action( 'ninja_forms_save_progress', 'ninja_forms_save_progress_email_user' );
}

function ninja_forms_save_progress_email_user(){
	global $ninja_forms_processing, $current_user;

	if( $ninja_forms_processing->get_form_setting( 'email_saved' ) ){
		$email_saved = $ninja_forms_processing->get_form_setting( 'email_saved' );
	}else{
		$email_saved = 0;
	}
	
	if( $email_saved == 1 ){

		get_currentuserinfo();

	    $user_email = $current_user->user_email;

		$email_from = $ninja_forms_processing->get_form_setting('email_from');
		$email_type = $ninja_forms_processing->get_form_setting('email_type');
		$subject = $ninja_forms_processing->get_form_setting('saved_subject');
		$message = $ninja_forms_processing->get_form_setting('save_email_msg');

		//Apply shortcodes to each of our message fields.
		$subject = do_shortcode( $subject );
		$message = do_shortcode( $message );

		$email_from = htmlspecialchars_decode($email_from);
		$email_from = htmlspecialchars_decode($email_from);

		$headers = "\nMIME-Version: 1.0\n";
		$headers .= "From: $email_from \r\n";
		$headers .= "Content-Type: text/".$email_type."; charset=utf-8\r\n";

		wp_mail( $user_email, $subject, $message, $headers );
	}
}