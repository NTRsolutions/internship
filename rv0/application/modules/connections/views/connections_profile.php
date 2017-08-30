<link href="<?php echo ASSETS;?>assets/css/style.css" rel="stylesheet">
<div class="main-content news-page ">
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
		<div  style="display:none" class="center-bar"><i class="fa fa-bars" aria-hidden="true"></i></div>
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
        <!-- drag profile text -->
        
        <!-- timeline profile picture -->
        <div id="timelineProfilePic">
          <?php if(isset($connection->profile_thumb_image) && $connection->profile_thumb_image !=''){?>
          <img src="<?php echo base_url();?>resize.php?src=<?php echo $connection->profile_thumb_image;?>&w=196&h=196">
          <?php }else{ ?>
          <img src="<?php echo ASSETS;?>assets/img/profile-big-thumb.jpg">
          <?php } ?>
        </div>
        
        <!-- timeline title -->
        <div id="timelineTitle"><?php echo $connection->display_name;?> <span class="profile-activity">
          <?php if(isset($connection->last_accessed_on)) { echo 'Active on: '.time_elapsed_string(strtotime($connection->last_accessed_on)); }  ?>
          </span> </div>
        
        <!-- timeline nav -->
        <div id="timelineNav"></div>
      </div>
      
      <!-- conver page end --> 
      
    </div>
    <div class="members-directory">
      <div class="members-count col-lg-12">
        <ul class="profile-list">
          <li><a href="<?php echo base_url();?>connections/profile/<?php echo $connection->id;?>" class="active">Profile</a></li>
          <li><a href="<?php echo base_url();?>connections/activity/<?php echo $connection->id;?>" >Activity</a></li>
          <?php if($coverpageUpdate) { ?>
          <li class="activity-edit"><a href="<?php echo base_url();?>user/profile/<?php echo $connection->id;?>" >Edit</a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="tabbing-container col-lg-12">
        <ul class="col-lg-4 nav nav-pills profile-tabbing">
          <li role="presentation" id="con_view" class="active"><a href="javascript:void(0);" onClick="showdetails('view');">View</a></li>
          <li role="presentation" id="con_education" class=""><a href="javascript:void(0);" onClick="showdetails('details');">Education Details</a></li>
        </ul>
      </div>
    </div>
    <div class="">
      <div class="col-lg-12">
        <div class="table-responsive" id="connection_details">
          <h3>Basic</h3>
          <table class="table table-striped basic-table">
            <tbody>
              <?php if($connection->display_name) { ?>
              <tr>
                <td>Display Name</td>
                <td><span><?php echo $connection->display_name;?></span></td>
              </tr>
              <?php } ?>
              <?php if($connection->first_name) { ?>
              <tr>
                <td>First Name</td>
                <td><span><?php echo $connection->first_name;?></span></td>
              </tr>
              <?php } ?>
              <?php if($connection->last_name) { ?>
              <tr>
                <td>Last Name</td>
                <td><span><?php echo $connection->last_name;?></span></td>
              </tr>
              <?php } ?>
              <?php if($connection->branch_name) { ?>
              <tr>
                <td>Branch</td>
                <td><span><?php echo $connection->branch_name;?></span></td>
              </tr>
              <?php } ?>
              <?php if($connection->course) { ?>
              <tr>
                <td>Course</td>
                <td><span><?php echo $connection->course;?></span></td>
              </tr>
              <?php } ?>
              <?php if($connection->passout_year) { ?>
              <tr>
                <td>Year of Passed Out</td>
                <td><span><?php echo $connection->passout_year;?></span></td>
              </tr>
              <?php } ?>
			   <?php if($rolenames[0]->name!='') { ?>
              <tr>
                <td>Role</td>
                <td>
					<?php foreach($rolenames as $k=>$v){?>
					<span class="role-list"><?php echo $v->name;?></span>
					<?php } ?>
					
				</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="cd-timelines1" style="display:none;">
        <?php $education=json_decode($connection->education_details);?>
		<?php $profession=json_decode($connection->profession);?>
		
		<section id="cd-timeline" class="cd-container">
        <?php if((isset($education->school->school_name) && $education->school->school_name!='')|| $profession!=""  ||(isset($education->undergraduation->undergraduation_name) && $education->undergraduation->undergraduation_name!='')||(isset($education->postgraduation->postgraduation_name) && $education->postgraduation->postgraduation_name!='')||(isset($education->phd->phd_name) && $education->phd->phd_name!='') || (isset($profession) && $profession!='')){?>
        
          <?php if(isset($connection->education_details) && $connection->education_details){?>
          
            <?php if(isset($education->school->school_name) && $education->school->school_name !=''){?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-picture"> <i class="fa fa-book" aria-hidden="true"></i> </div>
              <!-- cd-timeline-img -->
              
              <div class="cd-timeline-content">
                <h2>School Details</h2>
                <p>School Name : <?php echo $education->school->school_name;?><br>
                  School Location : <?php echo $education->school->school_location;?></p>
                <span class="cd-date"><?php echo $education->school->school_passout_year;?></span> </div>
              <!-- cd-timeline-content --> 
            </div>
            <!-- cd-timeline-block -->
            <?php }?>
            <?php if(isset($education->undergraduation->undergraduation_name) && $education->undergraduation->undergraduation_name !=''){?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-picture"> <i class="fa fa-university" aria-hidden="true"></i> </div>
              <!-- cd-timeline-img -->
              
              <div class="cd-timeline-content">
                <h2>Under Graduation Details</h2>
                <p>Name : <?php echo $education->undergraduation->undergraduation_name;?><br>
                  Location : <?php echo $education->undergraduation->undergraduation_location;?><br>
                  specification : <?php echo $education->undergraduation->undergraduation_specification;?></p>
                <span class="cd-date"><?php echo $education->undergraduation->undergraduation_passout_year;?></span> </div>
              <!-- cd-timeline-content --> 
            </div>
            <!-- cd-timeline-block -->
            <?php } ?>
            <?php if(isset($education->postgraduation->postgraduation_name) && $education->postgraduation->postgraduation_name !=''){?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-picture"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> </div>
              <!-- cd-timeline-img -->
              
              <div class="cd-timeline-content">
                <h2>Post Graduation Details</h2>
                <p>Name : <?php echo $education->postgraduation->postgraduation_name;?><br>
                  Location : <?php echo $education->postgraduation->postgraduation_location;?><br>
                  specification : <?php echo $education->postgraduation->postgraduation_specification;?></p>
                <span class="cd-date"><?php echo $education->postgraduation->postgraduation_passout_year;?></span> </div>
              <!-- cd-timeline-content --> 
            </div>
            <!-- cd-timeline-block -->
            <?php } ?>
            <?php if(isset($education->phd->phd_name) && $education->phd->phd_name !=''){?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-picture"> <i class="fa fa-university" aria-hidden="true"></i> </div>
              <!-- cd-timeline-img -->
              
              <div class="cd-timeline-content">
                <h2>PHD Details</h2>
                <p>Name : <?php echo $education->phd->phd_name;?><br>
                  Location : <?php echo $education->phd->phd_location;?><br>
                  Specification : <?php echo $education->phd->phd_specification;?></p>
                <span class="cd-date"><?php echo $education->phd->phd_passout_year;?></span> </div>
              <!-- cd-timeline-content --> 
            </div>
            <!-- cd-timeline-block -->
            <?php } } ?>
            <!-- profissions details start-->
       
       
		<?php if(isset($profession) && $profession!=''){?>
			 <?php foreach($profession as $k=>$v){?>
			<div class="cd-timeline-block">
              <div class="cd-timeline-img cd-picture"> <i class="fa fa-black-tie" aria-hidden="true"></i> </div>
              <!-- cd-timeline-img -->
             
              <div class="cd-timeline-content">
                <h2>Professional Details </h2>
					<p>Industry : <?php if(isset($v->industry) && $v->industry!='other'){echo $v->industry;}else{echo $v->other_industry;}?><br/>
					Company : <?php echo $v->company;?><br/>
					Profession : <?php echo $v->profession;?><br/>
					from : <?php echo $v->from;?><br/>
					to : <?php echo $v->to;?>.</p>
					<!--<a href="#0" class="cd-read-more">Read more</a>-->
					<span class="cd-date"><?php echo $v->from;?></span>
            </div>
			
			
			</div>
			<?php } ?>
		
		<?php } ?>
          
          
         
       
        <?php }else{ ?>
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-picture">
					<div class="cd-timeline-img cd-picture"> <i class="fa fa-university" aria-hidden="true"></i> </div>
				</div> <!-- cd-timeline-img -->

				<div class="cd-timeline-content">
					<h2>Educational And Professional Details Not Updated</h2>
					
				</div> <!-- cd-timeline-content -->
			</div>
	
        
        <?php } ?>
        </section>
      </div>
      <!--<div class="table-responsive">
        <h3>Profession</h3>
        <table class="table table-striped profession-table">
          <tbody>
            <tr>
              <td>Profession</td>
              <td><a href="#">select Indusry</a></td>
            </tr>
          </tbody>
        </table>
      </div>--> 
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/jquery-ui.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/modernizr.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/main.js"></script> 
<script src="<?php echo ASSETS;?>assets/js/connection.js"></script> 
