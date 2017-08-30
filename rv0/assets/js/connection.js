function loadmore(){
		var id=$("#postdata").find('li').last().attr('id');
		var uid=$("#uid").val();
		 
		$.ajax({
		url: base_url+"connections/getactivities",
		method: "POST",
		data: { post_id: id , uid:uid},
		dataType: "json",
		async: false
	}).done(function(msg){
		if(!msg){
			$('#lodedel').remove();
			return false;
		}
		
		$('#postdata').append(msg);
	 
		
	
	});
} 
 $(document).ready(function() {
 setTimeout(function() {
					$( ".no-home-animate" ).each(function() {
								 $(this).removeClass('no-home-animate').addClass('show');
						});
			}, 10);
			 
});

if($('#timelineContainer').length>0)
{
// cover image

	 //remove conver 
function removeCover() 
{
	if(confirm('Are you sure want to remove Cover image?'))
	{
		 show_site_loader();
		 $.ajax({
			type: "POST",
			url: base_url+"user/removeCover",
			data: '',
			cache: false,
			beforeSend: function(){ },
			success: function(html)
			{
			   $('.remove-cover').fadeOut('slow');
			   $('#timelineBackground').html('');
			   hide_site_loader();
			},error: function(html)
			{
				 hide_site_loader();
			}
		});

	}
}
$(document).ready(function()
{

/* Uploading Profile BackGround Image */
$('body').on('change','#bgphotoimg', function()
{
 $(".center-bar").show();
$("#bgimageform").ajaxForm({target: '#timelineBackground',
beforeSubmit:function(){
show_site_loader();
},
success:function(txt){
	 
if(txt!='Fail upload folder with read access.' && txt!='Image file size max 1 MB' && txt!='Invalid file format.' && txt!='Please select image..!')

{ $("#timelineShade").hide();
  $("#bgimageform").hide();
  $(".timelineWrap").show();
  
}
hide_site_loader();
},
error:function(){
hide_site_loader();
} }).submit();
});



/* Banner position drag */
$("body").on('mouseover','.headerimage',function ()
{
var y1 = $('#timelineBackground').height();
var y2 =  $('.headerimage').height();
$(this).draggable({
scroll: false,
axis: "y",
drag: function(event, ui) {
if(ui.position.top >= 0)
{
ui.position.top = 0;
}
else if(ui.position.top <= y1 - y2)
{
ui.position.top = y1 - y2;
}
},
stop: function(event, ui)
{
}
});
});


/* Bannert Position Save*/
$("body").on('click','.bgSave',function ()
{
var id = $(this).attr("id");
var p = $("#timelineBGload").attr("style");
var Y =p.split("top:");
var Z=Y[1].split(";");
var dataString ='position='+Z[0];
$.ajax({
type: "POST",
url: base_url+"user/updatecoverpagePosition",
data: dataString,
cache: false,
beforeSend: function(){ 
show_site_loader();
},
success: function(html)
{
if(html)
{
	$(".timelineWrap").fadeOut('slow');
$(".bgImage").fadeOut('slow');
$(".bgSave").fadeOut('slow');
$("#timelineShade").fadeIn("slow");
$("#bgimageform").fadeIn("slow");
 $('.remove-cover').fadeIn('slow');
$("#timelineBGload").removeClass("headerimage");
$("#timelineBGload").css({'margin-top':html});
$(".center-bar").hide();
hide_site_loader();
return false;
}
}
});
hide_site_loader();
return false;
});



});
 
function showdetails(val)
 {
	if(val=='view'){
		$("#cd-timelines1").css('display','none');
		$("#con_view").addClass('active');
		$("#con_education").removeClass('active');
		$("#connection_details").css('display','block');
	}else{
		$("#connection_details").css('display','none');
		$("#con_view").removeClass('active');
		$("#con_education").addClass('active');
		
		$("#cd-timelines1").css('display','block');
		
	} 
 }
 
}
