     <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Edit Profile</li>
            
        </ul>
        
        <div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>Personal data Summary</h5>
                <h1>Edit Profile</h1>
            </div>
        </div><!--pageheader-->
 
  <div class="maincontent">
            <div class="maincontentinner" style="padding:0;">
                <div class="row-fluid">
                    	
                        <?php $userdata = $this->session->userdata('scms_admin_users');	?>
                        <div class="span">
                            <form action="" class="editprofileform" id="editprofileform" method="post" onsubmit="return false">
                                
                                <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Profile Information</h4>
                                    <div class="widgetcontent" style="border:0">
										<!-- <div id="avatar-holder" style="float:right;">
											<img src="<?php echo base_url();?>assets/images/profilethumb.png" alt="" class="img-polaroid"/>-->
											<input type='hidden' name="pimg" id="pimg" value="<?=$userdata->admin_img  ?>"/>
											<div class="avatar-holder" id="avatar-holder" style="float:right;">
												 <a href="javascript:void(0)" class="<? if($userdata->admin_img != ''){ ?>profimg<? } ?>"> 
												 <img  class="img-polaroid" height="100" width="100" src="<?php echo base_url();?>assets/images/photos/profileimages/<? if($userdata->admin_img != ''){ ?><?= $userdata->admin_img  ?> <? } else { ?>thumb1.png<? } ?>" alt="Profile Image"> 
												 <!-- <span onclick="removeprofileimg()"><img src="<?php echo base_url();?>assets/images/chat_close.png"/></span> -->
												 </a> 
										    </div>
										<!-- </div> -->
                                        <p>
                                            <label>Username:</label>
                                            <input type="text" name="username" class="input-xlarge username" value="<?=$userdata->admin_displayname?>" />                                            
                                        </p>
                                        <p>
                                            <label>Email:</label>
                                            <input type="text" name="email" class="input-xlarge email" value="<?=$userdata->admin_email?>" />
                                        </p>
                                        <p>
                                            <label>Status:</label>
                                            <select name="profile_status" class="profile_status">
                                            <option value=1>Active</option>
                                            <option value=0>In active</option>
                                            </select>
                                        </p>
                                         <p>
                                            <label>Firstname:</label>
                                            <input type="text" name="firstname" class="input-xlarge firstname" value="" />
                                        </p>
                                        <p>
                                            <label>Lastname:</label>
                                            <input type="text" name="lastname" class="input-xlarge lastname" value="" />
                                        </p>
                                        <p>
                                            <label>Location:</label>
                                            <input type="text" name="location" class="input-xlarge location" value="" />
                                        </p> 
										<div class="par">
										<label>Profile image</label>
										<div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden">
										<div class="input-append">
										<div class="uneditable-input span3">
										<i class="iconfa-file fileupload-exists"></i>
										<span class="fileupload-preview"></span>
										</div>
										<span class="btn btn-file"><span class="fileupload-new">Select file</span>
										<span class="fileupload-exists">Change</span>
										<input type="file"  class="profileImage" name="profileImage" id="profileImage" onChange="return uploadfile('profileImage')"></span>
										<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
										</div>
										</div>
										</div>  
										<!-- <p>
											<label>Profile image</label>
										    <input type="file"  name="profileImage" id="profileImage" onChange="return uploadfile('profileImage')"></span>
										</p> -->                              
                                        <p>
                                            <label>About You:</label>
                                            <textarea name="about" class="span8 about"></textarea>
                                        </p>                                                                              
                                    </div>
                             
                            </div>
                                </div>                                                                                                                                                              
                                <p style="margin:20px 10px;">
                                	<button type="submit" id="profile_update" class="btn btn-primary">Update Profile</button> &nbsp; <!-- <a href="">Deactivate your account</a> -->
                                </p>
                                
                            </form>
                        </div><!--span8-->
                    </div><!--row-fluid-->
                    
                    <div class="footer">
                        <div class="footer-left">
                            <span>Sparity Admin Template.</span>
                        </div>
                        <div class="footer-right">
                             <span>Designed by: <a href="http://www.sparity.com/">Sparity</a></span>
                        </div>
                    </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        </div><!--rightpanel-->
        
<script>
 jQuery(document).ready(function(){
	    jQuery("#profile_update").click(function() {		
		    if(formSubmit('editprofileform')){
					
				var pUsername  = $('.username').val();
				var pEmail     = $('.email').val();
				var pStatus    = $('.profile_status').val();
				var pImg       = $('#pimg').val();

			         $.ajax({
			 		    type: "POST",
			 		    url: "<?php echo base_url()?>admin/updateprofile1",
			 		    data: "pUsername="+pUsername+"&pEmail="+pEmail+"&pStatus="+pStatus+"&pImg="+pImg,			 		
			 		    success: function(result) {
				 		      var data=jQuery.parseJSON(result);
 				 		      if(data.status)
				 		      {
								jQuery.noticeAdd({
								text: data.success,
								stay: false,
								type: 'error'
								}); 
 				 		      }
 				 		      else
 				 		      {
								jQuery.noticeAdd({
								text: data.error,
								stay: false,
								type: 'error'
								});
 				 		      }
			 		            
			 		    }
			 	     })
		    }   
	         })
 });
 </script>	         
