    <div id="footer-outer">
    
		<div id="footer" class="col-full">
		
			<div id="copyright" class="col-left">
            <?php if(get_option('woo_footer_left') == 'true'){
            
                    echo stripslashes(get_option('woo_footer_left_text'));	
    
            } else { ?>
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
            <?php } ?>
			</div>
			
			<div id="credit" class="col-right">
            <?php if(get_option('woo_footer_right') == 'true'){
            
                echo stripslashes(get_option('woo_footer_right_text'));
            
            } else { ?>
				<p><?php _e('Powered by', 'woothemes') ?> <a href="http://www.wordpress.org">WordPress</a>. &nbsp;<?php _e('Designed by', 'woothemes') ?> <a href="http://www.woothemes.com"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
            <?php } ?>
			</div>
			
		</div><!-- /#footer  -->
	
	</div><!-- /#footer-outer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>