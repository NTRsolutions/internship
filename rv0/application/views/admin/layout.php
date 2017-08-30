<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Gj</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.notice.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" type="text/css" />
 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script>
  var admin_baseurl = 'http://localhost/cms/admin/';
</script>
</head>

<body>

<div class="mainwrapper">
    
    <div class="header">
        <div class="logo">
            <a href="dashboard"><img src="<?php echo base_url();?>assets/images/logo.png" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
               	<?php $userdata = $this->session->userdata('scms_admin_users');	?>
                <li class="right">
                    <div class="userloggedinfo">
                                 
                        <div class="userinfo">
						
                            <h5><?=$userdata->admin_displayname?> <small>- <?=$userdata->admin_email?></small></h5>
                            <ul>
                                <li><a href="<?php echo base_url();?>admin/edituserprofile_1">Edit Profile</a></li>
                                <li><a href="<?php echo base_url();?>admin/changepassword1">Change password</a></li>
                                <li><a href="<?php echo base_url();?>admin/logout">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>
    
    <div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Menu</li>
                <li class="active"><a href="<?php echo base_url();?>admin/dashboard"><span class="iconfa-laptop"></span> Dashboard</a></li>
                 
                
                <li class="dropdown"><a href=""><span class="iconfa-th-list"></span>Location managment</a>
                	<ul  <?php if($leftmenu=='country' || $leftmenu=='addcountry' || $leftmenu=='state'|| $leftmenu=='addstate' || $leftmenu=='city' || $leftmenu=='addcity' || $leftmenu=='town' || $leftmenu=='addtown'){ ?> style="display:block;" <?php } ?>>
                    	<li class="<?php if($leftmenu=='addcountry'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/country/addCountry">Add Country</a></li>
                        <li class="<?php if($leftmenu=='country'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/country">List Countries</a></li>
                        <li class="<?php if($leftmenu=='addstate'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/state/addState">Add State</a></li>
                        <li class="<?php if($leftmenu=='state'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/state">List States</a></li>
                        <li class="<?php if($leftmenu=='city'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/city">List City</a></li>
                        <li class="<?php if($leftmenu=='addcity'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/city/addCity">Add City</a></li>
                       <li class="<?php if($leftmenu=='addtown'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/town/addTown">Add Town</a></li>
                       <li class="<?php if($leftmenu=='town'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>admin/town">List Town</a></li>
                    </ul>
                </li> 
                
                 
                      
                 <li class="dropdown"><a href=""><span class="iconfa-th-list"></span>Follow managment</a>
                	<ul>
                    	<li ><a href="<?php echo base_url();?>admin/follow">Follwoing list</a></li>
                         
                    </ul>
                </li> 
               
                                     
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    
        <?php echo $body; ?>
 
    
</div><!--mainwrapper-->

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.notice.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mjs.nestedSortable.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validation.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/upload.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cookie.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/elements.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
<script>
initSample();
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
</body>
</html>
