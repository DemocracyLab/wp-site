<?php get_header(); ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">      
                    
		<?php $showfeatured = get_option('woo_featured'); if ($showfeatured <> "true") { if (get_option('woo_exclude')) update_option("woo_exclude", ""); } ?>
		<?php if ( !$paged && $showfeatured == "true" ) include ( TEMPLATEPATH . '/includes/featured.php' ); ?> 

			<?php   
			// Exclude stored duplicates 
			$exclude = get_option('woo_exclude'); 
			// Exclude categories
			//$cat_exclude = array();
			$cats = explode(',',get_option('woo_home_exclude')); 
			foreach ($cats as $cat)
			  $cat_exclude[] = $cat;			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
			$args = array(	'post__not_in' => $exclude, 
							'category__not_in' => $cat_exclude,
							'paged'=> $paged ); 
			query_posts($args);			
			?>
			
			<?php $count = 0; ?>
                  
		<div id="home-widgets">
		
			<div class="left">
			
				<?php woo_sidebar('home-left'); ?>
			
			</div><!-- /.left -->
			
			<div class="right">
			
				<?php woo_sidebar('home-right'); ?>
			
			</div><!-- /.right -->
			
			<div class="clear"></div>

		</div>

                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>