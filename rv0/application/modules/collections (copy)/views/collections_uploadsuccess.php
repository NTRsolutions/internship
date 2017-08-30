

<div>
 <center><p style="color:green;font-size:50px" > <span class="glyphicon glyphicon-ok" style="height:100px; width:100px"></span></p></center>
<center><p style="color:green;font-size:20px" >you have submitted successfully </p> </center>
  
<table class="table">
<tbody>
<tr><td><?php echo 'Name'?>:</td><td> <?php echo $data['name']; ?></td></tr>
<tr><td><?php echo 'Description';?>: </td><td> <?php echo $data['description'];?></td></tr>
<?php if($data['img']!='')
{?>
<tr><td><?php echo 'img'?>:</td><td>  <?php echo $data['img'];?></td></tr>
<?php } ?>
<tr><td><?php echo 'quantity'?>:</td><td>  <?php echo $data['quantity'];?></td></tr>
</tbody>
</table>
</div> 
<a href="<?php echo base_url('collections/');?>" class="btn btn-info">Back</a>