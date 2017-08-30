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
            <td style="padding:15px 50px 20px 50px;background:#fff;">
            <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px; font-weight:300;">Hello!</p>
            <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">Welcome to the <strong>"<?php echo ORGANISAION_NAME; ?>" </strong>Community, As a member of <strong>"<?php echo ORGANISAION_NAME; ?>"</strong>, you receive access to our closely yet strong-knit alumni network that will be a great place to meet peers, interact and make long-lasting connections.</p>
                <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"><a style="text-decoration:none; color:#04567a;" href="<?php echo base_url();?>" target="_blank"><strong>Login</strong></a> today to familiarize yourself to make the most of your membership!</p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">Avail maximum networking benefits of our <strong>"<?php echo ORGANISAION_NAME; ?>"</strong> community by checking off the following simple tasks :</p>
              
              <table style="font-size:14px;">
              <tr><td>Update your profile for better visibility.</td>
              <td style="text-align:right;"><img style="width:100px;" src="<?php echo ASSETS;?>assets/img/profiles-tips.png" /></td></tr>
              <tr><td>Visit our alumni profiles  and start connecting with our members</td>
              <td style="text-align:left;"><img style="width:90px; margin:10px 0" src="<?php echo ASSETS;?>assets/img/alumni-connection.png" /></td></tr>
              <tr><td>Visit our activity page  and join the discussions</td>
              <td style="text-align:right;"><img style="width:100px;margin:10px 0" src="<?php echo ASSETS;?>assets/img/members.png" /></td></tr>
              <tr><td>Check our Calendar for events</td>
              <td style="text-align:right;"><img style="width:100px; margin:10px 0" src="<?php echo ASSETS;?>assets/img/events.jpg" /></td></tr>
              <tr><td>Edit " how would you like to give back" in User interest preferences</td>
              <td style="text-align:right;"><img style="width:100px; margin:10px 0" src="<?php echo ASSETS;?>assets/img/edit.png" /></td></tr>
              </table>
              <a href="<?php echo base_url().$link;?>" target="_blank" style="text-decoration:none;color:#fff; padding:7px 30px; background:#49df58; margin:20px 0; display:table;">Update Your Profile</a>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">Please do not hesitate to contact me, should you have any questions. I am more than glad to help!</p>
              
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;">I hope you enjoy your time in <strong>"<?php echo ORGANISAION_NAME; ?>"</strong>,</p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px; text-align:left;">Sincerely,<br /><strong><?php echo ORGANISAION_NAME; ?></strong></p>
             
              </td>
          </tr>
          <tr>
            
          </tr>
        </tbody>
      </table></td>
      
      
     
      
  </tr>
  <tr>
  	 <td>
      <table style="width:500px;margin:25px auto 25px auto;padding:0px;background:#f8f8f8;border-spacing: 0px;color:#505050;">
      		<tr><td>
            	<p style="font-size:12px;line-height:20px;margin:0px 0px 15px 0px; text-align:center;">You are receiving this email because <a href="mailto:name@email.com" style="text-decoration:none; color:#04567a;" >name@email.com</a> is registered with “organization”<br />
                Please do not reply directly to this email. If you have any questions or feedback,<br />

please visit our <strong>contact us page.</strong><br />

Power by <strong>RightLink</strong>
</p>
            </td></tr>
        </table>
      </td>
  </tr>
</table>
</body>
</html>