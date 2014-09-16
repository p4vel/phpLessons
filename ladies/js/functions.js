jQuery(document).ready(function(){
    jQuery('tr.participation td').click(function(){
    	jQuery(this).toggleClass('participate');
    	var field = jQuery(this).attr('id');
    	updateDB(field);
    });
});

function updateDB(field){
	jQuery.ajax({
		type: "POST",
		url: "incl/update_participation.php",
		data: {name: field}
	})
		.done(function(msg){
			alert("Data Saved: " + msg)
		});
}