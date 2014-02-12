<?php

function ninja_forms_save_progress_activation(){
	global $wpdb;
	if($wpdb->get_var("SHOW COLUMNS FROM ".NINJA_FORMS_SUBS_TABLE_NAME." LIKE 'saved'") != 'saved') {
		$sql = "ALTER TABLE ".NINJA_FORMS_SUBS_TABLE_NAME." ADD `saved` INT(11) NOT NULL";
		$wpdb->query($sql);
		$all_subs = ninja_forms_get_all_subs();
		if( is_array( $all_subs ) AND !empty( $all_subs ) ){
			foreach( $all_subs as $sub ){
				if( $sub['action'] == 'save' ){
					$sub_id = $sub['id'];
					$update_array = array(
						'saved' => 1,
					);
					$wpdb->update( NINJA_FORMS_SUBS_TABLE_NAME, $update_array, array( 'id' => $sub_id ) );
				}
			}
		}
	}
}