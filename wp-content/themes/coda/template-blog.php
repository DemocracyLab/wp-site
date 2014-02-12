<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
        <?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
        <?php query_posts("post_type=post&paged=$paged"); ?>
		<?php if (have_posts()) : $count = 0; ?>                
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div class="post">

                <h1 class="title" id="archive"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                    
                    <p class="post-meta">
                    	<span class="small"><?php _e('Posted by', 'woothemes') ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span>
                    	<span class="small"><?php _e('on', 'woothemes') ?></span> <span class="post-date"><?php the_time(get_option('date_format')); ?></span>
                    	<span class="small"><?php _e('in', 'woothemes') ?></span> <span class="post-category"><?php the_category(', ') ?></span>
                        <span class="comments"><?php comments_popup_link(__('0 comments', 'woothemes'), __('1 comment', 'woothemes'), __('% comments', 'woothemes')); ?></span>
                    </p>

<?php woo_image('width='.$woo_options['woo_thumb_w'].'&height='.$woo_options['woo_thumb_h'].'&class=thumbnail '.$woo_options['woo_thumb_align']); ?>
                
                <div class="entry">
                        <?php if ( get_option('woo_post_content_archives') == "true" ) { the_content(); } else { the_excerpt(); } ?>
                </div><!-- /.entry -->
                
                        <div class="clear"></div>

                <div class="post-more"></div>                                                                  

            </div><!-- /.post -->
            
        <?php endwhile; else: ?>
            <div class="post">
                <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>