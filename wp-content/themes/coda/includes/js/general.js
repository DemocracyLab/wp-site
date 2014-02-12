jQuery(document).ready(function(){    
        
    // Accordian
    jQuery('#accordion h3').next().hide();

    jQuery('#accordion h3:first').next().show();
    
    jQuery('#accordion h3').click(function(){
    
    jQuery('#accordion h3').next().slideUp();
    
    if( jQuery(this).next().css('display') == 'none'){
    
        jQuery(this).next().slideDown();
    
    }
    else {
        
        jQuery(this).next().slideUp();
        
    }

        
    })
        
})