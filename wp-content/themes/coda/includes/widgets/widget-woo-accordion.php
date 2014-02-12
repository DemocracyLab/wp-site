<?php
/*---------------------------------------------------------------------------------*/
/* Accordion widget */
/*---------------------------------------------------------------------------------*/

class Woo_Accordion extends WP_Widget {

   function Woo_Accordion() {
  	   $widget_ops = array('description' => 'This widget is the Homepage Accordion widget. It contains the Popular posts, Latest Posts and Recent Comments.' );
       parent::WP_Widget(false, $name = __('Woo - Accordion (Homepage)', 'woothemes'), $widget_ops);    
   }


   function widget($args, $instance) {        
       extract( $args );
       
       $number = $instance['number']; if ($number == '') $number = 5;
       $thumb_size = $instance['thumb_size']; if ($thumb_size == '') $thumb_size = 35;
       ?>  

 		<div id="accordion">
            
			<h3 class="toggle"><?php _e('Latest Posts', 'woothemes'); ?></h3>
				
				<ul>                            
                    <?php if ( function_exists('woo_tabs_latest') ) woo_tabs_latest($number, $thumb_size); ?> 
                    	                   
                </ul>
                
			<h3 class="toggle"><?php _e('Popular Posts', 'woothemes'); ?></h3>
				
				<ul>                            
                    <?php if ( function_exists('woo_tabs_popular') ) woo_tabs_popular($number, $thumb_size); ?>                    
                    	                   
                </ul>
                
			<h3 class="toggle"><?php _e('Recent Comments', 'woothemes'); ?></h3>
				
				<ul>                            
                    <?php if ( function_exists('woo_tabs_comments') ) woo_tabs_comments($number, $thumb_size); ?>                    
                    	                   
                </ul>                                
 
               			
        </div><!-- /Accordion -->
    
         <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {                
       $number = esc_attr($instance['number']);
       $thumb_size = esc_attr($instance['thumb_size']);
	   
       ?>    
       <p>
       <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:','woothemes'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
       </label>
       </p>  
       <p>
       <label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Thumbnail Size (0=disable):','woothemes'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>" type="text" value="<?php echo $thumb_size; ?>" />
       </label>
       </p>  
       <?php 
   }

} 
register_widget('Woo_Accordion');
?>