<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.form.js"></script>

<div class="main-content news-page">
  <div class="col-lg-12 user_profile">
    <div class="contact-form profile-container">
      <div class="page-header">
        <h1>Profile Details</h1>
       
      </div>
      <div class="tabbing-container">
        <ul class="nav nav-pills">
          <li class="active"><a data-toggle="tab" href="#home">Basic</a></li>
          <li><a data-toggle="tab" href="#images">Upload Profile Image</a></li>
          <li><a data-toggle="tab" href="#menu1">Education Details</a></li>
          <li><a data-toggle="tab" href="#menu5">Profession</a></li>
          <li><a data-toggle="tab" href="#menu6">User Interest</a></li>
		  <li><a data-toggle="tab" href="#menu7">User Roles</a></li>
        </ul>
      </div>
      <div class="page-content tab-content profile-details">
        <form class="tab-pane fade in active"method="post"  name="userprofiledata" enctype="multipart/form-data" action="<?php echo base_url();?>user/profileupdate" id="home" onSubmit="return formSubmit('home')">
          <?php if($success_msg!='') { ?>
          <p class="error-helful bg-success" id="bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
          <?php $success_msg ='';}else{ ?>
          <p class="error-helful bg-success" style="display:none"><i class="fa fa-check-circle-o"></i></p>
          <?php } ?>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <label for="exampleInputEmail1">Display Name (required)</label>
            <input type="text" class="form-control required" name="display_name" value="<?php echo $user->display_name;?>" alt="Display Name" placeholder="">
          </div>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <label for="exampleInputPassword1">First Name</label>
            <input type="text" class="form-control required" name="first_name" value="<?php echo $user->first_name;?>" alt="First Name" placeholder="">
          </div>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control required" name="last_name" value="<?php echo $user->last_name;?>" alt="Last Name"  placeholder="">
          </div>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <label for="exampleInputEmail1">Mobile Number</label>
            <input type="text" class="form-control required numeric" name="mobile" id="mobile" value="<?php echo $user->mobile;?>" alt="Mobile Number"  placeholder="">
            <?php if(!$user->sms_verified) { ?>
            <a class="verifylink" href="<?php echo base_url().'verifymobile'?>">Verify <abbr title="Get quick updates from your institution by verifying your mobile number."><i class="fa fa-question-circle-o" aria-hidden="true"></i> </abbr></a>
            <?php  }else{ ?>
            <a class="verifiedlink" href="<?php echo base_url().'verifymobile'?>"><i class="fa fa-check"></i> Verified</a>
            <?php } ?>
          </div>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12 text-left">
            <label for="exampleInputPassword1">Date of Birth	(required)</label>
			 <?php $a=explode('-',$user->dob);?>
            <div class="select-control"> <span class="month" >
              <select class="form-control required" name="dob_month" alt="Birthday Month">
                <option <?php if($a[1]=='00'){?>selected="selected"<?php } ?>value="">----</option>
                <option <?php if($a[1]=='01'){?>selected="selected"<?php } ?> value="01">January</option>
                <option <?php if($a[1]=='02'){?>selected="selected"<?php } ?> value="02">February</option>
                <option <?php if($a[1]=='03'){?>selected="selected"<?php } ?> value="03">March</option>
                <option <?php if($a[1]=='04'){?>selected="selected"<?php } ?> value="04">April</option>
                <option <?php if($a[1]=='05'){?>selected="selected"<?php } ?> value="05">May</option>
                <option <?php if($a[1]=='06'){?>selected="selected"<?php } ?> value="06">June</option>
                <option <?php if($a[1]=='07'){?>selected="selected"<?php } ?> value="07">July</option>
                <option <?php if($a[1]=='08'){?>selected="selected"<?php } ?> value="08">August</option>
                <option <?php if($a[1]=='09'){?>selected="selected"<?php } ?> value="09">September</option>
                <option <?php if($a[1]=='10'){?>selected="selected"<?php } ?> value="10">October</option>
                <option <?php if($a[1]=='11'){?>selected="selected"<?php } ?> value="11">November</option>
                <option <?php if($a[1]=='12'){?>selected="selected"<?php } ?> value="12">December</option>
              </select>
              </span> <span class="date">
              <select class="form-control required" name="day" alt="Birthday Date">
                <option value="">----</option>
                <?php for($i=1; $i<32; $i++){?>
                <option <?php if($i==$a[2]){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> 
              <span class="year">
              <select class="form-control required" name="year" alt="Birthday Year">
                <option value="">----</option>
                <?php for($i=1900; $i<=date(Y)-15; $i++){?>
                <option <?php if($i==$a[0]){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <?php $org =getorgtype();?>
         <?php if($org[0]->organizationType!="ngos"){  ?>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12 text-left">
            <label for="exampleInputPassword1">Year of Passed Out	(required)</label>
            <div class="select-control"> <span class="year">
              <select class="form-control required" name="passout_year" alt="Year of Passed Out">
                <option value="">----</option>
                <?php for($i=1946; $i<=date(Y); $i++){?>
                <option <?php if($i==$user->passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <?php } ?>
          <input type="hidden" name="profiledata" value="home">
          
          <button class="btn btn-primary" onClick="profilrupdate('home','home');"  type="submit">Save Changes</button>
        </form>
        <form class="tab-pane fade"method="post"   name="userprofiledata" enctype="multipart/form-data" action="<?php echo base_url();?>user/profileupdate" id="images" onSubmit="return formSubmit('images')">
		  
          <div class="profile-thumb col-lg-2 col-md-2 col-sm-4 col-xs-12  pull-right">
            <?php if(isset($user->profile_thumb_image) && $user->profile_thumb_image!=''){?>
            <img id="profilethumb" src="<?php echo base_url();?>resize.php?src=<?php echo $user->profile_thumb_image;?>&w=122&h=122">
            <input type="hidden" id="socialthumb" value="<?php echo $user->profile_image;?>">
            <?php } else{ ?>
            <img id="profilethumb" src="<?php echo ASSETS;?>assets/img/user-thumb.jpg">
            <input type="hidden" id="socialthumb" value="<?php echo ASSETS;?>assets/img/user-thumb.jpg">
            <?php } ?>
            <div style="display:none" class="profile-buttons">
              <div class="fblogin"> <a href="#"   onclick="return fbAuth('<?php echo $user->id; ?>','<?php echo ORGANISAION_NAME; ?>');">Share profile image</a> </div>
              <div class="sharepic" style="display:none"> <a href="javascript:void(0)" onclick="share_pic('<?php echo $user->id; ?>','<?php echo ORGANISAION_NAME; ?>');">Share image</a> </div>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12 img-container">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 upload-photo">
              <div class="input-file">
                <label for="exampleInputEmail1" class="btn btn-default btn-file"><i class="fa fa-plus" aria-hidden="true"></i> Upload Photo
                  <input type="file" id="userimage" class="form-control inputfile" name="user_image"  value="" placeholder="">
                </label>
              </div>
            </div>
            <div style="display:none" class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 choose-photo"> <a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-picture-o" aria-hidden="true"></i> Choose From Gallery</a> </div>
          </div>
        </form>
        <form class="tab-pane fade" id="menu1" method="post" action="<?php echo base_url();?>user/profileupdate" onSubmit="return false">
          <div style="display:none" class="edu_sucess">Please Fill the details</div>
		  <div class="col-xs-12">
            <h5 class="educational-heading">School Graduation :-</h5>
          </div>
		  
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="school_name" alt="School Name" value="<?php echo $school->school_name;?>" id="sname" placeholder="">
          </div>
          <div class="form-group col-lg-10 text-left">
            <label for="exampleInputPassword1">Year of Passed Out</label>
            <div class="select-control"> <span class="year" alt="School Year of Passed Out" >
              <select class="form-control" id="syear" name="school_passout_year" alt="School passout year">
                <option value="">----</option>
                <?php for($i=1980; $i<=date(Y); $i++){?>
                <option <?php if($i==$school->school_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Location</label>
            <input type="text" class="form-control" alt="School Location"  value="<?php echo $school->school_location;?>" name="school_location" id="slocation" placeholder="">
          </div>
          <div class="col-xs-12">
            <h5 class="educational-heading">Under Graduation :-</h5>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" alt="Undergraduation name" name="undergraduation_name" value="<?php echo $undergraduation->undergraduation_name;?>" id="uname" placeholder="">
          </div>
          <div class="form-group col-lg-10 text-left">
            <label for="exampleInputPassword1">Year of Passed Out</label>
            <div class="select-control"> <span class="year">
              <select class="form-control" id="uyear" name="undergraduation_passout_year" alt="Undergraduation Year of Passed Out">
                <option value="">----</option>
                <?php for($i=1980; $i<=date(Y); $i++){?>
                <option <?php if($i==$undergraduation->undergraduation_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Specification</label>
            <input type="text" class="form-control" alt="Undergraduation Specification" value="<?php echo $undergraduation->undergraduation_specification;?>" name="undergraduation_specification" id="uspecification" placeholder="">
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Location</label>
            <input type="text" class="form-control" alt="Undergraduation Location" value="<?php echo $undergraduation->undergraduation_location;?>" name="undergraduation_location" id="ulocation" placeholder="">
          </div>
          <input type="hidden" name="profiledata" value="undergraduation">
          <div class="col-xs-12">
            <h5 class="educational-heading">Post Graduation :-</h5>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" alt="Postgraduation Name" value="<?php echo $postgraduation->postgraduation_name;?>" name="postgraduation_name" id="pname" placeholder="">
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Specification</label>
            <input type="text" class="form-control" alt="Postgraduation Specification" value="<?php echo $postgraduation->postgraduation_specification;?>" name="postgraduation_specification" id="pspecification" placeholder="">
          </div>
          <div class="form-group col-lg-10 text-left">
            <label for="exampleInputPassword1">Year of Passed Out</label>
            <div class="select-control"> <span class="year">
              <select class="form-control" id="pyear" alt="Postgraduation Year of Passed Out" name="postgraduation_passout_year">
                <option value="">----</option>
                <?php for($i=1980; $i<=date(Y); $i++){?>
                <option <?php if($i==$postgraduation->postgraduation_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Location</label>
            <input type="text" class="form-control"  alt="Postgraduation Location" value="<?php echo $postgraduation->postgraduation_location;?>" name="postgraduation_location" id="plocation" placeholder="">
          </div>
          <div class="col-xs-12">
            <h5 class="educational-heading">PHD :-</h5>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" alt="Phd Name" value="<?php echo $phd->phd_name;?>" name="phd_name" id="phd_name" placeholder="">
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Specification</label>
            <input type="text" class="form-control" alt="Phd Specification" value="<?php echo $phd->phd_specification;?>" name="phd_specification" id="phd_specification" placeholder="">
          </div>
          <div class="form-group col-lg-10 text-left">
            <label for="exampleInputPassword1">Year of Passed Out</label>
            <div class="select-control"> <span class="year">
              <select class="form-control" name="phd_passout_year" id="phd_year" alt="Phd Year of Passed Out">
                <option value="">----</option>
                <?php for($i=1980; $i<=date(Y); $i++){?>
                <option <?php if($i==$phd->phd_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              </span> </div>
          </div>
          <div class="form-group col-lg-10">
            <label for="exampleInputEmail1">Location</label>
            <input type="text" class="form-control" alt="Phd Location" value="<?php echo $phd->phd_location;?>" name="phd_location" id="phd_location" placeholder="">
          </div>
          <input type="hidden" name="profiledata" value="school">
          <button type="submit" onClick="profilrupdate('menu1','school');" class="btn btn-default">Save Changes</button>
        </form>
        <form class="tab-pane fade" id="menu5"   method="post" action="<?php echo base_url();?>user/profileupdate" onsubmit="return false">
          <div class="mainprofession ">
            <?php 
		  $i=0;
		  $ui = 0;
		  $industry=array('Entertainment','Machinery','Telecommunications','Chemicals','Food & Beverage','Not For Profit','Consulting','Hospitality','Shipping','Banking','Energy','Environmental','Manufacturing','Transportation','Communication','Government','Recreating','Education','Insurance','IT','Biotechnology','Engineering','Finance','Media','Utilities','Construction','Healthcare','Retail','Apparel','Electronics','Agriculture','Business','Pharmaceutical','Other');  
			      
				    $firstYear =   1970;
                   $lastYear = date('Y');
		  if(count($profession)>0)
		  { ?>
            <?php foreach($profession as $pk=>$pv) { $i=$pk; $ui++;?>
            <div class="profession col-lg-12 col-xs-12 remove<?php echo $pk ?> "  >
              <div class="form-group col-lg-6 col-md-6">
                <label for="exampleInputPassword1">Industry</label>
                
				 <div class="select-control">
                  <select  onChange="otherIndustry(this.value,<?php echo $pk;?>)" class="form-control required" name="prof[<?php echo $pk; ?>][industry]" alt="Industry">
                    <option value="">select industry</option>
					<?php foreach($industry as $ik=>$iv){ ?>
                    <option <?php if($pv->industry==$iv){?> selected="selected" <?php }?>   value="<?php echo $iv; ?>"><?php echo $iv; ?></option>
                    <?php } ?>
                  </select>
                </div>
				  
				 <div <?php if(isset($pv->industry) && $pv->industry=="other"){ ?> style="display:block" <?php } else{ ?>style="display:none"<?php } ?> class="form-group col-lg-6 col-md-6 text-other other_<?php echo $pk;?>">
                <input type="text" class="form-control"   placeholder="Please specify"  name="prof[<?php echo $pk; ?>][other_industry]" value="<?php if(isset($pv->other_industry)){echo $pv->other_industry;} ?>" />
                 </div>
				 
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label for="exampleInputPassword1">Company</label>

				<input type="text" class="form-control required" placeholder="" alt="Company" name="prof[<?php echo $pk; ?>][company]" value="<?php if(isset($pv->company)){echo $pv->company;} ?>" />
			
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label for="exampleInputPassword1">Profession</label>
                <input type="text" class="form-control required" alt="profession" name="prof[<?php echo $pk; ?>][profession]" value="<?php if(isset($pv->profession)){echo $pv->profession;} ?>" id="" placeholder="">
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label for="exampleInputPassword1">Time Period</label>
                <div class="select-control form-inline">
                  <div class="inline-cntainer"> <span class="">From</span>
                    <select class="form-control required" alt="To Year" name=prof[<?php echo $pk; ?>][from]>
                      <option value="">From</option>
                      <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
					   <option <?php if($pv->from==$y){?> selected="selected" <?php }?>  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
					   
                    </select>
                  </div>
                  <div class="inline-cntainer"> <span class="">To</span>
                    <select class="form-control required" alt="From Year" name=prof[<?php echo $pk;?>][to]>
                      <option value="">To</option>
					   <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
					   <option <?php if($pv->to==$y){?> selected="selected" <?php }?>  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
					    
					 </select>
                  </div>
                </div>
              </div>
			  
			   <?php if($ui!=1) { ?>
			  <a class="remove-btn" href="javascript:void(0)" onClick="removeProfession(<?php echo $pk; ?>)"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>
			   <?php } ?>
            
			<a class="add-btn" href="javascript:void(0)" onclick="addProfessionFields()">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Add Profession</a>
			</div>
            <?php } ?>
            <?php }else{ ?>
            <div class="profession col-lg-12 col-xs-12">
              <div class="form-group col-lg-6 col-md-6 ">
                <label for="exampleInputPassword1">Industry</label>
                <div class="select-control">
                  <select  class="form-control required" onChange="otherIndustry(this.value,'0')" name="prof[0][industry]" alt="Industry">
                    <option value="">select industry</option>
					<?php foreach($industry as $ik=>$iv){ ?>
                    <option   value="<?php echo $iv; ?>"><?php echo $iv; ?></option>
                    <?php } ?>
                  </select>
			    </div>
                <div class="form-group col-lg-6 col-md-6 other_0 text-other"  style="display:none" >
                 
                <input type="text" class="form-control" placeholder="Please specify" name="prof[0][other_industry]" value="" />
              </div>
              </div>
			  
			  
			  
                <div class="form-group col-lg-6 col-md-6">
                <label for="exampleInputPassword1">Company</label>
               
				<input type="text" class="form-control required" alt="Company"  name="prof[0][company]" value="" />
				
              </div>
              <div class="form-group col-lg-6 col-md-6 ">
                <label for="exampleInputPassword1">Profession</label>
                <input type="text" class="form-control required" alt="profession" name="prof[0][profession]" id="" placeholder="">
              </div>
              <div class="form-group col-lg-6 col-md-6 ">
                <label for="exampleInputPassword1">Time Period</label>
                <div class="select-control form-inline">
                  <div class="inline-cntainer"> <span class="">From</span>
                    <select class="form-control required" alt="From period" name=prof[0][from]>
					 <option value="">From</option>
					<?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
					   <option  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
                     </select>
                  </div>
                  <div class="inline-cntainer"> 
					  <span class="">To</span>
                    <select class="form-control required" alt="Time period" name=prof[0][to]>
                      <option value="">To</option>
                      <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
					   <option  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
					      
                    </select>
                  </div>
                </div>
              </div>
 
 
              <a class="add-btn" href="javascript:void(0)" onclick="addProfessionFields()">
				  <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Profession</a> 
				  <a class="remove-btn" style="display:none;" href="javascript:void(0)" onClick="removeProfession('+c+')">
					  <i class="fa fa-times" aria-hidden="true"></i> Remove</a>
               </div>
         
           
 
 
             <!-- <a class="add-btn" href="javascript:void(0)" onclick="addProfessionFields()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Profession</a> 
			  
			  </div>-->
          
 
          <?php }
		  ?>
          
          </div>
      
      <input type="hidden" id="proVal" name="proVal" value="<?php echo $i; ?>">
          <input type="hidden" name="profiledata" value="profession">
	   
      <button type="submit" onClick="profilrupdate('menu5','profession');" class="btn btn-default">Save Changes</button>
	 </form> 
		<form class="tab-pane fade"method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>user/profileupdate" id="menu6" onSubmit="return false">
          <?php if($success_msg!='') { ?>
          <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
          <?php }else{ ?>
          <p class="error-helful bg-success" style="display:none"><i class="fa fa-check-circle-o"></i></p>
          <?php } ?>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12 userintrest-container">
            <h4 for="exampleInputEmail1">User Interests :- </h4>
            <?php //$alumni=json_decode($alumniinterest->interestName);
            foreach($alumniinterest as $k=>$v){?>
            
            <div class="intrest-list">
              <label class="left">
            	<input type="checkbox" class="left" <?php if(in_array($v->ID,$userinterest)){?> checked="checked"<?php }  ?> name="user_interest[]" value="<?php echo $v->ID;?>" >
          
            <?php echo $v->interestName;?>
            </label>
            </div>
            
            
            <?php } ?>
          </div>
          <input type="hidden" name="profiledata" value="userinterest">
          <button type="submit" onClick="profilrupdate('menu6','userinterest');" class="btn btn-default">Save Changes</button>
        </form>
		<form class="tab-pane fade "method="post" name="userprofiledata" enctype="multipart/form-data" action="<?php echo base_url();?>user/profileupdate" id="menu7" onSubmit="return false">
          <?php if($success_msg!='') { ?>
          <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
          <?php }else{ ?>
          <p class="error-helful bg-success" style="display:none"><i class="fa fa-check-circle-o"></i></p>
          <?php } ?>
          <div class="form-group col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <label for="exampleInputEmail1">User Roles </label>
             <?php $roles =getRoles(); $r=explode(",",$role);?>
			 <label for="exampleInputEmail1">Select Role <span>*</span></label>
			   <?php $role; if($roles[0]->id!=''){?>
			<select name="signup_role[]" multiple id="signup_role" class="form-control required role" alt="Select Role">
			 <?php foreach($roles as $k=>$v){?>
			<option <?php if(in_array($v->id,$r)){ ?> selected="selected" <?php } ?> value="<?php echo $v->id; ?>"><?php echo $v->name;?></option>
			 <?php } ?>
			</select>
			  <?php } ?>
			
          </div>
          <input type="hidden" name="profiledata" value="userrole">
          <button type="submit" onClick="profilrupdate('menu7','userrole');" class="btn btn-default">Save Changes</button>
        </form>
        
    </div>
	
        
  </div>
</div>

</div>
<!-- crop container-->

<div id="doCrop" class="docrop-design" style="display:none">
  <div class="crop-design-main">
    <input type="hidden" name="current_large_image_width" id="current_large_image_width" value="0" />
    <input type="hidden"name="current_large_image_height" id="current_large_image_height"  value="0"  />
    <input type="hidden"name="random_key" id="random_key"  value=""  />
    <h2>Crop profile image</h2>
    <a onclick="createThumb()" href="javascript:void(0)" >Save</a> <a class="cancle-btn" onclick="closeCrop()" href="javascript:void(0)" >Cancel</a>
    <div align="center" class="thumbContainer"> <img src="" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
      <div style="border:1px #e5e5e5 solid; float:right; position:relative; overflow:hidden; width:160px; height:160px;"> <img src="" style="position: relative;" id="croper" alt="Thumbnail Preview" /> </div>
      <br style="clear:both;"/>
      <input type="hidden" name="x1" value="" id="x1" />
      <input type="hidden" name="y1" value="" id="y1" />
      <input type="hidden" name="x2" value="" id="x2" />
      <input type="hidden" name="y2" value="" id="y2" />
      <input type="hidden" name="w" value="" id="w" />
      <input type="hidden" name="h" value="" id="h" />
    </div>
  </div>
</div>

<!-- end crop container --> 

<!-- cover image crop container

<div id="cover_doCrop" class="docrop-design"  style="display:none">
  <div class="cover-crop-design-main">
    <input type="hidden" name="cover_current_large_image_width" id="cover_current_large_image_width" value="0" />
    <input type="hidden"name="cover_current_large_image_height" id="cover_current_large_image_height"  value="0"  />
    <input type="hidden"name="cover_random_key" id="cover_random_key"  value=""  />
    <h2>Crop cover page</h2>
    <a onclick="createCoverpage()" href="javascript:void(0)" class="save-btn" >Save</a> <a class="cancle-btn" onclick="closeCoverCrop()" href="javascript:void(0)" >Cancel</a>
    <div align="center"> <img  src="" style="float: left; margin-right: 10px;" id="cover_thumbnail" alt="Create Cover page" />
      <div style="display:none;border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:1290px; height:334px;"> <img src="" style="position: relative;" id="cover_croper" alt="Thumbnail Preview" /> </div>
      <br style="clear:both;"/>
      <input type="hidden" name="x3" value="" id="x3" />
      <input type="hidden" name="y3" value="" id="y3" />
      <input type="hidden" name="x4" value="" id="x4" />
      <input type="hidden" name="y4" value="" id="y4" />
      <input type="hidden" name="cw" value="" id="cw" />
      <input type="hidden" name="ch" value="" id="ch" />
    </div>
  </div>
</div>-->
<div class="modal fade login-container search-image-container" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog col-lg-12 col-md-12 col-sm-12 col-xs-12" role="document">
    <div class="modal-content">
      <div class="login-holder">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Search Image</h4>
        </div>
        <div class="modal-body">
          <form method="post" name="search_image" id="search_image"   onsubmit="return false">
            <div class="form-group">
              <?php //$cookies=get_cookie(rightlink_username);print_r($cookies);exit?>
              <div class="input-group">
                <div class="input-group-addon">
                  <button onClick="getImageSearch()" class="btn btn-primary">Search</button>
                </div>
                <input type="text" class="username-input form-control required" name="search" value="" id="search" placeholder="Name or Hall Ticket Number" alt="Hall Ticket Number">
                <i class="fa fa-search" aria-hidden="true"></i> </div>
            </div>
          </form>
          <div id="scrollbox5">
            <div id="searchdata" style="display:none;"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- end crop container --> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/validation.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/profile.js"></script> 
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.imgareaselect.min.js"></script> 

 
