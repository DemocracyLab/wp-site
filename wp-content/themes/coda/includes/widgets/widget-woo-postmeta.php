<?php
/*---------------------------------------------------------------------------------*/
/* Post Meta widget */
/*---------------------------------------------------------------------------------*/
class Woo_Post_Meta extends WP_Widget {

   function Woo_Post_Meta() {
	   $widget_ops = array('description' => 'This is a WooThemes Post Meta widget for single posts only.' );
       parent::WP_Widget(false, __('Woo - Post Meta', 'woothemes'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
	?>
	
	<?php if ( is_single() ) { ?>
		<?php echo $before_widget; ?>
        <div>
        
        	<div id="dim"> 
		<div class="msgbox"> 
			<a class="close" href="#" ><img src="<?php bloginfo('template_directory'); ?>/images/dim/close.jpg"/></a>
 			<div class="social">
 				<h3>Share this article</h3>
		<ul>
	<li class="twitter"><a href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>"><?php _e('Tweet this', 'woothemes') ?></a></li>
	<li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('Share on facebook', 'woothemes') ?></a></li>
	<li class="delicious"><a href="http://delicious.com/post?url=<?php the_permalink();?>&title=<?php the_title();?>"><?php _e('Add to delicious', 'woothemes') ?></a></li>
	<li class="digg"><a href="http://www.digg.com/submit?phase=2&url=<?php the_permalink();?>"><?php _e('Digg it!', 'woothemes') ?></a></li>
	<li class="stumble"><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><?php _e('Stumble upon it', 'woothemes') ?></a></li>
		</ul>
 			</div>

		</div> 
	</div>
	
	<h3><?php _e('Post Meta', 'woothemes') ?></h3>
	
	<div id="post-meta">
	<ul>
	<li class="share"><a class="alert" href="#" ><?php _e('Share with friends', 'woothemes') ?></a></span></li>
	<li class="print"><a href="javascript:window.print()"><?php _e('Print this article', 'woothemes') ?></a></span></li>
	<li class="vote-lg"><?php if(function_exists(getILikeThis)) getILikeThis('get'); ?></span></li>
	</ul>
	</div>
	
        </div>
		<?php echo $after_widget; ?> 
	<?php } ?>	
		  
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       ?>
       <p>There are no options for this widget.</p>
      <?php
   }
} 

register_widget('Woo_Post_Meta');
?>