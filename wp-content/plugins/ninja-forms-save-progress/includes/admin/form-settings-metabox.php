<?php

function ninja_forms_register_form_settings_save_progress_metabox(){

	$save_table_cols = array();
	if( isset( $_REQUEST['form_id'] ) ){
		$form_id = $_REQUEST['form_id'];
		$fields = ninja_forms_get_fields_by_form_id( $form_id );
		
		foreach( $fields as $field ){
			if( isset( $field['data']['label'] ) ){
				$save_table_cols[] = array( 'name' => $field['data']['label'], 'value' => $field['id'] );
			}else{
				$save_table_cols[] = array( 'name' => 'Field ID: '.$field['id'], 'value' => $field['id'] );
			}
		}
	}else{

	}

	$args = array(
		'page' => 'ninja-forms',
		'tab' => 'form_settings',
		'slug' => 'save_progress',
		'title' => __('Save Progress Settings', 'ninja-forms'),
		'display_function' => '',
		'state' => 'closed',
		'settings' => array(
			array(
				'name' => 'save_progress',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Allow users to save progress?', 'ninja-forms'),
				'display_function' => '',
				'help' => __('', 'ninja-forms'),
			),
			array(
				'name' => 'clear_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Clear Saved Form?', 'ninja-forms'),
				'display_function' => '',
				'help' => __('', 'ninja-forms'),
			),				
			array(
				'name' => 'hide_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Hide Saved Form?', 'ninja-forms'),
				'display_function' => '',
				'help' => __('', 'ninja-forms'),
			),			
			array(
				'name' => 'clear_incomplete_saves',
				'type' => 'text',
				'label' => __('Number of days to keep incomplete form entries', 'ninja-forms'),
			),			
			array(
				'name' => 'save_msg',
				'type' => 'rte',
				'label' => __('Saved Form Message', 'ninja-forms'),
				'desc' => __('If you want to include field data entered by the user, for instance a name, you can use the following shortcode: [ninja_forms_field id=23] where 23 is the ID of the field you want to insert. This will tell Ninja Forms to replace the bracketed text with whatever input the user placed in that field. You can find the field ID when you expand the field for editing.', 'ninja-forms'),
			),
			array(
				'name' => 'email_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Email user when they save a form?', 'ninja-forms'),
				'display_function' => '',
				'help' => __('', 'ninja-forms'),
			),
			array(
				'name' => 'saved_subject',
				'type' => 'text',
				'label' => __('Saved Form Email Subject', 'ninja-forms'),
			),		
			array(
				'name' => 'save_email_msg',
				'type' => 'rte',
				'label' => __('Saved Form Email Message', 'ninja-forms'),
				'desc' => __('If you want to include field data entered by the user, for instance a name, you can use the following shortcode: [ninja_forms_field id=23] where 23 is the ID of the field you want to insert. This will tell Ninja Forms to replace the bracketed text with whatever input the user placed in that field. You can find the field ID when you expand the field for editing.', 'ninja-forms'),
			),
			array(
				'name' => 'multi_save',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Allow multiple saved forms?', 'ninja-forms-save-progress' ),
				'display_function' => '',
				'help' => __('', 'ninja-forms'),
			),
			array(
				'name' => 'save_table',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Display saved submission table above form?', 'ninja-forms-save-progress' ),
			),			
			array(
				'name' => 'save_table_cols',
				'type' => 'multi_select',
				'desc' => __( 'Use CTRL + click to select multiple fields (COMMAND + click for Mac users). The number of field columns you want will depend upon the size of your field labels and values. Three is a good, standard value.' , 'ninja-forms-save-progress' ),
				'options' => $save_table_cols,
				'label' => __( 'Use these fields as table columns', 'ninja-forms-save-progress' ),
				'size' => 5,
			),
			array(
				'name' => 'save_delete',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Allow users to delete their saves?', 'ninja-forms-save-progress' ),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
}

add_action( 'admin_init', 'ninja_forms_register_form_settings_save_progress_metabox', 11 );