<!--main Content-->


<div class="main-content register-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Verify your Mobile Number</h1>
      <p>Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in on time.</p>
    </div> 
  </div>
  <div class="col-lg-12">
    <div class="row">
      <form method="post"  class=""   name="mobile_user" id="mobile_user" action="<?php echo base_url('user/mobile_verify'); ?>"  onsubmit="return formSubmit('mobile_user')">
        <?php if($success_msg!='') { ?>
        <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
        <?php }else{ ?>
			<p class="error-helful bg-success" style="display:none"><i class="fa fa-check-circle-o"></i></p>
		<?php } ?>
        <?php if($error_msg!='') { ?>
        <p class="error-helful bg-danger"><i class="fa fa-times-circle"></i> </i> <?php echo $error_msg; ?></p>
        <?php }else{ ?>
			<p class="error-helful bg-danger" style="display:none"><i class="fa fa-times-circle"></i> </i> </p>
		<?php } ?>
        <div class="col-lg-6 account-details"> 
          
          <div class="form-group">
            <label for="exampleInputPassword1">Verification code: <span>*</span></label>
            <input type="text" class="form-control required"  name="code" value="" id="code" placeholder="Verification code" alt="Verification code" >
            <input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>"/> <a href="javascript:void(0)" onclick="resendMobileCode()">resend verification code</a>
          </div>
          
          <input type="submit" class="btn btn-primary pull-right" value="Verify" >
        </div>
         </form>
    </div>
  </div>
</div>
<script>
 function resendMobileCode()
 {
	   var e = $('#mobile').val();
	    $('.load-layout-image').show();
	   $.ajax({
				url:  base_url+ 'user/resendMobileCode' ,
				type: 'POST',
				async : false,
				data: 'ajax=true&mobile='+e,
				success: function(data, textStatus, jqXHR)
				{
					
					
					var msg = jQuery.parseJSON(data); 
					 
					 if(msg.status)
					 {
						 $('.bg-success').html('<i class="fa fa-check-circle-o"></i>'+msg.message).show();
						  $('.load-layout-image').hide();
					 } 
				   else
					{
						 
						  $('.bg-error').html('<i class="fa fa-times-circle"></i>'+msg.message).hide();
						   $('.load-layout-image').hide();
						  return false;
					}
				}
							 
			}); 
	   
 }
  </script> 
