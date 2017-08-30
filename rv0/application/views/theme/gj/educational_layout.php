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

<!-- close social window -->

<?php 
  
//if user click cancel not login, then i just close the popup window
 if ($closeReloadWindow=='close'){
	 
        echo "<script>
            window.close();
            </script>";
}
 
//only if valid session found and loginsucc is set
if ($closeReloadWindow=='reload'){
     
 
        echo "<script>
            window.close();
            window.opener.location.reload();
            </script>";
} ?>
 <!-- end window -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	var base_url='<?php echo base_url();?>';
	var assets = '<?php echo ASSETS; ?>'; 
	
	

</script>
</head>
<body id="mainBody" class="<?php echo THEMECOLOUR; ?>">
<?php  $getcondata=getOrgData(); ?>
<div class="site-container" id="site-container">
  <header class="navbar-static-top">
    <nav class="navbar navbar-default ">
      <div class="container-fluid"> 
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <?php if(HEADERLOGO==''){ ?>	
		   <a class="navbar-brand" href="#"><img width="190" src="<?php echo ASSETS;?>assets/img/rightlink.png"></a> </div>
        <?php }else{ ?>
        <a class="navbar-brand" href="#"><img width="190" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=50"></a> </div>
      <?php } ?>
      <?php $layout_session = $this->session->userdata('logged_in');?>
	   
      <!-- Collect the nav links, forms, and other content for toggling -->
      
      <!-- /.navbar-collapse --> 
      
      <!-- /.container-fluid --> 
    </nav>
    <div class="secondry-menu container-fluid">
      
    </div>
  </header>
  <?php echo $theme_body; ?> 
  
  <!-- main-footer -->
  
  <footer> <a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-circle-o-up"></i></a>
    <div class="col-lg-12 footer-widgets">
      <div class="row">
        
        
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 footer-contact">
          <h3 class="widgettitle">Contact Us</h3>
          <div class="postings-container">
            <address>
            <?php if(isset($getcondata[0]->contact_address)){ echo  $getcondata[0]->contact_address;} ?>
            </address>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 copy-right">Copyright © <?php echo date('Y');?> NorthAlley. All Rights Reserved.</div>
  </footer>
  
</div>

<!-- Include all compiled plugins (below), or include individual files as needed --> 

<!-- <script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.cookie.js" ></script> --> 

<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/stickUp.min.js" ></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/validation.js"></script>
<script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/layout.js" ></script> 


</body>
</html>
