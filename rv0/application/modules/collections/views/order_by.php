<?php include "page_template.php";?>
	<script type="text/javascript">
    $(document).ready(function() {
    var search = $("#search");

        search.keyup(function() {

                $.post("http://localhost/new/rv0/collections/search", { search : search.val()}, function(data) {
                    $("#errors").html(data);
                });
                document.getElementById('prod_details').style.display = 'none';
			return true;
            
            
        });
});

	</script>
	<script type="text/javascript">
    $(document).ready(function() {
    var search = $("#order");

        search.change(function() {
            //alert(search.val());
        	if(search.val()=='price')
            {
                $.post("http://localhost/new/rv0/collections/price", function(data) {
                    $("#errors").html(data);
                });
                document.getElementById('prod_details').style.display = 'none';
			return true;
		    }
		    else if(search.val()=='alpha')
		    {
		    	$.post("http://localhost/new/rv0/collections/alphabetic", function(data) {
                    $("#errors").html(data);
                });
                document.getElementById('prod_details').style.display = 'none';
			return true;
		    }
            
            
        });
        });
</script>	
		    <div id="errors"></div>
			<!-- start: Content -->
			<div id="prod_details" class="span10 content">
				<div>
					 <!-- content starts here-->
					 		<div >
							
								  <input type="text" name="search" id="search" placeholder="Search Product" />
								  <select id="order">
								    <option selected="selected">Sort</option>
								  	<option value="price">Price</option>
								  	<option value="alpha">alphabetic</option>
								  </select>
								  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a name="addproduct"  class="btn btn-info" href="<?php echo base_url('collections/addcollection');?>">Add Collections</a>
															  
							 </div> 
							  <br>
							 
							 <div>
							  
							 <div class="table-responsive">
							
							  <table class="table">
								    <thead>
								      <tr>
								        <th>S.No</th>
								        <th>Image</th>
								        <th>Collection</th>
								        <th>description</th>
								        <th>Action</th>				        
								     </tr>
								     </thead>
								    <tbody>
								   <?php $i=1;foreach($data as $key => $value):?>
								      <tr>
								        <td><?php echo $i;?></td>
								        <td><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/collections/'.$value->img);?>"></td>
								        <td><a href="<?php echo base_url('collections/edit/'.$value->name);?>"><?php echo $value->name;?></a></td>
								         <td><?php echo $value->description;?></td>
								           <td><a href="<?php echo base_url('collections/delete/'.$value->name);?>"><i class="fa fa-trash-o fa-lg"></i></a>&emsp;<a href="<?php echo base_url('collections/edit/'.$value->name);?>"><i class="fa fa-pencil fa-fw"></i></a></td>
								      </tr>
								    <?php $i++; endforeach; ?>
								    </tbody>
								  </table>
								 </div>
							
							 </div>
							  <div class="col-md-offset-5" style="margin-bottom: 40px">
							 <?php
							 echo $this->pagination->create_links();
							 ?>
							 </div>  
					<!-- content ends here-->
					 
			
			 </div>	
			


			</div>
			

	<div class="clearfix"></div>
</body>
</html>