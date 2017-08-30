<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>RightLink-Email</title>
</head>
<body style="font-family: Arial,Helvetica,sans-serif;color:#666;margin:0px;background:#f5f5f5;">
<table style="min-width:650px;border-spacing: 0px;background:#f5f5f5;margin:auto;">
  <tr>
    <td><table style="width:620px;margin:25px auto 25px auto;padding:0px;background:#fff;border-spacing: 0px;color:#666;">
        <thead>
          <tr>
            <td><img src="<?php echo base_url().'img/header-cover.png'; ?>" alt="RightLink" 
									 style="border:none;margin:0px;" width="620" height="245" /></td>
          </tr>
          <?php if(HEADERLOGO != ''){ ?>
          <tr>
            <td style="text-align:center; padding-top:20px;"><img style="width:133px;height:150px;" src="<?php echo HEADERLOGO; ?>" /></td>
          </tr>
          <?php } ?>
        </thead>
        <tbody style="background:#fff;">
          <tr>
            <td style="padding:15px 50px 40px 50px;background:#fff;"><p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px; font-weight:300;"> Dear <?php echo $first_name.' '.$last_name ?>, </p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"> Your Alma Mater is calling! </p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"> Join our Engagement Network built exclusively for our school community. Juniors, seniors, teachers, parents – engage with them all in one place </p>
              <ul style="font-size:14px;line-height:20px; margin:0px 0px 15px 0px; padding-left:13px;">
                <li>Share your experiences</li>
                <li>Connect with your peers</li>
                <li>Leverage your network</li>
                <li>Give back to the School</li>
              </ul>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"> No matter who you are, what you do, how old you get, your memories from your days at <?php echo strtoupper(ORGANISAION_NAME); ?> will remain one of the most cherished - For you, and for us. Come, take a trip down the memory lane and transport yourself back to your second home. </p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 15px 0px;"> We invite you to join our growing Network </p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 30px 0px;"> We have already signed-up for you and have some special somethings in store for you. </p>
              <p style="font-size:14px;line-height:20px;margin:0px 0px 0px 0px;"> <a href="<?php echo site_url('user/verify').'?email='.$email.'&code='.$activation_code; ?>" style=" background:#3dafe4; color:#1b1464; font-size:16px; text-decoration:none; border-radius:4px; padding:10px 15px; margin-right:5px;">Click here</a> to activate your account.</p></td>
          </tr>
            </tfoot>
          
      </table></td>
  </tr>
</table>
</body>
</html>
