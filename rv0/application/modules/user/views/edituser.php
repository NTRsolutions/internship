     <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Edit User</li>
            
        </ul>
        
        <div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>User Management</h5>
                <h1>Edit User</h1>
            </div>
        </div><!--pageheader-->
 
  <div class="maincontent">
            <div class="maincontentinner" style="padding:0;">
                <div class="row-fluid">                    	
                        <div class="span">
                             <form action="" id="updateuser_form" class="editprofileform" method="post" onsubmit="return false">                                
                               <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Add User</h4>
                                    <div class="widgetcontent" style="border:0">
                                        <p>
                                            <label>Displayname:</label>
                                            <input type="text" name="user_displayname" class="input-xlarge user_displayname" value="<?=$udata[0]->admin_displayname?>" />                                            
                                        </p>
                                        <p>
                                            <label>Useremail:</label>
                                            <input type="text" name="user_email" class="input-xlarge user_email" value="<?=$udata[0]->admin_email?>" />
                                        </p>
                                        <p>
                                            <label>Userstatus:</label>
                                            <select name="user_status" class="user_status">
												<option value="1" <? if($udata[0]->admin_status == 1) {?>selected<? } ?>>Active</option>
												<option value="0" <? if($udata[0]->admin_status == 0) {?>selected<? } ?>>Inactive</option>
                                            </select>
                                        </p>
                                         <p>
                                            <label>Userrole:</label>
                                            <select name="user_role" class="user_role">
												<option value="1" <? if($udata[0]->admin_role == 1) {?>selected<? } ?>>Super Admin</option>
												<option value="2" <? if($udata[0]->admin_role == 2) {?>selected<? } ?>>Admin</option>
                                            </select>
                                        </p>										
                                    </div>
                             
                            </div>
                                </div>                                                                                                                                                              
                                <p style="margin:20px 10px;">
                                	<button type="submit" id="updateuser_submit" class="btn btn-primary">Update User</button> &nbsp; <!-- <a href="">Deactivate your account</a> -->
                                </p>
                                 <input type="hidden" name="userid" class="user_id" value="<?=$udata[0]->admin_id?>" />
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
	    jQuery("#updateuser_submit").click(function() {		
		    if(formSubmit('updateuser_form')){
					
				var uDisplayname  = $('.user_displayname').val();
				var uEmail  = $('.user_email').val();
				var uStatus = $('.user_status').val();
				var uRole   = $('.user_role').val();
				var uId   = $('.user_id').val();

			         $.ajax({
			 		    type: "POST",
			 		    url: "<?php echo base_url()?>admin/users/updateuser1",
			 		    data: "uDisplayname="+uDisplayname+"&uEmail="+uEmail+"&uStatus="+uStatus+"&uRole="+uRole+"&uId="+uId,			 		
			 		    success: function(result) {
				 		      var data=jQuery.parseJSON(result);
 				 		      if(data.status)
				 		      {
								jQuery.noticeAdd({
								text: data.success,
								stay: false,
								type: 'error'
								}); 
								window.location.href = admin_baseurl+'users/userslist1';															 
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
