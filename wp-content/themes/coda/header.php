<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/effects.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS['feedurl'] = get_option('woo_feed_url'); if ( !empty($feedurl) ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
      
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );  ?>
<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php woo_top(); ?>

<div id="wrapper">
	<div id="top">
        <div class="col-full">   
	<div id="header">
 		       
		<div id="logo">
	       
		<?php if (get_option('woo_texttitle') <> "true") : $logo = get_option('woo_logo'); ?>
            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
                <img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
            </a>
        <?php endif; ?> 
        
        <?php if( is_singular() ) : ?>
            <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
        <?php else : ?>
            <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>
            <span class="site-description"><?php bloginfo('description'); ?></span>
	      	
		</div><!-- /#logo -->

                    <div id="search" class="fr">
                        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
                            <input type="text" class="field" name="s" id="s"  value="<?php _e('Enter keywords...', 'woothemes') ?>" onfocus="if (this.value == '<?php _e('Enter keywords...', 'woothemes') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter keywords...', 'woothemes') ?>';}" />
                            <input class="submit btn" type="image" src="<?php bloginfo('template_directory'); ?>/images/ico-search.png" value="Go" />
                        </form>
                    </div><!-- /#search -->
       
	</div><!-- /#header -->
    
	<div id="navigation" class="col-full">
		    <?php
   			if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
   				wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'nav fl', 'menu_id' => 'main-nav' , 'theme_location' => 'primary-menu' ) );
    		} else {
    		?>
        <ul id="main-nav" class="nav fl">
			<?php 
        	if ( get_option('woo_custom_nav_menu') == 'true' ) {
        		if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output();

			} else { ?>
            	
	            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
	            <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>
	            <?php 
	    		if ( get_option('woo_cat_menu') == 'true' ) 
	    			wp_list_categories('sort_column=menu_order&depth=6&title_li=&exclude='.get_option('woo_nav_exclude')); 
	    		else
	    			wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude='.get_option('woo_nav_exclude')); 

			}
			?>
        </ul><!-- /#nav -->
        <?php } ?>
        <!--<ul class="rss fr">
            <?php $email = get_option('woo_subscribe_email'); if ( $email ) { ?>
            <li class="sub-email"><a href="<?php echo $email; ?>" target="_blank"><?php _e('Subcribe by Email', 'woothemes') ?></a></li>
            <?php } ?>
            <li class="sub-rss"><a href="<?php if ( $GLOBALS[feedurl] ) { echo $GLOBALS[feedurl]; } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('Subscribe to RSS feed', 'woothemes') ?></a></li>-->
        </ul>
        
	</div><!-- /#navigation -->
       </div>
       </div>