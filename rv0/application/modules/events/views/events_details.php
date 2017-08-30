<script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<link href="<?php echo ASSETS;?>assets/css/prettyPhoto.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/jquery.prettyPhoto.js"></script>
<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="events-header"><!-- <a class="back-btn" href="<?php echo base_url();?>events">All Events</a>-->
      <?php  if(isset($events->event_enddate) && strtotime($events->event_enddate)<strtotime($currentdate)){ ?>
      <p class="bg-info">This event has passed.</p>
      <?php }else if(strtotime($events->event_startdate)<strtotime($currentdate)  && strtotime($events->event_enddate)>strtotime($currentdate)){?>
      <p class="bg-info">Running Events.</p>
      <?php }else{ ?>
      <p class="bg-info">This event has Futured.</p>
      <?php }?>
      <h2 class="events-notice"><?php echo $events->event_title;?> Live on <?php echo date('jS F Y',strtotime($events->event_startdate));?></h2>
      <div class="event-description"><?php echo $events->event_description;?></div>
    </div>
    <div class="events-container">
      <div class="col-lg-4 events-details">
        <h4>Details</h4>
        <div class="event-date"> <strong>Date: </strong><br>
          <span> Start Date : <?php echo date('F jS,Y',strtotime($events->event_startdate));?></span><br/>
          <span> End Date : <?php echo date('F jS,Y',strtotime($events->event_enddate));?></span> </div>
      </div>
      <div class="col-lg-4 events-organizer">
        <h4>Organizer</h4>
        <div class="organizer-content">
          <p><?php echo $events->event_organizer_name;?></p>
          <strong>Phone: </strong><br>
          <span><?php echo $events->event_organizer_phone;?></span><br>
          <br>
          <strong>Email: </strong><br>
          <span><?php echo $events->event_organizer_email;?></span><br>
          <br>
          <strong>Website:</strong><br>
          <span><a  target="_blank" href="<?php echo $events->event_organizer_website;?>"><?php echo $events->event_organizer_website;?></a></span><br>
          <br>
        </div>
      </div>
      <div class="col-lg-4 events-venue">
        <h4>Address</h4>
        <div class="venue-content">
          
          <?php echo $events->event_address;?>
          
        </div>
      </div>
    </div>
	
	
	<div id="main" class="pretty-photo">
    <?php $images = json_decode($events->events_images);?>
	<?php if(count($images)>0){ ?>
    <ul class="gallery clearfix photo-gallery">
      <?php foreach($images as $k=>$v){?>
      <li><a href="<?php echo $v;?>" rel="prettyPhoto[gallery2]" ><img src="<?php echo $v;?>" width="100" height="100" /></a></li>
      <?php } ?>
    </ul>
	<?php } ?>
  </div>
      <div class="comments-holder">
	      <?php  $session = $this->session->userdata('logged_in');?>
	   <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="comments showcomment" onClick="showCommentsData(this,'<?php echo doEncrypt($events->event_id);?>','events')" href="javascript:void(0)">See Comments </a> 
			  <a class="comments hidecomment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a href="#" class="comments" data-toggle="modal" data-target="#myModal">Comment</a>
	  <?php   }  ?>
	  </div>
	
  </div>
  
    
	
  <!--<div class="col-lg-12 map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.2042193953043!2d78.37149851436386!3d17.44993695559225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb93dca5007399%3A0x60fe7164985acada!2sJubilee+Enclave%2C+HITEC+City%2C+Hyderabad%2C+Andhra+Pradesh+500081!5e0!3m2!1sen!2sin!4v1460033887121" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div >-->
  <div class="col-lg-12">
    <div id="map" class="map" style="width:100%;height:350px; margin:20px auto 0;border: 3px solid #e5e5e5; box-shadow: 0 1px 2px #333;"></div>
  </div>
