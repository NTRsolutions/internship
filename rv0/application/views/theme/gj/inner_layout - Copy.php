<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--facebook tags-->
      <script>var fbkey='<?php echo FacebookID; ?>';</script>
      <?php $facebook=facebookTags(); //print_r($facebook);exit;?>
      <meta property="fb:app_id" content="1091549324229299">
      <meta property="og:url" content="<?php echo $facebook['pageUrl']; ?>">
      <meta property="og:image" content="<?php echo $facebook['imageUrl']; ?>">
      <meta property="og:description" content="<?php echo $facebook['description']; ?>">
      <meta property="og:title" content="<?php echo $facebook['pageTitle']; ?>">
      <meta property="og:site_name" content="<?php echo $facebook['siteTitle']; ?>">
      <meta property="og:see_also" content="<?php echo $facebook['homepageUrl']; ?>">
      <!-- facebook tags end-->
      <title><?php echo ORGANISAION_NAME; ?></title>
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS;?>assets/img/favicon-16x16.png">
      <!-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>-->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
      <!-- Bootstrap -->
      <link href="<?php echo ASSETS;?>assets/css/bootstrap.min.css" rel="stylesheet">
      <!--<link href="<?php echo ASSETS;?>assets/css/font-awesome.min.css" rel="stylesheet">-->
      <link href="<?php echo ASSETS;?>assets/css/stickup.css" rel="stylesheet">
      <link href="<?php echo ASSETS;?>assets/css/custom-styles.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
              
                $gb=getBranchdetails();
         	  
         		$org =getorgtype();
         		//print_r($org);exit;
         		  if($org[0]->organizationType=="college"){ 
         		        if(empty($gb[0]->branch_name) || empty($gb[0]->passout_year) || empty($gb[0]->course)){  ?>
      <script>
         window.close();
         <?php if($gb[0]->provider=='Facebook'){?>
         window.location.href="<?php echo base_url();?>user/brachUpdate/";
         <?php }else{ ?>
         window.opener.location="<?php echo base_url();?>user/brachUpdate/";
         <?php } ?>
      </script>
      <?php }else{ ?>
      <script>
         window.close(); 
         //window.location.href="<?php echo base_url();?>";
         window.opener.location.reload();
         //window.opener.location='';
      </script>
      <?php 	}  } ?>
      <?php if($org[0]->organizationType=="school"){ 
         if(empty($gb[0]->passout_year)){  ?>
      <script>
         window.close();
         <?php if($gb[0]->provider=='Facebook'){?>
         window.location.href="<?php echo base_url();?>user/brachUpdate/";
         <?php }else{ ?>
         window.opener.location="<?php echo base_url();?>user/brachUpdate/";
         <?php } ?>
          
      </script>
      <?php }else{?>
      <script>
         window.close();
         window.opener.location.reload();
         //window.location.href="<?php echo base_url();?>";
         //window.opener.location="<?php echo base_url();?>user/brachUpdate/";
         //window.opener.location.reload();
         //window.opener.location='';
      </script>
      <?php 	} ?>
      <?php } ?>
      <?php if($org[0]->organizationType=="ngos"){   
         if(empty($gb[0]->branch_name)){  ?>
      <script>
         window.close();
         <?php if($gb[0]->provider=='Facebook'){?>
         window.location.href="<?php echo base_url();?>user/brachUpdate/";
         <?php }else{ ?>
         window.opener.location="<?php echo base_url();?>user/brachUpdate/";
         <?php } ?>
      </script>
      <?php }else{ ?>
      <script>
         window.close();
         window.opener.location.reload();
         //window.opener.location='';
      </script>
      <?php 	}  } ?>
      <?php } ?>
      <!-- end window -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script>
         var base_url='<?php echo base_url();?>';
         var assets = '<?php echo ASSETS; ?>'; 
      </script>
   </head>
   <?php $layout_session = $this->session->userdata('logged_in');?>
   <body id="mainBody" <?php if($layout_session['user']['id']!=''){?> class="body-container" <?php }else{ ?> class="<?php echo THEMECOLOUR; ?>" <?php } ?>>
      <?php  $getcondata=getOrgData(); ?>
      <div class="site-container" id="site-container">
         <header class="navbar-static-top">
            <nav class="navbar navbar-default ">
               <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                     <?php if(HEADERLOGO==''){ ?>
                     <a class="navbar-brand" href="<?php echo base_url();?>"><img width="" src="<?php echo ASSETS;?>assets/img/rightlink.png"></a>
                     <?php }else{ ?>
                     <a class="navbar-brand" href="<?php echo base_url();?>"><img width="" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=50"></a>
                     <?php } ?>
                     <?php $layout_session = $this->session->userdata('logged_in'); ?>
                     <div class="pull-right login-strip">
                        <ul class="nav navbar-nav navbar-right profile-menu profile-menu-desktop">
                           <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                           <li class="notifi-count">
                              <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu2" title="Notifications" data-toggle="dropdown" aria-haspopup="true" onClick="updatepoststatus();" aria-expanded="true"><i class="fa fa-bell" aria-hidden="true"></i>
                              <?php $a = Getposts(); if($a!=0){?>
                              <span class="badge" id="badge">
                              <?php
                                 // fetching the notifications count
                                 echo Getposts();
                                 ?>
                              </span>
                              <?php } ?>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="scrollbox4">
                                 <li class="posting-list-container">
                                    <ul id="layout_postdata">
                                       <?php
                                          // fetching the notifications
                                           $data = Getpostsdata(); 
                                          //print_r($data);exit;
                                          ?>
                                       <?php if(isset($data) && $data !=''){
                                          foreach($data as $p=>$q){ ?>
                                       <li id="notifiction_<?php echo $q->id; ?>">
                                          <?php if(isset($q->profile_image) && $q->profile_image!=''){ ?>
                                          <img  title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo base_url();?>resize.php?src=<?php echo $q->profile_image;?>&w=80&h=80" alt="user-thumb">
                                          <?php } else{?>
                                          <img title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
                                          <?php }?>
                                          <?php if($q->action_type=='post'){ 
                                             $url = base_url().'posts/postdetailes/'.$q->action_item_id;;
                                             }else if($q->action_type=='news'){
                                             $url = base_url().'news/newsdetails/'.$q->action_item_id;;
                                             }else if($q->action_type=='event')
                                             {
                                             $url = base_url().'events/eventsdetails/'.$q->action_item_id;;
                                             }else if($q->action_type=='newjoin') {
                                             $url = base_url().'connections/profile/'.$q->action_item_id;;
                                             }
                                             ?>
                                          <div class="post-details">
                                             <?php 
                                                $status = '';
                                                if($q->action_type=='post'){  
                                                $status = ' posted';
                                                } else  if($q->action_type=='news'){  
                                                $status = ' posted news';
                                                }else if($q->action_type=='newjoin') {
                                                $status = ' Joined';
                                                }else if($q->action_type=='campaign'){
                                                $status = 'campaign';
                                                }
                                                else
                                                {
                                                $status = ' posted event';
                                                }  
                                                ?>
                                             <a href="<?php echo $url; ?>" class="activity-title"> <?php echo $q->display_name;?> <span class="post-status"><?php echo $status; ?></span> </a>
                                             <?php 
                                                // $extstr_content = '';
                                                // if(strlen($q->activity_content)>14)
                                                // {
                                                //	 $extstr_content = '...';
                                                // }
                                                // $activity_content = substr($q->activity_content,0,14).$extstr_content;
                                                ?>
                                             <!--  <a href="<?php echo $url; ?>" class="activity-description"> <?php echo $activity_content;?> </a>-->
                                             <p class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></p>
                                          </div>
                                       </li>
                                       <?php } }else{?>
                                       <li>
                                          <p class="post-status">NO activities found..</p>
                                       </li>
                                       <?php } ?>
                                    </ul>
                                 </li>
                                 <li class="posting-list-container"><span style="display:none" class="loader-btn load-top-image"><i class="fa fa-spinner fa-pulse"></i></span></li>
                              </ul>
                              <input type="hidden" name="post_id" id="layout_loadmore_postid" value="<?php echo $id;?>">
                           </li>
                           <?php } ?>
                           <?php /* if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                           <li class="notifi-count"><a href="<?php echo base_url().'message'?>"  type="button" title="Messages"><i class="fa fa-weixin" aria-hidden="true"></i><span class="badge"><?php echo getMessagenotification(); ?></span></a> </li>
                           <?php } */ ?>
                           <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                           <?php 
                              $profile_display_name = $layout_session['user']['display_name'];
                              //$profile_display_name = $layout_session['user']['firstName'].' '.$layout_session['user']['lastName'];
                              ?>
                           <li class="user-dropdown">
                              <a href="javascript:void(0);" title="<?php echo  $profile_display_name; ?>" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
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
                                 <li <?php if($activepage=='profile'){ ?> active <?php } ?>><a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($layout_session['user']['id']); ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                                 <?php if($layout_session['user']['provider']=='rightlink'){?>
                                 <li <?php if($activepage=='changepassword'){ ?> active <?php } ?>><a href="<?php echo base_url();?>user/changepassword"><i class="fa fa-user" aria-hidden="true"></i> Change password</a></li>
                                 <?php } ?>
                                 <?php /*<li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-users" aria-hidden="true"></i> Invite Friends</a></li>  */?>
                                 <?php if($layout_session['user']['provider']=='Facebook'){?>
                                 <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>
                                 <?php }else{?>
                                 <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>
                                 <?php  } ?>
                              </ul>
                           </li>
                           <?php }else{?>
                           <li ><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock"></i>Login</a></li>
                           <!--<li class="<?php if($activepage=='register'){ ?> active <?php } ?>"><a href="<?php echo base_url('register'); ?>"><i class="fa fa-sign-in"></i>Register</a></li>-->
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --> 
            </nav>
            <div class="secondry-menu ">
               <div class="container-fluid">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav navbar-right profile-menu profile-menu-mobile">
                        <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                        <li class="notifi-count">
                           <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu2" title="Notifications" data-toggle="dropdown" aria-haspopup="true" onClick="updatepoststatus();" aria-expanded="true"><i class="fa fa-bell" aria-hidden="true"></i>
                           <?php $a = Getposts(); if($a!=0){?>
                           <span class="badge" id="badge">
                           <?php
                              // fetching the notifications count
                              echo Getposts();
                              ?>
                           </span>
                           <?php } ?>
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="scrollbox4">
                              <li class="posting-list-container">
                                 <ul id="layout_postdata">
                                    <?php
                                       // fetching the notifications
                                        $data = Getpostsdata(); 
                                       //print_r($data);exit;
                                       ?>
                                    <?php if(isset($data) && $data !=''){
                                       foreach($data as $p=>$q){ ?>
                                    <li id="notifiction_<?php echo $q->id; ?>">
                                       <?php if(isset($q->profile_image) && $q->profile_image!=''){ ?>
                                       <img  title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo base_url();?>resize.php?src=<?php echo $q->profile_image;?>&w=80&h=80" alt="user-thumb">
                                       <?php } else{?>
                                       <img title="<?php echo $q->display_name; ?>" class="user-thumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg" alt="user-thumb">
                                       <?php }?>
                                       <?php if($q->action_type=='post'){ 
                                          $url = base_url().'posts/postdetailes/'.$q->action_item_id;;
                                          }else if($q->action_type=='news'){
                                          $url = base_url().'news/newsdetails/'.$q->action_item_id;;
                                          }else if($q->action_type=='event')
                                          {
                                          $url = base_url().'events/eventsdetails/'.$q->action_item_id;;
                                          }else if($q->action_type=='newjoin') {
                                          $url = base_url().'connections/profile/'.$q->action_item_id;;
                                          }
                                          ?>
                                       <div class="post-details">
                                          <?php 
                                             $status = '';
                                             if($q->action_type=='post'){  
                                             $status = ' posted';
                                             } else  if($q->action_type=='news'){  
                                             $status = ' posted news';
                                             }else if($q->action_type=='newjoin') {
                                             $status = ' Joined';
                                             }else if($q->action_type=='campaign'){
                                             $status = 'campaign';
                                             }
                                             else
                                             {
                                             $status = ' posted event';
                                             }  
                                             ?>
                                          <a href="<?php echo $url; ?>" class="activity-title"> <?php echo $q->display_name;?> <span class="post-status"><?php echo $status; ?></span> </a>
                                          <?php 
                                             // $extstr_content = '';
                                             // if(strlen($q->activity_content)>14)
                                             // {
                                             //	 $extstr_content = '...';
                                             // }
                                             // $activity_content = substr($q->activity_content,0,14).$extstr_content;
                                             ?>
                                          <!--  <a href="<?php echo $url; ?>" class="activity-description"> <?php echo $activity_content;?> </a>-->
                                          <p class="activity-time"><?php echo time_elapsed_string(strtotime($q->date_time));?></p>
                                       </div>
                                    </li>
                                    <?php } }else{?>
                                    <li>
                                       <p class="post-status">NO activities found..</p>
                                    </li>
                                    <?php } ?>
                                 </ul>
                              </li>
                              <li class="posting-list-container"><span style="display:none" class="loader-btn load-top-image"><i class="fa fa-spinner fa-pulse"></i></span></li>
                           </ul>
                           <input type="hidden" name="post_id" id="layout_loadmore_postid" value="<?php echo $id;?>">
                        </li>
                        <?php } ?>
                        <?php /* if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                        <li class="notifi-count"><a href="<?php echo base_url().'message'?>"  type="button" title="Messages"><i class="fa fa-weixin" aria-hidden="true"></i><span class="badge"><?php echo getMessagenotification(); ?></span></a> </li>
                        <?php } */ ?>
                        <?php if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                        <?php 
                           $profile_display_name = $layout_session['user']['display_name'];
                           //$profile_display_name = $layout_session['user']['firstName'].' '.$layout_session['user']['lastName'];
                           ?>
                        <li class="user-dropdown">
                           <a href="javascript:void(0);" title="<?php echo  $profile_display_name; ?>" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
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
                              <li <?php if($activepage=='profile'){ ?> active <?php } ?>><a href="<?php echo base_url();?>connections/profile/<?php echo doEncrypt($layout_session['user']['id']); ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                              <?php if($layout_session['user']['provider']=='rightlink'){?>
                              <li <?php if($activepage=='changepassword'){ ?> active <?php } ?>><a href="<?php echo base_url();?>user/changepassword"><i class="fa fa-user" aria-hidden="true"></i> Change password</a></li>
                              <?php } ?>
                              <?php /*<li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-users" aria-hidden="true"></i> Invite Friends</a></li>  */?>
                              <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>
                           </ul>
                        </li>
                        <?php }else{?>
                        <li ><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock"></i>Login</a></li>
                        <li class="<?php if($activepage=='register'){ ?> active <?php } ?>"><a href="<?php echo base_url('register'); ?>"><i class="fa fa-sign-in"></i>Register</a></li>
                        <?php } ?>
                     </ul>
                     <ul class="nav navbar-nav navbar-left mobile-menu">
                        <li class="<?php if($activepage=='home'){ ?> active <?php } ?> dropdown" role="presentation">
                           <a class="dropdown-toggle" data-toggle=""  href="<?php echo base_url();?>home" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                           <?php $pages = getMenuurls(); $alumnicount = alumniroleurls(); $roleslist=rolesList();//print_r($pages);exit;?>
                           <?php //if($pages['count']!=0){
                              //foreach($pages['pagelist'] as $k=>$v){?>
                           <ul class="dropdown-menu">
                              <?php if($pages['pagelist']['name']=='AboutUs'){?>
                              <li><a href="<?php echo base_url();?>home/About_Us">About Us</a></li>
                              <?php }?>
                           </ul>
                           <!--<li><a href="<?php echo base_url();?>home/Present_Executive_Team">Present Executive Team</a></li>
                              <?php //}if($pages['ExecutiveCommittee']){?>
                              <li><a href="<?php echo base_url();?>home/Executive_Committee">Executive Committee </a></li>
                              <?php //}if($pages['MemorandumofAssociation']){?>
                              <li><a href="<?php echo base_url();?>home/Memorandum_of_Association">Memorandum of Association</a></li>
                              <?php //}if($pages['AwardsRecongnitioins']){?>
                              <li><a href="<?php echo base_url();?>home/Awards_Recongnitioins">Awards & Recongnitioins </a></li>
                              <?php //}?>
                              </ul>-->
                           <?php //}//} ?>
                        </li>
                        <li class="<?php if($activepage=='activity'){ ?> active <?php } ?>" ><a href="<?php echo base_url();?>activity">Activity</a></li>
                        <li class="<?php if($activepage=='connection'){ ?> active <?php } ?> dropdown" role="presentation">
                           <a class="dropdown-toggle" data-toggle="" href="javascript:void(0);" aria-haspopup="true" aria-expanded="false">Network</a>
                           <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url();?>connections">Alumni's</a></li>
                              <?php foreach($roleslist as $k=>$v){?>
                              <?php if($k!='Alumni'){?>
                              <li><a href="<?php echo base_url();?>connections/getPages/<?php echo $k;?>"><?php echo $k;?></a></li>
                              <!--<li><a href="<?php echo base_url();?>connections/distinguishedalumni">Distinguished Alumni</a></li>-->
                              <?php } } ?>
                           </ul>
                        </li>
                        <li class="<?php if($activepage=='news'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>news">News</a></li>
                        <li class="<?php if($activepage=='event'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>events">Events</a></li>
                        <li class="<?php if($activepage=='gallery'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>gallery">Gallery</a></li>
                        <?php /* if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){?>
                        <li class="<?php if($activepage=='message'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>message">Messages</a></li>
                        <?php } */ ?>
                        <li class="<?php if($activepage=='contact'){ ?> active <?php } ?>"><a href="<?php echo base_url();?>contactus">Contact us</a></li>
                        <?php  if(count($pages['more'])>0){?>
                        <li class="<?php if($activepage=='more'){ ?> active <?php } ?> dropdown">
                           <a href="javascript:void(0);">More</a>
                           <ul class="dropdown-menu">
                              <?php foreach($pages['more'] as $k=>$v){//print_r($k);exit;?>
                              <?php //if($k=='Alumni'){?>
                              <li><a href="<?php echo base_url();?>home/getmorepages/<?php echo $v['name'];?>"><?php echo $v['name'];?></a></li>
                              <!--<li><a href="<?php echo base_url();?>connections/distinguishedalumni">Distinguished Alumni</a></li>-->
                              <?php } //} ?>
                           </ul>
                        </li>
                        <?php } ?>
                     </ul>
                  </div>
                  <!-- /.navbar-collapse --> 
               </div>
            </div>
         </header>
         <?php echo $theme_body; ?> 
         <!-- main-footer -->
         <footer>
            <a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-circle-o-up"></i></a>
            <div class="col-lg-12 footer-widgets">
               <div class="row">
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 logo-widget">
                     <!--<?php if(HEADERLOGO==''){ ?>
                        <img class="footer-logo" src="<?php echo ASSETS;?>assets/img/rightlink.png">
                        <?php }else{ ?>
                        <img  class="footer-logo" src="<?php echo base_url();?>/resize.php?src=<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>&h=100">
                        <?php } ?>-->
                     <h3 class="widgettitle">About Us</h3>
                     <p>
                        <?php if(isset($getcondata[0]->about_org)){ echo $getcondata[0]->about_org;} ?>
                     </p>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 recent-post-widget">
                     <h3 class="widgettitle">Links</h3>
                     <ul class="footer-links">
                        <li><a href="<?php echo base_url();?>activity">Activity</a></li>
                        <li><a href="<?php echo base_url();?>connections">Network</a></li>
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
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 footer-contact">
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
            <div class="col-lg-12 copy-right">Copyright © <?php echo date(Y);?> NorthAlley. All Rights Reserved.</div>
         </footer>
         <?php if(!isset($layout_session['user']['id']) && $layout_session['user']['id']==''){?>
        <!--- login popup starting --->
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
                           <a href="javascript:void(0)" onclick="helpBlock()" id="helpBlock" class="help-block-btn">Forgot your password?</a>
                           <button type="submit" class="btn btn-primary"><span class="pull-left">Login</span> <span style="display:none" class="loader-btn load-layout-image"><i class="fa fa-spinner fa-pulse"></i></span></button>
                           <input type="hidden" name="dest_url" id="dest_url" value="<?php echo $dest_url; ?>"/>
                           <div class="form-group remember-widget">
                              <span class="pull-left rememberMe">
                                 <!--<label>
                                    <input type="checkbox" name="remberme" id="remberme" value="">
                                    Remember Me </label>--> 
                              </span>
                              <span class="pull-right signUp"> No account? <a href="<?php echo base_url().'register';?>">Sign up</a> </span> 
                           </div>
                        </form>
                        <div class="social-icons-widget">
                           <span>Connect with: </span>
                           <ul class="social-icons-list">
                              <li><a href="javascript:void(0)"  onclick="Login()"><i class="fa fa-facebook-square"></i></a></li>
                              <?php /* <li><a  onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Facebook?dest-url=<?php echo $dest_url; ?>')" href="javascript:void(0)"><i class="fa fa-facebook-square"></i></a></li>*/?>
                              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Google?dest-url=<?php echo $dest_url; ?>')"    href="javascript:void(0)"><i class="fa fa-google-plus-square"></i></a></li>
                              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/Twitter?dest-url=<?php echo $dest_url; ?>')"   href="javascript:void(0)"> <i class="fa fa-twitter-square"></i></a></li>
                              <li><a onclick="loginURL('<?php echo base_url(); ?>user/sociallogin/LinkedIn?dest-url=<?php echo $dest_url; ?>')"  href="javascript:void(0)"> <i class="fa fa-linkedin-square"></i> </a></li>
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
                           <p>Please enter your username or email address. You will receive a new password via Email or Mobile.</p>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                 <input type="text" class="form-control required" id="forgotusername" alt="Email or Username"  placeholder="Email or Username">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary"><span class="pull-left">Reset Password </span> <span style="display:none;" class="loader-btn load-forgot-image"><i class="fa fa-spinner fa-pulse"></i></span></button>
                           <div class="form-group"> <span class="pull-left rememberMe"> </span> <span class="pull-right signUp"> Already have an account? <a href="javascript:void(0)" onclcik="loginblock()" id="login-block">Login instead</a> </span> </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <!--- login popup ending --->  
      </div>
      <?php } ?>
      <div class="loader-bg site-wait-loader" style="display:none"></div>
      <div class="loader-icon site-wait-loader" style="display:none"><i class="fa fa-spinner fa-pulse"></i><br>
         <span>Loading please wait...</span> 
      </div>
      <!-- color panner swich starting -->
      <div id="switcher" >
         <span class="custom-close"></span> <span class="custom-show"></span>
         <div class="clearfix"></div>
         <span class="sw-title">Colors :</span> 
         <!--<ul id="de-color">
            <li class="blue"></li>
            <li class="red"></li>
            <li class="yellow"></li>
            <li class="orange"></li>
            <li class="green"></li>
            <li class="purple"></li>
            </ul>-->
         <select class="selector form-control">
            <option value="blue">Blue</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="yellow">Yellow</option>
            <option value="orange">Orange</option>
            <option value="purple">Purple</option>
         </select>
      </div>
      <?php if(isset($chat) && $chat=='not'){?>
      <?php }else{?>
      <?php  if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){ ?>
      <!--chat start-->
      <?php //$this->load->view('common/css'); ?>
      <?php $totalchatcount=totalchatcount();?>
      <link rel="stylesheet" href="<?php echo ASSETS; ?>assets/chat/css/chat.css" rel="stylesheet">
      <!--<link rel="stylesheet" href="<?php echo ASSETS; ?>assets/chat/font-awesome/css/font-awesome.min.css">-->
      <a href="javascript:void(0)" id="menu-toggle" style="display:block;" class="btn-chat btn btn-success chat-icon-design">
      <i class="fa fa-comments-o fa-3x"></i>
      <span class="badge progress-bar-danger" id="chat_count"><?php if($totalchatcount!=''){ echo $totalchatcount;}?></span>
      </a>
      <!--CHAT CONTAINER STARTS HERE-->
      <div id="chat-container" class="fixed" style="display:none;"></div>
      <!-- Header -->
      <header id="top" class="header">
         <div class="text-vertical-center"></div>
      </header>
      <?php //$this->load->view('common/javascript'); ?>
      <!--chat end-->
      <?php } }?>
      <!--  color panner swich ending --> 
      <!-- Include all compiled plugins (below), or include individual files as needed --> 
      <!-- <script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.cookie.js" ></script>
         <script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/stickUp.min.js" ></script> -->  
      <script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/layout.js" ></script> 
      <script  type="text/javascript" src="<?php echo ASSETS;?>assets/js/profile.js" ></script> 
      <?php  if(isset($layout_session['user']['id']) && $layout_session['user']['id']!=''){ ?>
      <!--chat js--> 
      <script type="text/javascript">var base = "<?php echo base_url();?>";</script> 
      <!--<script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/jquery-1.10.2.min.js"></script>
         <script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/jquery-ui.js"></script>
         <script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/bootstrap.min.js"></script>--> 
      <script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/jquery.slimscroll.js"></script> 
      <script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/main.js"></script> 
      <script type="text/javascript" src="<?php echo ASSETS; ?>assets/chat/js/chatigniter.js"></script> 
      <?php } ?>
      <script type="text/javascript">
         function getCoursesdata(val){
           
          $.ajax({
         				url: base_url+'user/getCourseName',
         				type: 'POST',
         				data: "orgname="+val,  
         				success: function(data)
         				{var obj = jQuery.parseJSON( data );
         				
         					var str='<select id="course" name="course" class="form-control required">';
         					$.each(obj, function( k, v ) {
         						str+='<option value="'+v+'">'+v+'</option>';
         						
         					});
         					str+='</select>';
         					
         				 	 $('.course').html(str);
         				 }
         				 
         			});
           
          }
      </script>
   </body>
</html>