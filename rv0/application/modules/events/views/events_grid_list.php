<div class="main-content news-page events-list">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Events</h1>
      <div class="members-search">
        <form method="post" name="search" action="<?php echo base_url();?>events/search">
          <input type="text" class="search" name="searchname" placeholder="Search Events..." <?php if(isset($searchname) && $searchname!=''){?>value="<?php echo $searchname;?>"<?php }else{?>value=""<?php }?>>
          <input type="submit" class="button" value="Search">
        </form>
      </div>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12"><a href="#" class="total-events">All Events <span><?php echo $eventscount;?></span> </a>
      <div class="grid-container"><a class="btn cal-icon" href="<?php echo base_url();?>events"><i class="fa fa-calendar" aria-hidden="true"></i></a> <a class="disabled btn list-icon" href="<?php echo base_url();?>events/gridView"><i class="fa fa-list" aria-hidden="true"></i> </a></div>
    </div>
  </div>
  <div class="col-lg-12 school-news recent-post-widget">
    <div class="postings-container">
		<?php  $session = $this->session->userdata('logged_in');?>
      <?php if($eventscount){?>
      <div><?php echo $pagination;?> </div>
	  <?php if(count($events>0)){ ?>
      <?php foreach($events as $k=>$v){ $images=json_decode($v->events_images);   /*foreach($images as $kk=>$vv){ $indx = $kk; break;}*/ ?>
	   <section class="postings">
        <div class="row">
          <div class="col-lg-1">
		    <?php if(isset($images[0])){ ?>
            <img src="<?php echo base_url(); ?>resize.php?src=<?php echo $images[0];?>&h=100&w=100" width="100" height="100">
            <?php }else{ ?>
            <img src="<?php echo ASSETS ?>assets/img/no-events.png" width="100" height="100">
			<?php $images[0] .= ASSETS."assets/img/no-events.png"?>; 
            <?php } ?>
          </div>
          <div class="post-content col-lg-11 col-xs-8">
            <h4><a href="<?php echo base_url();?>events/eventsdetails/<?php echo $v->event_id;?>" class="post-header"><?php echo $v->event_title;?></a></h4>
            <span><?php echo date('d, M Y',strtotime($v->created_on));?></span>
            <?php
             $dots = '';
             if(strlen($v->event_description)>1000){
			   $dots = '...';
			 }
			 ?>
			 <div class="modal fade comments-modal" id="myModal_<?php echo doDecrypt($v->event_id)?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span class="name-color"><?php echo $v->event_title;?></span></h4>
                    </div>
                    <div class="modal-body scrollbox6" > 
                    <div class="modal-description">
                        <?php echo $v->event_description;?> 
                    </div>
                    <div class="popup-comments-holder">
                      
	             <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                      <div class="popup-toggle"><a class="activity-comment-popup" onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $v->event_id;?>','events')" href="javascript:void(0)">See Comments </a> 
                          <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a></div>
                      <div style="display:none" class="comments-popup-container"></div>
                      <?php }else{  ?>
                      <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
                      <?php } ?>
                    </div>
                    
                    </div>
                    
                  </div>
                </div>
              </div>
            <p class="post-description"> <?php echo substr($v->event_description,0,1000).$dots;?></p>
			<div>
				<?php $description=$v->event_description.' Address:'.$v->event_address.' Event start date:'.$v->event_startdate.'  Event end date:'.$v->event_enddate; ?>
				  <a href="javascript:void(0)" onclick="share_pic({'link':'<?php echo base_url().'events/eventsdetails/'.$v->event_id; ?>','redirect_uri':'<?php echo base_url().'events/eventsdetails/'.$v->event_id; ?>',picture:'<?php echo $images[0];?>',name:'<?php echo preg_replace('/[^A-Za-z0-9\-]/', '',$v->event_title); ?>','description':'<?php echo strip_tags($description);?>'});">Share on Facebook</a>
		   </div>
			 
          </div>
        </div>
        <div class="news-comments-holder events-comments">
           <?php /*<a class="read-btn" href="<?php echo base_url();?>events/eventsdetails/<?php echo $v->event_id;?>">Read more</a> */ ?>
			 <a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($v->event_id)?>">Read more</a>
		  <?php  $session = $this->session->userdata('logged_in');?>
	   <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="comments showcomment"    onClick="showCommentsData(this,'comments-container','<?php echo $v->event_id;?>','events')" href="javascript:void(0)">See Comments </a> 
			  <a class="comments hidecomment"  href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
	  <?php   }  ?>
       </div>
       
       
		
		</section>
      <?php } ?>
	  <?php } ?>
      <div><?php echo $pagination;?> </div>
      <?php }else{ ?>
      <p>No events found...</p>
      <?php }?>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Data -->
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/data/comments-data.js"></script>
		 <!--<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/profile.js"></script>-->

		<!-- Libraries -->
	 
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery-comments.js"></script>
		 
		<script>
function showCommentsData(ele,containerId,id,type){
      $(ele).hide();   
	  $(ele).parents('section').find('.hidecomment').show();
      commentData(ele,containerId,id,type);
	
}
function hideCommentsData(ele){
	 $(ele).hide(); 
	 $(ele).parents('section').find('.showcomment').show();
	 $(ele).parents('section').find('.comments-container').hide();
	  
}
function showCommentsDataPopup(ele,containerId,id,type){
      $(ele).hide();   
	  $(ele).parents('section').find('.hide-comment-popup').show();
      commentData(ele,containerId,id,type);
	
}
function hideCommentsDataPopup(ele){
	 $(ele).hide(); 
	 $(ele).parents('section').find('.activity-comment-popup').show();
	 $(ele).parents('section').find('.comments-popup-container').hide();
	  
}

function commentData(ele,containerId,id,type){
	            var userImageUrl = $('#profileimage').attr('src');
                var container = $(ele).parents('section').find('.'+containerId);
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
