<?php
    $sliders = array();
      if(TENENT_ID == 1)
      {
		  $sliders[0]['name'] =   ASSETS.'assets/img/red.jpg';
		  $sliders[0]['heading'] = 'Join the comunity of modern thinking students';
		  $sliders[0]['description'] = 'Universo was founded on 1st July, 1976. Bhagawan Sri Satya Sai Baba has been our guiding light, and the driving force behind this temple of education.';
		  
		  $sliders[1]['name'] =   ASSETS.'assets/img/blue.jpg';
		  $sliders[1]['heading'] = 'A warm welcome to our alumni';
		  $sliders[1]['description'] = '';
	  }else
	  {
		  $sliders[0]['name'] =   ASSETS.'assets/img/red.jpg';
		  $sliders[0]['heading'] = 'Join the comunity of modern thinking students';
		  $sliders[0]['description'] = 'Universo was founded on 1st July, 1976. Bhagawan Sri Satya Sai Baba has been our guiding light, and the driving force behind this temple of education.';
		  
		  $sliders[1]['name'] =   ASSETS.'assets/img/blue.jpg';
		  $sliders[1]['heading'] = 'A warm welcome to our alumni';
		  $sliders[1]['description'] = '';
	  }
    
     ?>

<!--Banner slider-->

<div class=" main-slider">
  <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden; visibility: hidden;"> 
    <!-- Loading Screen -->
    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
      <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
      <div style="position:absolute;display:block;background:url('<?php echo ASSETS;?>assets/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>
    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
      <?php foreach($sliders as $imk=>$slid) { ?>
      <div data-p="225.00" style="display: none;"> <img data-u="image" src="<?php echo $slid['name']?>" />
        <div style="position: absolute; top: 150px; left: 80px; width: 600px; height: 120px; font-size: 32px; color: #ffffff; line-height: 38px;"><br>
          <p><?php echo $slid['heading']?></p>
        </div>
        <div style="position: absolute; top: 275px; left: 80px; width: 600px; height: 120px; font-size: 16px; color: #ffffff; line-height: 23px; font-weight:400;"><?php echo $slid['description']?></div>
      </div>
      <?php } ?>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1"> 
      <!-- bullet navigator item prototype -->
      <div data-u="prototype" style="width:16px;height:16px;"></div>
    </div>
    <!-- Arrow Navigator --> 
    <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span> <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span> </div>
