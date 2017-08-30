<?php
    $sliders = array();
      
		   if(!isset($bannerImages[0]->banner_images) && $bannerImages[0]->banner_images=="")
		   $bannerImages[0]->banner_images=ASSETS.'assets/img/red.jpg';
   ?>
<!-- STYLES -->

<script type="text/javascript">
	  // var _gaq = _gaq || [];
	  // _gaq.push(['_setAccount', 'XX-XXXXXXX-XX']);
	  // _gaq.push(['_trackPageview']);

	  // (function() {
	  //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	  //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	  //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  // })();
</script>
<!-- maps -->


<div id="full_map_container" style="display:none"> <a id="closemap"><i class="fa fa-compress"></i> Close map</a>
  <div id="full_map_canvas"> </div>
</div>

<!--Banner slider-->

<div class="banner-container">
  <ul class="bxslider">
    <?php $io = 1;foreach($bannerImages as $k=>$v){ 
	      $st = '';
	      if($io==1)
			  $st= 'style="display:none"';
	  ?>
    <li <?php  echo $st; ?> ><img title="<?php echo $v->banner_title;?>" src="<?php echo $v->banner_images; ?>"></li>
    <?php } ?>
  </ul>
  <?php /*
 
  <div class="row">
	    
    <div class="ban-left big-thumb col-lg-7 col-md-7 col-sm-7 col-xs-12"> <img class="banner-thumb-large" width="772" height="420" src="<?php echo $bannerImages[0]->banner_images; ?>" alt="user-thumb">
      <div class="ban-post"> <a href="#" class="post-heading"><?php echo ORGANISAION_NAME; ?></a>
       <?php if(isset($bannerImages[0]->banner_title)){?>
        <h2 class="caption-title"> <?php echo $bannerImages[0]->banner_title; ?></h2>
        <?php } ?>
        <?php if(isset($bannerImages[0]->banner_description)){?>
        <p class="ban-description"><?php echo substr(trim($bannerImages[0]->banner_description),0,210);?></p>
        <?php } ?>
      </div>
    </div>
    <div class="ban-right col-lg-5 col-md-5 col-sm-5 col-xs-5">
      <div class="small-thumb"><img class="banner-thumb-small" width="547" height="210" src="<?php echo $bannerImages[1]->banner_images; ?>" alt="user-thumb">
        <div class="ban-post"> <a href="#" class="post-heading"><?php echo ORGANISAION_NAME; ?></a>
          <?php if(isset($bannerImages[1]->banner_title)){ ?>
          <h2 class="caption-title"><?php echo $bannerImages[1]->banner_title; ?></h2>
          <?php } ?>
        </div>
      </div>
      <div class="down-thumb"><img width="547" height="210" class="banner-thumb-small" src="<?php echo $bannerImages[2]->banner_images; ?>" alt="user-thumb">
        <div class="ban-post"> <a href="#" class="post-heading"><?php echo ORGANISAION_NAME; ?></a>
         <?php if(isset($bannerImages[2]->banner_title)){?>
          <h2 class="caption-title"><?php echo $bannerImages[2]->banner_title; ?></h2>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>  */?>
</div>

<!--Banner slider--> 
<!--main Content-->
<div class="main-content">
  <div class="col-lg-12 map-container"> <a href="javascript:void(0)" id="fullmap"><i class="fa fa-expand"></i> Full screen</a>
    <div id="map_canvas" ></div>
  </div>
 
