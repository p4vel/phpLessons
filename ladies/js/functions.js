jQuery(document).ready(function(){
    jQuery('tr.participation td').click(function(){
    	jQuery(this).toggleClass('participate');
    });
});