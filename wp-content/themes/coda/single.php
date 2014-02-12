<?php get_header(); ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
		           
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>

            <div <?php post_class(); ?>>

                    <?php if ( $woo_options['woo_thumb_single'] == "true" ) woo_image('width='.$woo_options['woo_single_w'].'&height='.$woo_options['woo_single_h'].'&class=thumbnail alignleft'); ?>

                    <h1 class="single-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                    
                    <p class="post-meta">
                    	<span class="small"><?php _e('Posted by', 'woothemes') ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span>
                    	<span class="small"><?php _e('on', 'woothemes') ?></span> <span class="post-date"><?php the_time(get_option('date_format')); ?></span>
                    	<span class="small"><?php _e('in', 'woothemes') ?></span> <span class="post-category"><?php the_category(', ') ?></span>
   	                    <?php edit_post_link( __('Edit', 'woothemes'), '<span class="small-edit">', '</span>' ); ?>
                    </p>


            <div class="fix"></div>

            </div>

	<div id="tabs">

	<?php $comm = get_option('woo_comments'); if ( 'open' == $post->comment_status && ($comm == "post" || $comm == "both") ) : ?>
			
		<ul class="wooTabs tabs">
			<li><a href="#article"><?php _e('Article',woothemes); ?></a></li>
			<li><a href="#discuss"><?php _e('Comments',woothemes); ?> <span>(<?php echo $post->comment_count ?>)</span></a></li>
		</ul>
		
		<div class="fix"></div>
		
	<?php endif; ?>
		
		<div class="inside">
		 				<div <?php post_class(); ?> id="article">
                    
                    <div class="entry" id="article">
                    	<?php the_content(); ?>
					</div>
										
					<?php the_tags('<p class="tags">Tags:&nbsp; ', ' ', '</p>'); ?>
                    
                </div><!-- /.post -->
           
                    <div id="discuss">
                
                <?php $comm = get_option('woo_comments'); if ( 'open' == $post->comment_status && ($comm == "post" || $comm == "both") ) : ?>
	                <?php comments_template('', true); ?>
                <?php endif; ?>
                                                    
			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
  				</div><!-- /.post -->             
           	<?php endif; ?>

            </div>
		
	</div><!-- INSIDE END -->
	
	</div><!-- TABS END -->
	
	<div class="fix" style="height:25px !important;"></div>
	
	<!-- TABS END -->
	
	<div class="fix"></div>  
        
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>