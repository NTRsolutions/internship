<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sparity</title>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.default.css" type="text/css" />
<link href="<?php echo base_url();?>assets/css/jquery.notice.css" type="text/css" media="screen" rel="stylesheet" />
 
<!-- 
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script> -->
 
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="<?php echo base_url();?>/assets/images/logo.png" alt="" /></div>
        <form id="login"  action=""  id="loginform1"  method="post" onsubmit="return false;">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="email"  class="required email" id="email" placeholder="Enter valid username" />
                <?php echo form_error('email') ?>
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Enter valid password" />
               <?php echo form_error('password') ?>
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit" id="login_submit">Sign In</button>
            </div>
            <div class="inputwrapper animate4 bounceIn">
                <label><input type="checkbox" class="remember" name="signin" /> Keep me sign in</label>
            </div>
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>GJ Admin</p>
</div>

</body>
</html>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.notice.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>-->
<script src="<?php echo base_url();?>assets/js/validation.js"></script>
<script>
  $(document).ready(function(){
     $('#login_submit').click(function(){
		 
     if(formSubmit('loginform1'))
     {   
       var email=$('#email').val();
       var pass=$('#password').val();
        
		   $.ajax({
			   type:"POST",
			   url:"<?php echo base_url()?>admin/login",
			   data:"email="+email+"&password="+pass,
			   success:function(result){
				  var data=$.parseJSON(result);
				      
					  if(data.status)
					  {
					   window.location.href = '<?php echo base_url();?>admin/dashboard';
					  }
					  else
					  {
						jQuery.noticeAdd({
						text: data.error,
						stay: false,
						type: 'error'
						});
					   //window.location.href = '<?php echo base_url();?>admin/';
 					  }
			   }
		        
		  }) 
     }
     })
  });
</script>
