// Run javascript after DOM is initialized
$(document).ready(function() {

    var mapdata='';
    $.ajax({url: base_url+"getLocations", success: function(result){
		var t = JSON.parse(result);

		    mapdata = {
		    locations: t,
		     zoom:4,
		     

		 
		  };
	    $('#map_canvas').mapit(mapdata);
       
    }});

  
	 
	$( "#fullmap" ).click(function() {
        $('#map_canvas').html(''); 
        $('#full_map_container').show();
        $('body').addClass('body-mapfull'); 
        $('#full_map_container').addClass('full_map_container_map');
         $('#full_map_canvas').mapit(mapdata);
      
	});
	$( "#closemap" ).click(function() {
		$('#full_map_container').hide();
        $('#full_map_canvas').html('');
        $('body').removeClass('body-mapfull'); 
        $('#full_map_container').removeClass('full_map_container_map');
        $('#map_canvas').mapit(mapdata);
	});

});
