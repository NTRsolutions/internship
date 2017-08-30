<input type="hidden" id="uid" value="<?php echo $userid; ?>"/>
<div class="main-content news-page">
  <div class="col-lg-12 user_profile">
    <div class="page-header"> 
      <!-- coverpage -->
     
     
				<div id="timelineContainer">

				<!-- timeline background -->
				<div id="timelineBackground">
				<?php if(isset($connection->profile_cover_image) && $connection->profile_cover_image !=''){?>
				<img src="<?php echo base_url('uploads/users/coverpages').'/'.$connection->profile_cover_image; ?>" class="bgImage" style="margin-top: <?php echo $connection->coverpage_position; ?>;">
				<?php }else{ ?>
				 
                <?php } ?>
				</div>
                <?php if($coverpageUpdate) { ?>
				<!-- timeline background -->
				<div style="background:url(<?php echo ASSETS; ?>assets/images/timeline_shade.png);" id="timelineShade">
				<form id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>user/coverpageUpdate">
                
                <?php
                  $removeStyle= '';
                  if($connection->profile_cover_image ==''){
					  $removeStyle= 'style="display:none;"';
					}
				?>
				 
                <a <?php echo $removeStyle; ?> href="javascript:void(0)" class="remove-cover" onclick="removeCover()" ><i class="fa fa-times"></i> Remove</a>
               
				<div class="uploadFile timelineUploadBG">
                
				<input type="file" name="photoimg" id="bgphotoimg" class="custom-file-input" original-title="Change Cover Picture">
                
				</div>
				</form>
				</div>
				<?php } ?>

				<!-- timeline profile picture -->
				<div id="timelineProfilePic">
				 <?php if(isset($connection->profile_thumb_image) && $connection->profile_thumb_image !=''){?>
				  <img src="<?php echo base_url();?>resize.php?src=<?php echo $connection->profile_thumb_image;?>&w=196&h=196">
				  <?php }else{ ?>
				  <img src="<?php echo ASSETS;?>assets/img/profile-big-thumb.jpg">
				  <?php } ?>
				</div>

				<!-- timeline title -->
				<div id="timelineTitle"><?php echo $connection->display_name;?>
				 <span class="profile-activity">
						<?php if(isset($connection->last_accessed_on)) { echo 'Active on: '.time_elapsed_string(strtotime($connection->last_accessed_on)); }  ?>
				 </span>
			   </div>

				<!-- timeline nav -->
				<div id="timelineNav"></div>

				</div>

     
     
     <!-- conver page end -->
     
  </div>
  <div class="members-directory ">
    <div class="members-count col-lg-12">
      <ul class="profile-list">
        <li><a href="<?php echo base_url();?>connections/profile/<?php echo $connection->id;?>">Profile</a></li>
        <li><a href="<?php echo base_url();?>connections/activity/<?php echo $connection->id;?>" class="active">Activity</a></li>
         <?php if($coverpageUpdate) { ?>
          <li class="activity-edit"><a href="<?php echo base_url();?>user/profile/<?php echo $connection->id;?>" >Edit</a></li>
          <?php } ?>
      </ul>
    </div>
    <div class="col-lg-12">
      <ul class="activity-list list-group" id="postdata">
        <?php foreach($pastdata as $p=>$q){?>
        <li class="list-group-item" id="<?php echo $q->id; ?>">
          <?php $id=$q->id;?>
          <?php if(isset($q->profile_thumb_image) && $q->profile_thumb_image!=''){?>
          <img class="user-thumb" src="<?php echo base_url();?>resize.php?src=<?php echo $q->profile_thumb_image;?>&w=80&h=80" alt="user-thumb">
          <?php } else{?>
          <img class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
          <?php }?>
          <div class="activity-content">
            <p class="activity-header">
              <?php if($q->action_type=='post'){ ?>
              <a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($q->user_id);?>"> <?php echo $q->display_name;?></a> posted  
              <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
             
            <?php }else{ ?>
            <?php echo $q->display_name;?> posted <?php echo $q->action_type; ?>
            <?php } ?>
             </p>
            <!--<p><i class="bp-activity-visibility fa fa-globe"></i></p>-->
            <?php if($q->action_type=='post'){ 
				     $url = base_url().'posts/postdetailes/'.$q->action_item_id;;
					}else if($q->action_type=='news'){
						$url = base_url().'news/newsdetails/'.$q->action_item_id;;
					}else if($q->action_type=='event')
					{
						$url = base_url().'events/eventsdetails/'.$q->action_item_id;;
					}
			  ?>
            <?php if($q->action_type!='post'){ ?>
            <a href="<?php echo $url; ?>" class="activity-description"> <?php echo $q->activity_title;?> </a>
            <?php } ?>
			<div class="modal fade comments-modal" id="myModal_<?php echo doDecrypt($q->action_item_id)?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span class="name-color"><?php echo $q->display_name;?></span> Posted.</h4>
                    </div>
                    <div class="modal-body scrollbox6" > 
                    <div class="modal-description">
                        <?php echo $q->activity_content;?> 
                    </div>
                    <div class="popup-comments-holder">
                      <?php  $session = $this->session->userdata('logged_in');?>
	             <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                        <div class="popup-toggle"><a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a></div>
                      <div style="display:none" class="comments-popup-container"></div>
                      <?php }else{  ?>
                      <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
                      <?php } ?>
                    </div>
                    
                    </div>
                    
                  </div>
                </div>
              </div>
            <a href="<?php echo $url; ?>" class="activity-description"> <?php echo substr($q->activity_content,0,500)?> </a>
			
              <?php  $session = $this->session->userdata('logged_in');?>
	             <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
               <a class="activity-comment"   onClick="showCommentsData(this,'comments-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> 
			   <a class="hide-comment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)" >Hide Comments</a>
			   <a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($q->action_item_id)?>">Read more</a>
               <div style="display:none"   class="comments-container"></div>
				 <?php }else{  ?>
				   <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
				 <?php } ?>

            

			</div>
			 
			
			
        </li>
        <?php } ?>
        <input type="hidden" name="post_id" id="loadmore_postid" value="<?php echo $id;?>">
      </ul>
      <?php if(is_array($pastdata) && count($pastdata)>0) { ?>
      <ul class="activity-list list-group" id="lodedel">
        <li class="list-group-item load-more"> <a href="javascript:void(0);" onClick="loadmore()">Load More</a> </li>
      </ul>
      <?php } ?>
    </div>
    <?php if($pastdata=='') { ?>
    <div class="tab-2 info-alert">Sorry, there was no activity found.</div>
    <?php } ?>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo ASSETS;?>assets/js/jquery-ui.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/modernizr.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/connection.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
		

		<!-- Data -->
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/data/comments-data.js"></script>

		<!-- Libraries -->
	 
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery-comments.js"></script>
		<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/comment-post.js"></script>
