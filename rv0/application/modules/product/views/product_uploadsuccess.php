

<div>
 <center><p style="color:green;font-size:50px" > <span class="glyphicon glyphicon-ok" style="height:100px; width:100px"></span></p></center>
<center><p style="color:green;font-size:20px" >you have submitted successfully </p> </center>
  
<table class="table">
<tbody>
<tr><td><?php echo 'Product Name'?>:</td><td> <?php echo $data['p_name']; ?></td></tr>
<tr><td><?php echo 'Status';?>: </td><td> <?php echo $data['status'];?></td></tr>
<tr><td><?php echo 'Description';?>: </td><td> <?php echo $data['discription'];?></td></tr>
<tr><td><?php echo 'Offer Price';?>: </td><td> <?php echo $data['o_price'];?></td></tr>
<tr><td><?php echo 'Retails Price';?>:</td><td> <?php echo $data['r_price'];?></td></tr>
<tr><td><?php echo 'Sales Price'?>: </td><td> <?php echo $data['s_price'];?></td></tr>
<tr><td><?php echo 'Cost Price'?>:</td><td>  <?php echo $data['c_price'];?></td></tr>
<tr><td><?php echo 'SRP'?>:</td><td>  <?php echo $data['srp'];?></td></tr>
<tr><td><?php echo 'img'?>:</td><td>  <?php echo $data['img'];?></td></tr>
<tr><td><?php echo 'Product Category'?>:</td><td>  <?php echo $data['p_category'];?></td></tr>

</tbody>
</table>
</div> 
<a href="<?php base_url('product/view_product');?>" class="btn btn-info">Back</a>
</div>
</body>
</html>