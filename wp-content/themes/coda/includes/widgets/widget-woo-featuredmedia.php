<?php
/*---------------------------------------------------------------------------------*/
/* Featured Media Widget */
/*---------------------------------------------------------------------------------*/

class Woo_FeaturedMedia extends WP_Widget {

	function Woo_FeaturedMedia() {
		$widget_ops = array('description' => 'Display a list of media-related posts.' );
		parent::WP_Widget(false, __('Woo - Featured Media (Homepage)', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		$title = $instance['title'];
		$numposts = $instance['numposts'];
		$featuredvideo = $instance['featuredvideo'];
		$featuredimages = $instance['featuredimages'];
		$featuredaudio = $instance['featuredaudio'];
		
        ?><div class="featuredmedia-widget widget"><?php
			if($title != '') {
			?><h3><?php _e($title,'woothemes'); ?></h3><?php
			}
			if(isset($numposts)) {
			} else {
				$numposts = 3;
			} 
			if(isset($featuredvideo)) {
				$tags .= $featuredvideo;
			}
			if(isset($featuredimages)) {
				$tags .= ','.$featuredimages;
			} 
			if(isset($featuredaudio)) {
				$tags .= ','.$featuredaudio;
			} ?>
			<div class="outer">
				<div class="inner">	
		
       				<ul class="pagination">
 					<?php query_posts('tag='.$tags.'&orderby=date&order=DESC&showposts='.$numposts);?>
					<?php while (have_posts()) : the_post();  $GLOBALS['shownposts'][$count] = $post->ID; $count++; ?>
            			<li>
							<div class="fl">
								<?php 
								$posttags = get_the_tags();
								foreach ($posttags as $posttag) {
									if ($posttag) {
										if (strtolower($posttag->name) == strtolower($featuredvideo)) {
										?><img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico-video.png" alt="video" title="Video" /><?php 
										} elseif (strtolower($posttag->name) == strtolower($featuredimages)) {
										?><img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico-photo.png" alt="image" title="Image" /><?php 
										} elseif (strtolower($posttag->name) == strtolower($featuredaudio)) {
										?><img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico-audio.png" alt="audio" title="Audio" /><?php 
										} else {
										}
									}
								}
								?>
							</div>
							<div class="fr" id="media">
	                    		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
	                    		<span class="meta"><?php _e('Posted on ','woothemes'); ?><?php the_time(get_option('date_format')); ?></span>
	                    		<span class="comments"><?php comments_popup_link(__('0 comments', 'woothemes'), __('1 comment', 'woothemes'), __('% comments', 'woothemes')); ?></span>
                    		</div>
                			<div style="clear:both"></div>
           				</li>
          			<?php endwhile; ?>      
        			</ul>      
				</div>
			</div>
		</div><?php
	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$numposts = esc_attr($instance['numposts']);
		$featuredvideo = esc_attr($instance['featuredvideo']);
		$featuredimages = esc_attr($instance['featuredimages']);
		$featuredaudio = esc_attr($instance['featuredaudio']);
		
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
            <label for="<?php echo $this->get_field_id('featuredvideo'); ?>"><?php _e('Videos Tag:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('featuredvideo'); ?>" value="<?php echo $featuredvideo; ?>" class="widefat" id="<?php echo $this->get_field_id('featuredvideo'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('featuredimages'); ?>"><?php _e('Images Tag:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('featuredimages'); ?>" value="<?php echo $featuredimages; ?>" class="widefat" id="<?php echo $this->get_field_id('featuredimages'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('featuredaudio'); ?>"><?php _e('Audio Tag:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('featuredaudio'); ?>" value="<?php echo $featuredaudio; ?>" class="widefat" id="<?php echo $this->get_field_id('featuredaudio'); ?>" />
        </p>
        <?php
	}
} 

register_widget('Woo_FeaturedMedia');
?>