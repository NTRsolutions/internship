<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ORGANISAION_NAME; ?></title>
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS;?>assets/img/favicon-16x16.png">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
<!-- Bootstrap -->
<link href="<?php echo ASSETS;?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ASSETS;?>assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo ASSETS;?>assets/css/stickup.css" rel="stylesheet">
<link href="<?php echo ASSETS;?>assets/css/custom-styles.css" rel="stylesheet">

<!-- colors css -->
 
<link href="<?php echo ASSETS;?>assets/css/theme.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	var base_url='<?php echo base_url();?>';
	var assets = '<?php echo ASSETS; ?>'; 
	
	

</script>
</head>
<body  class="<?php echo THEMECOLOUR; ?>">
<?php  $getcondata=getOrgData(); ?>
<div class="site-container" id="site-container">
  <header class="navbar-static-top">
  <nav class="navbar navbar-default ">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <?php if(HEADERLOGO==''){ ?>
      <a class="navbar-brand" href="#"><img width="190" src="<?php echo ASSETS;?>assets/img/rightlink.png"></a> </div>
    <?php }else{ ?>
    <a class="navbar-brand" href="#"><img width="190" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=50"></a> </div>
  <?php } ?>
  <?php $layout_session = $this->session->userdata('logged_in');?>
  
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="pull-right login-strip">
    <ul class="nav navbar-nav navbar-right profile-menu profile-menu-desktop">
       
       
      <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
      <?php 
      $profile_display_name = $layout_session['user']['display_name'];
	   //$profile_display_name = $layout_session['user']['firstName'].' '.$layout_session['user']['lastName'];
	  ?>
      <li class="user-dropdown"> <a href="javascript:void(0);" title="<?php echo  $profile_display_name; ?>" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
        <?php if(isset($layout_session['user']['profile_thumb_image']) && $layout_session['user']['profile_thumb_image']!=''){?>
        <img id="profileimage" class="user-icon" src="<?php echo base_url();?>resize.php?src=<?php echo $layout_session['user']['profile_thumb_image'];?>&w=28&28">
        <?php }else{ ?>
        <img  id="profileimage" class="user-icon" src="<?php echo ASSETS;?>assets/img/emp-none.png">
        <?php } ?>
        <?php 
 
         $extstr = '';
		 if(strlen($profile_display_name)>14)
		 {
			 $extstr = '...';
		 }
		 $pname = substr($profile_display_name,0,14).$extstr;
		 echo $pname;
		?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          
          <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-lock" aria-hidden="true"></i>Logout</a></li>
        </ul>
      </li>
      <?php }else{?>
      <li ><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock"></i>Login</a></li>
      <li class="<?php if($activepage=='register'){ ?> active <?php } ?>"><a href="<?php echo base_url('register'); ?>"><i class="fa fa-sign-in"></i>Register</a></li>
      <?php } ?>
    </ul>
    
  </div>
  <!-- /.navbar-collapse --> 

<!-- /.container-fluid -->
</nav>
<div class="secondry-menu container-fluid">
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
   
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav navbar-right profile-menu profile-menu-mobile">
       
       
      <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
      <?php 
      $profile_display_name = $layout_session['user']['display_name'];
	   //$profile_display_name = $layout_session['user']['firstName'].' '.$layout_session['user']['lastName'];
	  ?>
      <li class="user-dropdown"> <a href="javascript:void(0);" title="<?php echo  $profile_display_name; ?>" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
        <?php if(isset($layout_session['user']['profile_thumb_image']) && $layout_session['user']['profile_thumb_image']!=''){?>
        <img id="profileimage" class="user-icon" src="<?php echo base_url();?>resize.php?src=<?php echo $layout_session['user']['profile_thumb_image'];?>&w=28&28">
        <?php }else{ ?>
        <img  id="profileimage" class="user-icon" src="<?php echo ASSETS;?>assets/img/emp-none.png">
        <?php } ?>
        <?php 
 
         $extstr = '';
		 if(strlen($profile_display_name)>14)
		 {
			 $extstr = '...';
		 }
		 $pname = substr($profile_display_name,0,14).$extstr;
		 echo $pname;
		?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          
          <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-lock" aria-hidden="true"></i>Logout</a></li>
        </ul>
      </li>
      <?php }else{?>
      <li ><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock"></i>Login</a></li>
      <li class="<?php if($activepage=='register'){ ?> active <?php } ?>"><a href="<?php echo base_url('register'); ?>"><i class="fa fa-sign-in"></i>Register</a></li>
      <?php } ?>
    </ul>
    </div>
   
</div>
</header>
<?php echo $theme_body; ?> 

<!-- main-footer -->

