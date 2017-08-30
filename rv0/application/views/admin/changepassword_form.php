<div class="breadcrumbs span3">
	<div class="span4 hed-name">
    	<h3 class="heading-name"><?php echo $this->lang->line('admin_site_cpass_changepassword')?></h3>
    </div>
    <div class="span2 add-button ">
    </div>
	
</div>
<!--<div class="error_message span12">
 <div  id="success_message" class="alert alert-success span4" ></div>
 <div  id="error_message" class="alert alert-error span4"></div>  
 </div>-->  
 <form method="post" id="cpass_form" action="" onsubmit="return formSubmit(this.id)" class="form-horizontal login-form">
		 <div class="control-group email-password"> 
         <label for="inputEmail" class="control-label Old-Password"><?php echo $this->lang->line('admin_site_cpass_oldpass')?> </label>
         <div class="controls">
                <input type="password" class="required span7" name="oldpassword" placeholder="Old password" id="oldpassword" alt="<?php echo $this->lang->line('admin_site_cpass_oldpass')?>">
              </div>
              </div>
		 

	      <div class="control-group email-password">
              <label for="inputPassword" class="control-label Old-Password"><?php echo $this->lang->line('admin_site_cpass_newpass')?></label>
		      <div class="controls">
		        <input id="pass" type="password" class="required pass span7"   name="pass" placeholder="Password" id="inputPassword" alt="<?php echo $this->lang->line('admin_site_cpass_newpass')?>">     
		      </div>
              </div>

             <div class="control-group email-password">
              <label for="inputPassword" class="control-label Old-Password"><?php echo $this->lang->line('admin_site_cpass_confirmpass')?></label>
              <div class="controls">
                <input id="cpass" type="password" class="required cpass span7"  name="cpass" placeholder="Confirm Password" alt="<?php echo $this->lang->line('admin_site_cpass_confirmpass')?>" id="inputPassword">
                  
              </div>
            </div>

        <div class="controls ">
		   <a href="javascript:void(0)" id="cpass_submit">
           <button class="btn btn-primary submit-but" type="button"><?php echo $this->lang->line('admin_site_submit')?> </button>
           </a>
        </div>
 </form> 
<script>
 $(document).ready(function(){
	    $("#cpass_submit").click(function() {
		    if(formSubmit('cpass_form')){
		    	 var oldpass=$('#oldpassword').val();
		         var newpass=$('#pass').val();
	                 var cpass=$('#cpass').val();
			         $.ajax({
			 		    type: "POST",
			 		    url: "<?php echo base_url()?>admin/cpass",
			 		    data: "admin_pass="+oldpass+"&newpass="+newpass+"&cpass="+cpass,
			 		    success: function(result) {
				 		      var data=$.parseJSON(result);
				 		      if(data.status)
				 		      {
								  jQuery.noticeAdd({
										 text: data.success,
										 stay: false,
									     type: 'success'
									});
 				 		      }else{
								   jQuery.noticeAdd({
										text: data.failure,
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
  
