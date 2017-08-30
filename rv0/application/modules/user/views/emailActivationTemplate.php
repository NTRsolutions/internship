<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>RightLink-Email</title>
</head>
<body style="font-family: Arial,Helvetica,sans-serif;color:#333;margin:0px;background:#fff;">
<table style="min-width:650px;border-spacing: 0px;background:#f8f8f8;margin:auto;">
  <tr>
    <td><table style="width:600px;margin:25px auto 25px auto;padding:0px;background:#fff;border-spacing: 0px;color:#505050; border:1px solid #edecec; border-radius:4px;">
        <thead>
          <tr>
             <td style="text-align:center;">
			 <?php if(HEADERLOGO==''){ ?>
			<img src="<?php echo ASSETS;?>assets/img/rightlink-logo.png" alt="RightLink" 
									 style="border:none;margin:20px 0px 10px 0;" width="180px"  />
			 <?php }else{?>
			<img src="<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>" alt="RightLink" 
									 style="border:none;margin:20px 0px 10px 0;" width="180px"  />
			 <?php } ?>						 
									 
			</td>
          </tr>
        </thead>
        <tbody style="background:#fff;">
          <tr>
            <td style="padding:15px 50px 0px 50px;background:#fff;">
            <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px; ">Dear <strong><?php echo $firstname ?> <?php echo $lastname ?></strong>,</p>
            <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">It gives me immense pleasure to welcome you to our <?php echo ORGANISAION_NAME; ?> community.</p>
                <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"><?php echo ORGANISAION_NAME; ?> has lots to offer! As a member you can connect with students, identify your peers and cherish close connections through our robust alumni network.</p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">Join our phenomenal network of alumni spread across the globe, as <?php echo ORGANISAION_NAME; ?> helps you to connect to your fellow alumni, compile strategies, augment ideas and seek exceptional growth on professional front.</p>
              
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">The privileges of <?php echo ORGANISAION_NAME; ?> membership are not just limited to Professional networking!</p>
              
            
              
              
              <table style="font-size:14px;">
              <tr><td><a href="<?php echo $activation_link; ?>" target="_blank" style="text-decoration:none;color:#fff; padding:7px 15px; background:#49df58; margin:0px 5px 0 0; display:table;">Activate</a></td>
              <td style="text-align:right;">your account today!</td></tr>
              
              </table>
             
              </td>
          </tr>
          <tr>
            <td><img style="width:600px;" src="<?php echo ASSETS;?>assets/img/blue-background.png" /></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  <tr>
  	 <td>
      <table style="width:500px;margin:25px auto 25px auto;padding:0px;background:#f8f8f8;border-spacing: 0px;color:#505050;">
      		<tr><td>
            	<p style="font-size:12px;line-height:20px;margin:0px 0px 15px 0px; text-align:center;">You are receiving this email because <a href="<?php echo $email; ?>" style="text-decoration:none; color:#04567a;" ><?php echo $email; ?></a> is registered with <?php echo ORGANISAION_NAME; ?><br />
                Please do not reply directly to this email. If you have any questions or feedback,<br />

please visit our <strong>contact us page.</strong><br />

Powered by <strong>RightLink</strong>
</p>
            </td></tr>
        </table>
      </td>
  </tr>
</table>
</body>
</html>