</div>
<?php $map= explode(",",$events->event_map);?>
<script type="text/javascript">
$(document).ready(function () {
	// Define the latitude and longitude positions
	var latitude = parseFloat("<?php echo $map[0]; ?>"); // Latitude get from above variable
	var longitude = parseFloat("<?php echo $map[1]; ?>"); // Longitude from same
	var latlngPos = new google.maps.LatLng(latitude, longitude);
	
	// Set up options for the Google map
	var myOptions = {
		zoom: 14,
		center: latlngPos,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControlOptions: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE
		}
	};
	
	// Define the map
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	
	// Add the marker
	var marker = new google.maps.Marker({
		position: latlngPos,
		map: map,
		title: "Your Location"
	});
	$("area[rel^='prettyPhoto']").prettyPhoto();
	
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false,social_tools:false,overlay_gallery: false});
	//$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

});
</script> 
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Data -->
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/data/comments-data.js"></script>

		<!-- Libraries -->
	 
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery-comments.js"></script>
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/comment-post.js"></script>
<script>
function showCommentsData(containerId,id,type){
      $(containerId).hide();   
	  $('.hidecomment').show();
      commentData(containerId,id,type);
	
}
function hideCommentsData(ele){
	 $(ele).hide(); 
	 $('.showcomment').show();
	 $('.comments-container').hide();
	  
}

function commentData(containerEle,id,type){
	            var userImageUrl = $('#profileimage').attr('src');
				 console.log(containerEle);
				 var container =  $('.comments-container');
				 console.log(container);
				 var commentContainer =  $(container).comments({
					profilePictureURL:userImageUrl,
					roundProfilePictures: true,
					textareaRows: 1,
					enableAttachments: false,					 
					item_id: id,
					item_type: type,
					enableUpvoting: false, 
                    enableNavigation: false,      					
					getComments: function(success, error) {
						 
						  $.ajax({
						  url: base_url+"home/getCommentdata",
						  type: "POST",
						  data: {'postId':id,'post_type':type},
						  success: function(msg)
							{
								 
								 var commentsArray  = jQuery.parseJSON(msg );
								 setTimeout(function() {
													success(commentsArray);
													$(container).show();
												}, 500);
								  
								}
							});
	             },
					postComment: function(data,successpost, error) {
						console.log(data);
						  $.ajax({
						  url: base_url+"home/insertCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								  
								 
								var msg  = jQuery.parseJSON(msg);
								   setTimeout(function() {
//data.fullname="azarrr";									   
									//data.comment_id= 	msg.id;							   
													successpost(msg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
								
							});
				      },
					putComment: function(data, successpost, error) {
						 $.ajax({
						  url: base_url+"home/updateCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								 
								 var commsg  = jQuery.parseJSON(msg );
								
								   setTimeout(function() {	
                  						   successpost(commsg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
						   });
				     },
					deleteComment: function(data,successpost,error) {
						  
						 $.ajax({
						  url: base_url+"home/deleteCommentdata",
						  type: "POST",
						  data: data,
						  success: function(msg)
							{
								 
								 var commsg  = jQuery.parseJSON(msg );
								
								   setTimeout(function() {	
                  						   successpost(msg);
													//$("#commentsdata_"+containerId).show();
												}, 500);
								}
						   });
					},
					upvoteComment: function(data, success, error) {
						 setTimeout(function() {
							success(data);
						}, 500);
					},
				   uploadAttachments: function(data,successpost,error) {
        var responses = 0;
        var successfulUploads = [];

        var serverResponded = function() {
            responses++;

            // Check if all requests have finished
            if(responses == data.length) {
                
                // Case: all failed
                if(successfulUploads.length == 0) {
                    error();

                // Case: some succeeded
                } else {
                    successpost(successfulUploads)
                }
            }
        }

        $(data).each(function(index, commentJSON) {

            // Create form data
            var formData = new FormData();
            $(Object.keys(commentJSON)).each(function(index, key) {
                var value = commentJSON[key];
                if(value) formData.append(key, value);
            });

            $.ajax({
                url: '<?php echo base_url();?>home/imagesCommentdata',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(commentJSON) {
					console.log(commentJSON);
                    successfulUploads.push(commentJSON);
                    serverResponded();
                },
                error: function(data) {
                    serverResponded();
                },
            });
        });
    },
				});
}
</script>		
