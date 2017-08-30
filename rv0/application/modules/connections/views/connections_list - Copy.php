<div class="main-content news-page connections-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Connections</h1>
      <div class="members-search">
        <form method="post" name="search" action="<?php echo base_url();?>connections/search">
          <input type="text" class="search" name="searchname" <?php if(isset($searchname) && $searchname!=''){?>value="<?php echo $searchname;?>"<?php }else{?>value=""<?php }?> placeholder="Search Connections..." >
          <input type="submit" class="button" value="Search">
        </form>
      </div>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12"><a href="#">All Connections
      <?php if($totalcount!=''){?>
      <span><?php echo $totalcount;?></span>
      <?php }else{?>
      <span>0</span>
      <?php } ?>
      </a></div>
 
    <form class="form-inline members-directory-form">
      <div class="form-group">
        <label for="">ORDER BY: </label>
        <select class="form-control" onChange="getconnectiondata(this.value);">
          <option  value="active" <?php if($filter=='active'){?>selected="selected"<?php } ?>>Last Active</option>
          <option value="alphabetical" <?php if($filter=='alphabetical'){?>selected="selected"<?php } ?>>Alphabetical</option>
        </select> 
      </div>
    </form>
  </div>
  <div class="col-lg-12 school-news recent-post-widget">
    <div class="postings-container connection-contentainer">
      <?php if($totalcount!=''){?>
      <p><?php echo $pagination;?> </p>
      <?php foreach($connections as $k=>$v){?>
      <section class="postings  no-home-animate">
        <?php if(isset($v->profile_thumb_image) && $v->profile_thumb_image !=''){?>
        <img src="<?php echo base_url();?>resize.php?src=<?php echo $v->profile_thumb_image;?>&w=80&h=80">
        <?php }else{ ?>
        <img src="<?php echo ASSETS;?>assets/img/emp-none.png">
        <?php } ?>
        <div class="post-content">
          <p><a href="<?php echo base_url();?>connections/profile/<?php echo $v->id;?>" class="post-header"><?php echo $v->display_name;?></a></p>
            <?php if(isset($v->last_accessed_on) && $v->last_accessed_on!=''	) { ?>
          <p class="active-time">Active on:<?php echo $v->last_accessed_on;?></p>
          <?php }?>
           <?php if(isset($v->passout_year) && $v->passout_year!=''	) { ?>
          <p class="connection-description">Batch: <span class="batch-year"><?php echo $v->passout_year;?></span></p>
          <?php } ?>
          <?php if(isset($v->branch_name) && $v->branch_name!=''	) { ?>
          <p class="connection-description">Branch Name: <span class="batch-year"><?php echo $v->branch_name;?></span></p>
          <?php } ?>
          <?php if(isset($v->course) && $v->course!=''	) { ?>
          <p class="connection-description">Course: <span class="batch-year"><?php echo $v->course;?></span></p>
          <?php } ?>
          <!-- <p class="connection-content">"Join the comunity of modern thinking students" <a href="<?php echo base_url();?>connections/connectiondetails/<?php echo $v->id;?>">View</a></p>-->
         
        </div>
      </section>
      <?php }?>
      <section class="post-bottom"><?php echo $pagination;?><!-- Viewing 1 - 4 of 4 active members --></section>
      <?php }else{ ?>
      <p>No Connections found...</p>
      <?php }?>
    </div>
  </div>
</div>
<script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/activity.js"></script> 
<script>
  function getconnectiondata(val){
	 window.location.href=base_url+'connections/filters/'+val; 
  }
  </script> 
