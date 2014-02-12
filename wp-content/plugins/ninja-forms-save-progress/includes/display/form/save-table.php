<?php

/*
 * Create a function to output a table of a user's save submissions.
 * @since 1.1
 * @returns void
 */

add_action( 'ninja_forms_display_before_fields', 'ninja_forms_output_saved_forms_table' );

function ninja_forms_output_saved_forms_table( $form_id ){
	global $current_user;
	get_currentuserinfo();

	$form_row = ninja_forms_get_form_by_id( $form_id );
	$form_data = $form_row['data'];

	if( isset( $form_data['save_table'] ) ){
		$save_table = $form_data['save_table'];
	}else{
		$save_table = 0;
	}

	if( isset( $form_data['save_table_cols'] ) ){
		$cols = $form_data['save_table_cols'];
	}else{
		$cols = array();
	}

	if( isset( $current_user ) ){
		$user_id = $current_user->ID;	
	}else{
		$user_id = '';
	}

	if( $save_table == 1 ){
		ninja_forms_save_progress_output_table( $user_id, $form_id, $cols );		
	}
}


function ninja_forms_save_progress_output_table( $user_id, $form_id, $cols = array(), $url = '' ){
	global $ninja_forms_processing, $wp;
	$sub_results = ninja_forms_get_saved_form( $user_id, $form_id, true );
	$form_row = ninja_forms_get_form_by_id( $form_id );
	$form_data = $form_row['data'];
	if( isset( $form_data['save_delete'] ) ){
		$delete = $form_data['save_delete'];
	}else{
		$delete = 0;
	}
	//echo "<pre>";
	//print_r( $sub_results );
	//echo "</pre>";

	$plugin_settings = get_option( 'ninja_forms_settings' );
	$date_format = $plugin_settings['date_format'];

	$cols_array = array();

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else if( is_object( $ninja_forms_processing ) ){
		$save_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
	}else{
		$save_id = '';
	}

	if( is_array( $sub_results ) AND !empty( $sub_results ) ){

		if( is_array( $cols ) AND !empty( $cols ) ){
			foreach( $cols as $field_id ){
				$field_row = ninja_forms_get_field_by_id( $field_id );
				$field_data = $field_row['data'];
				if( isset( $field_data['label'] ) ){
					$cols_array[] = $field_data['label'];
				}
			}
		}

		if( $url == '' ){
			?>
			<h4><?php _e( 'Continue a saved form', 'ninja-forms-save-progress' );?></h4>
			<?php
		}
		?>
		
		<table>
			<thead>
				<tr>
					<?php
					if( $delete == 1 ){
						?>
						<th></th>
						<?php
					}
					?>
					<th><?php _e( 'Date Updated', 'ninja-forms-save-progress' );?></th>
					<?php
					if( is_array( $cols_array ) AND !empty( $cols_array ) ){
						foreach( $cols_array as $label ){
							?>
							<th><?php echo $label;?></th>
							<?php
						}
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				if( is_array( $sub_results ) AND !empty( $sub_results ) ){
					foreach( $sub_results as $sub ){
						if( $save_id == $sub['id'] ){
							$tr_class = 'ninja-forms-save-active';
							$active = true;
						}else{
							$tr_class = 'ninja-forms-save-inactive';
							$active = false;
						}
						if( $url == '' ){
							$edit_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'edit_save' ) );
							$delete_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'delete_save' ) );
						}else{
							$edit_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'edit_save' ), $url );
							$delete_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'delete_save' ), $url );
						}
						?>
						<tr class="<?php echo $tr_class;?>">
							<?php
							if( $delete == 1 ){
							?>
							<td>
								<a href="<?php echo $delete_url;?>" class="ninja-forms-save-progress-delete-sub"><?php _e( 'Delete', 'ninja-forms-save-progress' );?></a>
							</td>			
							<?php
							}
							?>				
							<td>
								<?php
								if( !$active ){ 
									?>
									<a href="<?php echo $edit_url;?>#ninja_forms_form_<?php echo $form_id;?>">
									<?php 
								}
								$date_updated = $sub['date_updated'];
								$date_updated = strtotime( $date_updated );
								$date_updated = date( $date_format, $date_updated );
								echo $date_updated;
								if( !$active ){ ?>
									</a>
								<?php
								} 
								?>
							</td>

							<?php
							if( is_array( $cols ) AND !empty( $cols ) ){
								foreach( $cols as $field_id ){
									foreach( $sub['data'] as $data ){
										if( $data['field_id'] == $field_id ){
											?>
											<td>
												<?php
												if( !$active ){ 
													?>
													<a href="<?php echo $edit_url;?>#ninja_forms_form_<?php echo $form_id;?>">
													<?php 
												} 
												echo $data['user_value'];
													if( !$active ){ ?>
														</a>
													<?php
													} 
												?>
											</td>
											<?php									
										}
									}
								}
							}
							?>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
		<?php
	}
}