
<?php include 'page_template.php';?>


			<div id="content" class="span10 content">
					
					 				<div id="after" style="display:none">
 										 <div id="errors"></div> 
 									</div> 
	 
							 <div id="prod_details" class="col-md-10"> 
	<iframe id="SomeFrameName" style="display: none" name="SomeFrameName" src="about:blank"></iframe>
							 
								<div  class="table-responsive">
								 <form method="post" id="product_form" action="<?php echo base_url('category/pcategory_insert');?>" enctype="multipart/form-data">
								  	<table class="table">
								  		 <tbody>
								  		 <tr>
								  		 <b style="font-size: 25px">Add Category</b>
								  		 </tr>
									      <tr>
									      
												 <td><div class="form-group">
													  <label >Category Name:</label>
													  <input type="text" class="form-control" id="c_name" name="c_name" required>
													</div></td>
												
										  </tr>
										  <tr>
										    <td><label >Description:</label><br>
										     <textarea placeholder="Enter text..." cols="5" id="discription" name="discription" required></textarea> 
										    </td>
										   
										  </tr>
										  <tr>
										  <th>Images</th>
										  </tr>
										  <tr>
												 <td>
												 	 <input type="file" name="img"  size="20" id="img">
												 	Upload a JPG,GIF,JPEG or PNG
												 </td> 
											
										  </tr>
										 <!-- <tr>
										   <td><div class="form-group">
													  <label >Category Parent:</label></br>
													    <input type="checkbox" value="infant" name="type[]">infant</br>
													    <input type="checkbox" value="bag" name="type[]">bag</br>
													    <input type="checkbox" value="pen" name="type[]">pen</br>

													</div></td>
													</tr>-->
											
								 <tr>
										  <td colspan="4">
										  <div class="dropdown">
										  	<div class="input-group">
										  	<label>Add Product</label>
        <input class="form-control" type="text" name="searchroleName"  placeholder="Search By Name" id="addproducts"/><div class="input-group-addon"><span style="margin:5px 0px 0px 5px;" class="fa fa-search form-control-feedback"></span></div>
    </div>
										  	<div  class="dropdown-content" id="productdiv">
											  	<ul id="myUL">
									 			 <?php foreach($products as $key => $value):?>
													      <li><input type="checkbox" name="product[]" value="<?php echo $value->pid;?>" id="box" onclick="check('<?php echo $value->p_name;?>','<?php echo $value->img;?>',this)"><span><?php echo $value->p_name;?></span><!--<img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"><?php echo $value->discription;?>--></li>
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
										  <td><center>
										  <input type='submit' id="submit" name="submit" value="submit"  class="btn btn-info">
										  <input type="reset" value="Reset" class="btn btn-info">
										  </center></td>
										  </tr>
									</form>
								</div>
								
							
							
							 		  
					<!-- content ends here-->
					
			
			 </div>	
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
                url: "http://localhost/new/rv0/category/pcategory_insert",
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
function check(name,img)
{
	var url="<?php echo base_url('uploads/store/');?>"+'/';
	document.getElementById('print').innerHTML+="<td>"+name+"</td><td><img style='width:50px;height:50px' class='img-responsive' src="+url+img+"></td></table></div>";//<td><?php echo $value->discription;?></td>	
}  				 				
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
	//<td><?php echo $value->discription;?></td>	
	/*if(a.checked==true)
	{
		document.getElementById('print').innerHTML+="<td>"+name+"</td><td><img style='width:40px;height:40px' class='img-responsive' src="+url+img+"></td><td><i class='fa fa-times' aria-hidden='true'></i></td></table></div>";
	}
	else
	{


	}*/
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
</script>
</body>
</html>
