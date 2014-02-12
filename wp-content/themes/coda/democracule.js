/**
 * @author elemunjeli
 * for DemocracyLab at OSCON 2013
 * quick and dirty jquery using only the onboard libraries of the site
 */

		jQuery(document).ready(function($){
				
				/*I'm just into the object nowadays*/
				var trigDiv = $('.triggerDiv');
				
				/*the names of the triggerDivs*/
				var divNames = ['d-top', 'd-right', 'd-left', 'd-center'];
				 
				/*when we begin, all but off are hidden*/ 
				$('#d-topImg').hide();
				$("#d-rightImg").hide();
				$("#d-leftImg").hide();
				$("#d-centerImg").hide();
							
				trigDiv.mouseenter(function(){
					
					var triggered = $(this).attr('id');
					var posArr;
					
					switch(triggered){
						case 'd-top': 
							posArr = [[250, 5, 125], [65,420,374], [104,296,24], [128, 267,177]];
							break;
						case 'd-right':
							posArr = [[160,45,43],[255,238,240],[122,260,65],[144,37,305]];
							break;
						case 'd-left':
							posArr = [[91,103,27],[195,138,314],[280, 213,8],[135,44,163]];
							break;
						case 'd-center':
							posArr = [[105, 29, 17], [72, 112,433], [100, 390,33], [270, 136, 90]];
							break;
					
						
					}
					
					divChange(divNames, posArr);
					
					/*get the id of the triggerDiv and make it into the imgDiv id*/
					var triggeredImg = triggered + 'Img';
										
					/*hide all the triggerDivs except the one you rolled over*/
					if( $('.imgDiv').attr('id') != triggeredImg){
						$('.imgDiv').hide();
					}
					
					$('#' + triggeredImg).show();
	
												
				});
				
				$('#democraDiv').mouseleave( function(){
					
					$('.imgDiv').hide();	
					$('#d-offImg').show();
					divChange(divNames, [[150, 5, 175],[150, 340, 345], [150, 340, 5],[150,205, 175]]);
				});
				
				function divChange(divNames, divPos){
					
					for(var i = 0; i < divPos.length; i++){
						$('#'+ divNames[i]).css('width', divPos[i][0]).css('height',divPos[i][0]).css('top', divPos[i][1]).css('left', divPos[i][2]);
						
					}
					
				}
							
		});			
	