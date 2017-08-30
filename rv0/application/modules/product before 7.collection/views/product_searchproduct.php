<div id="prod_details">
		 <div class="table-responsive">
							  <table class="table">
								    <thead>
								      <tr>
								        <th>S.No</th>
								        <th>Image</th>
								        <th>Product</th>
								        <th>SKU</th>
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

