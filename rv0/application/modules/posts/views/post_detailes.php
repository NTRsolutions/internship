<link href="<?php echo ASSETS;?>assets/css/prettyPhoto.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/jquery.prettyPhoto.js"></script>
<div class="main-content news-page">
 <div class="latestAct-widget">
  <div class="widget-content">
    <ul class="activity-list list-group" id="postdata">
      <li class="list-group-item"> 
	<?php if($postdata->profile_thumb_image==''){  ?>
      <img class="user-thumb" src="<?php echo ASSETS?>assets/img/user-thumb.jpg" alt="user-thumb">
      <?php }else{ ?>
		  <img class="user-thumb" src="<?php echo base_url();?>resize.php?src=<?php echo $postdata->profile_thumb_image;?>&h=80&w=80" alt="user-thumb">
		 <?php }  ?>  
        <div class="activity-content"> 
          <p class="activity-header">
			  <?php if($user_id!='') { ?>
			    <a href="<?php echo base_url(); ?>connections/profile/<?php echo  $postdata->user_id; ?>"><?php echo $postdata->display_name;?></a>
			  <?php }else{ ?>
					   <?php echo $postdata->display_name;?>
			 <?php } ?>
			 posted. </p>
           <!-- Edit post content-->
              <?php if($postdata->editable){ ?>
               <div class="dropdown isedit">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <span class="caret"> </span> </button>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)" onclick="editPost('<?php echo $postdata->post_id; ?>',this)"><i class="fa fa-pencil-square-o"></i> Edit Post</a></li>
                  <li><a href="javascript:void(0)" onclick="removePostdetail('<?php echo $postdata->post_id; ?>',this)"><i class="fa fa-trash" ></i> Remove </a></li>
                </ul>
              </div>
              <?php  } ?>
         <!-- Edit post content end-->
          <p><?php echo time_elapsed_string(strtotime($postdata->post_date));?></p>
          <p class="activity-description"><?php echo $postdata->post_description;?></p>
        </div>
      </li>
    </ul>
      
	 <?php if(count($postthumbsimages)>0){?>
    <div id="main" class="pretty-photo">
      <ul class="gallery clearfix">
        <?php foreach($postthumbsimages as $k=>$v){?>
        <li><a href="<?php echo $postimages[$k];?>" rel="prettyPhoto[gallery2]" ><img src="<?php echo $v;?>" width="123" height="123" /></a></li>
        <?php } ?>
      </ul>
    </div>
	 <?php } ?>
	   <div class="comments-holder">
	      <?php  $session = $this->session->userdata('logged_in');?>
	   <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="comments showcomment" onClick="showCommentsData(this,'<?php echo $postdata->post_id;?>','post')" href="javascript:void(0)">See Comments </a> 
			  <a class="comments hidecomment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a href="#" class="comments" data-toggle="modal" data-target="#myModal">Comment</a>
	  <?php   }  ?>
	  </div>
	  
	 
  </div>
  </div>
</div>

 <!-- edit popup template -->
  <?php echo $editPopup; ?>
 <!-- edit popup template end-->

<?php if($user_id!='') { ?>
<link href="<?php echo ASSETS;?>assets/css/imageupload/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="<?php echo ASSETS;?>assets/css/imageupload/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/imageupload/jquery.filer.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/imageupload/custom.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script>
<?php } ?>


<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){ 
				animateImages(); 
			});
			function animateImages()
			{
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false,social_tools:false,overlay_gallery: false});
			}
</script> 
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Data -->
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/data/comments-data.js"></script>

		<!-- Libraries -->
	 
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery-comments.js"></script>
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/comment-post.js"></script>
<script>
function removePostdetail(id,elem)
	{
		if(confirm('Are you want to delete post?'))
		{
				elt = elem;
				$.ajax({
				url: base_url+"posts/deletepost",
				method: "POST",
				data: { post_id: id},
				dataType: "json",
				async: false
					}).done(function(msg){
						 
						  if(msg==1)
						  {
							   if($('.gallery').length>0)
							  {
								 
								   window.location = base_url;
							  }else
							  {
								   $(elt).parents('li.list-group-item').remove();
								   window.location = base_url; 
							  }
							 
							   
						  }else
						  {
							   alert('You are not authorized to delete this post.'); 
							   
						  }
						  
					});
		}
	}


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
