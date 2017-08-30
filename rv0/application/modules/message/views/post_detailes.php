<link href="<?php echo ASSETS;?>assets/css/prettyPhoto.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/jquery.prettyPhoto.js"></script>
<div class="main-content news-page">
  <div class="latestAct-widget">
    <div class="widget-content">
      <ul class="activity-list list-group" id="postdata">
        <li class="list-group-item">
          <?php if($postdata->profile_thumb_image==''){  ?>
          <img class="user-thumb" src="<?php echo base_url();?>assets/img/user-thumb.jpg" alt="user-thumb">
          <?php }else{ ?>
          <img class="user-thumb" src="<?php echo $postdata->profile_thumb_image;?>" alt="user-thumb">
          <?php }  ?>
          <div class="activity-content">
            <p class="activity-header"><a href="<?php echo base_url(); ?>connections/profile/<?php echo  $postdata->id; ?>"><?php echo $postdata->display_name;?></a> posted an update </p>
            <p><?php echo time_elapsed_string(strtotime($postdata->post_date));?></p>
            <p class="activity-description"><?php echo $postdata->post_description;?></p>
          </div>
        </li>
      </ul>
      <div id="main" class="pretty-photo">
        <ul class="gallery clearfix">
          <?php foreach($postimages as $k=>$v){?>
          <li><a href="<?php echo $v;?>" rel="prettyPhoto[gallery2]" ><img src="<?php echo $v;?>" width="100" height="100" /></a></li>
          <?php } ?>
        </ul>
      </div>
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
