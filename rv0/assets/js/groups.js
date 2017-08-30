/* user image croping*/
$( "#groupimage" ).on('change', prepareUpload);
function prepareUpload(event)
{
      files = event.target.files;
       
   
    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
     show_site_loader();
     $.ajax({
        url: base_url+'groups/updateGroupPhoto',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
			 
			if(data.status=='success')
			{ 
				$('#thumbnail').attr('src',base_url+data.image_location);
				$('#croper').attr('src',base_url+data.image_location);
				$('#current_large_image_width').val(data.width);
				$('#current_large_image_height').val(data.height);
				$('#random_key').val(data.random_key);
				var c = data.height/data.width;
				  
				$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
				$('body').removeClass('overflow-hidden').addClass('overflow-hidden');
				$('#doCrop').show();
		     }else
		     {
						 
							$("#images").find(".error-msg").html('');
							$("#images").prepend('<div class="error-msg">'+data.message+'</div>');
							setTimeout(function(){$("div").find(".error-msg").fadeOut('slow');}, 3000);
					 
			 }
            hide_site_loader();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
             hide_site_loader();
            // STOP LOADING SPINNER
        }
    });
}
 
function preview(img, selection) { 
	 
	var scaleX = 160 / selection.width; 
	var scaleY = 160 / selection.height; 
	var current_large_image_width = $('#current_large_image_width').val();
	var current_large_image_height = $('#current_large_image_height').val();
	 
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * current_large_image_width ) + 'px', 
		height: Math.round(scaleY * current_large_image_height ) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
function closeCrop()
{ 
	$('#thumbnail').imgAreaSelect({ hide: true });
	$('#doCrop').hide();
	$('body').removeClass('overflow-hidden');
}
function closeCoverCrop()
{ 
	$('#cover_thumbnail').imgAreaSelect({ hide: true });
	$('#cover_doCrop').hide();
}
function createThumb()
{ 
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		var groupID = $('#groupdId').val();
		var originalimage = $('#thumbnail').attr('src');
		var random_key = $('#random_key').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			           
					 $.ajax({
						url: base_url+'groups/updateThumbImage',
						type: 'POST',
						data: "imageLocation="+originalimage+"&x1="+x1+"&y1="+y1+"&x2="+x2+"&y2="+y2+"&w="+w+"&h="+h+"&random_key="+random_key+"&groupID="+groupID,  
						success: function(data, textStatus, jqXHR)
						{
							 
							 $('#profilethumb').attr('src',base_url+data);
							 $('#profileimage').attr('src',base_url+data);
							 $('#thumbnail').imgAreaSelect({ hide: true });
							 $('#doCrop').hide();
							 $('body').removeClass('overflow-hidden');
							 $("#images").find(".success").html('');
							 $("#images").prepend('<div class="success">Profile image updated</div>');
							 setTimeout(function(){$("div").find(".success").fadeOut('slow');}, 3000);
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							// Handle errors here
							console.log('ERRORS: ' + textStatus);
							// STOP LOADING SPINNER
						}
					});
		   
		}
 }
  
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
var gid= $("#gidval").val();
var Z=Y[1].split(";");
var dataString ='position='+Z[0]+'&gid='+gid;
$.ajax({
type: "POST",
url: base_url+"groups/updatecoverpagePosition",
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
 
 function leaveRequestedGroup($relid,$userid){
	 
	  
 }
 
}

