<?php

add_action( 'init', 'ninja_forms_register_tab_metabox_option_save_progress_license', 11 );
function ninja_forms_register_tab_metabox_option_save_progress_license(){
	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'license_settings',
		'slug' => 'license_settings',
		'settings' => array(
			array(
				'name' => 'save_progress_license',
				'type' => 'text',
				'label' => __('Save Progress License Key', 'ninja-forms'),
				'desc' => __('You will find this included with your purchase email.', 'ninja-forms'),
				'save_function' => 'ninja_forms_save_progress_activate_license',
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox_options' ) ){
		ninja_forms_register_tab_metabox_options($args);
	}
}

add_action( 'admin_init', 'ninja_forms_save_progress_modify_license_label' );
function ninja_forms_save_progress_modify_license_label(){
	global $ninja_forms_tabs_metaboxes;

	for ($x=0; $x < count( $ninja_forms_tabs_metaboxes['ninja-forms-settings']['license_settings']['license_settings']['settings'] ); $x++) { 
		if( $ninja_forms_tabs_metaboxes['ninja-forms-settings']['license_settings']['license_settings']['settings'][$x]['name'] == 'save_progress_license' ){
			$plugin_settings = get_option( 'ninja_forms_settings' );
			if( !isset( $plugin_settings['save_progress_license_status'] ) OR $plugin_settings['save_progress_license_status'] == 'invalid' ){
				$status = ' <img src="'.NINJA_FORMS_URL.'/images/no.png">';
			}else{
				$status = ' <img src="'.NINJA_FORMS_URL.'/images/yes.png">';
			}
			$ninja_forms_tabs_metaboxes['ninja-forms-settings']['license_settings']['license_settings']['settings'][$x]['label'] .= $status;
		}		
	}
}

function ninja_forms_save_progress_activate_license( $data ){
	$plugin_settings = get_option( 'ninja_forms_settings' );
	if( isset( $plugin_settings['save_progress_license_status'] ) ){
		$status = $plugin_settings['save_progress_license_status'];
	}else{
		$status = 'invalid';
	}

	if( isset( $plugin_settings['save_progress_license'] ) ){
		$old_license = $plugin_settings['save_progress_license'];
	}else{
		$old_license = '';
	}

	if( $old_license == '' OR ( $old_license != $data['save_progress_license'] ) OR $status == 'invalid' ){
 		// retrieve the license from the database
		$license = $data['save_progress_license'];

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'activate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( NINJA_FORMS_SAVE_PROGRESS_EDD_SL_ITEM_NAME ) // the name of our product in EDD
		);
 
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, NINJA_FORMS_SAVE_PROGRESS_EDD_SL_STORE_URL ) );
 
		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;
 
		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"
 		$plugin_settings = get_option( 'ninja_forms_settings' );
 		$plugin_settings['save_progress_license_status'] = $license_data->license;

		update_option( 'ninja_forms_settings', $plugin_settings );		
	}
}