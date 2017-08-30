<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="base-style" href="<?php echo base_url('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url('bootstrap/css/style.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/halflings.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/glyphicons.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>" rel="stylesheet">
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url('bootstrap/css/style.css');?>" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url('bootstrap/css/style-responsive.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/halflings.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/glyphicons.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/fullcalendar.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>" rel="stylesheet">

	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/font-awesome-ie7.min.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/halflings.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/glyphicons.css');?>" rel="stylesheet">
	<link id="bootstrap-style" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>" rel="stylesheet">
	<!-- end: CSS -->
	<!-- start: JavaScript-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('bootstrap/js/jquery-1.9.1.min.js');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/jquery-migrate-1.0.0.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery-ui-1.10.0.custom.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.ui.touch-punch.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/modernizr.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.cookie.js');?>"></script>
	
		<script src='<?php echo base_url('bootstrap/js/fullcalendar.min.js');?>'></script>
	
		<script src='<?php echo base_url('bootstrap/js/jquery.dataTables.min.js');?>'></script>

		<script src="<?php echo base_url('bootstrap/js/excanvas.js');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/jquery.flot.js');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/jquery.flot.pie.js');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/jquery.flot.stack.js');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/jquery.flot.resize.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.chosen.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.uniform.min.js');?>"></script>
		
		<script src="<?php echo base_url('bootstrap/js/jquery.cleditor.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.noty.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.elfinder.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.raty.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.iphone.toggle.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.uploadify-3.1.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.gritter.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.imagesloaded.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.masonry.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.knob.modified.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/jquery.sparkline.min.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/counter.js');?>"></script>
	
		<script src="<?php echo base_url('bootstrap/js/retina.js');?>"></script>

		<script src="<?php echo base_url('bootstrap/js/custom.js');?>"></script>
	<!-- end: JavaScript-->	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('bootstrap/img/favicon.ico');?>" >
	<!-- end: Favicon -->
	<style type="text/css">
		#content
		{
			float:left;
		}

		input[type="text"]
		{
			height: 30px;
		}
		.viewproduct_div
		{
			float:left;
		}
		.addproduct_btn
		{
			float:left;
		}
		.d
		{
			background: red;
		}
		#prod_details
		{
		
			background: white;
		}
		.righticon
		{
			color:green;
		}
		.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}
#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
	</style>
	
		
		
</head>

<body>
 <!--<div id="errors"></div>-->
		<!-- start: Header -->
	    <div class="navbar" style="margin-bottom:0px;">
      <div class="navbar-inner">
        
     
          <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#">Rightlink cms</a>
     
          
        
          <div class="nav-no-collapse header-nav">
						<ul class="nav pull-right">
				          <li class="dropdown">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="halflings-icon white user"></i> User
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li class="dropdown-menu-title">
		 									<span>Account Settings</span>
										</li>
										<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
										<li><a href="<?php echo base_url('product/logout');?>"><i class="halflings-icon off"></i> Logout</a></li>
									</ul>
								</li>
								<!-- end: User Dropdown -->
							</ul>
				</div>
				<!-- end: Header Menu -->
     
        </div>
      </div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						
						<li>
							<a href="http://localhost/new/rv0/collections/"><i class="icon-folder-close-alt"></i><span>Collections</span></a>
							
						</li>
						<li>
							<a  href="http://localhost/new/rv0/product/"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Products</span><span class="caret"></span></a>
								
						</li>
						<li><a href="http://localhost/new/rv0/category/"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Categories</span></a></li>
						
					</ul>
				</div>
			</div>
			</div>


			<!-- end: Main Menu -->