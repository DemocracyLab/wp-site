<?php
/*-----------------------------------------------------------------------------------

- Loads all the .php files found in /includes/widgets/ directory

----------------------------------------------------------------------------------- */

include( TEMPLATEPATH . '/includes/widgets/widget-woo-adspace.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-blogauthor.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-flickr.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-search.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-twitter.php' );	
include( TEMPLATEPATH . '/includes/widgets/widget-woo-accordion.php' );	
include( TEMPLATEPATH . '/includes/widgets/widget-woo-featuredmedia.php' );	
include( TEMPLATEPATH . '/includes/widgets/widget-woo-postmeta.php' );	
include( TEMPLATEPATH . '/includes/widgets/widget-woo-recentposts.php' );	

	
/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
function woo_deregister_widgets(){
    unregister_widget('WP_Widget_Search');         
}
add_action('widgets_init', 'woo_deregister_widgets');  


?>