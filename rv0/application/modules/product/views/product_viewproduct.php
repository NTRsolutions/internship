<?php include "page_template.php";?>
	<script type="text/javascript">
	/*$(document).ready(function(){
        // When this particular form is submitted
        $('input').onkeyup(function(e){
            // Stop normal refresh of page
            e.preventDefault();
            // Use ajax
            alert('kjhjkh');
           var data = $('#search').value();
            $.ajax({
                // Send via post
                type: 'post',
                // This is your page that will process the update 
                // and return the errors/success messages
                url: "http://localhost/CodeIgniter-3.1.4/Signedin/search",
                // This is what compiles the form data
                data: data,
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

    });*/
    $(document).ready(function() {
    var search = $("#search");

        search.keyup(function() {

                $.post("http://localhost/new/rv0/product/search", { search : search.val()}, function(data) {
                    $("#errors").html(data);
                });
                document.getElementById('prod_details').style.display = 'none';
			return true;
            
            
        });
});

	</script>	
		
	
			<!-- start: Content -->
			<div id="content" class="span10 content">
				<div>
					 <!-- content starts here-->
					 		<div >
							
								  <input type="text" name="search" id="search" placeholder="Search Product" />&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a name="addproduct"  class="btn btn-info" href="<?php echo base_url('product/addproduct');?>">Add Product</a>
															  
							 </div> 
							  <br>
							 <div id="errors"></div>
							 <div id="prod_details">
							  
							 <div class="table-responsive">
							
							  <table class="table">
								    <thead>
								      <tr>
								        <th>S.No</th>
								        <th>Image</th>
								        <th>Product</th>
								        <th></th>
								        <th>Category</th>
								        <th>Price</th>
								        <th>Action</th>
								        
								     </tr>
								     </thead>
								    <tbody>
								   <?php $i=1;foreach($data as $key => $value):?>
								      <tr>
								        <td><?php echo $i;?></td>
								        <td><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"></td>
								        <td><?php echo $value->p_name;?></td>
								         <td><?php echo $value->srp;?></td>
								         <td><?php echo $value->p_category;?></td>
								          <td><?php echo $value->r_price;?></td>
								           <td><a href="<?php echo base_url('product/delete/'.$value->pid);?>"><i class="fa fa-trash-o fa-lg"></i></a>&emsp;<a href="<?php echo base_url('product/edit/'.$value->pid);?>"><i class="fa fa-pencil fa-fw"></i></a></td>
								      </tr>
								    <?php $i++; endforeach; ?>
								    </tbody>
								  </table>
								 </div>
							
							 </div>
							 		  
					<!-- content ends here-->
					 
			
			 </div>	
			


			</div>
			

	<div class="clearfix"></div>
</div>
</body>
</html>