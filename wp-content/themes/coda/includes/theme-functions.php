<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Set Global Variables
- Read More Link
- Page / Post navigation
- WooTabs - Popular Posts
- WooTabs - Latest Posts
- WooTabs - Latest Comments
- Misc
- WordPress 3.0 New Features Support

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Read More Link */
/*-----------------------------------------------------------------------------------*/
function replace_excerpt($content) {
       return str_replace('[...]',
               '<a href="'. get_permalink() .'" class="more">&nbsp;Read more &raquo;</a>',
               $content
       );
}
add_filter('the_excerpt', 'replace_excerpt');

/*-----------------------------------------------------------------------------------*/
/* Set Global Variables */
/*-----------------------------------------------------------------------------------*/
// Featured Tags
	$GLOBALS['feat_tags_array'] = array();
// Duplicate posts 
	$GLOBALS['shownposts'] = array();

// Featured dimensions
	$GLOBALS['width_feat'] = '700'; if (get_option('woo_width_feat')) $GLOBALS['width_feat'] = get_option('woo_width_feat'); 		
	$GLOBALS['height_feat'] = '320'; if (get_option('woo_height_feat')) $GLOBALS['height_feat'] = get_option('woo_height_feat'); 

// Shorten Excerpt text for use in theme
function woo_excerpt($text, $chars = 120) {
	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text."...";
	return $text;
}

/*-----------------------------------------------------------------------------------*/
/* Page / Post navigation */
/*-----------------------------------------------------------------------------------*/
function woo_pagenav() { 

	if (function_exists('wp_pagenavi') ) { ?>
    
<?php wp_pagenavi(); ?>
    
	<?php } else { ?>    
    
		<?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
        
            <div class="nav-entries">
                <div class="nav-prev fl"><?php previous_posts_link(__('&laquo; Newer Entries ', 'woothemes')) ?></div>
                <div class="nav-next fr"><?php next_posts_link(__(' Older Entries &raquo;', 'woothemes')) ?></div>
                <div class="fix"></div>
            </div>	
        
		<?php } ?>
    
	<?php }   
}                	

function woo_postnav() { 

	?>
        <div class="post-entries">
            <div class="post-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
            <div class="post-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
            <div class="fix"></div>
        </div>	

	<?php 
}                	



/*-----------------------------------------------------------------------------------*/
/* WooTabs - Popular Posts */
/*-----------------------------------------------------------------------------------*/

function woo_tabs_popular( $posts = 5, $size = 35 ) {
	$popular = new WP_Query('orderby=comment_count&posts_per_page='.$posts);
	while ($popular->have_posts()) : $popular->the_post();
?>
<li>
	<?php if ($size <> 0) woo_get_image('image',$size,$size,'thumbnail',90,null,'src',1,0,'','',true,false,false); ?>
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/>
	<span class="meta"><?php the_time(get_option('date_format')); ?></span>
	<div class="fix"></div>
</li>
<?php endwhile; 
}



/*-----------------------------------------------------------------------------------*/
/* WooTabs - Latest Posts */
/*-----------------------------------------------------------------------------------*/

function woo_tabs_latest( $posts = 5, $size = 35 ) {
	$the_query = new WP_Query('showposts='. $posts .'&orderby=post_date&order=desc');	
	while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li>
	<?php if ($size <> 0) woo_get_image('image',$size,$size,'thumbnail',90,null,'src',1,0,'','',true,false,false); ?>
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/>
	<span class="meta"><?php the_time(get_option('date_format')); ?></span>
	<div class="fix"></div></li>
<?php endwhile; 
}



/*-----------------------------------------------------------------------------------*/
/* WooTabs - Latest Comments */
/*-----------------------------------------------------------------------------------*/

function woo_tabs_comments( $posts = 5, $size = 35 ) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,50) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT ".$posts;
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	?>
	<li>
		<?php echo get_avatar( $comment, $size ); ?>
	<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'woothemes'); ?> <?php echo $comment->post_title; ?><br/>
		<a class="rec-com" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'woothemes'); ?> <?php echo $comment->post_title; ?>">
			<?php echo strip_tags($comment->com_excerpt); ?>...
		</a>
		<div class="fix"></div>
	</li>
	<?php 
	}
}



/*-----------------------------------------------------------------------------------*/
/* MISC */
/*-----------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu' ) ) );
}
    
    
?>