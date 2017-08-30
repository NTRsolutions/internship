
<div class="rightpanel">
  <ul class="breadcrumbs">
    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>New User</li>
  </ul>
  <div class="pageheader">
    <div class="pageicon"><span class="iconfa-laptop"></span></div>
    <div class="pagetitle">
      <h5>User Management</h5>
      <h1>New User</h1>
    </div>
  </div>
  <!--pageheader-->
  
  <div class="maincontent">
    <div class="maincontentinner" style="padding:0;">
      <div class="row-fluid">
        <div class="span">
        <form action="" id="adduser_form" class="editprofileform" method="post" onsubmit="return false">
          <div class="widgetbox login-information">
            <h4 class="widgettitle">Add User</h4>
            <div class="widgetcontent" style="border:0">
              <p>
                <label>Displayname:</label>
                <input type="text" name="user_displayname" class="input-xlarge user_displayname" value="" />
              </p>
              <p>
                <label>Useremail:</label>
                <input type="text" name="user_email" class="input-xlarge user_email" value="" />
              </p>
              <p>
                <label>Userstatus:</label>
                <select name="user_status" class="user_status">
                  <option value=1>Active</option>
                  <option value=0>In active</option>
                </select>
              </p>
              <p>
                <label>Userrole:</label>
                <select name="user_role" class="user_role">
                  <option value="1">Superadmin</option>
                  <option value="2">Admin</option>
                </select>
              </p>
            </div>
          </div>
          </div>
          <p style="margin:20px 10px;">
            <button type="submit" id="adduser_submit" class="btn btn-primary">Add User</button>
            &nbsp; <!-- <a href="">Deactivate your account</a> --> 
          </p>
        </form>
      </div>
      <!--span8--> 
    </div>
    <!--row-fluid-->
    
    <div class="footer">
      <div class="footer-left"> <span>Sparity Admin Template.</span> </div>
      <div class="footer-right"> <span>Designed by: <a href="http://www.sparity.com/">Sparity</a></span> </div>
    </div>
    <!--footer--> 
    
  </div>
  <!--maincontentinner--> 
</div>
<!--maincontent-->
</div>
<!--rightpanel--> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script>
 jQuery(document).ready(function(){
	    jQuery("#adduser_submit").click(function() {		
		    if(formSubmit('adduser_form')){
					
				var uDisplayname  = $('.user_displayname').val();
				var uEmail  = $('.user_email').val();
				var uStatus = $('.user_status').val();
				var uRole   = $('.user_role').val();
 
			         $.ajax({
			 		    type: "POST",
			 		    url: "<?php echo base_url()?>admin/users/saveuser1",
			 		    data: "uDisplayname="+uDisplayname+"&uEmail="+uEmail+"&uStatus="+uStatus+"&uRole="+uRole,			 		
			 		    success: function(result) {
				 		      var data=jQuery.parseJSON(result);
 				 		      if(data.status)
				 		      {
								jQuery.noticeAdd({
								text: data.success,
								stay: false,
								type: 'error'
								}); 
								jQuery("#adduser_form").find("input,select,textarea").each(function(){
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
 				 		      }
			 		            
			 		    }
			 	     })
		    }   
	         })
 });
 </script> 
