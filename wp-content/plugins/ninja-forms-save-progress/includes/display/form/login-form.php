<?php
/**
 * Outputs the HTML for the login form.
 *
**/
add_action('init', 'ninja_forms_register_display_user_login');
function ninja_forms_register_display_user_login(){
	add_action('ninja_forms_display_before_fields', 'ninja_forms_display_user_login');
}

function ninja_forms_display_user_login($form_id){
	global $ninja_forms_processing;

	$plugin_settings = get_option('ninja_forms_settings');
	$reset_password = $plugin_settings['reset_password'];
	$register_link = $plugin_settings['register_link'];
	$username_label = $plugin_settings['username_label'];
	$password_label = $plugin_settings['password_label'];
	$login_button_label = $plugin_settings['login_button_label'];
	$cancel_button_label = $plugin_settings['cancel_button_label'];

	if(!is_user_logged_in()){
		if(isset($_POST['_ninja_forms_login_log'])){
			$login = $_POST['_ninja_forms_login_log'];
		}else{
			$login = '';
		}
		$display = "display:none;";
		$error_msg = '';
		if( is_object( $ninja_forms_processing) AND $ninja_forms_processing->get_error('_login_password')){
			$error_msg = $ninja_forms_processing->get_error('_login_password');
			$error_msg = $error_msg['msg'];
			$display = '';
		}else{
			$error_msg = '';
		}
	?>
	<div id="ninja_forms_form_<?php echo $form_id;?>_login_form" class="" style="<?php echo $display;?>">
		<?php _e($username_label, 'ninja-forms');?>: <input type="text" name="_ninja_forms_login_log" class="ninja-forms-login" value="<?php echo $login;?>">
		<?php _e($password_label, 'ninja-forms');?>: <input type="password" name="_ninja_forms_login_password" class="ninja-forms-login">
		<div id="ninja_forms_field_password_error">
			<?php
				echo $error_msg;
			?>
		</div>
		<div>
			<a href="<?php echo site_url('wp-login.php?action=lostpassword');?>" target="_blank" id="" class=""><?php echo $reset_password;?></a>
		</div>		
		<input type="submit" name="_ninja_forms_wp_login" value="<?php _e($login_button_label, 'ninja-forms');?>"> <input type="button" onclick="javascript:ninja_forms_toggle_login_register('login', <?php echo $form_id;?>);" id="ninja_forms_form_<?php echo $form_id;?>_hide_login" class="ninja-forms-display-hide-login" value="<?php _e($cancel_button_label, 'ninja-forms');?>">
	</div>
	<?php
	}
}