<div class="main-holder">  
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 school-news recent-post-widget left-container">
    
    <div class="top-main-widget">
    
 <div class="active-members col-lg-9 col-md-9">
      <h3 class="widgettitle">RECENTLY ACTIVE MEMBERS</h3>
      <ul class="avatar-widget">
        <?php foreach($users as $key=>$val){  ?>
        <li class="avatar-item col-xs-3"> <a href="#">
          <?php if(isset($val->profile_thumb_image) && $val->profile_thumb_image !=''){ ?>
          <?php if($user_id!='') { ?>
          <a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($val->id);?>"><img  width="123" height="123" title="<?php echo $val->display_name;?>" src="resize.php?src=<?php echo $val->profile_image; ?>&h=123&w=123"></a>
          <?php  }else{ ?>
          <img  width="123" height="123" title="<?php echo $val->display_name;?>" src="resize.php?src=<?php echo $val->profile_image; ?>&h=123&w=123">
          <?php } ?>
          <?php } else{ ?>
          <?php if($user_id!='') { ?>
          <a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($val->id);?>"><img  width="123" height="123" title="<?php echo $val->display_name;?>" src="<?php echo ASSETS;?>assets/img/emp-none.png"></a>
          <?php  }else{ ?>
          <img  width="123" height="123" title="<?php echo $val->display_name;?>" src="<?php echo ASSETS;?>assets/img/emp-none.png">
          <?php } ?>
          <?php }?>
          </a> </li>
        <?php  } ?>
      </ul>
    </div>
    
    
    <div class="col-lg-3 col-md-3 alumni-container pull-right">
    
       <div class="col-sm-12 alumni-members">
        <h3 class="widgettitle">Alumni Members</h3>
        <div class="member-count"> <a href="<?php echo base_url();?>connections"><span class="stat-count" style="display:none">
          <?php if(isset($userCount)){ echo $userCount;}?>
          </span> </a></div>
      </div>
      <?php //if($user_id=='') { ?>
        
    </div>
    
    
    </div>
    
    <div class="news-widget">
      <div class="news-container">
        
          <div class="main-news main-events col-lg-8 col-md-8 col-sm-6 col-xs-12">
           <h3 class="widgettitle">UPcoming Events</h3>
              <?php //print_r($events); ?>
      
      <div class="postings-container">
	     <?php if(isset($events) and count($events)>0){  ?>
        <section class="postings">
                    <img width="80" height="80" src="<?php echo base_url();?>">
                    <div class="events-holder"><a href="<?php echo base_url().'events/eventsdetails/'.$events[0]->event_id; ?>" class="post-header"><?php echo $events[0]->event_title; ?></a>
                      
					  <div><span><?php echo ORGANISAION_NAME; ?></span></div>
					  <div><span><?php echo $events[0]->event_address;?></span></div>
					  <?php $event_end_date=$events[0]->event_enddate;?>
					   <?php
                          $then = new DateTime($event_end_date);
								$now = new DateTime();
								$delta = $now->diff($then);

								$quantities = array(
									'year' => $delta->y,
									'month' => $delta->m,
									'day' => $delta->d,
									'hour' => $delta->h,
									'minute' => $delta->i,
									'second' => $delta->s);

								$str = '';
								foreach($quantities as $unit => $value) {
									if($value == 0) continue;
									$str .= $value . ' ' . $unit;
									if($value != 1) {
										$str .= 's';
									}
									$str .=  ': ';
								}
								$str = $str == '' ? 'a moment ' : substr($str, 0, -2);

								echo $str;
                                ?>
						 
            </div>
        </section>
		 <?php }else{ ?>
		 <span>No events.................</span>
		 <?php } ?>
        <!--<section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">FEATURED-NEWS / UNIVERSO SCHOOL</a> <a href="#" class="post-description">We have been moulding kids into motivated, enterprising and compassionate adults, for 37 years</a></p>
            </section>
        <section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">UNIVERSO SCHOOL</a> <a href="#" class="post-description">A warm welcome to our alumni</a></p>
            </section>-->
        <?php if(is_array($events) && count($events)>0) { ?>
        <section class="load-more"> <a href="<?php echo base_url();?>events" class="readmore-btn">Explore</a> </section>
        <?php } ?>
      </div>
          
      </div>
      <div class="main-news col-lg-4 col-md-4 col-sm-6 col-xs-12">
         <h3 class="widgettitle">News</h3>
       <?php if(isset($news) and count($news)>0){  ?>
      <div class="postings-container">
        <?php foreach($news as $k=>$v){ $images=json_decode($v->news_images);?>
        <section class="postings">
          <?php if(isset($images[0]) && $images[0]!='' ) { ?>
          <img width="80" height="80" src="resize.php?src=<?php echo $images[0]; ?>&h=80&w=80">
          <?php }else{ ?>
          <img width="80" height="80" src="<?php echo ASSETS;?>assets/img/no-news-img.png">
          <?php } ?>
          <p><a href="<?php echo base_url().'news/newsdetails/'.$v->news_id; ?>" class="post-header"><?php echo ucwords($v->news_title);?></a>
            <?php // echo substr(strip_tags($v->news_title),0,30)."...";?>
          </p>
          <p><?php echo $v->created_on;?></p>
        </section>
        <?php } ?>
        <!--<section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">FEATURED-NEWS / UNIVERSO SCHOOL</a> <a href="#" class="post-description">We have been moulding kids into motivated, enterprising and compassionate adults, for 37 years</a></p>
            </section>
        <section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">UNIVERSO SCHOOL</a> <a href="#" class="post-description">A warm welcome to our alumni</a></p>
            </section>-->
        <?php if(is_array($news) && count($news)>2) { ?>
        <section class="load-more"> <a href="<?php echo base_url();?>news" class="readmore-btn">Explore</a> </section>
        <?php } ?>
      </div>
	   <?php } ?>
          
      </div>
      </div>
      
      <div class="community-widget">
        <h3 class="widgettitle">Join The Community</h3>
        <p class="home_login_error_msg"  style="display:none"></p>
        <div class="login-container">
          <form method="post" name="home_login_user" id="home_login_user"   onsubmit="return doHomeLogin()">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="username-input form-control required" name="email" id="home_login_email" placeholder="Username or Email" alt="Username">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input type="password" class="password-input form-control required" name="pass" id="home_login_pass" placeholder="password" alt="Password" >
              </div>
            </div>
            <a href="javascript:void(0)" onclick="homeHelpBlock()" id="helpBlock" class="help-block forget-btn">Forgot your password?</a>
            <button type="submit" class="btn btn-primary">Login</button>
            <span style="display:none" class="loader-btn load-home-login-image"><i class="fa fa-spinner fa-pulse"></i></span>
            <div class="form-group remember-widget"> <span class="pull-left rememberMe"> 
              <!--<label>
            <input type="checkbox">
                Remember Me </label>--> 
              </span> <span class="pull-right signUp"> No account? <a href="<?php echo base_url('register'); ?>">Sign up</a> </span> </div>
          </form>
          <div class="social-icons-widget"> <span>Connect with: </span>
            <ul class="social-icons-list">
              <li><a  onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Facebook')" href="javascript:void(0)"><i class="fa fa-facebook-square"></i></a></li>
              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Google')"    href="javascript:void(0)"><i class="fa fa-google-plus-square"></i></a></li>
              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Twitter')"   href="javascript:void(0)"> <i class="fa fa-twitter-square"></i></a></li>
              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/LinkedIn')"  href="javascript:void(0)"> <i class="fa fa-linkedin-square"></i> </a></li>
            </ul>
          </div>
          <br>
        </div>
      </div>
      <?php //} ?>
      
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 members-widget">
    
    <div class="latestAct-widget">
      <div class="widget-heading"> <h3>Latest Activity</h3>
       
      </div>
      <div class="widget-content">
        <?php if(isset($user_id) && $user_id!=''){ ?>
        <div>
          <form class="formcontroler" name="postcontent" id="postcontent" action="<?php echo base_url();?>home/savepost"  method="post" enctype="multipart/form-data" onSubmit="return formSubmit('postcontent')">
            <textarea  name="post_description" class="form-control required" id="postdes" placeholder="Add a post"></textarea>
            <div class="widget-buttons">
              <input class="browse-file " type="file" name="files[]" id="filer_input2" multiple value="Post Image">
              <input type="submit" class="submit-button"  value="Submit Post" name="submit_btn">
            </div>
          </form>
        </div>
        <?php } ?>
        <ul class="activity-list list-group swing" id="postdata">
          <?php foreach($pastdata as $p=>$q){?>
          <li class="list-group-item  activity-list-item no-home-animate" alt="<?php echo $q->action_type; ?>" id="<?php echo $q->id; ?>">
            <?php $id=$q->id;?>
            <?php if(isset($q->profile_image) && $q->profile_image!=''){?>
            <img class="user-thumb"  width="60" height="60" src="resize.php?src=<?php echo $q->profile_image; ?>&h=80&w=80" alt="user-thumb">
            <?php } else{?>
            <img class="user-thumb"  width="60" height="60" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
            <?php }?>
            <div class="activity-content">
              <p class="activity-header">
                <?php if($q->action_type=='post'){ ?>
                <?php if($user_id!='') { ?>
                <a class="activity-name" href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($q->user_id);?>"> <?php echo $q->display_name;?></a> posted
                <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
                <?php }else{ ?>
                <span class="name-color"><?php echo $q->display_name;?></span> Posted.
                <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
                <?php } ?>
                <?php }else if($q->action_type=='newjoin'){ ?>
                <?php if($user_id!='') { ?>
                <a class="activity-name" href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($q->user_id);?>"> <?php echo $q->display_name;?></a> Joined.
                <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
                <?php }else{ ?>
                <span class="name-color"><?php echo $q->display_name;?></span> Joined.
                 <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
                <?php } ?>
              </p>
              <?php }else{ ?>
              <span><?php echo $q->display_name;?></span> posted <?php echo $q->action_type; ?>
              <span class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></span>
              <?php } ?>
             
              <!--<p><i class="bp-activity-visibility fa fa-globe"></i></p>-->
              <?php if($q->action_type=='post'){ 
				     $url = base_url().'posts/postdetailes/'.$q->action_item_id;;
					}else if($q->action_type=='news'){
						$url = base_url().'news/newsdetails/'.$q->action_item_id;
					}else if($q->action_type=='event')
					{
						$url = base_url().'events/eventsdetails/'.$q->action_item_id;
					}
					/*else if($q->action_type=='campaign')
					{
						$url = base_url().'campaign/campaigndetails/'.$q->action_item_id;;
					}*/
			  ?>
              <?php  if($q->action_type!='newjoin'){ ?>
              <?php if($q->action_type!='post'){ ?>
              <a href="<?php echo $url; ?>" class="activity-title"> <?php echo $q->activity_title;?> </a>
              <?php }else{ ?>
              
              <a href="<?php echo  $url; ?>" class="activity-description"> <?php echo substr($q->activity_content,0,500);?>... </a> 
              <!-- Trigger the modal with a button --> 
             
              
              <!-- Modal -->
              <?php 
              } ?>
              <?php if(isset($user_id) && $user_id!=''){ ?>
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
                    <div class="popup-comments-holder">
                      <?php if(isset($user_id) && $user_id!=''){ ?>
                      <div class="popup-toggle">
                          <a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a>
                      </div>
                      <div style="display:none" class="comments-popup-container"></div>
                      <?php }else{  ?>
                      <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
                      <?php } ?>
                    </div>
                    </div>
                   </div>
                </div>
              </div>
			   <a type="button" class="read-btn"   data-toggle="modal" data-target="#myModal_<?php echo doDecrypt($q->action_item_id)?>">Read more</a> 
			  <!-- <a href="javascript:void(0)"  class="read-btn" onClick="getActivityContent(<?php echo doDecrypt($q->action_item_id)?>,'<?php echo $q->action_type;?>');">Read more</a> -->
              <div style="display:none" class="comments-container"></div>
              <?php }else{  ?>
              <a class="comments" href="#" data-toggle="modal" data-target="#myModal">Comment</a>
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
                    <div class="popup-comments-holder">
                      <?php if(isset($user_id) && $user_id!=''){ ?>
                      <div class="popup-toggle">
                          <a class="activity-comment-popup"   onClick="showCommentsDataPopup(this,'comments-popup-container','<?php echo $q->action_item_id;?>','<?php echo $q->action_type;?>')" href="javascript:void(0)">See Comments </a> <a class="hide-comment-popup" href="javascript:void(0)" style="display:none" onClick="hideCommentsDataPopup(this)">Hide Comments</a>
                      </div>
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
			   <!--<a href="javascript:void(0)"  class="read-btn" onClick="getActivityContent(<?php echo doDecrypt($q->action_item_id)?>,'<?php echo $q->action_type;?>');">Read more</a>-->
              <?php } ?>
              <?php }?>
              <!-- Edit post content-->
              <?php if($q->action_type=='post' && isset($user_id) && $user_id!='' && $q->editable){ ?>
              <div class="dropdown isedit">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <span class="caret"> </span> </button>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)" onclick="editPost('<?php echo $q->action_item_id; ?>',this)"><i class="fa fa-pencil-square-o"></i> Edit Post</a></li>
                  <li><a href="javascript:void(0)" onclick="removePost('<?php echo $q->action_item_id; ?>',this)"><i class="fa fa-trash" ></i> Remove </a></li>
                </ul>
              </div>
              <?php  } ?>
              <!-- Edit post content end--> 
            </div>
          </li>
          <?php } ?>
          <input type="hidden" name="post_id" id="loadmore_postid" value="<?php echo $id;?>">
        </ul>

          <a class="view-btn" href="<?php echo base_url();?>activity">Explore</a>
      </div>
      <!--comments for post--> 
      
    </div>
    
    
    
    
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
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/home.js"></script> 
<!-- JS --> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/vendor/jquery.mapit.js"></script> 
<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/initializers.js"></script>
<link href="<?php echo ASSETS;?>assets/js/jquery.bxslider.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/vendor/jquery.mapit.js"></script> 
<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/initializers.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/plugins/jquery.easing.1.3.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/jquery.bxslider.js"></script> 
<!-- Styles -->
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/jquery-comments.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- Data --> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/data/comments-data.js"></script> 

<!-- Libraries --> 

<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery-comments.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/comment-post.js"></script> 
<script type="text/javascript">
  $('.bxslider').bxSlider({
  mode: 'fade',
  auto: true,
  captions: true,
   slideHeight: 300,
  slideWidth: 1500
});

function getActivityContent(id,val){
	 
	$.ajax({
						url:  base_url+ 'home/getActivityContent',
						type: 'POST',
						data:  'actvityId='+id+'&type='+val,
						success: function(data)
						 {   
						 console.log(data);
						 var msg = jQuery.parseJSON(data); 
						   console.log(msg);
						 }
					}); 
}
 
</script> 