</div>
<!--Banner slider--> 
<!--main Content-->
<div class="main-content">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 school-news recent-post-widget">
    <h3 class="widgettitle">SCHOOL NEWS</h3>
    <div class="postings-container">
      <?php foreach($news as $k=>$v){ $images=json_decode($v->news_images);?>
      <section class="postings"> <img src="<?php echo $images[0];?>">
        <p><a href="<?php echo base_url().'news/newsdetails/'.$v->news_id; ?>" class="post-header"><?php echo ucwords($v->news_title);?></a> <?php echo substr(strip_tags($v->news_title),0,30);?></p>
        <p><?php echo date('d, M Y',strtotime($v->created_on));?></p>
      </section>
      <?php } ?>
      <!--<section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">FEATURED-NEWS / UNIVERSO SCHOOL</a> <a href="#" class="post-description">We have been moulding kids into motivated, enterprising and compassionate adults, for 37 years</a></p>
            </section>
        <section class="postings"> <img src="<?php echo ASSETS;?>assets/img/home_banner1-100x80.jpg">
              <p><a href="#" class="post-header">UNIVERSO SCHOOL</a> <a href="#" class="post-description">A warm welcome to our alumni</a></p>
            </section>-->
      <?php if(is_array($news) && count($news)>2) { ?>
      <section class="load-more"> <a href="<?php echo base_url();?>news" class="readmore-btn">View all</a> </section>
      <?php } ?>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 members-widget">
    <div class="active-members">
      <h3 class="widgettitle">RECENTLY ACTIVE MEMBERS</h3>
      <ul class="avatar-widget">
        <?php foreach($users as $key=>$val){?>
        <?php if($key < 4){?>
        <li class="avatar-item"> <a href="#">
          <?php if(isset($val->profile_thumb_image) && $val->profile_thumb_image !=''){?>
          <a href="<?php echo base_url();?>connections/profile/<?php echo $val->id;?>"><img src="<?php echo $val->profile_thumb_image;?>"></a>
          <?php } else{ ?>
          <a href="<?php echo base_url();?>connections/profile/<?php echo $val->id;?>"><img src="<?php echo ASSETS;?>assets/img/emp-none.png"></a>
          <?php }?>
          </a> </li>
        <?php  }} ?>
      </ul>
    </div>
    <div class="latestAct-widget">
      <div class="widget-heading"> <span>Latest Activity</span>
        <div class="gp-triangle"></div>
      </div>
      <div class="widget-content">
        <?php if(isset($user_id) && $user_id!=''){ ?>
        <div>
          <form class="formcontroler" name="postcontent" id="postcontent" action="<?php echo base_url();?>home/savepost"  method="post" enctype="multipart/form-data" onSubmit="return formSubmit('postcontent')">
            <textarea  name="post_description" class="form-control required" id="postdes" placeholder="Comment Here"></textarea>
            <div class="widget-buttons">
              <input class="browse-file " type="file" name="files[]" id="filer_input2" multiple value="Post Image">
              <input type="submit" class="submit-button"  value="Post Submit" name="submit_btn">
            </div>
          </form>
        </div>
        <?php } ?>
        <ul class="activity-list list-group swing" id="postdata">
          <?php foreach($pastdata as $p=>$q){?>
          <li class="list-group-item no-home-animate" id="<?php echo $q->id; ?>">
            <?php $id=$q->id;?>
            <?php if(isset($q->profile_image) && $q->profile_image!=''){?>
            <img class="user-thumb" src="<?php echo $q->profile_image; ?>" alt="user-thumb">
            <?php } else{?>
            <img class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
            <?php }?>
            <div class="activity-content">
              <p class="activity-header">
                <?php if($q->action_type=='post'){ ?>
                <a href="<?php echo base_url();?>connections/profile/<?php echo $q->user_id;?>"> <?php echo $q->display_name;?></a> posted an update </p>
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
              <?php if($q->action_type!='post'){ ?>
              <a href="<?php echo $url; ?>" class="activity-title"> <?php echo $q->activity_title;?> </a>
              <?php } ?>
              <a href="<?php echo $url; ?>" class="activity-description"> <?php echo $q->activity_content;?> </a> </div>
          </li>
          <?php } ?>
          <input type="hidden" name="post_id" id="loadmore_postid" value="<?php echo $id;?>">
        </ul>
        <?php if(is_array($pastdata) && count($pastdata)>9) { ?>
        <ul class="activity-list list-group" id="lodedel">
          <li class="list-group-item load-more"> <a class="load-txt" href="javascript:void(0);" onClick="loadmore()"><span class="load-span">Load More</span> <img  style="display:none" class="load-more load-image" src="<?php echo ASSETS;?>assets/img/load-more.gif" alt="user-thumb"></a> </li>
        </ul>
        <?php } ?>
        <?php if($pastdata=='') { ?>
        <div class="tab-2 info-alert">Sorry, there was no activity found.</div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <div class="col-sm-12 alumni-members">
        <h3 class="widgettitle">Alumni Members</h3>
        <div class="member-count"> <span><?php echo count($users);?></span> </div>
      </div>
      <div class="col-sm-12 community-widget">
        <h3 class="widgettitle">Join The Community</h3>
        <div class="login-container">
          <form>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Username or Email">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Password">
              </div>
              <a href="#" id="helpBlock" class="help-block">Forgot your password?</a> </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="form-group"> <span class="pull-left rememberMe">
              <label>
                <input type="checkbox">
                Remember Me </label>
              </span> <span class="pull-right signUp"> No account? <a href="#">Sign up</a> </span> </div>
          </form>
          <div class="social-icons-widget"> <span>Connect with: </span>
            <ul class="social-icons-list">
              <li><a href="#"><img src="<?php echo ASSETS;?>assets/img/facebook.png" alt="facebook-icon"></a></li>
              <li><a href="#"><img src="<?php echo ASSETS;?>assets/img/google.png" alt="google-icon"></a></li>
              <li><a href="#"><img src="<?php echo ASSETS;?>assets/img/twitter.png" alt="twitter-icon"></a></li>
              <li><a href="#"><img src="<?php echo ASSETS;?>assets/img/linkedin.png" alt="linkedin-icon"></a></li>
            </ul>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jssor.slider.mini.js"></script>
<?php if($user_id!='') { ?>
<link href="<?php echo ASSETS;?>assets/css/imageupload/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="<?php echo ASSETS;?>assets/css/imageupload/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/imageupload/jquery.filer.min.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/imageupload/custom.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/home.js"></script> 
