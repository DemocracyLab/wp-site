<?php
function bbg_debug_doc_trash( $new_status, $old_status, $post ) {
    if ( 'bp_doc' == $post->post_type && 'trash' == $new_status ) {
        global $wp_query;
        $v = array( $wp_query, $_SERVER );
        update_option( 'bbg_debug_doc_trash', json_encode( $v ) );
    }
}
add_action( 'transition_post_status', 'bbg_debug_doc_trash', 9999, 3 );