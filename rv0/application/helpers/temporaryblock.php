<?php
session_start();
date_default_timezone_set ("UTC" );
function remainingTime($to,$from)
    {
        $mydate=date('Y-m-d H:i:s');
        $to_time = strtotime(urldecode($to));
        $from_time = strtotime($mydate);
        return ceil(round(abs($to_time - $from_time),2));
        if(remainingTime<1):
            header('Location: '.$_COOKIE['whda_whd_url']);
        endif;
    }
  $remainingtime= remainingTime($_COOKIE['whda_whd_endtime'],$_COOKIE['whda_whd_starttime'])
?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>My WHDMS - Temporary IP Blocked</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>


<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/login/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/login/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/login/css/global.css" rel="stylesheet" type="text/css"/>
<link href="assets/login/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link href="assets/login/css/custome.css" rel="stylesheet" type="text/css"/>
<!-- End GLOBAL MANDATORY STYLES -->
<link rel="shortcut icon" href="assets/login/images/favicon.png"/>
<style>
    .mytimerdata{
        position: relative;
    }
     #mytimer {
    color: #00a1f1;
    font-size: 80px;
    font-weight: 300;
}
.mytimertext {
       color: #747474;
    font-size: 18px;
    left: 158px;
    position: absolute;
    top: 44px;
}
 </style>
</head>
<body style="overflow-x: hidden !important;">
<!--    RESOLUTION ERRROR-->
        <div style="display: none" id="errorbox" class="whd_error_overlay">
         <div class="whd_error_top_strip">
             <div class="logo">
                 <a href="">
                     <img src="assets/login/images/logo.png" style=" margin: 0 auto;" class="img-responsive">
                 </a>
             </div>
        <div class="whd_error_box col-md-8 col-sm-12 col-xs-12"> 
                 <div class="whd_error_header col-md-12 text-center">
                     <h1>Sorry ! We don't support this screen resolution</h1>
                 </div>
         </div>
        </div>
        </div>
 <!--    RESOLUTION ERRROR-->   
 
    <div class="whd-container fullpage-wrap row">
        <div class="whd-login-holder col-md-4 col-sm-8 col-xs-10">
            <div class="whd-logo-holder">
                <div class="whd-logo">
                    <a href="">
                        <img src='assets/login/images/logo.png' alt="WHDMS" height="50"  />
                    </a>
                </div>
            </div>
            <div class="whd-login-form">
                <div class="whd-form-title">
                    Your IP has been temporarily blocked!
                </div>
                <form class="whd-form" style="padding: 0px 30px;">
                    <div class="form-group" >
      This IP has been temporarily blocked because of security concerns.
     

      <div class="mytimerdata">
          <span id="mytimer"><?=$remainingtime?></span> 
      <span class="mytimertext">seconds to <br> release block </span> 
      </div> 
                  
                    </div>

<!--                    <div class="back-footer-link">Go back <a href="login">Login</a></div>-->
                </form>
                 <div class="clearfix"></div>
            </div>
            
            
        </div>
    </div>
     <div class="lfooter">
        <div class="text">
        <div class="pull-left">
         &copy; 2015 <a href="<?=$_COOKIE['whda_whd_url']?>" class="linktohome">WHDMS.com</a> All Rights reserved. 
         
        </div>
        <div class="pull-right">
        My.WHDMS v<?=$_COOKIE['whda_whd_version']?>
        </div>
        <div class="clearfix"></div>
        </div>
        </div>
 <!--[if lt IE 9]>
<script src="assets/login/plugins/respond.min.js"></script>
<script src="assets/login/plugins/excanvas.min.js"></script> 
<![endif]-->
<!--[if lt IE 9]>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->
<script src="assets/login/plugins/jquery.min.js" type="text/javascript"></script>
<script src='assets/login/plugins/jquery-ui.min.js'></script>
<script src="assets/login/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/login/plugins/bootstrap/js/bootstrap.js" type="text/javascript"></script>    
<script src="assets/login/plugins/custumescroll/jquery.nicescroll.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {    
            "use strict";     
        //    $("body").niceScroll({styler:"fb",cursorcolor:"#888888", cursorwidth: '6', cursorborderradius: '0px', background: '#cccccc', autohidemode: false, spacebarenabled:false,  cursorborder: ''});  
       
  
        var count=<?=$remainingtime?>;

        var counter=setInterval(timer, 1000); //1000 will  run it every 1 second   
        function timer()
        {
          count=count-1;
          if (count <= 0)
          {
             clearInterval(counter);
              window.location = "<?=$_COOKIE['whda_whd_url']?>";
             return;
          }
          
          if(count.toString().length <3)
          {
              document.getElementById("mytimer").innerHTML='0'+count; // watch for spelling
          }
          else if(count.toString().length <2)
          {
              document.getElementById("mytimer").innerHTML='00'+count; // watch for spelling
          }
          else              
	  {
	        document.getElementById("mytimer").innerHTML=count; // watch for spelling
	  }
        }    
    });
  </script>
</body>
</html>
