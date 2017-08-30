<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Welcome Message</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
	</head>
	<body style="margin:0; padding:0;" bgcolor="#f2f2f2">
		<table style="min-width:320px; margin: 0px auto; background:url(<?php echo ASSETS;?>/assets/images/bg.png) no-repeat bottom;" width="600px" cellspacing="0" cellpadding="0" bgcolor="#f2f2f2">
			<!-- fix for gmail -->
			<tr>
				<td class="hide">
					<table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
						<tr>
							<td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			      <?php $session = $this->session->userdata('logged_in');?>
				<td class="wrapper" style="padding:0 10px;">
					<!-- module 1 -->
					<table data-module="module-1" data-thumb="img/logo.png" width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td data-bgcolor="bg-module" bgcolor="">
								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
									<tr>
										<td style="padding:29px 0 30px;">
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<th class="flex" width="113" align="left" style="padding:0;">
														<table class="center" cellpadding="0" cellspacing="0">
															<tr>
																<td style="line-height:0;">
																	
																	<?php if(HEADERLOGO==''){ ?>
																	  <img  src="<?php echo ASSETS;?>assets/img/rightlink.png">
																	  <?php }else{ ?>
																	  <img src="<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>">
																	  <?php } ?>
																</td>
															</tr>
														</table>
													</th>
													<th class="flex" align="left" style="padding:0;">
														<table width="100%" cellpadding="0" cellspacing="0">
															<tr>
																<td data-color="text" data-size="size navigation" data-min="10" data-max="22" data-link-style="text-decoration:none; color:#888;" class="nav" align="right" style="font:bold 13px/15px Arial, Helvetica, sans-serif; color:#888;">
																	<a target="_blank" style="text-decoration:none; color:#888;" href="#"><?php echo date('M d,Y'); ?></a> 
																</td>
															</tr>
														</table>
													</th>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
					<!-- module 2 -->
					<table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellspacing="0" cellpadding="0">
						<tbody><tr>
							<td data-bgcolor="bg-module" bgcolor="">
								<table class="flexible" style="margin:0 auto;" width="600" cellspacing="0" cellpadding="0" align="center">
									<tbody>
									<tr>
										<td data-bgcolor="bg-block" class="holder" style="" bgcolor="">
											<table width="100%" cellspacing="0" cellpadding="0">
												<tbody><tr>
													<td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px; text-align: left;" align="center">
														Hello <?php echo $session['user']['firstName'].' '.$session['user']['lastName'].' '?> ! 
													</td>
												</tr>
												<tr>
													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;" align="center">
														<p style="text-align: left; color:#202020;">Welcome to the <?php echo strtoupper(ORGANISAION_NAME);?> Community, As a member of <?php echo strtoupper(ORGANISAION_NAME);?> , you receive access to our closely yet strong-knit alumni network that will be a great place to meet peers,interact and make long-lasting connections.</p>
                                                        <p style="text-align: left; color:#202020;">Stay connected to familiarize yourself to make the most of your membership!</p>
                                                        <p style="text-align: left; color:#202020;">Avail maximum benefits of our <?php echo strtoupper(ORGANISAION_NAME);?> community by checking off the following simple tasks :</p>
                                                        <ul style=" text-align:left; color:#202020;">
                                                        	<li style="margin-bottom:8px;">Update your <b><a href="<?php echo base_url();?>" >profile</a></b> for a better visibility ( Professional details and Educational details) </li>
                                                            <li style="margin-bottom:8px;">Visit our <b><a href="<?php echo base_url();?>connections">alumni profiles</a></b> and start connecting with our members</li>
                                                            <li style="margin-bottom:8px;">Post in <b><a href="<?php echo base_url();?>activity">Activity</a></b> and join the discussions</li>
                                                            <li style="margin-bottom:8px;">Check our Calendar for <b><a href="<?php echo base_url();?>events">Events</a></b></li>
                                                            <li style="margin-bottom:8px;">Check our <b><a href="<?php echo base_url();?>news">News</a></b> and stay updated with Institution.</li>
                                                        </ul>
                                                        <p style="text-align: left; color:#202020;">Please do not hesitate to contact us, should you have any questions. We are more than glad to help!</p>
                                                        <p style="text-align: left; color:#202020;">We hope you enjoy being a part of <?php echo strtoupper(ORGANISAION_NAME);?>,</p>
                                                        <p style="text-align:left; font-size:18px;">Sincerely,</p>
                                                        <p style="color:#368ee0; text-decoration:none; text-align:left;"><?php echo strtoupper(ORGANISAION_NAME);?></p>
                                                        
													</td>
												</tr>
												<tr>
													
												</tr>
											</tbody></table>
										</td>
									</tr>
									
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				 
				</td>
			</tr>
			 
			 
		</table>
	</body>
</html>
 
