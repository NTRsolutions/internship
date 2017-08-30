     <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Change password</li>
            
        </ul>
        
        <div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>Account Settings</h5>
                <h1>Change password</h1>
            </div>
        </div><!--pageheader-->
 
  <div class="maincontent">
            <div class="maincontentinner" style="padding:0;">
                <div class="row-fluid">
                    	
                        <?php $userdata = $this->session->userdata('scms_admin_users');	?>
                        <div class="span">
                            <form action="" class="editprofileform" id="changepasswordform" method="post" onsubmit="return false">
                                
                                <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Change password</h4>
                                    <div class="widgetcontent" style="border:0">
                                        <p>
                                            <label style="width:115px;">Old Password:</label>
                                            <input type="password" name="opass" class="input-xlarge opass" value="" />                                            
                                        </p>
                                        <p>
                                            <label style="width:115px;">New Password:</label>
                                            <input type="password" name="pass" class="input-xlarge pass" value="" />
                                        </p>
                                         <p>
                                            <label style="width:115px;">Confirm Password:</label>
                                            <input type="password" name="cpass" class="input-xlarge cpass" value="" />
                                        </p>
                                    </div>
                             
                            </div>
                                </div>                                                                                                                                                              
                                <p style="margin:20px 10px;">
                                	<button type="submit" id="password_update" class="btn btn-primary">Update</button> &nbsp; <!-- <a href="">Deactivate your account</a> -->
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
	    jQuery("#password_update").click(function() {		
		    if(formSubmit('changepasswordform')){
					
				var oPass  = $('.opass').val();
				var nPass     = $('.pass').val();
				var cPass    = $('.cpass').val();
 
			         $.ajax({
			 		    type: "POST",
			 		    url: "<?php echo base_url()?>admin/cpass",
			 		    data: "oPass="+oPass+"&nPass="+nPass+"&cPass="+cPass,			 		
			 		    success: function(result) {
				 		      var data=jQuery.parseJSON(result);
 				 		      if(data.status)
				 		      {
								jQuery.noticeAdd({
								text: data.success,
								stay: false,
								type: 'error'
								}); 
								jQuery("#changepasswordform").find("input,select,textarea").each(function(){
									$(this).val('');
								});		
 				 		      }
 				 		      else
 				 		      {
								jQuery.noticeAdd({
								text: data.error,
								stay: false,
								type: 'error'
								});
								jQuery("#changepasswordform").find("input,select,textarea").each(function(){
									$(this).val('');
								});
 				 		      }
			 		            
			 		    }
			 	     })
		    }   
	         })
 });
 </script>	         
