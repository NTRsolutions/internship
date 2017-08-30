
 <ul class="breadcrumb">
     <li><a href="#"><?php echo $this->lang->line('admin_site_home'); ?><span class="divider">/</span></a></li>
     <li class="active"><?php echo $this->lang->line('admin_site_set_settings'); ?> <span class="divider">/</span></li>
     <li class="active"><a href="#"><?php echo $this->lang->line('admin_site_add'); ?></a></li>
</ul>
 <!--<div style="display:none" id="success_message"></div>
 <div style="display:none" id="error_message"></div>-->
<div class="breadcrumbs span12">
	<div class="span2 hed-name">
    	<h3 class="heading-name"><?php echo $this->lang->line('admin_site_set_settings'); ?></h3>
    </div>
    <div class="span2 add-button ">
     
        
    </div>
	
</div>
 <!--<div class="error_message span12">
 <div  id="success_message" class="alert alert-success span4" ></div>
 <div  id="error_message" class="alert alert-error span4"></div>  
 </div>-->         
 <form method="post" id="settings_form" action="" onsubmit="return formSubmit(this.id)" class="form-horizontal login-form">
		 <div class="control-group email-password"> <label for="inputEmail" class="control-label Old-Password"><?php echo $this->lang->line('admin_site_set_dateformate'); ?></label>
			 <div class="controls">
			       <select id="dateformate"   class="span7 required" alt="<?php echo $this->lang->line('admin_site_set_dateformate'); ?>" onChange="datevalue(this.value)"  name="dateformate">
				<option value="1">dd-mm-yy</option>
				<option value="2">yy-mm-dd</option>
				<option value="3">dd-yy-mm</option>
				<option value="4">mm-yy-dd</option>
				<option value="5">yy-dd-mm</option>
			      </select>
			  </div>
              </div>
		 
		  
            
          <div class="control-group email-password">
          	<label class="control-label Old-Password"><?php echo $this->lang->line('admin_site_set_perpage'); ?></label>
            <div class="controls">
                    <select id="perpage"   class="span7 required" alt="<?php echo $this->lang->line('admin_site_set_perpage'); ?>" name="perpage">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
		   </select>
            </div>
          </div>
		  
           <div class="controls ">
		   <a href="javascript:void(0)" id="setting_submit">
           <button class="btn btn-primary submit-but" type="button"><?php echo $this->lang->line('admin_site_submit') ?></button>
           </a>
           </div>
 </form> 	
 <script>
 $(document).ready(function(){
	    
                   $('#setting_submit').click(function(){
                       if(formSubmit('settings_form')){
                         var dateformate =$('#dateformate').val();
                         var perpage=$('#perpage').val();
				         $.ajax({
				 		    type: "POST",
				 		    url: "<?php echo base_url();?>admin/settings",
				 		    data: "dateformate="+dateformate+"&perpage="+perpage,
				 		    success: function(result) {
					 		      var data=$.parseJSON(result);
					 		      if(data.status)
				 		      {
								  jQuery.noticeAdd({
										 text: data.success,
										 stay: false,
									     type: 'success'
									});
 				 		      }else{
								   jQuery.noticeAdd({
										text: data.failure,
										stay: false,
										type: 'error'
									});
								  
				 		    	    
				 		    	   
				 		      }
				 		    }
				 	     })
                       }        
                  })
 });
 </script>
