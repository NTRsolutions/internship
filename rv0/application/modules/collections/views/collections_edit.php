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
													  <input type="text" class="form-control" value="<?php echo $value->quantity; ?>" id="quantity" name="quantity" onkeypress="return isNumber(event)" required>
													</div>
											</td>
	
										  </tr>
										   <tr>
										    <td> <label >Price</label><br>
										    <input type="text" id="price" name="price" 
										    value="<?php echo $value->price; ?>" onkeypress="return isNumber(event)" required> 
										    </td>
										     <td><label>Offer price</label><input type="text" class="form-control" id="offerprice" name="offerprice" value="<?php echo $value->offerprice; ?>" onkeypress="return isNumber(event)" required>
										    </td>
										  </tr>
										   <!--<tr>
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
								 </td></tr>-->
								 <tr>
										  <td colspan="4">
										  <div class="dropdown"><label >Add Products</label><br>
										  	<div class="input-group">
        <input class="form-control" type="text" name="searchroleName"  placeholder="Search By Name" id="addproducts"/><div class="input-group-addon"><span style="margin:5px 0px 0px 5px;" class="fa fa-search form-control-feedback"></span></div>
    </div>										<div  class="dropdown-content" id="productdiv">
											  	<ul id="myUL">
									 			 <?php foreach($products as $key => $value):?>
													      <li><input type="checkbox" name="product[]" value="<?php echo $value->pid;?>"
													      	<?php foreach($pids as $k => $v)
											        		{
											        			if($v==$value->pid)
											        			{
											        				echo 'checked';
											        			}
											        		}

													      ?> onclick="check()"  ><span><?php echo $value->p_name;?></span><!--<img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"><?php echo $value->discription;?>--></li>
												<?php $i++; endforeach; ?>
												</ul>
											</div>
										  </div>
										  </td>
										  </tr>
										  <tr>
										  <td colspan="4" >
										  <div class="table-responsive">
										  <table class="table" id="print">
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
										 </center>
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
    <!--<script type="text/javascript">
		$(document).ready(function(){
       
        $('#addproducts').click(function(){
        	  if(document.getElementById('products').style.display=='none')
        		 document.getElementById('products').style.display="block";
        	  else
        	  	 document.getElementById('products').style.display="none";

        	 });

    });
	</script>-->
<script type="text/javascript">
 $(document).ready(function() {
 	$('#addproducts').keyup(function(){
 		document.getElementById('productdiv').style.display="block";
 		//alert("hi");
    var input, filter, ul, li, a, i;
    input = document.getElementById("addproducts");
    filter = input.value.toUpperCase();
    //alert(filter);
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        if(filter=='')
        document.getElementById('productdiv').style.display="none";
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "block";
        } else {
            li[i].style.display = "none";

        }
    }
});
});
 $(document).ready(function()
 {
 	check();
 });
 function check()
{
	
	var url="<?php echo base_url('uploads/store/');?>"+'/';
	var p=document.getElementsByName('product[]');
	
	var j=0;
	document.getElementById('print').innerHTML="";
	for(var i=0;i<p.length;i++)
	{		
			if(p[i].checked)
			{
				//alert(p[i].value);
				//<?php $resultArray =  (array) $data[0]; ?>
				//var a = new array();
				//a[j]=new array();

			    <?php foreach($products as $key => $val){ ?>
			       if(p[i].value=="<?php echo $val->pid; ?>")
			       {
			       		var name="<?php echo $val->p_name; ?>";
			       		var img="<?php echo $val->img ;?>";
			       		//j++;
			       		document.getElementById('print').innerHTML+="<td>"+name+"</td><td><img style='width:40px;height:40px' class='img-responsive' src="+url+img+"></td><td><span onclick='remove("+p[i].value+")' id='cross'><i class='fa fa-times' aria-hidden='true'></i></span></td>";

			       }
			    <?php } ?>
			}
		
	}
}
function remove(pid)
{
	var p=document.getElementsByName('product[]');
	for(var i=0;i<p.length;i++)
	{
			if(p[i].checked && p[i].value==pid)
			{
				p[i].checked=false;
				check();
			}
	}
}	
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      
        return false;
    }
   
    return true;
  }    
    				 				
</script>
	
	
	
</body>
</html>