<footer> <a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-circle-o-up"></i></a>
    <div class="col-lg-12 footer-widgets">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 logo-widget">
          <?php if(HEADERLOGO==''){ ?>
          <img class="footer-logo" src="<?php echo ASSETS;?>assets/img/rightlink.png">
          <?php }else{ ?>
          <img  class="footer-logo" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=100">
          <?php } ?>
          <p>
            <?php if(isset($getcondata[0]->about_org)){ echo $getcondata[0]->about_org;} ?>
          </p>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 recent-post-widget">
          <h3 class="widgettitle">Links</h3>
          <ul class="footer-links">
            <li><a href="<?php echo base_url();?>activity">Activity</a></li>
            <li><a href="<?php echo base_url();?>connections">Connections</a></li>
            <li><a href="<?php echo base_url();?>news">News</a></li>
            <li><a href="<?php echo base_url();?>events">Events</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 footer-contact">
          <h3 class="widgettitle">Contact Us</h3>
          <div class="postings-container">
            <address>
            <?php if(isset($getcondata[0]->contact_address)){ echo  $getcondata[0]->contact_address;} ?>
            </address>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 footer-contact">
          <h3 class="widgettitle">Follow Us</h3>
          
          <ul class="nav navbar-nav social-icons">
       <?php if(trim($getcondata[0]->facebook_id) !=""){?>
       <li><a target="_balnk" href="<?php echo $getcondata[0]->facebook_id;?>"><i class="fa fa-facebook"></i> </a></li>
       <?php } ?>
       <?php if(trim($getcondata[0]->twitter_id) !=""){?>
       <li><a target="_balnk" href="<?php echo $getcondata[0]->twitter_id;?>"><i class="fa fa-twitter"></i> </a></li>
       <?php } ?>
       <?php if(trim($getcondata[0]->google_id) !=""){?>
       <li><a target="_balnk" href="<?php echo $getcondata[0]->google_id;?>"><i class=" fa fa-google-plus"></i> </a></li>
       <?php } ?>
       <?php if(trim($getcondata[0]->linked_id) !=""){?>
       <li><a target="_balnk" href="<?php echo $getcondata[0]->linked_id;?>"><i class="fa fa-linkedin"></i> </a></li>
       <?php } ?>
     </ul>
          
          
        </div>
      </div>
    </div>
    <div class="col-lg-12 copy-right">Copyright © 2016 NorthAlley. All Rights Reserved.</div>
  </footer>
<?php if(!isset($layout_session['user']['id']) && $layout_session['user']['id']==''){?>
<div class="modal fade login-container" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="login-holder <?php if($openLogin=='yes') {  ?> openLogin <?php } ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Login</h4>
        </div>
        <div class="modal-body">
          <?php if($login_error_msg!='') { ?>
          <p class="login_error_msg"  ><i class="fa fa-times-circle"></i> <?php echo $login_error_msg; ?></p>
          <?php  }else { ?>
         
          <p class="login_error_msg"  style="display:none"></p>
          <?php } ?>
          <form method="post" name="login_user" id="login_user"   onsubmit="return doLogin()">
            <div class="form-group">
              <?php //$cookies=get_cookie(rightlink_username);print_r($cookies);exit?>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="username-input form-control required" name="email" value="" id="login_email" placeholder="Username or Email" alt="Username">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input type="password" class="password-input form-control required" name="pass" id="login_pass" placeholder="Password" alt="Password" >
              </div>
            </div>
            <a href="javascript:void(0)" onclick="helpBlock()" id="helpBlock" class="help-block forget-btn">Forgot your password?</a>
            <button type="submit" class="btn btn-primary">Login</button>
            <span style="display:none" class="loader-btn load-layout-image"><i class="fa fa-spinner fa-pulse"></i></span>
            <div class="form-group"> <span class="pull-left rememberMe">
              <label>
                <input type="checkbox" name="remberme" id="remberme" value="">
                Remember Me </label>
              </span> <span class="pull-right signUp"> No account? <a href="<?php echo base_url().'register';?>">Sign up</a> </span> </div>
          </form>
          <div class="social-icons-widget"> <span>Connect with: </span>
            <ul class="social-icons-list">
              <li><a href="<?php echo base_url().'user/sociallogin/Facebook';?>"><i class="fa fa-facebook-square"></i></a></li>
              <li><a href="<?php echo base_url().'user/sociallogin/Google';?>"><i class="fa fa-google-plus-square"></i></a></li>
              <li><a href="<?php echo base_url().'user/sociallogin/Twitter';?>"> <i class="fa fa-twitter-square"></i></a></li>
              <li><a href="<?php echo base_url().'user/sociallogin/LinkedIn';?>"> <i class="fa fa-linkedin-square"></i> </a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="forgot-holder" style="display:none">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Lost Password</h4>
        </div>
        <div class="modal-body">
          <p class="forgot_error_msg error-helful bg-danger" style="display:none"><i class="fa fa-times-circle"></i> Invalid Username or Password</p>
          <p class="forgot_success_msg error-helful bg-success" style="display:none"><i class="fa fa-times-circle"></i> Invalid Username or Password</p>
          <form method="post" name="forgot_user" id="forgot_user"    onsubmit="return doForgot()">
            <p>Please enter your username or email address. You will receive a new password via email.</p>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control required email" id="forgotusername" alt="Email"  placeholder="Email address">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
            <span style="display:none" class="loader-btn load-forgot-image"><i class="fa fa-spinner fa-pulse"></i></span>
            <div class="form-group"> <span class="pull-left rememberMe"> </span> <span class="pull-right signUp"> Already have an account? <a href="javascript:void(0)" onclcik="loginblock()" id="login-block">Login instead</a> </span> </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/stickUp.min.js" ></script> 
<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/layout.js" ></script>
</body>
</html>
