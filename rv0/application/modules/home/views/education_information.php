<div class="main-content news-page educational-details">
  <div class="col-lg-12">
    <form id="menu5" name="" action="<?php echo base_url();?>home/saveedu" method="POST" onsubmit="return formSubmit('menu5')">
      <div class="contact-form profile-container">
        <div class="page-header">
          <h4>Profile Details</h4>
        </div>
        <div class="mainprofession ">
          <?php 
		  $i=0;
		  $ui = 0;
		    $industry=array('Entertainment','Machinery','Telecommunications','Chemicals','Food & Beverage','Not For Profit','Consulting','Hospitality','Shipping','Banking','Energy','Environmental','Manufacturing','Transportation','Communication','Government','Recreating','Education','Insurance','IT','Biotechnology','Engineering','Finance','Media','Utilities','Construction','Healthcare','Retail','Apparel','Electronics','Agriculture','Business','Pharmaceutical','Other'); 
			      
				    $firstYear =   1970;
                   $lastYear = date('Y');
		  if(count($profession)>0)
		  {
			 
			  
				   ?>
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
                <input type="text" class="form-control " placeholder="Please specify"  name="prof[<?php echo $pk; ?>][other_industry]" value="<?php if(isset($pv->other_industry)){echo $pv->other_industry;} ?>" />
              </div>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="exampleInputPassword1">Company</label>
              <input type="text" class="form-control required" alt="Company" placeholder="Other" name="prof[<?php echo $pk; ?>][company]" value="<?php if(isset($pv->company)){echo $pv->company;} ?>" />
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="exampleInputPassword1">Profession</label>
              <input type="text" class="form-control required" alt="Profession" name="prof[<?php echo $pk; ?>][profession]" value="<?php if(isset($pv->profession)){echo $pv->profession;} ?>" id="" placeholder="">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="exampleInputPassword1">Time Period</label>
              <div class="select-control form-inline">
                <div class="inline-cntainer"> <span class="">From</span>
                  <select class="form-control required" alt="Time Period" name=prof[<?php echo $pk; ?>][from] >
                    <option value="">From</option>
                    <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
                    <option <?php if($pv->from==$y){?> selected="selected" <?php }?>  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
                  </select>
                </div>
                <div class="inline-cntainer"> <span class="">To</span>
                  <select class="form-control required" alt="Time Period" name=prof[<?php echo $pk;?>][to] >
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
            <a class="add-btn" href="javascript:void(0)" onclick="addProfessionFields()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Profession</a> </div>
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
              <input type="text" alt="Company" class="form-control required"  name="prof[0][company]" value="" />
            </div>
            <div class="form-group col-lg-6 col-md-6 ">
              <label for="exampleInputPassword1">Profession</label>
              <input type="text" alt="Profession" class="form-control required" name="prof[0][profession]" id="" placeholder="">
            </div>
            <div class="form-group col-lg-6 col-md-6 ">
              <label for="exampleInputPassword1">Time Period</label>
              <div class="select-control form-inline">
                <div class="inline-cntainer"> <span class="">From</span>
                  <select class="form-control required" alt="Time Period" name=prof[0][from]>
                    <option value="">From</option>
                    <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     {?>
                    <option  value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
                     
                  </select>
                </div>
                <div class="inline-cntainer"> <span class="">To</span>
                  <select class="form-control required" alt="Time Period" name=prof[0][to]>
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
            <a class="add-btn" href="javascript:void(0)" onclick="addProfessionFields()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Profession</a> <a class="remove-btn" style="display:none;" href="javascript:void(0)" onClick="removeProfession('+c+')"><i class="fa fa-times" aria-hidden="true"></i> Remove</a> </div>
          <?php }
		  ?>
        </div>
        <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
        <input type="hidden" id="proVal" name="proVal" value="<?php echo $i; ?>">
        <input type="hidden" name="profiledata" value="profession">
        <!-- <button type="submit" onClick="profilrupdate('menu5','profession');" class="btn btn-default">Save Changes</button>
      </form>--> 
      </div>
      <div class="contact-form profile-container">
        <div class="page-header">
          <h4>Educational Details</h4>
        </div>
        <div class="tabbing-container">
          <ul class="nav nav-pills" id="education-tab-header">
            <li class="active"><a data-toggle="tab" href="#home">School Graduation</a></li>
            <li><a data-toggle="tab" href="#images">Under Graduation</a></li>
            <li><a data-toggle="tab" href="#menu1">Post Graduation</a></li>
            <li><a data-toggle="tab" href="#menu5"  onClick="tabclick('phd');">PHD</a></li>
            <!--<li><a data-toggle="tab" href="#menu6">Alumni Interest</a></li>-->
          </ul>
        </div>
        <div class="page-content tab-content profile-details"> 
          <!-- <form class=""  method="post" action="<?php echo base_url();?>home/profileupdate">-->
          <div id="home" class="tab-pane fade in active">
            <div class="col-xs-12">
              <h5 class="educational-heading">School Graduation :-</h5>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="school_name" alt="School Name" value="<?php echo $school->school_name;?>" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10 text-left">
              <label for="exampleInputPassword1">Year of Passed Out</label>
              <div class="select-control"> <span class="year" alt="School Year of Passed Out" >
                <select class="form-control" name="school_passout_year" alt="School passout year">
                  <option value="">----</option>
                  <?php for($i=1980; $i<=date(Y); $i++){?>
                  <option <?php if($i==$school->school_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php } ?>
                </select>
                </span> </div>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Location</label>
              <input type="text" class="form-control" alt="School Location"  value="<?php echo $school->school_location;?>" name="school_location" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="btn-group col-lg-10"> 
              <!-- <button type="submit" class="btn btn-default save-btn">Save Changes</button>--> 
              
              <a class="btn btn-default next-btn" data-toggle="tab" href="#images" >Next</a> 
              <!--<a class="btn btn-default previous-btn">Previous</a>--> 
              
            </div>
          </div>
          <div id="images" class="ug-details tab-pane fade">
            <div class="col-xs-12">
              <h5 class="educational-heading">Under Graduation :-</h5>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" alt="Undergraduation name" name="undergraduation_name" value="<?php echo $undergraduation->undergraduation_name;?>" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10 text-left">
              <label for="exampleInputPassword1">Year of Passed Out</label>
              <div class="select-control"> <span class="year">
                <select class="form-control" name="undergraduation_passout_year" alt="Undergraduation Year of Passed Out">
                  <option value="">----</option>
                  <?php for($i=1980; $i<=date(Y); $i++){?>
                  <option <?php if($i==$undergraduation->undergraduation_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php } ?>
                </select>
                </span> </div>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Specification</label>
              <input type="text" class="form-control" alt="Undergraduation Specification" value="<?php echo $undergraduation->undergraduation_specification;?>" name="undergraduation_specification" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Location</label>
              <input type="text" class="form-control" alt="Undergraduation Location" value="<?php echo $undergraduation->undergraduation_location;?>" name="undergraduation_location" id="exampleInputEmail1" placeholder="">
            </div>
            <input type="hidden" name="profiledata" value="undergraduation">
            <div class="btn-group col-lg-10">
              <!--<button type="submit" class="btn btn-default save-btn">Save Changes</button>-->
              <a class="btn btn-default next-btn" data-toggle="tab" href="#menu1">Next</a> <a class="btn btn-default previous-btn" data-toggle="tab" href="#home">Previous</a> </div>
          </div>
          <div id="menu1" class="pg-details tab-pane fade">
            <div class="col-xs-12">
              <h5 class="educational-heading">Post Graduation :-</h5>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" alt="Postgraduation Name" value="<?php echo $postgraduation->postgraduation_name;?>" name="postgraduation_name" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Specification</label>
              <input type="text" class="form-control" alt="Postgraduation Specification" value="<?php echo $postgraduation->postgraduation_specification;?>" name="postgraduation_specification" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10 text-left">
              <label for="exampleInputPassword1">Year of Passed Out</label>
              <div class="select-control"> <span class="year">
                <select class="form-control" alt="Postgraduation Year of Passed Out" name="postgraduation_passout_year">
                  <option value="">----</option>
                  <?php for($i=1980; $i<=date(Y); $i++){?>
                  <option <?php if($i==$postgraduation->postgraduation_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php } ?>
                </select>
                </span> </div>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Location</label>
              <input type="text" class="form-control"  alt="Postgraduation Location" value="<?php echo $postgraduation->postgraduation_location;?>" name="postgraduation_location" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="btn-group col-lg-10">
              <!--<button type="submit" class="btn btn-default save-btn">Save Changes</button>-->
              <a class="btn btn-default next-btn" data-toggle="tab" href="#menu5" onClick="tabclick('phd');">Next</a> <a class="btn btn-default previous-btn" data-toggle="tab" href="#images">Previous</a> </div>
          </div>
          <div id="menu5" class="phd-details tab-pane fade">
            <div class="col-xs-12">
              <h5 class="educational-heading">PHD :-</h5>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" alt="Phd Name" value="<?php echo $phd->phd_name;?>" name="phd_name" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Specification</label>
              <input type="text" class="form-control" alt="Phd Specification" value="<?php echo $phd->phd_specification;?>" name="phd_specification" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group col-lg-10 text-left">
              <label for="exampleInputPassword1">Year of Passed Out</label>
              <div class="select-control"> <span class="year">
                <select class="form-control" name="phd_passout_year" alt="Phd Year of Passed Out">
                  <option value="">----</option>
                  <?php for($i=1980; $i<=date(Y); $i++){?>
                  <option <?php if($i==$phd->phd_passout_year){?>selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php } ?>
                </select>
                </span> </div>
            </div>
            <div class="form-group col-lg-10">
              <label for="exampleInputEmail1">Location</label>
              <input type="text" class="form-control" alt="Phd Location" value="<?php echo $phd->phd_location;?>" name="phd_location" id="exampleInputEmail1" placeholder="">
            </div>
            <input type="hidden" name="profiledata" value="school">
            <div class="btn-group col-lg-10">
             <!-- <button type="submit" class="btn btn-default save-btn">Save Changes</button>-->
              
              <!--<a class="btn btn-default next-btn" data-toggle="tab" href="#menu6" >Next</a>   --> 
              <a class="btn btn-default previous-btn" data-toggle="tab" href="#menu1">Previous</a> </div>
          </div>
          <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
        </div>
      </div>
      <div  class="contact-form profile-container">
        <div class="page-header">
          <h4>Alumni Interest</h4>
          <hr>
        </div>
        <div class="form-group col-lg-12">
          <label for="exampleInputEmail1">Name</label>
          <?php //$alumni=json_decode($alumniinterest->interestName);
            foreach($alumniinterest as $k=>$v){?>
          <div class="intrest-list">
            <input type="checkbox" class="" <?php if(in_array($v->ID,$userinterest)){?> checked="checked"<?php }  ?> name="user_interest[]" value="<?php echo $v->ID;?>" >
            <label><?php echo $v->interestName;?></label>
            </div>
            <?php } ?>
          
        </div>
         <div class="row">
        <input type="hidden" name="profiledata" value="userinterest">
        <div class="btn-group">
          <button type="submit" class="btn btn-default save-btn">Save Changes</button>
        </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>

<script>
function addProfessionFields(){
	 var iniVal=$('#proVal').val();
	 var c = parseInt(iniVal)+1;
     var appenddatra = '<div class="profession profession-add col-lg-12 col-xs-12 remove'+c+' ">\
	                 <div class="form-group col-lg-6 col-md-6 ">\
                      <label for="exampleInputPassword1">Industry</label>\
            <div class="select-control"> <span class="">\
              <select class="form-control required"  onChange="otherIndustry(this.value,\''+c+'\')"  name="prof['+c+'][industry]" alt="Industry">\
                <option value="">select industry</option>\
					                    <option value="Entertainment">Entertainment</option>\
                                        <option value="Machinery">Machinery</option>\
                                        <option value="Telecommunications">Telecommunications</option>\
                                        <option value="Chemicals">Chemicals</option>\
                                        <option value="Food & Beverage">Food & Beverage</option>\
                                        <option value="Not For Profit">Not For Profit</option>\
                                        <option value="Consulting">Consulting</option>\
                                        <option value="Hospitality">Hospitality</option>\
                                        <option value="Shipping">Shipping</option>\
                                        <option value="Banking">Banking</option>\
                                        <option value="Energy">Energy</option>\
                                        <option value="Environmental">Environmental</option>\
                                        <option value="Manufacturing">Manufacturing</option>\
                                        <option value="Transportation">Transportation</option>\
                                        <option value="Communication">Communication</option>\
                                        <option value="Government">Government</option>\
                                        <option value="Recreating">Recreating</option>\
                                        <option value="Education">Education</option>\
                                        <option value="Insurance">Insurance</option>\
                                        <option value="IT">IT</option>\
                                        <option value="Biotechnology">Biotechnology</option>\
                                        <option value="Engineering">Engineering</option>\
                                        <option value="Finance">Finance</option>\
                                        <option value="Media">Media</option>\
                                        <option value="Utilities">Utilities</option>\
                                        <option value="Construction">Construction</option>\
                                        <option value="Healthcare">Healthcare</option>\
                                        <option value="Retail">Retail</option>\
                                        <option value="Apparel">Apparel</option>\
                                        <option value="Electronics">Electronics</option>\
										<option value="Agriculture">Agriculture</option>\
										<option value="Business">Business</option>\
										<option value="Pharmaceutical">Pharmaceutical</option>\
                                        <option value="other">other</option>\
              </select>\
              </span> </div>\
			   <div style="display:none" class="form-group col-lg-6 col-md-6 text-other other_'+c+'">\
                 <input type="text" class="form-control" placeholder="Please specify"  name="prof['+c+'][other_industry]" value="" />\
                 </div>\
          </div>\
		     <div class="form-group col-lg-6 col-md-6">\
                <label for="exampleInputPassword1">Company</label>\
                <div class="select-control">\
				<input type="text" class="form-control required" alt="Company"  name="prof['+c+'][company]" value="" />\
				 </div>\
              </div>\
		   <div class="form-group form-group-clear col-lg-6 col-md-6 ">\
            <label for="exampleInputPassword1">profession</label>\
             <input type="text" class="form-control required" alt="profession" name="prof['+c+'][profession]" id="" placeholder=""></div>\
		   <div class="form-group col-lg-6 col-md-6">\
  <label for="exampleInputPassword1">Time Period</label>\
  <div class="select-control form-inline">\
    <div class="inline-cntainer"> <span class="">From</span>\
      <select class="form-control required" alt="Time Period" name="prof['+c+'][from]">\
        <option value="">From</option>\
        <option value="1970">1970</option>\
<option value="1971">1971</option>\
<option value="1972">1972</option>\
<option value="1973">1973</option>\
<option value="1974">1974</option>\
<option value="1975">1975</option>\
<option value="1976">1976</option>\
<option value="1977">1977</option>\
<option value="1978">1978</option>\
<option value="1979">1979</option>\
<option value="1980">1980</option>\
<option value="1981">1981</option>\
<option value="1982">1982</option>\
<option value="1983">1983</option>\
<option value="1984">1984</option>\
<option value="1985">1985</option>\
<option value="1986">1986</option>\
<option value="1987">1987</option>\
<option value="1988">1988</option>\
<option value="1989">1989</option>\
<option value="1990">1990</option>\
<option value="1991">1991</option>\
<option value="1992">1992</option>\
<option value="1993">1993</option>\
<option value="1994">1994</option>\
<option value="1995">1995</option>\
<option value="1996">1996</option>\
<option value="1997">1997</option>\
<option value="1998">1998</option>\
<option value="1999">1999</option>\
<option value="2000">2000</option>\
<option value="2001">2001</option>\
<option value="2002">2002</option>\
<option value="2003">2003</option>\
<option value="2004">2004</option>\
<option value="2005">2005</option>\
<option value="2006">2006</option>\
<option value="2007">2007</option>\
<option value="2008">2008</option>\
<option value="2009">2009</option>\
<option value="2010">2010</option>\
<option value="2011">2011</option>\
<option value="2012">2012</option>\
<option value="2013">2013</option>\
<option value="2014">2014</option>\
<option value="2015">2015</option>\
<option value="2016">2016</option>\
<option value="2017">2017</option>\
      </select>\
    </div>\
    <div class="inline-cntainer"> <span class="">To</span>\
      <select class="form-control required" alt="Time Period" name="prof['+c+'][to]">\
        <option value="">To</option>\
        <option value="1970">1970</option>\
<option value="1971">1971</option>\
<option value="1972">1972</option>\
<option value="1973">1973</option>\
<option value="1974">1974</option>\
<option value="1975">1975</option>\
<option value="1976">1976</option>\
<option value="1977">1977</option>\
<option value="1978">1978</option>\
<option value="1979">1979</option>\
<option value="1980">1980</option>\
<option value="1981">1981</option>\
<option value="1982">1982</option>\
<option value="1983">1983</option>\
<option value="1984">1984</option>\
<option value="1985">1985</option>\
<option value="1986">1986</option>\
<option value="1987">1987</option>\
<option value="1988">1988</option>\
<option value="1989">1989</option>\
<option value="1990">1990</option>\
<option value="1991">1991</option>\
<option value="1992">1992</option>\
<option value="1993">1993</option>\
<option value="1994">1994</option>\
<option value="1995">1995</option>\
<option value="1996">1996</option>\
<option value="1997">1997</option>\
<option value="1998">1998</option>\
<option value="1999">1999</option>\
<option value="2000">2000</option>\
<option value="2001">2001</option>\
<option value="2002">2002</option>\
<option value="2003">2003</option>\
<option value="2004">2004</option>\
<option value="2005">2005</option>\
<option value="2006">2006</option>\
<option value="2007">2007</option>\
<option value="2008">2008</option>\
<option value="2009">2009</option>\
<option value="2010">2010</option>\
<option value="2011">2011</option>\
<option value="2012">2012</option>\
<option value="2013">2013</option>\
<option value="2014">2014</option>\
<option value="2015">2015</option>\
<option value="2016">2016</option>\
<option value="2017">2017</option>\
      </select>\
    </div>\
  </div>\
</div>\
<a class="remove-btn" href="javascript:void(0)" onClick="removeProfession('+c+')"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>\
 </div>';
	 $('.mainprofession').append(appenddatra);
	 $('#proVal').val(c)
	
}
function otherIndustry(val,keyval){
 if(val=="other"){
	  $(".other_"+keyval).removeAttr("style");	
	}
	else{
	$(".other_"+keyval).hide();	
	}
}
function removeProfession(id){
	 
	$('.remove'+id).remove();
}

$(document).ready(function(){
	$(".next-btn").on('click',function(){
		$("#education-tab-header li.active").removeClass("active").next("li").attr("class","active");
	});
	$(".previous-btn").on("click",function(){
		$("#education-tab-header li.active").removeClass("active").prev("li").attr("class","active");
	});
});
function tabclick(val){
	if(val=='phd'){
		$('.tab-pane').removeClass('active in');
		$('.ug-details').removeClass('active in');
		$('.pg-details').removeClass('active in ');
		$('.phd-details').addClass('active in');
		$('.userinterest').removeClass('active in');
	}
}
</script> 
