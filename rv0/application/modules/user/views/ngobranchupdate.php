<!--main Content-->


<div class="main-content register-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Update Branch details.</h1>
       
    </div> 
  </div>
  <div class="col-lg-12">
    <div class="row">
      <form method="post"  class=""   name="register_update" id="register_update" action="<?php echo base_url('user/insertbranchdetails'); ?>"  onsubmit="return formSubmit('register_update')">
        <?php if($success_msg!='') { ?>
        <p class="error-helful bg-success"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
        <?php } ?>
        <?php if($error_msg!='') { ?>
        <p class="error-helful bg-danger"><i class="fa fa-times-circle"></i> </i> <?php echo $error_msg; ?></p>
        <?php } ?>
        <div class="col-lg-6 account-details">
          <h4 class="widget-heading"></h4>
          
		   <?php $org =getorgtype(); ?>
		    <?php // print_r($org);?>
		   <?php if($org[0]->organizationType=="college"){  ?>
          <div class="form-group">
            <label for="exampleInputPassword1">Branch Name <span>*</span></label>
			 
             <?php $branches=getBranchesdata();//print_r($branches); ?>
					 <?php// $gbu=getBrancheuserdata();?>
					 
					<select onChange="getCoursesdata(this.value)" class="form-control required" id="branch_name" alt="Branch" name="branch_name">
					  <option value="">Select Branch</option>
					  <?php foreach($branches as $k=>$v){ ?>
					  <option value="<?php echo $v->organizationName;?>" <?php if($branchname==$v->organizationName){?>selected="selected"<?php } ?>><?php echo $v->organizationName; ?></option>
					    <?php } ?>
					</select>
					  
          </div>
		   <?php } ?>
		   
		  <div class="form-group">
            <label for="exampleInputPassword1">Pass out Year <span>*</span></label>
			  <?php $firstYear =   1960;
                   $lastYear = $firstYear +56; 
				   ?>
				   <select class="form-control required" id="passout_year" alt="Pass out year" name="passout_year">
                       <option value="">Select Pass out year</option>
                      <?php 
                    for($y=$firstYear;$y<=$lastYear;$y++)
                     { ?>
					   <option value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php  } ?>
					</select>
		  </div>
		   <?php if($org[0]->organizationType=="college"){  ?>
		    
		   <div  class="form-group courselist" id="courselist">
            <label for="exampleInputPassword1">Course <span>*</span></label>
			 <div class="course"></div>
            
          </div>
			 <?php } ?>
		  
		   
          <input type="submit" class="btn btn-primary pull-right" value="Submit" >
        </div>
         </form>
    </div>
  </div>
</div>
<script>
   $( document ).ready(function() {
	 $("#branch_name").trigger( "change" );
});
 
  function getCoursesdata(val){
 
	          $.ajax({
						url: base_url+'user/getCourseName',
						type: 'POST',
						data: "orgname="+val,  
						success: function(data)
						 {var obj = jQuery.parseJSON(data);
						 console.log(obj);
						 
						 if(obj==null){
							  
							 $('#courselist').hide();
						 }else{
						 var str="";
						   var str='<select id="course" alt="Course" name="course" class="form-control required">';
						        str+='<option value="">select course</option>';
							$.each(obj, function( k, v ) {
								str+='<option value="'+v+'">'+v+'</option>';
							 });
							str+='</select>';
							$('#courselist').show();
							$('.course').html(str);	
						 }
							  //alert(str);
							   
							  
							 
						 }
						 
					});
	   
   }
  
   
</script>
   
 
