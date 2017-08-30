<?php include "page_template.php";?>
			
			<!-- start: Content -->
			<?php $value=$data[0]; ?>
			<?php
			$pids=array();
			foreach ($data as $key => $value) {
				$pids[]=$value->pid;
			}
			?>
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
													  <label >Name:</label>
													  <input type="text" class="form-control" value="<?php echo $value->name; ?>" id="name" name="name" required>
													</div></td>
										  </tr>
										  <tr>
										    <td> <label >Description</label><br>
										    <textarea cols="5" id="description" name="description" required><?php echo $value->description; ?></textarea>
										    </td>
											<td><div class="form-group">
													  <label >Quantity:</label>
													  <input type="text" class="form-control" value="<?php echo $value->quantity; ?>" id="quantity" name="quantity" required>
													</div>
											</td>
	
										  </tr>
										  <tr>
										  <td><span style="cursor:pointer;" class="btn " id="addproducts" >Add products</span></td>
										  </tr>
										  <tr >
										  <td colspan="4" id="products" style="display: none;">
										  <div class="table-responsive"  >
							
							  <table  class="table" style="background:lightblue;">
								    <thead>
								      <tr>
								        <th></th>
								        <th>Name</th>
								        <th>image</th>
								        <th>Description</th>
								        <th>Actions</th>			        
								     </tr>
								     </thead>
								    <tbody>
								   <?php foreach($products as $key => $value):?>
								      <tr>
								        <td>
								        	<input type="checkbox" name="product[]" <?php foreach($pids as $k => $v)
								        		{
								        			if($v==$value->pid)
								        			{
								        				echo 'checked';
								        			}
								        		}
								        	?> value="<?php echo $value->pid;?>"
								        ></td>
								        <td><?php echo $value->p_name;?></td>
								        <td><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"></td>
								        <td><?php echo $value->discription;?></td>
								      </tr>

								    <?php $i++; endforeach; ?>
								    </tbody>
								  </table>
								 </div>
								 </td>
								 
										  </tr>
										  <tr>
												 
											 	 <td>
											 	 <h4> <label >Image</label></h4>
												 	 <input type="file" name="img"  size="20" id="img">Upload a JPG,GIF,JPEG or PNG
												 </td>
												<td></td>
										  </tr>
										  <tr>
										  
										  <td><center>
										  <input type='submit' value="submit"  class="btn btn-info">
										  <a href="<?php echo base_url('product/view_product');?>" class="btn btn-info">Cancel</a></center>
										  </td>
										  </tr>
										  

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
                url: "http://localhost/new/rv0/collections/do_update"+'/'+"<?php echo $data[0]->name; ?>",
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
    <script type="text/javascript">
		$(document).ready(function(){
       
        $('#addproducts').click(function(){
        	  if(document.getElementById('products').style.display=='none')
        		 document.getElementById('products').style.display="block";
        	  else
        	  	 document.getElementById('products').style.display="none";

        	 });

    });
	</script>

	
	
	
</body>
</html>
