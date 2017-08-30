<div class="main-content news-page">
  <div class="col-lg-12 recent-post-widget">
    <div class="connection-view">
      <section class="postings">
        <?php if(isset($connection->profile_image) && $connection->profile_image!=''){?>
        <img src="<?php echo $connection->profile_image;?>">
        <?php }else{?>
        <img src="<?php echo ASSETS;?>assets/img/profile-thumb.jpg">
        <?php } ?>
        <div class="post-content">
          <p><a href="#" class="post-header"><?php echo $connection->display_name;?></a> <span class="active-time">posted an update 1 month, 1 week ago</span> <span><i class="bp-activity-visibility fa fa-globe"></i></span></p>
          <p class="connection-content">Join the comunity of modern thinking students</p>
        </div>
      </section>
    </div>
  </div>
</div>
