


 <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css">

 
  
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    
     <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="http://kenwheeler.github.io/slick/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<div style="margin-top:3.5cm;">
	<h4 style="margin:50px 0px 0px 110px">HOME/STORE</h4>
		 	

	<div class="col-md-offset-1 col-sm-offset-1 col-md-8 col-sm-8" style="margin-top:10px">
		

		<?php foreach($product as $key):?>
		 		<div class="col-sm-6 col-md-3 "><figure><a href="<?php echo base_url('store/store_product/'.$key->pid);?>"><img style="width:200px; height:200px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$key->img);?>"> </a><figcaption><?php echo $key->p_name;?><br/><strong>Rs.<?php echo $key->r_price;?></strong></figcaption></figure></div>
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
	 
	 

