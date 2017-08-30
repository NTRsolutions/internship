<!--main Content-->
<div class="main-content register-page">
   <div class="col-lg-12">
      <div class="page-header ">
         <div class="col-lg-12">
          <h1>Create an Account</h1>
            <p>Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.</p></div>
      </div>
      <!--<div class="social-icons-widget">
         <h4 class="widget-heading">Connect with:</h4>
         <ul class="social-icons-list">
            <li><a  onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Facebook')" href="javascript:void(0)"><i class="fa fa-facebook-square"></i></a></li>
            <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Google')"    href="javascript:void(0)"><i class="fa fa-google-plus-square"></i></a></li>
            <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Twitter')"   href="javascript:void(0)"> <i class="fa fa-twitter-square"></i></a></li>
            <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/LinkedIn')"  href="javascript:void(0)"> <i class="fa fa-linkedin-square"></i> </a></li>
         </ul>
      </div>-->
       <!--<div class="facebook_widget_container">
           <div class="col-lg-6">
               <?php $getcondata1=getOrgData();?>
               <?php if($getcondata1[0]->facebook_url!=''){
                  $furl=$getcondata1[0]->facebook_url;?>
               <div class="fb-page" data-href="https://www.facebook.com/<?php echo $furl;?>" data-tabs="timeline" data-height="30" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"></div>
               <?php }	?>
           </div>
           <div class="col-lg-6">
               <p>Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time. Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.</p>
           </div>
       </div>-->
   </div>
   <div class="col-lg-12">
      <div class="row">
         <form method="post"  name="register_user" id="register_user" action="<?php echo base_url('user/doRegister'); ?>"  onsubmit="return formSubmit('register_user')">
            <?php if($success_msg!='') { ?>
            <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
            <?php } ?>
            <?php if($error_msg!='') { ?>
            <p class="error-helful bg-danger"><i class="fa fa-times-circle"></i>  <?php echo $error_msg; ?></p>
            <?php } ?>
            <div class="col-lg-6 account-details">
               <h4 class="widget-heading">Account Details</h4>
               <?php $roles =getRoles();?>
               <div class="form-group">
                  <label for="exampleInputEmail1">Select Role <span>*</span></label>
                  <select name="signup_role" id="signup_role" class="form-control required role">
                  <option value="alumni">alumni</option>
                     <?php foreach($roles as $k=>$v){?>
                     <option value="<?php echo $v->id; ?>"><?php echo $v->name;?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">Username <span>*</span></label>
                  <input type="text" class="form-control required username" name="signup_username" value="<?php if(isset($user['signup_username'])) {   echo $user['signup_username']; } ?>" id="signup_username" placeholder="Username" alt="Username">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Email Address <span>*</span></label>
                  <input type="text" class="form-control required email"  name="email" value="<?php if(isset($user['email'])) {   echo $user['email']; } ?>" id="email" placeholder="Email" alt="Email" >
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Choose a Password <span>*</span> <span id="password_strength">&nbsp;</span></label>
                  <input type="password" class="form-control required pass passwordstrength" name="pass" id="pass" placeholder="password" alt="Password">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password <span>*</span></label>
                  <input type="password" class="form-control required cpass" name="cpass" id="cpass" placeholder="Confirm password" alt="Confirm Password">
               </div>
            </div>
            <div class="col-lg-6 profile-details">
               <h4 class="widget-heading">Profile Details</h4>
               <div class="form-group">
                  <label for="exampleInputEmail1">Display Name <span>*</span></label>
                  <input type="text" class="form-control required" id="displayname" name="displayname"  value="<?php if(isset($user['displayname'])) {   echo $user['displayname']; } ?>" placeholder="Display Name" alt="Display Name">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">First Name <span>*</span></label>
                  <input type="text" class="form-control required" name="firstName"  value="<?php if(isset($user['firstName'])) {   echo $user['firstName']; } ?>" id="firstName" placeholder="First Name" alt="First Name">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Last Name <span>*</span></label>
                  <input type="text" class="form-control required" name="lastName"  value="<?php if(isset($user['lastName'])) {   echo $user['lastName']; } ?>" id="lastName" placeholder="Last Name" alt="Last Name">
               </div>
               <div class="form-group radio-group">
                  <label class="col-sm-2 control-label">Gender: <span>*</span></label>
                  <div class="col-sm-8 radio-list">
                     <label class="radio-inline radio-danger">
                        <div class="choice"><span class="checked">
                           <input type="radio" name="gender" class="styled"  checked="checked" value="m">
                           </span>
                        </div>
                        Male
                     </label>
                     <label class="radio-inline radio-danger">
                        <div class="choice"><span class="">
                           <input type="radio" name="gender"  class="styled" value="f">
                           </span>
                        </div>
                        Female
                     </label>
                  </div>
               </div>
               <?php /* $getb=getBranchesdata(); ?>
               <?php if(is_array($getb) && isset($getb)){?>
               <div class="form-group">
                  <label for="exampleInputPassword1">	Branch <span>*</span></label>
                  <select name="branch_name"  class="form-control">
                     <?php foreach($getb as $k=>$v){?>
                     <option value="<?php echo $v->organizationName;?>"><?php echo $v->organizationName;?></option>
                     <?php } ?>
                  </select>
               </div>
               <?php } */?>
               <div class="form-group">
                  <label for="exampleInputPassword1">Date of Birth <span>*</span></label>
                  <input class="form-control required" type="text" id="birthdate" name="birthdate" value="<?php if(isset($user['birthdate'])) {   echo $user['birthdate']; } ?>"  placeholder="Select date"  alt="Birth date">
               </div>
               <!--
                  <div class="form-group">
                  
                    <label for="exampleInputPassword1">	Year of Graduation <span>*</span></label>
                    <input class="form-control required numeric validate_passedout" type="text" maxlength="4" id="yop" name="yop" value="<?php if(isset($user['yop'])) {   echo $user['yop']; } ?>"  placeholder="Graduation Year"  alt="Passedout year">
                  
                  </div>
                  -->
               
               <input type="submit" class="btn btn-primary pull-right" value="Complete Sign Up">
            </div>
         </form>
      </div>
   </div>
</div>
<script src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script> 
<!--<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/profile.js"></script>-->
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
   function facebookpageLike(){
    var v=$("#facebooklike").val();
   // alert(v);
    if(v==''){
     $("#facebooklike").val(1);
    }else{
     $("#facebooklike").val();
    }
   // _42ft _4jy0 _opc  _4jy3 _517h _51sy
    //$('#iframe').contents().find('form')[0].submit();
    alert($('iframe').find("#facebook").length);
    console.log($('iframe'));
    $(".pluginConnectButtonDisconnected").click();
    //$('#iframe').contents().find('form')[0].submit(function(){
    // alert("kk");
    // });
    //$("#fbpage_id").click();
   }
</script>