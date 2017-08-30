<div id="prod_details">
		 <div>
							  
							 <div class="table-responsive">
							
							  <table class="table">
								    <thead>
								      <tr>
								        <th>S.No</th>
								        <th>Image</th>
								        <th>Collection</th>
								        <th>description</th>
								        <th>Price</th>
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
								         <td><?php echo $value->price;?></td>
								           <td><a href="<?php echo base_url('collections/delete/'.$value->name);?>"><i class="fa fa-trash-o fa-lg"></i></a>&emsp;<a href="<?php echo base_url('collections/edit/'.$value->name);?>"><i class="fa fa-pencil fa-fw"></i></a></td>
								      </tr>
								    <?php $i++; endforeach; ?>
								    </tbody>
								  </table>
								 </div>
							
							 </div>
							
							 </div>

