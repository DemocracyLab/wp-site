<?php
/**
 * Outputs the HTML for the resume form login/register link.
 *
**/
add_action('init', 'ninja_forms_register_display_resume_link');
function ninja_forms_register_display_resume_link(){
	add_action('ninja_forms_display_before_form_wrap', 'ninja_forms_display_resume_link');
}

function ninja_forms_display_resume_link($form_id){
	$form_row = ninja_forms_get_form_by_id($form_id);
	$form_data = $form_row['data'];
	if( isset( $form_data['save_progress'] ) ){
		$save_progress = $form_data['save_progress'];
	}else{
		$save_progress = 0;
	}
	if(!is_user_logged_in() AND $save_progress == 1){
		?>
		<div id="ninja_forms_form_<?php echo $form_id;?>_resume_link_wrap">
			<a href="javascript:ninja_forms_toggle_login_register('login', <?php echo $form_id;?>);" name="" id="">Login</a> or <a href="javascript:ninja_forms_toggle_login_register('register', <?php echo $form_id;?>);" name="" id="">Register</a> to save your progress or resume a saved form.
		</div>
		<?php
	}
}