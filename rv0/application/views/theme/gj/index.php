<!DOCTYPE html>
<head>
   <meta http-equiv="Content-Type" content="ASSETS;?>assets//html; charset=utf-8" />
   <meta charset="utf-8">
   <meta id="mtkwrds" name="keywords" content="<?php if(isset($page_meta_keywords))echo $page_meta_keywords;?>" />
   <meta name="description" content="<?php if(isset($page_meta_description))echo $page_meta_description;?>" />
   <title> :: Rightlink - v :: </title>
   <script type="ASSETS;?>assets//javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
   <script type="ASSETS;?>assets//javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
   <script type="ASSETS;?>assets//javascript" src="<?php echo base_url();?>assets/js/common.js"></script>
   <?php echo FacebookID; exit;?>
</head>
<body class="full-width page-condensed login-page">
   <!-- Navbar -->
   <div class="navbar navbar-inverse" role="navigation" style="border:none; border-radius: 0;">
      <form method="post" name="login_user" id="login_user" action="<?php echo base_url('user/doLogin'); ?>" onsubmit="return formSubmit('login_user')">
         <?php if($error_msg!='') { ?>
         <p class="error_msg"><?php echo $error_msg; ?></p>
         <?php } ?>
         <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
            <li>
               <div class="form-group has-feedback">
                  <label><span>User Name:</span> <input type="ASSETS;?>assets/" class="username-input required" name="email" id="email" placeholder="Email" alt="Enter valid email"></label>
                  <i class="icon-users form-control-feedback"></i>
               </div>
            </li>
            <li>
               <div class="form-group has-feedback">
                  <label><span>Password:</span> <input type="password" class="password-input required" name="pass" id="pass" placeholder="password" alt="Enter password" ></label>
                  <i class="icon-lock form-control-feedback"></i>
               </div>
               <a href="JavaScript:Void(0)":>Forgot Password</a>
            </li>
            <button   class="btn btn-success"> Login</button>
         </ul>
      </form>
   </div>
   <!-- /navbar -->
   <div class="block">
      <div class="loginpage-div">
         <div class="col-lg-5 col-md-6 col-sm-6">
            <form method="post"  class="form-horizontal" role="form" name="register_user" id="register_user" action="<?php echo base_url('user/doRegister'); ?>"  onsubmit="return formSubmit('register_user')">
               <!-- Basic inputs -->
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h6 class="panel-title"><i class="icon-user"></i> Create an Account</h6>
                  </div>
                  <?php if($success_msg!='') { ?>
                  <p class="success_msg"><?php echo $success_msg; ?></p>
                  <?php } ?>
                  <?php if($error_msg!='') { ?>
                  <p class="error_msg"><?php echo $error_msg; ?></p>
                  <?php } ?>
                  <div class="panel-body">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">User Name: </label>
                        <div class="col-sm-8">
                           <input type="ASSETS;?>assets/" class="form-control required" name="signup_username" id="signup_username" placeholder="User Name" alt="Enter user name">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Email: </label>
                        <div class="col-sm-8">
                           <input type="ASSETS;?>assets/" class="form-control required email"  name="email" id="email" placeholder="Email" alt="Enter valid Email" >
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Password: </label>
                        <div class="col-sm-8">
                           <input type="password" class="form-control required pass" name="pass" id="pass" placeholder="password" alt="Enter Password">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Retype Password: </label>
                        <div class="col-sm-8">
                           <input type="password" class="form-control required cpass" name="cpass" id="cpass" placeholder="Confirm password" alt="Enter confirm Password">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">First Name: </label>
                        <div class="col-sm-8">
                           <input type="ASSETS;?>assets/" class="form-control required" name="firstName" id="firstName" placeholder="First Name" alt="Enter First name">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Last Name: </label>
                        <div class="col-sm-8">
                           <input type="ASSETS;?>assets/" class="form-control required" name="lastName" id="lastName" placeholder="Last Name" alt="Enter Last name">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Gender: </label>
                        <div class="col-sm-8">
                           <label class="radio-inline radio-danger">
                              <div class="choice"><span class="checked"><input type="radio" name="gender" class="styled"  checked="checked" value="m"></span></div>
                              Male
                           </label>
                           <label class="radio-inline radio-danger">
                              <div class="choice"><span class=""><input type="radio" name="gender"  class="styled" value="f"></span></div>
                              Female
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of Birth: </label>
                        <div class="col-sm-8">
                           <input class="form-control required" type="ASSETS;?>assets/" id="birthdate" name="birthdate"  placeholder="Select date"  alt="Select Birth date">
                        </div>
                     </div>
                     <div class="plupload_file_name">
                        <div class="plupload_buttons"><button class="plupload_button plupload_add" style="position: relative; z-index: 1;">Sign Up</button></div>
                     </div>
                  </div>
               </div>
        
         <!-- /spinner -->
         </form>
        </div>
      </div>
   </div>
   <!-- Login wrapper -->
   <!-- /login wrapper -->
   <!-- Footer -->
   <!-- /footer -->
   <script></script>
</body>
</html>