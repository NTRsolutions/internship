<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Gallery</h1>
      <div class="members-search">
        <form method="post" name="search" action="<?php echo base_url();?>gallery/search">
          <input type="text" class="search" name="searchname" placeholder="Search Gallery..." <?php if(isset($searchname) && $searchname!=''){?>value="<?php echo $searchname;?>"<?php }else{?>value=""<?php }?>>
          <input type="submit" class="button" value="Search">
        </form>
      </div>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12"><a href="javascript:void(0);">All Gallery <span><?php echo $gallerycount;?></span> </a></div>
  </div>
  <div class="col-lg-12 school-news recent-post-widget">
    <div class="postings-container gallery-container">
      <?php if($gallerycount){?>
      <div class="pagination-container"><?php echo $pagination;?> </div>
     
		  
		  
			
				
                
                
                
                
<div class="row">
  <?php foreach($gallery as $k=>$v){ ?>
  <div class="col-sm-6 col-md-3">
   <a href="<?php echo $v->galleryRedirectUrl;?>" target="_blank">
    <div class="thumbnail">
      <?php if(isset($v->galleryImage)){ ?>
					<img src="<?php echo base_url(); ?>resize.php?src=<?php echo $v->galleryImage;?>&h=100&w=100" width="100" height="100">
				<?php }else{ ?>
					<img src="<?php echo ASSETS ?>assets/img/no-news-img.png" width="100" height="100">
				<?php } ?>
      <div class="caption">
        <h3 class="name-color"><?php echo $v->galleryTitle;?></h3>
        
        <p class="active-time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo date('d, M Y',strtotime($v->createdOn));?></p>
        
        <?php
							 $dots = '';
							 if(strlen($v->galleryDescription)>1000){
							   $dots = '...';
							 }
						?>
                         <p class="connection-description"><?php echo substr($v->galleryDescription,0,150).$dots;?></p>
        
      </div>
    </div>
      </a>
  </div>
  
   <?php } ?>
</div>
                
                
						 
                        
			              
            
          
   
     
      <div class="pagination-bottom"><?php echo $pagination;?> </div>
      <?php }else{ ?>
      <p>No Gallery found...</p>
      <?php }?>
    </div>
  </div>
</div>

		 
			
