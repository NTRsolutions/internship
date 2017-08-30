

<div>
 <center><p style="color:green;font-size:50px" > <span class="glyphicon glyphicon-ok" style="height:100px; width:100px"></span></p></center>
<center><p style="color:green;font-size:20px" >you have submitted successfully </p> </center>
<table class="table">
<tbody>
<tr><td><?php echo 'Product Name'?>:</td><td> <?php echo $data['c_name']; ?></td></tr>
<tr><td><?php echo 'Description';?>: </td><td> <?php echo $data['c_description'];?></td></tr>
<tr><td><?php echo 'image'?>:</td><td><?php echo $data['c_img'];?></td></tr>
</tbody>
</table>
</div> 
<a href="<?php base_url('product/view_product');?>" class="btn btn-info">Back</a>