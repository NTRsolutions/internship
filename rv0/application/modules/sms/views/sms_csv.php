<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
	a{
		text-decoration: none;
		color: black;

	}
	a:focus {
    outline: none;
	}
	span
	{
		margin-left: 15px; 
	}
	a:hover span
	{
		background:#4682B4;
		border-radius:5px;
	}
	div
	{
		float:left;
		margin-left: 20px;
	}
</style>
</head>
<body>
<?php foreach($filenames as $key =>$value): $GLOBALS['a']=$value['name'];?>
	<div>
<a href="<?php echo base_url("sms/show/").'/'.$value['name'];?>" onclick="return false" ondblclick="location=this.href"><img onmouseover="this.src='<?php echo base_url("assets/images/csv2.png");?>'" onmouseout="this.src='<?php echo base_url("assets/images/csv1.png");?>'" src="<?php echo base_url("assets/images/csv1.png");?>" height="100" width="100"><br><span>&nbsp;<?php echo $value['name'];?>&nbsp;</span></a>
</div>

<?php endforeach;?>


<div>
       
       <form method="post" enctype="multipart/form-data" action="<?php echo base_url("sms/data");?>" >
         <div align="center">

         <p>Upload csv <input type="file" name="file"></p>
         <p><input type="submit" name="sumbit" value="Upload"></p>
         <input type="hidden" name="path" value="<?php echo $path;?>">	
         </div>
         	
         </form>
</div>
</body>
</html>