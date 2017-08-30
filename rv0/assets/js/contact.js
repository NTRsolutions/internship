 function savecontact(){
	if(!formSubmit('contactus'))
	return false;
	var userdata = $("#contactus").serialize();
	show_site_loader();
	$.ajax({
		url: "contactus/sendcontact",
		method: "POST",
		data: userdata,
		dataType: "json"
	}).done(function(msg){
		if(msg.status == 'success'){
			$('#contactus')[0].reset();
			$("#contactus").find(".success").html('');
			$("#contactus").prepend('<div class="success">'+msg.message+'</div>');
			setTimeout(function(){$("div").find(".success").fadeOut('slow');}, 3000);
		}else{
			$("#contactus").find(".error").html('');
			$("#contactus").prepend('<div class="error-msg">'+msg.message+'</div>');
			setTimeout(function(){$("div").find(".error-msg").fadeOut('slow');}, 3000);
		}
		hide_site_loader();
	});
}
