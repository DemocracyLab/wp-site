<?php
/*---------------------------------------------------------------------------------*/
/* Live Twitter widget */
/*---------------------------------------------------------------------------------*/
class Woo_Twitter extends WP_Widget {

   function Woo_Twitter() {
	   $widget_ops = array('description' => 'Add a Live Twitter feed to your sidebar with this widget.' );
       parent::WP_Widget(false, __('Woo - Live Twitter (Homepage)', 'woothemes'),$widget_ops);      
   }
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
    $limit = 1;
	$string = $instance['string'];
	$limit = $instance['limit'];
	$rate = $instance['rate'];
	$rate = $instance['rate'];
	$follow_link = $instance['follow_link'];
	$follow_text = $instance['follow_text'];
	
	$unique_id = $args['widget_id'];	
	
	if(empty($rate)) $rate = 15000;
	if(empty($limit)) $limit = 5;
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>
        		
        		<?php
			    if(!empty($string)){
			    $string_array = explode(",",$string);
			    ?>
				<div id="twitterSearch"> </div>
			    <script type="text/javascript">
			    jQuery(document).ready(function(){
				<?php
				foreach($string_array as $s){ ?>
			  		jQuery('#twitterSearch').liveTwitter('<?php echo $s; ?>', {limit: <?php echo $limit; ?>, rate:<?php echo $rate; ?>});
			  	<?php } ?>
			  	});
			   	</script>
			    <?php } ?>
			   
			   	<?php if(!empty($follow_text)) { ?>
			    <p class="link-ancillary"><a title="Follow us on Twitter" href="<?php echo $follow_link; ?>"><?php echo $follow_text; ?></a></p>
			    <?php } ?>
			    
        <?php echo $after_widget; ?>
        
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
	   $string = esc_attr($instance['string']);
	   $rate = esc_attr($instance['rate']);
	   $limit = esc_attr($instance['limit']);
	   $follow_text = esc_attr($instance['follow_text']);
	   $follow_link = esc_attr($instance['follow_link']);

       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('string'); ?>"><?php _e('Search String:','woothemes'); ?> <small><?php _e('(comma seperated)','woothemes'); ?></small></label>
	       <input type="text" name="<?php echo $this->get_field_name('string'); ?>"  value="<?php echo $string; ?>" class="widefat" id="<?php echo $this->get_field_id('string'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('rate'); ?>"><?php _e('Rate:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('rate'); ?>"  value="<?php echo $rate; ?>" class="widefat" id="<?php echo $this->get_field_id('rate'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('follow_link'); ?>"><?php _e('Follow Link:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('follow_link'); ?>"  value="<?php echo $follow_link; ?>" class="widefat" id="<?php echo $this->get_field_id('follow_link'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('follow_text'); ?>"><?php _e('Follow Text:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('follow_text'); ?>"  value="<?php echo $follow_text; ?>" class="widefat" id="<?php echo $this->get_field_id('follow_text'); ?>" />
       </p>
      <?php
   }
   
} 
register_widget('Woo_Twitter');
?>