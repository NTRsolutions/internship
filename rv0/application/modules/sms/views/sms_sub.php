<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery_popup.css'); ?>" />
<script src="<?php echo base_url('assets/js/jquery_popup.js'); ?>"></script>
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
		margin-left: 0px;
	}
</style>
<script type="text/javascript">
	
       $(document).ready(function() {

        $('#send').click(function(){
            
             var name=$('#name').val();
        	 $.post("<?php echo base_url('sms/create_section/').'/'.'uploads/sms/'.TENENT_ID.'/'.$parent; ?>",{section:name},function(data){
                $("#section").html(data);

        });
        	  $("#contact #cancel").parent().parent().hide();

	});
    });


</script>
</head>
<body id=section>

<?php foreach($filenames as $key =>$value):?>
	<div>
<a href="<?php echo base_url("sms/open_section/").'/'.$value['relative_path'].'/'.$value['name'];?>" onclick="return false" ondblclick="location=this.href"><img onmouseover="this.src='<?php echo base_url("assets/images/folder2.png");?>'" onmouseout="this.src='<?php echo base_url("assets/images/folder1.png");?>'" src="<?php echo base_url("assets/images/folder1.png");?>" height="100" width="100"><br><span>&nbsp;<?php echo $value['name'];?>&nbsp;</span></a>
</div>

<?php endforeach;?>
<div>
<img id='onclick' onmouseover="this.src='<?php echo base_url("assets/images/plus2.png");?>'" onmouseout="this.src='<?php echo base_url("assets/images/plus1.png");?>'" src="<?php echo base_url("assets/images/plus1.png");?>" height="120" width="110">
</div>

<div id="contactdiv">
<form class="form" action="#" id="contact">
<img src="<?php echo base_url('assets/images/cancel.png'); ?>" class="img" id="cancel"/>
<h3>Folder creation</h3>
<hr/><br/>
<label>Folder Name</label>
<br/>
<input type="text" id="name" placeholder="Name"/><br/>
<br/>
<center>
<input type="button" id="send" value="Create"/>
</center>
<br/>
</form>
</div>

</body>
</html>