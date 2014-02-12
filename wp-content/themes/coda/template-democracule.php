<?php
/*
Template Name: Democracule Template
*/
?>

<?php get_header(); ?>
       
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
		
			<div id='democraDiv'>
	
				<!--within the democraDiv are the images named for the biggest circle-->
				<div class='imgDiv' id='d-offImg'><img src='http://democracylab.org/wp-content/themes/coda/images/off.jpg'/></div>
				<div class='imgDiv' id='d-topImg'><img src='http://democracylab.org/wp-content/themes/coda/images/top.jpg'/></div>
				<div class='imgDiv' id='d-rightImg'><img src='http://democracylab.org/wp-content/themes/coda/images/right.jpg'/></div>
				<div class='imgDiv' id='d-leftImg'><img src='http://democracylab.org/wp-content/themes/coda/images/left.jpg'/></div>
				<div class='imgDiv' id='d-centerImg'><img src='http://democracylab.org/wp-content/themes/coda/images/center.jpg'/></div>
				
				<a href='http://democracylab.org/welcome-to-democracylab/citizens-workshop/'>
					<div class='triggerDiv' id='d-top' ></div>
				</a>
				<a href='http://democracylab.org/welcome-to-democracylab/donors-gift-shop/'>
					<div class='triggerDiv' id='d-right'></div>
				</a>
				<a href=' http://democracylab.org/welcome-to-democracylab/creators-commons/'>
					<div class='triggerDiv' id='d-left'></div>
				</a>
				<a href='http://democracylab.org/welcome-to-democracylab/project-portfolio/'>
					<div class='triggerDiv' id='d-center'></div>
				</a>
			</div>		           
           
		</div><!-- /#main -->
		<?php get_sidebar(); ?>
    </div><!-- /#content -->	
<?php get_footer(); ?>