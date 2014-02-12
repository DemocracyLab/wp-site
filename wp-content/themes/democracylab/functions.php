<?php


function add_my_scripts() {
	if(is_page_template('page-templates/template-democracule.php')){		
		wp_register_script( 'democracule', get_stylesheet_directory_uri() . '/js/democracule.js', array('jquery'));
		wp_enqueue_script('democracule');	
	}
	
}
add_action( 'wp_enqueue_scripts', 'add_my_scripts' );
remove_action( ‘bp_init’, ‘bp_core_load_buddybar_css’ );
/*trash bug*/

?>