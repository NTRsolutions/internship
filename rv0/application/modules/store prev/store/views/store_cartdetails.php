<div style="margin-top: 70px;">


					
                      <div class="col-sm-9 col-md-8 col-xs-8 col-md-offset-1" style="margin-top:50px; ">

                      <?php $p=0; foreach($data as $value => $key):?>
                      
                      <div class="row" style="margin-top:10px;background-color:#FFDAB9;border-radius: 20px;" >
                      <br>
                              <div class="col-sm-4 col-md-4 col-xs-4" >

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
                          		<td><p>Description:<?php echo $key->description;?></p></td>
                          	</tr>
                          	<tr>
                          		<td><p>price:<?php echo $key->r_price; ?></p></td>
                          	</tr>
                            <tr>
                            <td>
                            <p>Quantity <input type="text" min="1"  style="width:1.5cm" id="" value="<?php foreach ($quantity as $k => $v)
                            {
                                if($key->pid==$v->pid)
                                {
                                  $p+=$key->r_price*$v->quantity;
                                  echo $v->quantity;
                                }
                              } ?>"></p><div id="change" style="display:none"><p>change here</p></div>
                            </td>
                            </tr>
                            </table>
                         </div>
                         <div class=" col-md-4"><a name="addproduct"  class="btn btn-info" href="<?php echo base_url('store/remove_from_cart/'.$key->pid);?>">Remove All</a>&nbsp;
                         <!--<a name="addproduct" onclick="remove_quantity('<?php echo $key->pid;?>')" class="btn btn-info" >Remove quantity</a>--> </div>
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

                    <div class="col-md-9 col-md-offset-1" style="margin-top:10px;background-color:#FFDAB9;border-radius: 20px;">

                              <p><strong>Total Amount:<?php echo $p;?></strong></p>
                    </div>
               </div>
	 
</div>

<script>
function remove_quantity(pid)
{
  alert(pid);

      document.getElementById("('<?php echo $key->pid.a;?>')").disabled = false;  
       document.getElementById('change').style.display = 'block';

    //document.getElementById('qnty').style.display = 'block';
  // $.post("http://localhost/new/rv0/store/edit_quantity", { pid : pid,c_value : c_value}, function(data) {
       //  $("#errors").html(data);
  //  });
 }
$(document).ready(function() {
    var search = $("#search");

        search.keyup(function() {

                $.post("http://localhost/new/rv0/category/category_search", { search : search.val()}, function(data) {
                    $("#errors").html(data);
                });
                document.getElementById('prod_details').style.display = 'none';
      return true;
            
            
        });
});

</script>


