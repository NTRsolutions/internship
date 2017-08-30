<script type="text/javascript" src="<?php echo ASSETS;?>assets/js/jquery.min.js"></script>
<div style="margin-top: 70px;" id="cart">

					
                      <div class="col-sm-9 col-md-8 col-md-offset-1" style="margin-top:50px; ">

                      <?php $p=0; foreach($data as $value => $key):?>
                      
                      <div class="row" style="margin-top:10px;background-color:white;border:1px solid black;"" >
                      <br>
                              <div class="col-sm-4 col-md-4" >

                              <img src="
                             <?php $f=0;
                                  foreach ($quantity as $k => $v)
                                  {
                                    if($v->pid==$key->pid && $v->cartlogo!='')
                                    {
                                        echo base_url('uploads/store/customize/'.$v->cartlogo);
                                        $f=1;
                                        break;
                                    }
                                  }
                                  if($f!=1)
                                  echo base_url('uploads/store/'.$key->img);  
                            ?>"
                             class="img-responsive" style="height: 200px;width: 200px">
                              <br>
                              </div>
                      

                          <div class="col-sm-4 col-md-4">
                             <table>
                          	<tr>
                          		<td><p>ProductName:<?php echo $key->p_name;?></p></td>
                          	</tr>
                          	<tr>
                          		<td><p>Description:<?php echo $key->discription;?></p></td>
                          	</tr>
                          	<tr>
                          		<td><p>price:<?php echo $key->r_price; ?></p></td>
                          	</tr>
                            <tr>
                            <td>
                            <p>Quantity <input type="number" min="1" max="<?php echo $data->quantity;?>" style="width:1.5cm" value="<?php foreach ($quantity as $k => $v)
                            {
                                if($key->pid==$v->pid)
                                {
                                  $p+=$key->r_price*$v->quantity;
                                  echo $v->quantity;
                                }
                              } ?>" onchange="edit('<?php echo $key->pid;?>',this)" onkeypress="return isNumber(event)"></p>
                            </td>
                            </tr>
                            </table>
                         </div>
                         <div class=" col-md-4"><a name="addproduct"  class="btn btn-info" href="<?php echo base_url('store/remove_from_cart/'.$key->pid);?>">Remove</a></div>
                         <br>
                      </div>
                        <?php endforeach; ?> 
                    </div>
        <div class="col-md-3 col-sm-3" style="margin-top:2cm;">
   <div ><table>
      <tr> <td style="background-color:#707070;height:220px;width:220px;font-size:11px;" class="table-responsive" >
      <p class="rg" style="margin-left:20px;"><a href="<?php echo base_url('store/standard_products');?>">STANDARD PRODUCTS</a></p> <p class="rg" style="margin-left:20px;">INDIVIDUAL PRODUCTS</p>
      <p class="rg" style="margin-left:25px;" >Students</p><p class="rg" style="margin-left:25px;">Alumni</p>
      <p class="rg" style="margin-left:25px;">Faculty</p><p class="rg" style="margin-left:25px;">Sports</p><p class="rg" style="margin-left:25px;">Merchandise</p>
      <p class="rg" style="margin-left:25px;">Accessories</p></td></tr></table>
  </div>
</div>
         
               <div class="row">

                    <div class="col-md-9 col-md-offset-1" style="margin-top:10px;background-color:white;border:1px solid black;"">

                              <p><strong >Total Amount:<span id="total_amount"><?php echo $p;?></span></strong></p>
                    </div>
               </div>
	 
</div>
<script type="text/javascript">

  function edit(pid,a)
  {
   
    q=a.value; //alert(pid+q);
    $.post("http://localhost/new/rv0/store/cart_quantity", { pid : pid,quantity:q });
    //$('#cart').load('http://localhost/new/rv0/store/cart_details');
    window.location.href ='http://localhost/new/rv0/store/cart_details';

}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>



