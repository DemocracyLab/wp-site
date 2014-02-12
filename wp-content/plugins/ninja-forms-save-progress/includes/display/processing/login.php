<?php
add_action('plugins_loaded', 'ninja_forms_init_user_login');
function ninja_forms_init_user_login(){
	global $current_user, $user_ID;
	if(isset($_POST['_ninja_forms_wp_login'])){
		$form_id = $_POST['_form_id'];	
		$creds = array();
		$creds['user_login'] = $_POST['_ninja_forms_login_log'];
		$creds['user_password'] = $_POST['_ninja_forms_login_password'];
		$creds['remember'] = false;
		$user = wp_signon( $creds, false );
		if(!is_wp_error($user)){
			wp_set_current_user($user->ID);
			$current_url = add_query_arg( array('ninja-forms-login' => 1 ) );
			//wp_redirect( $current_url );
			//exit();
		}
	}
}

add_action( 'init', 'ninja_forms_register_user_login', 5 );
function ninja_forms_register_user_login(){
	add_action('ninja_forms_before_pre_process', 'ninja_forms_user_login');
}

function ninja_forms_user_login(){
	global $ninja_forms_processing;

	$plugin_settings = get_option('ninja_forms_settings');
	$login_error = $plugin_settings['login_error'];

	if( $ninja_forms_processing->get_extra_value( '_ninja_forms_wp_login' ) ){
		if(is_user_logged_in()){
			$ninja_forms_processing->set_action( 'login' );
			$ninja_forms_processing->add_error('_login_success', '', '_login_success' );
		}else{
			$ninja_forms_processing->add_error('_login_password', __($login_error, 'ninja-forms-save-progress'), '_login_password');
		}
	}
}