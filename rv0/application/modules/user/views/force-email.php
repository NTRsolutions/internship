<!--main Content-->


<div class="main-content register-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Update and verify your Email.</h1>
       
    </div> 
  </div>
  <div class="col-lg-12">
    <div class="row">
		<?php  $success_msg = $this->session->userdata('success_msg');?>
		<?php //$error_msg = $this->session->userdata('error_msg');?>
      <form method="post"  class=""   name="register_user" id="register_user" action="<?php echo base_url('user/addEmail'); ?>"  onsubmit="return formSubmit('register_user')">
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
          <h4 class="widget-heading">Email Details</h4>
          
          <div class="form-group">
            <label for="exampleInputPassword1">Email Address <span>*</span></label>
            <input type="text" class="form-control required email"  name="email" value="<?php echo $useremail;?>" id="email" placeholder="Email" alt="Email" >
          </div>
          
          <input type="submit" class="btn btn-primary pull-right" value="Update email" >
        </div>
         </form>
    </div>
  </div>
</div>
<script>
  $(function() {
	    var start = new Date();
    start.setFullYear(start.getFullYear() - 70);
    var end = new Date();
    end.setFullYear(end.getFullYear() - 15);
    $( "#birthdate" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: start.getFullYear() + ':' + end.getFullYear(),
        defaultDate: '01/01/'+start.getFullYear()
    }).attr('readonly','readonly');     
    
    /*
	jQuery document ready.
*/
 
	/*
		assigning keyup event to password field
		so everytime user type code will execute
	*/

	$('#pass').keyup(function()
	{
		$('#password_strength').html(checkStrength($('#pass').val()))
	})	
	
	/*
		checkStrength is function which will do the 
		main password strength checking for us
	*/
	
	function checkStrength(password)
	{
		//initial strength
		var strength = 0
		
		//if the password length is less than 6, return message.
		if (password.length < 6) { 
			$('#password_strength').removeClass();
			$('#password_strength').addClass('short');
			return 'Too short';
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('weak');
			return 'Weak';			
		}
		else if (strength == 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('good');
			return 'Good';		
		}
		else
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('strong');
			return 'Strong';
		}
	}
 
    
  });
  </script> 
