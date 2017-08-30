<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet", integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u", crossorigin="anonymous">

 <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
     <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="http://kenwheeler.github.io/slick/slick/slick.js" type="text/javascript" charset="utf-8"></script>

  <title><?php echo ORGANISAION_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS;?>assets/img/favicon-16x16.png">

  <style>

@font-face
{
  font-family:glyphicons-halflings-regular;
  src:url(glyphicons-halflings-regular.ttf);
}
a{
  text-decoration:none;
}
active a:hover{
color:red;
}
div a:hover
{
  color:#cc0000;
  
}
.rg{ 
  color:white;
}
a:visted{
color:#cc0000;
}

.right{
   float:right;
   margin-top:10px;
  
}

nav
{
    top:40px;
  position:fixed;
  
  
}
li:hover
{
  background:orange;
}
   
nav div div ul li a:hover{
    background-color:#cc0000;
  color:#FFFF00;
}
nav div div ul li a:visited{
    background-color:#cc0000;
  color:#FFFF00;
}

.id{
   background-color:black;
   text-color:white;
   right:200px;
}
 div p{
 align:100px 100px 100px 10px;
} 
.cart
{
  color:white;
  

}
.space
{
  margin-left: 6cm;
}
 .slider {
        width: 80%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 10px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
      
    }
</style>
    <style>
@font-face
{
	font-family:glyphicons-halflings-regular;
	src:url(glyphicons-halflings-regular.ttf);
}
a{
  text-decoration:none;

}
active a:hover{
color:red;
}
div a:hover
{
  color:#cc0000;
  
}
.rg{ 
  color:white;
}
a:visted{
color:#cc0000;
}

.right{
   float:right;
   margin-top:0px;
  
}
       
nav
{
    top:40px;
	position:fixed;
	}
        
.navbar-inverse {
    background-color:#213345 ;
    border-color:#213345;
}
li:hover
{
	background:orange;
}
   
nav div div ul li a:hover{
    background-color:#cc0000;
	color:#FFFF00;
}
nav div div ul li a:visited{
    background-color:#cc0000;
	color:#FFFF00;
}

id{
   background-color:#19334d;
   text-color:white;
   right:200px;
}
 div p{
 align:100px 100px 100px 10px;
}	
.cart
{
	color:white;
	

}
.space
{
	margin-left: 6cm;
}
.navbar-fixed-top
{

  position: fixed;
  right: 0;
  left: 0;
  z-index: 1030;
}
.transcolor{
    background: white; 
     
    
}
</style>


</head>
<body>
    <div class="navbar-fixed-top transcolor">
             <div style="margin:15px 10px -30px 20px;"> 
              <?php if(HEADERLOGO==''){ ?>
                               <a  href="<?php echo base_url();?>" style="margin-top:20px;"><img width="" src="<?php echo ASSETS;?>assets/img/rightlink.png"></a>
                               <?php }else{ ?>
              <a class="navbar-brand" href="<?php echo base_url();?>" style="margin-top:10px";><img width="" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=20"></a>
                               <?php } ?>
              </div>


          <div class="right">
          <i class="fa fa-lock" style="font-size:16px"></i><a href="#" style="margin-right:20px;text-decoration: none;color:black">&nbsp;Login</a>
          <i class="fa fa-sign-in" style="font-size:16px"></i><a  href="#" style="margin-right:20px;text-decoration:none;color:black">&nbsp;Register</a>
          </div>

          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <ul class="nav navbar-nav ">
          	  
                <li style="margin-left:10px;" ><a href="<?php echo base_url('users/User_control');?>" >Home</a></li>
                <li ><a href="#">Activity</a></li>
                <li><a href="#">Network</a></li>
                <li><a href="#">News</a></li>
          	  <li><a href="#">Events</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Store</a></li>
          	  <li><a href="#">Contact us</a></li>
          	   <li class="space"><a href="<?php echo base_url('store/cart_details');?>" class="cart"><span class="fa fa-shopping-cart " style="font-size:12px">&nbsp;</span>Cart&nbsp;<span class="badge white" id="cartno"><?php echo $no_products;?></span></a></li>
          	  </ul>
          	 </div>
	 </div>

 </nav>
  </div>