<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>News</h1>
      <div class="members-search">
        <form method="post" name="search" action="<?php echo base_url();?>news/search">
          <input type="text" class="search" name="searchname" placeholder="Search News..." <?php if(isset($searchname) && $searchname!=''){?>value="<?php echo $searchname;?>"<?php }else{?>value=""<?php }?>>
          <input type="submit" class="button" value="Search">
        </form>
      </div>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12"><a href="#">All News <span><?php echo $newscount;?></span> </a></div>
  </div>
  <div class="col-lg-12 school-news recent-post-widget">
    <div class="postings-container">
      <?php if($newscount){?>
      <div class="pagination-container"><?php echo $pagination;?> </div>
      <?php foreach($news as $k=>$v){ $images=json_decode($v->news_images); ?>
      <section class="postings">
        <div class="row">
          <div class="post-image">
		           
            <?php if(isset($images[0])){ ?>
            <img src="<?php echo base_url(); ?>resize.php?src=<?php echo $images[0];?>&h=100&w=100" width="100" height="100">
            <?php }else{ ?>
            <img src="<?php echo ASSETS ?>assets/img/no-news-img.png" width="100" height="100">
			<?php $images[0] .= ASSETS."assets/img/no-news-img.png"?>; 
            <?php } ?>
          </div>
          <div class="post-content col-lg-10 col-md-10 col-sm-10 col-xs-8">
            <h4><a href="<?php echo base_url();?>news/newsdetails/<?php echo $v->news_id;?>" class="post-header"><?php echo $v->news_title;?></a></h4>
            <span><?php echo date('d, M Y',strtotime($v->created_on));?></span>
            <?php
             $dots = '';
             if(strlen($v->news_description)>1000){
			   $dots = '...';
			 }
			?>
			<div class="modal fade comments-modal" id="myModal_<?php echo doDecrypt($v->news_id)?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span class="name-color"><?php echo $v->news_title;?></span></h4>
                    </div>
                    <div class="modal-body scrollbox6" > 
                    <div class="modal-description">
                        <?php echo $v->news_description;?> 
                    </div>
					
                    <div class="popup-comments-holder">
                      <?php  $session = $this->session->userdata('logged_in');?>
	             <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                      <div class="popup-toggle"><a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $v->news_id;?>','news')" href="javascript:void(0)">See Comments </a> 
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
			
            <p class="post-description"> <?php echo substr($v->news_description,0,1000).$dots;?></p>
			<div>
				  <a href="javascript:void(0)" onclick="share_pic({'link':'<?php echo base_url().'news/newsdetails/'.$v->news_id; ?>','redirect_uri':'<?php echo base_url().'news/newsdetails/'.$v->news_id; ?>',picture:'<?php echo $images[0];?>',name:'<?php echo preg_replace('/[^A-Za-z0-9\-]/', '',$v->news_title); ?>','description':'<?php echo strip_tags($v->news_description)?>'});">Share on Facebook</a>
		   </div>
          </div>
        </div>
        
      <div class="news-comments-holder">  
         <?php /* <a class="read-btn" href="<?php echo base_url();?>news/newsdetails/<?php echo $v->news_id;?>">Read more</a>  */?>
		 <a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($v->news_id)?>">Read more</a>

       <?php  $session = $this->session->userdata('logged_in');?>
	   <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="comments showcomment" onClick="showCommentsData(this,'comments-container','<?php echo $v->news_id;?>','news')" href="javascript:void(0)">See Comments </a> 
			  <a class="comments hidecomment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a href="#" class="comments" data-toggle="modal" data-target="#myModal">Comment</a>
	  <?php   }  ?>
          </div>

		</section>
      <?php } ?>
      <div class="pagination-bottom"><?php echo $pagination;?> </div>
      <?php }else{ ?>
      <p>No news found...</p>
      <?php }?>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!--<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/profile.js"></script>-->
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
