<link href="<?php echo ASSETS;?>assets/css/prettyPhoto.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/jquery.prettyPhoto.js"></script>
<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="news-heading">
      <h2><?php echo $news->news_title;?></h2>
      <p class="postedby"> Posted on : <?php echo date('d,M Y',strtotime($news->created_on));?> </p>
    </div>
    <div class="news-content">
      <div class="news-description"><?php echo $news->news_description;?></div>
      <!-- <?php $images=json_decode($news->news_images);?>
      <div class="news-img"><img src="http://dev.rightlink.io/am/assets/news_images/<?php echo $images[0];?>"></div>--> 
      
    </div>
    <div id="main" class="pretty-photo">
	  <?php if(count($gallery_images)>0){?>
      <ul class="gallery clearfix">
        <?php foreach($gallery_images as $k=>$v){?>
        <li><a href="<?php echo $v;?>" rel="prettyPhoto[gallery2]" ><img src="<?php echo base_url();?>resize.php?src=<?php echo $gallery_images[$k];?>&h=100&w=100" width="100" height="100" /></a></li>
        <?php } ?>
      </ul>
	  <?php } ?>
    </div>
	
	  <div class="comments-holder">
	      <?php  $session = $this->session->userdata('logged_in');?>
	   <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="comments showcomment" onClick="showCommentsData(this,'<?php echo doEncrypt($news->news_id);?>','news')" href="javascript:void(0)">See Comments </a> 
			  <a class="comments hidecomment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a href="#" class="comments" data-toggle="modal" data-target="#myModal">Comment</a>
	  <?php   }  ?>
	  </div>
	 
	 
  </div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
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
