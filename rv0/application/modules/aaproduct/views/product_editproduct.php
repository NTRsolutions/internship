			
			<!-- start: Content -->
			<?php $value=$data[0]; ?>
			<div id="content" class="span10 content">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
						</ul>
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
													
											 	 <td>
												 	  <div class="form-group">
														  <label >status</label>
														  <select class="form-control" name="status"  id="status" required>
														    <option <?=$value->status == 'Draft' ? ' selected="selected"' : '';?> >Draft</option>
														    <option <?=$value->status == 'Published' ? ' selected="selected"' : '';?> >Published</option>
														    <option <?=$value->status == 'Deactivated' ? ' selected="selected"' : '';?> >Deactivated</option>
														    
														  </select>
													</div>
												</td>
										  </tr>
										  <tr>
										    <td>Description<br>
										    <textarea cols="5" id="discription" name="discription" required><?php echo $value->discription; ?></textarea>
										    </td><td>
										     <div class="form-group">
														  <label >Category</label>
														  <select class="form-control" name="Category"  id="Category" required>
														    <option <?=$value->p_category == 'Bag' ? ' selected="selected"' : '';?> >Bag</option>
														    <option <?=$value->p_category  == 'Book' ? ' selected="selected"' : '';?> >Book</option>
														    <option <?=$value->p_category  == 'Bottle' ? ' selected="selected"' : '';?> >Bottle</option>
														    <option <?=$value->p_category  == 'Clip Board' ? ' selected="selected"' : '';?> >Clip Board</option>
														     <option <?=$value->p_category  == 'Pen' ? ' selected="selected"' : '';?> >Pen</option>

														    
														  </select>
													</div>
													</td>
										  </tr>
										  <tr>
										  <th>Pricing</th>
										  </tr>
										  <tr>
												 <td>
												 	<div class="form-group">
													  <label >Offer Price:</label>
													  <input type="text" class="form-control" name="o_price" id="o_price" value="<?php echo $value->o_price; ?>" required>
													</div>
													<div class="form-group">
													  <label >Retails price:</label>
													  <input type="text" class="form-control" name="r_price" id="r_price" value="<?php echo $value->r_price; ?>" required>
													</div>
													<div class="form-group">
													  <label >Sale Price:</label>
													  <input type="text" class="form-control" id="s_price" name="s_price" value="<?php echo $value->s_price; ?>" required>
													</div>
													<div class="form-group">
													  <label >Cost Price:</label>
													  <input type="text" class="form-control" id="c_price" name="c_price" value="<?php echo $value->c_price; ?>" required>
													</div>
													<div class="form-group">
													  <label >SRP:</label>
													  <input type="text" class="form-control" id="srp" name="srp" value="<?php echo $value->srp; ?>" required>
													</div>
												 </td>
											 	 <td>
											 	 	<h4>Image</h4>
												 	 <input type="file" name="img" value="<?php echo $value->img; ?>" size="20" id="img">
												 	Upload a JPG,GIF or PNG
												 	<br><h4>Right View(optional)</h4>
												 	 <input type="file" name="rightview"  size="20" id="rightview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><h4>Left View(optional)</h4><input type="file" name="leftview"  size="20" id="leftview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><h4>Top View(optional)</h4><input type="file" name="topview"  size="20" id="topview">
												 	Upload a JPG,GIF,JPEG or PNG 
												 	<br><h4>Bottom View(optional)</h4><input type="file" name="bottomview"  size="20" id="bottomview">
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

    </script>

