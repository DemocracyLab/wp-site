jQuery.noConflict(); 
jQuery(document).ready(function(){

    		jQuery("#dim").css("height", jQuery(document).height());
    		
    		jQuery(".alert").click(function(){
    			jQuery("#dim").fadeIn();
    			return false;
			});
    		
    		jQuery(".close").click(function(){
    			jQuery("#dim").fadeOut();
    			return false;
			});
			
		
		});
		
		jQuery(window).bind("resize", function(){
		 	jQuery("#dim").css("height", jQuery(window).height());
		});