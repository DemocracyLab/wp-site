<?php
/**
 * Template Name: Democracule Template
 *
 * Description: democracyLab's Home Page with Democracule and Survey. 
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class='title'><span class='responseSpan'>100%</span> of responses agree that today's political systems are inadequate to solve society's biggest problems.</div>
			<div class='responseDiv'><span id='responseMsg'>What do you think?</span>
				<span>
					<button class='responseButton agree'  value='1'>agree</button>
				</span>
				<span>
					<button class='responseButton disagree' value='0'>disagree</button>
				</span>
			</div>
			<div id="einstein"  class='container'>
				<div class="circleImg">Albert Einstein</div>
					<div id="einsteinTxt">
						<p>
							Albert Einstein once said,
						</p> 
						<blockquote>
							The significant problems we face today cannot be solved at the same level of thinking we were at when we created them.
						</blockquote>
						<p>
							We agree, and have accepted the challenge of creating the new levels of thinking that will be required to solve the significant problems that surround us. Our hypothesis is that we can collaboratively construct online civic engagement systems that will productively focus our collective intelligence.
						</p>
					</div>
			</div>
			<div id = 'democro'>

					<div id='democracule-div'>
						<div id='demImg'>
							<img src='http://democracylab.org/wp-content/themes/democracylab/images/democracule-2.jpg'/>
						</div>
						<div id='citDiv' class='democRing'>
							<div class='democTxt'>Discuss</div>
							<div class='demDesc'>Join the conversation about the essential ingredients to civic tech apps.</div>
						</div>
						<div id='proDiv' class='democRing'>
							<div class='democTxt'>Projects</div>
							<div class='demDesc'>Find info and analysis of the civic tech apps participating in our project.</div>
						</div>
						<div id='creDiv' class='democRing'>
							<div class='democTxt'>Develop</div>
							<div class='demDesc'>Help define technical specifications for civic engagement.</div>

						</div>
						<div id='donDiv' class='democRing'>
							<div class='democTxt'>Donate</div>
							<div class='demDesc'>Choose a project and pledge your support.</div>

					        </div>
					</div>
					<div class='container'>
						<div class='homeTxt'>
							<p>
							We'll know we're successful if our work results in measurable real-world improvements in communities that adopt our tools.  We've come to understand that the difference between science and experience is documentation, and believe an important purpose of this website is to document the methods and results of our group's experiments.
							</p>
							<p>
							The popular term for what we're doing is crowdsourcing. But instead of building an encyclopedia, we're developing tools to help communities work through the lifecycle of problems that affect them.  
							</p>
							<p>
							Our mission statement is centered around this objective: 
							</p>
						</div>
					</div>
					<div class='lastTxt'>
						<blockquote>
						Create open source software tools to help communities identify problems, construct solutions, make decisions, and take collaborative action.
						</blockquote>
						<p>
							Turns out, this isn't easy.  It's going to take time, talent, and resources to make our vision a reality.  We've designed the interactive feature of our website - our Democracule, around the needs of our members.  There are four nodes of the Democracule:
							<ul>
								<li>
									Discuss: analysis and insight about the common elements of civic tech applications.
								</li>
								<li>
									Browse: the place to explore the civic tech applications participating in our project.
								</li>
								<li>
									Donate: resources are pledged and allocated, results are documented.
								</li>
								<li>
									Develop: theory turns into action; plans are made, executed, and evaluated.

								</li>
							</ul>
							We're "building our bicycle while riding it", so please forgive our dust and feel free to suggest improvements. If you're a software developer comfortable in WordPress, feel free to play with our code at GitHub. Don't forget to click the join button to become part of our community. And make sure to check out our interview series with elected leaders and civic engagement pros. Welcome to DemocracyLab! Thank you for being here.
						</p>						
					</div>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>