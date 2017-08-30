


 
<div style="margin-top:3.5cm;">
	<h4 style="margin:50px 0px 0px 110px">HOME/STORE/COLLECTIONS</h4>
		 	

	<div class="col-md-offset-1 col-sm-offset-1 col-md-8 col-sm-8" style="margin-top:10px">
		

		<?php foreach($collections as $k => $key):?>
		 		<div class="col-sm-6 col-md-3 "><figure><a href="<?php echo base_url('store/store_collection/'.$key->pid);?>"><img style="width:200px; height:200px" class="img-responsive" src="<?php echo base_url('uploads/collections/'.$key->img);?>"> </a><figcaption><?php echo $key->name;?><br/><strong>Rs.<?php echo $key->offerprice;?></strong></figcaption></figure></div>
		<?php endforeach; ?>

	 
	</div> 
		  
		<div class="col-md-3 col-sm-3">
		 <div ><table>
				<tr> <td style="background-color:#707070;height:220px;width:220px;font-size:11px;" class="table-responsive" >
				<p class="rg"style="margin-left:20px"><a href="<?php echo base_url('store/standard_products');?>">STANDARD PRODUCTS</a></p> <p class="rg" style="margin-left:20px">INDIVIDUAL PRODUCTS</p>
				<p class="rg"style="margin-left:25px" >Students</p><p class="rg"style="margin-left:25px">Alumni</p>
				<p class="rg"style="margin-left:25px">Faculty</p><p class="rg"style="margin-left:25px">Sports</p><p class="rg"style="margin-left:25px">Merchandise</p>
				<p class="rg"style="margin-left:25px">Accessories</p></td></tr></table>
		</div>
	</div>
</div>
</body>
</html>
	 
	 

