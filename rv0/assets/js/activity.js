function loadmore(){
	  $('.load-span').hide();
	   $('.load-image').show();
	    var len = $("li.activity-list-item").length - 1;	     
	        
		var id=$("li.activity-list-item:eq("+len+")").attr('id'); 
		 
		$.ajax({
		url: base_url+"home/getpost",
		method: "POST",
		data: { post_id: id},
		dataType: "json",
		async: false
	}).done(function(msg){
		if(!msg){ 
			//$('.load-image').hide();
			//$('.load-span').show();
			$('#lodedel').remove();
			return false;
		}
		
		$('#postdata').append(msg);
		 setTimeout(function() {
			       $('.load-image').hide();
					$( ".no-home-animate" ).each(function() {
								 $(this).removeClass('no-home-animate').addClass('show');
						});
			}, 10);
	 
		$('.load-image').hide();
		$('.load-span').show();
	
	});
} 
 $(document).ready(function() {
 setTimeout(function() {
					$( ".no-home-animate" ).each(function() {
								 $(this).removeClass('no-home-animate').addClass('show');
						});
			}, 10);
			 
});
