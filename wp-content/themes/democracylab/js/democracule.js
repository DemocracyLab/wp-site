/**
 * @author elemunjeli
 * for DemocracyLab at OSCON 2013
 * quick and dirty jquery using only the onboard libraries of the site
 */

jQuery(document).ready(function($){
		//postback survey results
		var url = 'http://democracylab.org/wp-content/themes/democracylab/js/';
	    $.post(url + 'percent.php', {response : 3}, function(output){
					$('.responseSpan').html(output + '%');
		});
		
		//setup and hide descriptions on Democracule
	    $('.demDesc').hide();

								
		$('.democRing').mouseenter(function(){
			$('.democRing').not(this).hide();
			$('#demImg').hide();
			
			$(this).animate({width: '90%'}, {queue: false, duration: 500})
				   .animate({height: '90%'}, {queue: false, duration: 500})
				   .animate({borderRadius: '200px'}, {queue: false, duration: 500})
				   .animate({left: '0'}, {queue: false, duration: 500})
				   .animate({top: '0'},{queue: false, duration: 500});
				   
			$('div.democTxt').animate({fontSize: '36px'},{queue: false, duration: 500});
			$('.demDesc').fadeIn(500);
							 			
		});
		
		$('.democRing').mouseleave(function(){
			var triggered = $(this).attr('id');
			var posLeft;
			var posTop;
			
			switch(triggered){
				case 'citDiv':
					posLeft ='140px';
					posTop ='0';
					break;
				case 'proDiv':
					posLeft ='140px';
					posTop ='170px';
					break;
				case 'donDiv':
					posLeft ='0';
					posTop ='280px';
					break;
				case 'creDiv':
					posLeft ='280px';
					posTop ='280px';
					break;
			}
			
			$('.democRing').not(this).show(300);
			$('#demImg').show(300);
			
			$(this).animate({width: '100px'}, {queue: false, duration: 500})
				   .animate({height: '100px'}, {queue: false, duration: 500})
				   .animate({borderRadius: '75px'}, {queue: false, duration: 500})
				   .animate({left: posLeft}, {queue: false, duration: 500})
				   .animate({top: posTop},{queue: false, duration: 500});
				   
			$('div.democTxt').animate({fontSize: '15px'},{queue: false, duration: 500});
			$('.demDesc').hide();
							 
		});
		
		$('.responseButton').click(function(){
			
			if($(this).hasClass('agree')){
				$('#responseMsg').html('Welcome to the club!');
				$.post(url + 'percent.php', {response : 1}, function(output){
					$('.responseSpan').html(output + '%');
				});
			}
			else{
				$('#responseMsg').html('Bring your opinion to our discussions!');
				$.post(url + 'percent.php', {response : 0}, function(output){
					$('.responseSpan').html(output + '%');
				});
			}
		});

});			
	