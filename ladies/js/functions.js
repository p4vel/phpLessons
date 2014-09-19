jQuery(document).ready(function(){
    jQuery('tr.participation td').click(function(){
    	jQuery(this).toggleClass('participate');
    	var field = jQuery(this).attr('id');
    	var value = jQuery(this).attr('class');
    	updateDB(field, value);
    });
	jQuery('div.date_column .amount_participation').each(function(i){
    	$this = $(this);
    	var x = countParticipantsPerColumn($this);
    	jQuery(this).text(x);
    });
    
});

function updateDB(field, value){
	jQuery.ajax({
		type: "POST",
		url: "incl/update_participation.php",
		data: {
			name: field,
			participate: value
		}
	});
	jQuery('div.date_column .amount_participation').each(function(i){
    	$this = $(this);
    	var x = countParticipantsPerColumn($this);
    	jQuery(this).html("<td>"+x+"</td>");
    });
}

function countParticipantsPerColumn($this){
	var count_participants;
	count_participants = jQuery($this).parent().find('.participation .participate').length;
	return count_participants;
}