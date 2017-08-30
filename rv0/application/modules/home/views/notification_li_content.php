<?php foreach($pastdata as $p=>$q){?>

 <li id="notifiction_<?php echo $q->id; ?>">
                <?php if(isset($q->profile_image)){ ?>
                <img  title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo base_url();?>resize.php?src=<?php echo $q->profile_image;?>" alt="user-thumb">
                <?php } else{?>
                <img title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
                <?php }?>
                <?php if($q->action_type=='post'){ 
						 $url = base_url().'posts/postdetailes/'.$q->action_item_id;;
						}else if($q->action_type=='news'){
							$url = base_url().'news/newsdetails/'.$q->action_item_id;;
						}else if($q->action_type=='event')
						{
							$url = base_url().'events/eventsdetails/'.$q->action_item_id;;
						}else if($q->action_type=='newjoin') {
							$url = base_url().'connections/profile/'.$q->action_item_id;;
						}
						?>
                <div class="post-details">
				   
                  <?php 
                     $status = '';
                    if($q->action_type!='post'){  
					    $status = ' posted';
				    } else  if($q->action_type!='news'){  
						 $status = ' posted news';
					 }else if($q->action_type=='newjoin') {
						  $status = ' Joined';
					 }else {
						  $status = ' posted event';
					 }  
					?>
                     <a href="<?php echo $url; ?>" class="activity-title"> <?php echo $q->display_name; ?><?php echo $status; ?> </a>
                
                  <?php 
					// $extstr_content = '';
					// if(strlen($q->activity_content)>14)
					// {
					//	 $extstr_content = '...';
					// }
					// $activity_content = substr($q->activity_content,0,14).$extstr_content;
				 ?>
                <!--  <a href="<?php echo $url; ?>" class="activity-description"> <?php echo $activity_content;?> </a>-->
                  <p class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></p>
                </div>
 </li>

<?php } ?>
