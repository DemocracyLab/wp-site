<?php
/*---------------------------------------------------------------------------------*/
/* Recent Blog Posts Widget */
/*---------------------------------------------------------------------------------*/

class Woo_RecentBlogPosts extends WP_Widget {

	function Woo_RecentBlogPosts() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'recentblogposts-widget', 'description' => __('Use this widget to add your most recent blog posts as a widget.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'recentblogposts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'recentblogposts-widget', __('Woo - Recent Blog Posts (Homepage)', 'woothemes' ), $widget_ops, $control_ops );     
	
	} // End Woo_RecentBlogPosts()

	function widget( $args, $instance ) {
		extract( $args );	
		
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		$numposts = $instance['numposts']; if ( !isset( $numposts ) ) { $numposts = 3; }
		$blogcategory = $instance['blogcategory'];
		$image = $instance['image']; if ( $image == '' ) { $image = 60; }

		/* Before widget (defined by themes). */
			echo $before_widget;
	
			/* Display the widget title if one was input (before and after defined by themes). */
			if ( $title ) {
			
				echo $before_title . $title . $after_title;
			
			} // End IF Statement
			
			/* Widget content. */
			
			// Add actions for plugins/themes to hook onto.
			do_action( 'widget_woo_recentblogposts_top' );

?>
	<div class="outer">
		<div class="inner">	
				<ul class="pagination">
				<?php
					$posts_to_display = array();
					$categories = array();
					
					$category_id = $blogcategory;
					
					// Backwards compatibility.
					if ( ! is_numeric( $category_id ) ) { $category_id = get_cat_ID( $blogcategory ); }
					
					$categories[] = $category_id;
					
					// Get subcategories and search through them as well.
					$subcategories = get_categories( 'child_of=' . $category_id );
					
					if ( count( $subcategories ) ) {
						foreach ( $subcategories as $s ) {
							$categories[] = $s->cat_ID;
						}	
					}
					
					// First, get the sticky posts and display them only if they're in the category.
					
					$sticky = get_option( 'sticky_posts' );
				
				if ( $sticky ) {
					
					$args = array(
									'post__in' => $sticky, 
									'category__in' => $categories, 
									'showposts' => $numposts
								);
					
					query_posts( $args );

					if ( have_posts() ) {
						$counter = 0;
						while ( have_posts() && $counter < $numposts ) {
							the_post();
							
							$posts_to_display[] = get_post( get_the_ID(), OBJECT );
							
							$counter++;
						}
					}
					
					// Update the post count to fill in only the remaining slots.
					
					$numposts = $numposts - count( $posts_to_display );
					
					if ( $numposts < 0 ) { $numposts = 0; }
					
					wp_reset_query();
				
				} // End IF ( $sticky ) IF Statement
				
				if ( $numposts ) {

					// Then, get the remaining posts in the category to fill the missing gaps.
					
					$args = array(
									'orderby' => 'date', 
									'order' => 'DESC', 
									'showposts' => $numposts, 
									'ignore_sticky_posts' => 1, 
									'post__not_in' => $sticky, 
									'post_status' => 'publish'
								);
								
					if ( is_array( $categories ) ) { $args['category__in'] = $categories; }
					
					query_posts( $args );
					
					if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						
						$posts_to_display[] = get_post( get_the_ID(), OBJECT );
					}
					}
				} // End IF Statement
				
				wp_reset_query();
				?>
				<?php
					$count = 0;
					
					if ( count( $posts_to_display ) ) {
						global $post;
						$tmp_post = $post;
					
						foreach ( $posts_to_display as $post ) {
							setup_postdata( $post );
							$GLOBALS['shownposts'][$count] = $post->ID; $count++;
				?>
					<li>                
            		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php  if ( $image <> 0 ) woo_image('height='.$image.'&width='.$image.'&class=alignright'); ?>
					<div class="entry">
						<?php the_excerpt(); ?>
					</div><!-- /.entry -->
            		<span class="meta"><?php _e( 'Posted on ','woothemes' ); ?><?php the_time( get_option( 'date_format' ) ); ?></span>
       				<span class="comments"><?php comments_popup_link( __( '0 comments', 'woothemes' ), __( '1 comment', 'woothemes' ), __( '% comments', 'woothemes' ) ); ?></span>
       				<span><?php if( function_exists( 'getILikeThis' ) ) getILikeThis( 'get' ); ?></span>
        			<div style="clear:both"></div>
   				</li>
				<?php
						}
					
						$post = $tmp_post;
					}
				?>    
			</ul>      
		</div>
		<?php if ($category_id != "Select a category:") { ?>
		<ul class="pagination-bottom">
			<li>
			<a href="<?php echo get_category_link($category_id); ?>"><?php _e('View more posts','woothemes'); ?></a>
			</li>
		</ul>
		<?php } ?>
	</div>
<?php
			
			// Add actions for plugins/themes to hook onto.
			do_action( 'widget_woo_recentblogposts_bottom' );
	
			/* After widget (defined by themes). */
			echo $after_widget;
		
	} // End widget()

	/*----------------------------------------
	  update()
	  ----------------------------------------
	  
	  * Function to update the settings from
	  * the form() function.
	  
	  * Params:
	  * - Array $new_instance
	  * - Array $old_instance
	----------------------------------------*/

	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numposts'] = $new_instance['numposts'];
		$instance['blogcategory'] = $new_instance['blogcategory'];
		$instance['image'] = $new_instance['image'];

		return $instance;
		
	} // End update()

	/*----------------------------------------
	  form()
	  ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

	function form ( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Recent Blog Posts', 'woothemes' ), 'numposts' => 3, 'image' => 60 );
		$instance = wp_parse_args( (array) $instance, $defaults );
	       
		$title = esc_attr($instance['title']);
		$numposts = esc_attr($instance['numposts']);
		$blogcategory = esc_attr($instance['blogcategory']);
		$image = esc_attr($instance['image']);

		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('numposts'); ?>"><?php _e('Number of Posts:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('numposts'); ?>" value="<?php echo $numposts; ?>" class="widefat" id="<?php echo $this->get_field_id('numposts'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('blogcategory'); ?>"><?php _e('Blog Category:','woothemes'); ?></label>
            <?php
            	$args = array(
						    'show_option_all'    => false,
						    'orderby'            => 'ID', 
						    'order'              => 'ASC',
						    'show_last_update'   => 0,
						    'show_count'         => 0,
						    'hide_empty'         => 1, 
						    'child_of'           => 0,
						    'exclude'            => '',
						    'echo'               => 1,
						    'selected'           => $blogcategory,
						    'hierarchical'       => 1, 
						    'name'               => $this->get_field_name( 'blogcategory' ),
						    'id'                 => $this->get_field_id( 'blogcategory' ),
						    'class'              => 'postform',
						    'depth'              => 0,
						    'tab_index'          => 0,
						    'taxonomy'           => 'category',
						    'hide_if_empty'      => false
						   );
            	wp_dropdown_categories( $args );
            ?>
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Size (0 to disable):','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        
        <?php
	} // End form()

} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_RecentBlogPosts");' ), 1 );
?>