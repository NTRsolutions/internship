<?php include "page_template.php";?>
			
			<!-- start: Content -->
			<?php $value=$data[0]; ?>
			<div id="content" class="span10 content">
						
					 <!-- content starts here-->
					 <div id="after" style="display:none">
 										 <div id="errors"></div> 
 									</div> 
					 					 
							 <div id="prod_details">
							 
								<div style="margin-left: 5px" class="table-responsive">
								 <form method="post" id="product_form">
								  	<table class="table" >
								  		 <tbody>
									      <tr>
												 <td><div class="form-group">
													  <label >Product Name:</label>
													  <input type="text" class="form-control" value="<?php echo $value->p_name; ?>" id="p_name" name="p_name" required>
													</div></td>
													
											 	
										  </tr>
										  <tr>
										    <td>Description<br>
										    <textarea cols="5" id="discription" name="discription" required><?php echo $value->discription; ?></textarea>
										    </td><td>
										     <div class="form-group">
														  <label >Category</label>
														  <select class="form-control" name="Category"  id="Category" required>
														  

														    <option value=""></option>
														  <?php
														  	foreach ($category as $k => $v) {?>
																<option <?=$v->c_name == $value->p_category ? ' selected="selected"' : '';?> ><?php echo $v->c_name;?></option>

																<?php }?>	


														    
														  </select>
													</div>
													</td>
													<td><div class="form-group">
													  <label >Quantity:</label>
													  <input type="text" class="form-control" value="<?php echo $value->quantity; ?>"  name="qty" onkeypress="return isNumber(event)" required>
													</div></td>
													</td>
										  </tr>
										  <tr>
										  <th>Pricing</th>
										  </tr>
										  <tr>
												 <td>
												 	<div class="form-group">
													  <label >Offer Price:</label>
													  <input type="text" class="form-control" name="o_price" id="o_price" value="<?php echo $value->o_price; ?>" onkeypress="return isNumber(event)" required>
													</div>
													<div class="form-group">
													  <label >Retails price:</label>
													  <input type="text" class="form-control" name="r_price" id="r_price" value="<?php echo $value->r_price; ?>" onkeypress="return isNumber(event)" required>
													</div>
													<div class="form-group">
													  <label >Sale Price:</label>
													  <input type="text" class="form-control" id="s_price" name="s_price" value="<?php echo $value->s_price; ?>" onkeypress="return isNumber(event)" required>
													</div>
													
												 </td>
											 	 <td>
											 	 	<b>Image</b>
												 	 <input type="file" name="img" value="<?php echo $value->img; ?>" size="20" id="img">
												 	Upload a JPG,GIF or PNG
												 	<br><b>Right View(optional)</b>
												 	 <input type="file" name="rightview"  size="20" id="rightview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><b>Left View(optional)</b><input type="file" name="leftview"  size="20" id="leftview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><b>Top View(optional)</b><input type="file" name="topview"  size="20" id="topview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><b>Bottom View(optional)</b><input type="file" name="bottomview"  size="20" id="bottomview">
												 	Upload a JPG,GIF,JPEG or PNG
												</td>
												<td></td>
										  </tr>
										  <tr>
										  
										  <td><center>
										  <input type='submit' value="submit"  class="btn btn-info">
										  <a href="<?php echo base_url('product/view_product');?>" class="btn btn-info">Cancel</a>
										  </td>
										  </tr></center>
										  

									    </tbody>
									</table>
									</form>
								</div>
							
							 
								  
								 
							 </div>
							
							
							 		  
					<!-- content ends here-->
					 
			
			 </div>	
			


			
			
	   </div><!--/#content.span10-->

	  
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>


	</div>
	
	<div class="clearfix"></div>
<script>
    // When page is done loading
    $(document).ready(function(){
        // When this particular form is submitted
        $('#product_form').submit(function(e){
            // Stop normal refresh of page
            e.preventDefault();
            // Use ajax
            var formData = new FormData($(this)[0]);
            $.ajax({
                // Send via post
                type: 'post',
                // This is your page that will process the update 
                // and return the errors/success messages
                url: "http://localhost/new/rv0/product/do_update"+'/'+"<?php echo $value->pid; ?>",
                // This is what compiles the form data
                data: formData,
                // This is what the ajax will do if successfully executed
                success: function(response){
                    $('#errors').html(response);
                },
                cache: false,
	            contentType: false,
	            processData: false,
                //  If the ajax is a failure, this will pop up in the console.
                error: function(response){
                    console.log(response);
                }
            });
            document.getElementById('prod_details').style.display = 'none';
			document.getElementById('after').style.display = 'block';
			return true;
        });

    });

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      
        return false;
    }
   
    return true;
  }  
    </script>

	
	
</div>	
</body>
</html>
