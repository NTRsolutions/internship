<div class="main-content news-page connections-page">
  
	 <div class="col-lg-12">
    <div class="page-header">
      <h1><?php echo $title;?></h1>
        <!--<div class="members-search">
		          <form method="post" name="search" action="http://localhost:8080/rightlink/rv0/connections/search">
          <input type="text" class="search" name="searchname" value="" placeholder="Search Connections...">
          <input type="submit" class="button" value="Search">
        </form>
              </div>-->
    </div>
  </div> 
	  <div class="members-directory">
	   
		<?php/* if($alumnisinfo[0]!=''){ foreach($alumnisinfo as $k=>$v){?>
		<div class="col-lg-12 activity-list-container">
		  <?php echo $v->display_name;?>
		</div>
		<?php } }*/?>
          
          <div class="members-count col-lg-12"><a href="#">All <?php echo $title;?></a></div>
         
          <!--<form class="form-inline members-directory-form">
      <div class="form-group">
        <label for="">Order by: </label>
        <select class="form-control" onchange="getconnectiondata(this.value);">
          <option value="active">Last Active</option>
          <option value="alphabetical">Alphabetical</option>
        </select>
      </div>
    </form>-->
          
         <?php if(isset($pageinfo[0]->description) && $pageinfo[0]->description!=''){?>
          <div class=" activity-list-container page_description">
		     <div class="table-responsive">
                <?php echo $pageinfo[0]->description;?>
             </div>  
		  </div>
          <?php } ?>
          
         <div class="col-lg-12 school-news recent-post-widget">
             
              
          
            <div class="postings-container connection-contentainer">
				
				<?php $org =getorgtype();if($org[0]->organizationType=="college"){?>
					
						<?php if($alumnisinfo[0]!=''){ foreach($alumnisinfo as $k=>$v){?>
							<section class="postings col-lg-4 col-md-4 col-sm-6 col-xs-12 show">
								<div class="showin">
									  <?php if(isset($v->profile_thumb_image) && $v->profile_thumb_image !=''){?>
									  <img src="<?php echo base_url();?>resize.php?src=<?php echo $v->profile_thumb_image;?>&w=80&h=80">
									  <?php }else{ ?>
									  <img width="80" height="80" src="<?php echo ASSETS;?>assets/img/emp-none.png">
									  <?php } ?>
									<div class="post-content">
										<p>
											<?php if($logged) { ?>
												<a href="<?php echo base_url();?>connections/profile/<?php echo $v->id;?>" class="post-header"><?php echo $v->display_name;?></a>
											<?php }else{ ?>
												<a href="#" data-toggle="modal" data-target="#myModal" class="post-header"><?php echo $v->display_name;?></a>
											<?php } ?>
										</p>
			  
										<?php if(isset($v->last_accessed_on) && $v->last_accessed_on!='') { ?>
											<p class="active-time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $v->last_accessed_on;?></p>
										<?php }?>
										<?php if(isset($v->branch_name) && $v->branch_name!='') { ?>
											<p class="connection-description"><i class="fa fa-university" aria-hidden="true"></i> <span class="batch-year"><?php echo $v->branch_name;?></p>
										 <?php } ?>
										 <?php if($v->passout_year!='' || $v->course!='') { ?>
											<p class="connection-description"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
												<?php if($v->course!='' ){  ?>
													<span class="batch-year"> <?php echo $v->course;?> </span>
												<?php } ?>
												<?php if($v->passout_year!=''){  ?>
													<span class="batch-year">
													<?php if($v->course!=''){  echo ","; } ?>
													<?php echo $v->passout_year;?> </span>
												<?php } ?>
											</p>
										<?php } ?>
            
            <!-- <p class="connection-content">"Join the comunity of modern thinking students" <a href="<?php echo base_url();?>connections/connectiondetails/<?php echo $v->id;?>">View</a></p>--> 
            
          </div>
        </div>
        </section>
        <?php }}?>
      
				<?php }else{?>
					<?php if($alumnisinfo[0]!=''){ foreach($alumnisinfo as $k=>$v){?>
						<section class="postings col-lg-4 col-md-4 col-sm-6 col-xs-12  no-home-animate">
        <div class="showin">
          <?php if(isset($v->profile_thumb_image) && $v->profile_thumb_image !=''){?>
          <img src="<?php echo base_url();?>resize.php?src=<?php echo $v->profile_thumb_image;?>&w=80&h=80">
          <?php }else{ ?>
          <img width="80" height="80" src="<?php echo ASSETS;?>assets/img/emp-none.png">
          <?php } ?>
          <div class="post-content">
            <p>
              <?php if($logged) { ?>
              <a href="<?php echo base_url();?>connections/profile/<?php echo $v->id;?>" class="post-header"><?php echo $v->display_name;?></a>
              <?php }else{ ?>
             <?php /* <span class="name-color"><?php echo $v->display_name;?></span>*/?>
			  <a href="#" data-toggle="modal" data-target="#myModal" class="post-header"><?php echo $v->display_name;?></a>
              <?php } ?>
            </p>
			  
            <?php if(isset($v->last_accessed_on) && $v->last_accessed_on!='') { ?>
            <p class="active-time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $v->last_accessed_on;?></p>
            <?php }?>
            <?php if(isset($v->passout_year) && $v->passout_year!='') { ?>
			  <p class="connection-description"><i class="fa fa-university" aria-hidden="true"></i> <span class="batch-year"><?php echo $v->passout_year;?></p>
			 <?php } ?>
             
            
            <!-- <p class="connection-content">"Join the comunity of modern thinking students" <a href="<?php echo base_url();?>connections/connectiondetails/<?php echo $v->id;?>">View</a></p>--> 
            
          </div>
        </div>
      </section>
					<?php }}?>
				<?php } ?>
				</div>
          
          </div> 
          
          

</div>
</div>



