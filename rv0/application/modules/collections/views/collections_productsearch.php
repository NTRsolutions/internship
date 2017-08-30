<!--<div class="table-responsive">
							
											  <table  class="table" style="background:lightblue;">
												    <thead>
												      <tr>
												        <th></th>
												        <th>Name</th>
												        <th>image</th>
												        <th>description</th>			        
												     </tr>
												     </thead>
												    <tbody>
												   <?php foreach($data as $key => $value):?>
												      <tr>
												        <td><input type="checkbox" name="product[]" value="<?php echo $value->pid;?>" id="box"></td>
												        <td><?php echo $value->p_name;?></td>
												        <td><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"></td>
												        <td><?php echo $value->discription;?></td>
												      </tr>
												    <?php $i++; endforeach; ?>
												    </tbody>
												  </table>
								 			</div>-->
								 			<ul id="myUL">
								 			 <?php foreach($data as $key => $value):?>
												      <li><input type="checkbox" name="product[]" value="<?php echo $value->pid;?>" id="box"><?php echo $value->p_name;?><img style="width:50px;height:50px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$value->img);?>"><?php echo $value->discription;?></li>
											<?php $i++; endforeach; ?>
											</ul>
											
