<?php foreach($pastdata as $p=>$q){?>
<li class="list-group-item activity-list-item  no-home-animate" id="<?php echo $q->id; ?>" >
 
<?php if(isset($q->profile_image) && $q->profile_image!=''){?>
<img class="user-thumb"  width="60" height="60" src="resize.php?src=<?php echo $q->profile_image; ?>&h=80&w=80" alt="user-thumb">
<?php } else{?>
<img class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
<?php }?>
<div class="activity-content">
  <p class="activity-header">
	  <?php if($q->action_type=='post'){ ?>
		   <?php if($user_id!='') { ?>
				<a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($q->user_id);?>"> <?php echo $q->display_name;?></a> posted an update </p>
	         <?php }else{ ?>
					   <span class="name-color"><?php echo $q->display_name;?></span> posted. 
			 <?php } ?>
		  <?php }else if($q->action_type=='newjoin'){ ?>
			<?php if($user_id!='') { ?>
				<a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($q->user_id);?>"> <?php echo $q->display_name;?></a> Joined. </p>
			<?php }else{ ?>
			   <span class="name-color"><?php echo $q->display_name;?></span> Joined.
			<?php } ?>
		<?php }else{ ?>
		  <?php echo $q->display_name;?> posted <?php echo $q->action_type; ?>
	   <?php } ?>
	 
  <p class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></p>
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
  
   <?php  if($q->action_type!='newjoin'){ ?>
				<?php if($q->action_type!='post'){ ?>
					 <a href="<?php echo $url; ?>" class="activity-title"> 
				   <?php echo $q->activity_title;?>
				   </a>
			   <?php }else{ ?>
			    
			   <a href="<?php echo $url; ?>" class="activity-description"> 
              <?php echo substr($q->activity_content,0,500);?>...
             </a> 
			  
     <?php } ?> 
	          <?php  $session = $this->session->userdata('logged_in');?>
	 
	  <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                 <a class="activity-comment"   onClick="showCommentsData(this,'comments-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> 
			  <a class="hide-comment" href="javascript:void(0)" style="display:none" onClick="hideCommentsData(this)">Hide Comments</a>
			  <div class="modal fade comments-modal" id="myModal_<?php echo doDecrypt($q->action_item_id)?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <?php if($q->action_type=="post"){ ?>
                      <span><?php echo $q->display_name;?></span> posted
					   <?php }else{ ?>
					    <span><?php echo $q->display_name;?></span> posted <?php echo $q->action_type; ?>
					   <?php } ?>
                    </div>
                    <div class="modal-body scrollbox6" > 
                    <div class="modal-description">
                        <?php echo $q->activity_content;?> 
                    </div>
                    <div>
                    <?php  $session = $this->session->userdata('logged_in');?>
	               <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                      <a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a>
                      <div style="display:none" class="comments-popup-container"></div>
                      <?php }else{  ?>
                      <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
                      <?php } ?>
                    </div>
                    
                    </div>
                    
                  </div>
                </div>
              </div>
			  <!--start read more button -->
			  <a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($q->action_item_id)?>">Read more</a> 
			  <!--<div><a href="javascript:void(0)" onclick="share_pic({'link':'<?php echo $url; ?>','redirect_uri':'<?php echo $url; ?>','name':'<?php echo $q->activity_title; ?>','description':'<?php echo strip_tags($q->activity_content)?>'});">Share on facebook</a></div>
			  <!-- end of read more button -->
			  <div style="display:none"   class="comments-container"></div>
	     <?php } else {  ?>
	            <a href="#" data-toggle="modal" data-target="#myModal">Comment</a>
				<div class="modal fade comments-modal" id="myModal_<?php echo doDecrypt($q->action_item_id)?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <?php if($q->action_type=="post"){ ?>
                      <span><?php echo $q->display_name;?></span> posted
					   <?php }else{ ?>
					    <span><?php echo $q->display_name;?></span> posted <?php echo $q->action_type; ?>
					   <?php } ?>
                    </div>
                    <div class="modal-body scrollbox6" > 
                    <div class="modal-description">	
                        <?php echo $q->activity_content;?> 
                    </div>
                    <div>
                    <?php  $session = $this->session->userdata('logged_in');?>
	               <?php if(isset($session['user']['id']) && $session['user']['id']!=''){ ?>
                      <a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> 
					  <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a>
                      <div style="display:none" class="comments-popup-container"></div>
                      <?php }else{  ?>
                      <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
                      <?php } ?>
                    </div>
                    
                    </div>
                    
                  </div>
                </div>
              </div>
				<a type="button" class="read-btn" data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($q->action_item_id)?>">Read more</a> 
				<!--<div><a href="javascript:void(0)" onclick="share_pic({'link':'<?php echo $url; ?>','redirect_uri':'<?php echo $url; ?>','name':'<?php echo $q->activity_title; ?>','description':'<?php echo strip_tags($q->activity_content)?>'});">Share on facebook</a></div>
				  -->
				  
				  
	  <?php   }  ?>
	 <?php  } ?>
    <?php if($q->action_type=='post' && isset($user_id) && $user_id!='' && $q->editable){ ?>
               <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <span class="caret"> </span> </button>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)" onclick="editPost('<?php echo $q->action_item_id; ?>',this)"><i class="fa fa-pencil-square-o"></i> Edit Post</a></li>
                  <li><a href="javascript:void(0)" onclick="removePost('<?php echo $q->action_item_id; ?>',this)"><i class="fa fa-trash" ></i> Remove </a></li>
                </ul>
              </div>
              <?php  } ?>
  </div>
</li>
<?php } ?>

