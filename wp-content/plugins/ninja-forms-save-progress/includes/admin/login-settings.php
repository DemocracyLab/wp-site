<?php
add_action('init', 'ninja_forms_register_tab_login_settings');

function ninja_forms_register_tab_login_settings(){
	$args = array(
		'name' => 'Login / Registration', 
		'page' => 'ninja-forms-settings',
		'display_function' => '', 
		'save_function' => 'ninja_forms_save_login_settings',
	);
	if( function_exists( 'ninja_forms_register_tab' ) ){
		ninja_forms_register_tab('login_settings', $args);
	}
}

add_action('init', 'ninja_forms_register_login_settings_metabox');

function ninja_forms_register_login_settings_metabox(){

	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'login_settings',
		'slug' => 'login_settings',
		'title' => __('Login Labels', 'ninja-forms'),
		'settings' => array(
			array(
				'name' => 'login_link',
				'type' => 'text',
				'label' => __('Login Link Text', 'ninja-forms'),
			),
			array(
				'name' => 'username_label',
				'type' => 'text',
				'label' => __('Username Label', 'ninja-forms'),
			),
			array(
				'name' => 'reset_password',
				'type' => 'text',
				'label' => __('Password Reset Link Text', 'ninja-forms'),
			),
			array(
				'name' => 'password_label',
				'type' => 'text',
				'label' => __('Password Label', 'ninja-forms'),
			),	
			array(
				'name' => 'repassword_label',
				'type' => 'text',
				'label' => __('Password Re-entry Label', 'ninja-forms'),
			),
			array(
				'name' => 'password_mismatch',
				'type' => 'text',
				'label' => __('Password Mismatch Message', 'ninja-forms'),
			),			
			array(
				'name' => 'login_button_label',
				'type' => 'text',
				'label' => __('Login Button Label', 'ninja-forms'),
			),
			array(
				'name' => 'cancel_button_label',
				'type' => 'text',
				'label' => __('Cancel Button Label', 'ninja-forms'),
			),
			array(
				'name' => 'login_error',
				'type' => 'text',
				'label' => __('Login Error Message', 'ninja-forms'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
	
	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'login_settings',
		'slug' => 'register_labels',
		'title' => __('Registration Labels', 'ninja-forms'),
		'settings' => array(
			array(
				'name' => 'register_link',
				'type' => 'text',
				'label' => __('Register Link Text', 'ninja-forms'),
			),
			array(
				'name' => 'email_label',
				'type' => 'text',
				'label' => __('Email Label', 'ninja-forms'),
			),
			array(
				'name' => 'register_button_label',
				'type' => 'text',
				'label' => __('Register Button Label', 'ninja-forms'),
			),
			array(
				'name' => 'register_error',
				'type' => 'text',
				'label' => __('Registration Error Message', 'ninja-forms'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}

	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'login_settings',
		'slug' => 'register_settings',
		'title' => __('Registration Spam Settings', 'ninja-forms'),
		'settings' => array(
			array(
				'name' => 'register_spam_q',
				'type' => 'text',
				'label' => __('Register Spam Question', 'ninja-forms'),
			),
			array(
				'name' => 'register_spam_a',
				'type' => 'text',
				'label' => __('Register Spam Answer', 'ninja-forms'),
			),
			array(
				'name' => 'register_spam_error',
				'type' => 'text',
				'label' => __('Register Spam Error Message', 'ninja-forms'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
	
}

function ninja_forms_save_login_settings($data){
	$plugin_settings = get_option("ninja_forms_settings");
	foreach($data as $key => $val){
		$plugin_settings[$key] = $val;
	}
	update_option("ninja_forms_settings", $plugin_settings);
	$update_msg = __( 'Settings Saved', 'ninja-forms' );
	return $update_msg;
}