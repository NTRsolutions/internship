
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/slick.css">
<link href="<?php echo ASSETS;?>assets/css/slick-theme.css" rel="stylesheet">
<!--popup start-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--popup end-->

<script src="<?php echo ASSETS;?>assets/js/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>assets/js/slick.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>assets/css/bootstrap.min.css">
<link href="<?php echo ASSETS;?>assets/css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/bootstrap.min.js" ></script>



<style type="text/css">
   .slider {
        width: 80%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 10px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
      
    }
</style>
<?php 
$data=$collection;
?>


<script>
$(function(){
    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");
    canvas.width=200;
    canvas.height=200;
    var canvasOffset=$("#canvas").offset();
    var offsetX=canvasOffset.left;
    var offsetY=canvasOffset.top;

    var startX;
    var startY;
    var isDown=false;


    var pi2=Math.PI*2;
    var resizerRadius=2;
    var rr=resizerRadius*resizerRadius;
    var draggingResizer={x:0,y:0};
    var imageX=10;
    var imageY=10;
    var imageWidth,imageHeight,imageRight,imageBottom;
    var draggingImage=false;
    var startX;
    var startY;
    var img = new Image();
    var bg = new Image();
    bg.src=document.getElementById('prod').src;
    alert(document.getElementById('prod').src);
     bg.onload = function () {
    ctx.drawImage(bg,0,0,bg.width,bg.height,0,0,canvas.width,canvas.height);
    
  }
   // canvas.width=bg.naturalWidth;
   // canvas.height=bg.naturalHeight;

 
}); // end $(function(){});


</script>
<div id="errors"></div>


<h4 style="margin-top:3.5cm;margin-left:1.2cm;text-decoration:none">HOME/STORE/PRODUCT STORE</h4>

 <div class="container" >
        <div class="row">
             <div class="col-md-4 col-xs-12" >
                    	
                                 
                                       <div class="img-responsive"><img id="prod" src="<?php echo base_url('uploads/collections/'.$data->img);?>" style="height:250px;width:250px;" alt="Fjords"></div>
                                      
                                        
                                       
                                      
                            
                           
                   </div>

             
     <div class="col-md-5 col-xs-12">
       
        <table class="table-responsive">
        <tbody>

	           <tr><td style="font-size:20px;text-decoration:none; margin:10px 0px 0px 0px"><p><strong><?php echo $data->name; ?></strong></p></td></tr> 
	           <tr><td><p> Student134 | <span style="color:green">In Stock</span></p></td></tr>
	           <tr><td style="font-size:12px"><p> 10 Reviews | <span id="share" style="cursor:pointer;" data-toggle="modal" data-target="#myModal" >Share<span> | Add your review</p></td></tr>
	           <tr><td><p>Total Items: <span id="stock"><?php echo $data->quantity;?></span></p></td></tr>
	          <tr><td style="font-size:9px">1)School Bag   2)Apsara Scholar Kit   3)Exam Clipboard </td></tr>
	          <tr><td style="font-size:9px"><p> 4)Notebook Single Line 5)Water Color Cake With Brush     6)Pencil Box</p></td></tr>
	         <tr><td style="font-size:9px"><?php echo $data->description;?>  Lorem Ipsum is simply dummy text of the printing and type setting Industry.Lorem Ipsum has been the</td></tr>
	          <tr><td style="font-size:9px;">industry's standard dummy text ever since the 1500s,when an unknown printer took a galley of type</td></tr>
	          <tr><td style="font-size:9px"><p>scrambled it to make a type specimen book.It has survived not only five countries but also the leap.</p></td></tr>
	           <tr><td style="font-size:15px">COST</td></tr>
	           <tr><td style="word-spacing:10px"><p><strong>₹<?php echo $data->offerprice; ?>/-</strong><strong><strike>₹<?php echo $data->price; ?>/-</strike></strong>    QUANTITY    <input type="number" min="1" max="<?php echo $data->quantity;?>" size="2" value="1" style="width:1.5cm" id="quantity"> </p></td></tr></tbody> </table>
	           <p> <button type="button" name="addtocart" id="addtocart" style="background-color:#2F4F4F" class="btn btn-primary "><strong>ADD TO CART</strong></button>
             <button type="button" style="background-color:#FF4500;display: none;" id="customize" onclick="custom()"  class="btn btn-primary "><strong>CUSTOMIZE</strong></button>
	           </p>
             </div>
             
             <div class="col-md-3 col-xs-12">

             <table class="table-responsive"><tr>
		<td style="background-color:#707070;font-size:11px;text-color:white;height:220px;width:220px" >
	<p class="rg" style="margin-left:20px"><a href="<?php echo base_url('store/standard_products');?>">STANDARD PRODUCTS</a></p> <p class="rg" style="margin-left:20px">INDIVIDUAL PRODUCTS</p>
	<p class="rg" style="margin-left:25px" >Students</p><p class="rg"style="margin-left:25px">Alumni</p>
	<p class="rg" style="margin-left:25px">Faculty</p><p class="rg"style="margin-left:25px">Sports</p><p class="rg"style="margin-left:25px">Merchandise</p>
	<p class="rg"style="margin-left:25px">Accessories</p></td></tr>
		</table>

             </div>

        </div>
         
     </div>

    <div class="container">
          <div class="row">
            <p style="margin-top:70px">Products</p>
                <?php foreach($products as $k=>$key):?>
        <div class="col-sm-6 col-md-3 "><figure><a ><img style="width:200px; height:200px" class="img-responsive" src="<?php echo base_url('uploads/store/'.$key->img);?>"> </a><figcaption><?php echo $key->p_name;?><br/><strong>Rs.<?php echo $key->o_price;?></strong></figcaption></figure></div>
    <?php endforeach; ?>
          
        
      </div>
      </div>


        
        


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link</h4>
        </div>
        <div class="modal-body">
          <input type="text" onClick="this.setSelectionRange(0, this.value.length)" id="link" size="65">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  
 <script type="text/javascript">
$(document).ready(function() {
$("#addtocart").click(function(){
       var q=document.getElementById("quantity").value;
       c=document.getElementById("stock").innerHTML;
       if(c<q)
       {
         q=c;
         document.getElementById("quantity").value=q;
       }
       
       
      $.post("http://localhost/new/rv0/store/add_to_cart", { name : name , quantity : q }, function(data) {
                    $("#cartno").html(data);
                });
         document.getElementById("addtocart").innerHTML="ADDED TO CART";
        document.getElementById("addtocart").disabled=true;
        document.getElementById("customize").disabled=true;
        /*$.post("http://localhost/new/rv0/store/stock", { pid : pid, quantity : q }, function(data) {
                    $("#stock").html(data);
                });*/
                    
    });
    $("#share").click(function(){
      document.getElementById('link').value=window.location.href;
    });
});         
</script>
  




