<div id="prod_details">
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
								        <td><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/category/'.$value->c_img);?>"></td>
								        <td><?php echo $value->c_name;?></td>
								         <td><?php echo $value->c_description;?></td>
								           <td><a href="<?php echo base_url('category/category_delete/'.$value->c_name);?>"><i class="fa fa-trash-o fa-lg"></i></a>&emsp;<a href="<?php echo base_url('category/category_edit/'.$value->c_name);?>"><i class="fa fa-pencil fa-fw"></i></a></td>
								      </tr>
								    <?php $i++; endforeach; ?>
								    </tbody>
								  </table>
								 </div>
	</div>

