<table style="background:#eaeced;" cellspacing="0" cellpadding="0" width="100%">
<tbody>
<tr>
	<td>
		<table cellspacing="0" cellpadding="0" width="600" align="center">
		<!-- Main Wrapper Table with initial width set to 60opx -->
		<tbody>
		<tr>
			<!-- Introduction area -->
			<td>
				<table style="margin-bottom: 30px" cellspacing="0" cellpadding="0" width="100%" align="left">
				<tbody>
				<tr>
					<!-- row container for TITLE/EMAIL THEME -->
					<td>
						
						<?php if(HEADERLOGO==''){ ?>
						 <img  src="<?php echo ASSETS;?>assets/img/rightlink.png">
						 <?php }else{ ?>
						 <img src="<?php echo base_url();?>uploads/user_images/<?php echo HEADERLOGO;?>">
						 <?php } ?><br>
					</td>
					<td class="date" style="font-size: 14px; margin-top: 86px; font-weight: 400; color: #8c8890; font-family: Arial; float: right;">
					     <?php echo date('M d,Y'); ?>
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<!-- HTML IMAGE SPACER -->
			<td style="font-size: 0; background:#FFFFFF; border-radius: 8px 8px 0px 0px; line-height: 0; text-align: center;" height="290px">
				<img src="https://rightlink.org/am/assets/images/uploads/templates/717d3380d9be220a743b8995f0c968c2.jpg"><br>
			</td>
		</tr>
		<tr>
			<!-- Introduction area -->
			<td>
				<table style="background: #ea4d00; border-radius: 0px 0px 8px 8px; padding: 25px 0px" cellspacing="0" cellpadding="0" width="100%" align="left">
				<tbody>
				<tr>
					<!-- row container for TITLE/EMAIL THEME -->
					<td style="font-size: 24px; font-weight: 400; color: #FFFFFF; font-family: Arial;" align="center">
						Are you utilizing Your <?php $org =getorgtype();
		         if($org[0]->organizationType=="college"){?> College  <?php } else if($org[0]->organizationType=="school") ?>  School <?php }  ?>
					</td>
				</tr>
				<tr>
					<!-- row container for Tagline -->
					<td style="font-size: 42px; font-weight:400; color: #FFFFFF; font-family: Arial;" align="center">
						Alumni NETWORK ?
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<!-- Introduction area -->
			<td>
				 
			</td>
		</tr>
		<tr>
			<!-- Introduction area -->
			<td>
				 
			</td>
		</tr>
		<tr>
			<!-- Introduction area -->
			 
		</tr>
		<tr bgcolor="#e2e4e4">
			<td>
				<table class="footer" style=" margin-bottom: 40px;" cellspacing="0" cellpadding="0" width="100%" align="center">
				<!-- First column of footer content -->
				<tbody>
				<tr>
					<td>
						<p style=" float: left; width: 100%; font-size: 24px; font-weight:400; color: #8c8890; margin: 25px 0 15px 0px; font-family: Arial;" align="center">
							All you need to do is
						</p>
						<span style="width: 100%; float: left;" data-redactor-style="width: 100%; float: left;">
						<a align="center" style=" padding: 10px 64px; background-color: #408f37; text-decoration: none; border-radius: 6px; border-bottom: 3px solid #006000; font-size: 42px; color:#FFFFFF; width: 178px; margin: auto; display: block; font-weight: 100; font-family: Arial;" href="{link}">click here</a>
						<p style=" font-size: 24px; width:68%; font-weight:400; margin: auto; display: block; color: #8c8890; padding: 15px 0px; font-family: Arial;" align="center">
							to update your profile to gain access to your Alumni network!
						</p>
						<p style=" font-size: 24px; width:77%; font-weight:400; margin: auto; display: block; color: #8c8890; padding: 0px 0px 18px 0px; font-family: Arial;" align="center">
							We promise, 
							<br>
							<strong>It won't take more than a minute</strong> to do so <br>
							as you don't have to login
						</p>
						</span>
					</td>
				</tr>
				<tr>
					<!-- row container for TITLE/EMAIL THEME -->
					<td style="font-size: 14px; font-weight: 400; color: #8c8890; font-family: Arial;" align="center">
						Regards
					</td>
				</tr>
			    <tr>
					<!-- row container for Tagline -->
					<td style="font-size: 14px; font-weight:700; color: #8c8890; font-family: Arial;" align="center">
						 <?php echo strtoupper(ORGANISAION_NAME);?>
					</td>
				</tr>
				 
				</tbody>
				</table>
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>
