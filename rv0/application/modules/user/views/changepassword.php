<div class="main-content register-page">

  <div class="col-lg-5 col-md-5 col-sm-6 change-password">
  <div class="page-header">
    <h1>Change Password</h1>
  </div>
  
  <form name="changepassword" method="POST" action="<?php echo base_url();?>user/updatepassword" id="changepassword" onSubmit="return formSubmit('changepassword')">
  <?php if($success_msg!='') { ?>
  <p class="error-helful bg-success col-lg-6"><i class="fa fa-check-circle-o"></i> <?php echo $success_msg; ?> </p>
  <?php } ?>
  <?php if($error_msg!='') { ?>
  <p class="error-helful bg-danger"><i class="fa fa-times-circle"></i> </i> <?php echo $error_msg; ?></p>
  <?php } ?>
    <div class="form-group">
      <label for="old_password">Old Password:</label>
      <input type="password" name="old_password" class="form-control required" alt="Old password" placeholder="Old password" />
    </div>
    <div class="form-group">
      <label for="password">New Password:</label>
      <input type="password" name="password" class="form-control required pass" alt="New password" placeholder="New password" />
    </div>
    <div class="form-group">
      <label for="cpassword">Confirm Password:</label>
      <input type="password" name="cpassword" class="form-control required cpass" alt="Confirm new password"  placeholder="Confirm new password"/>
    </div>
    <div class="buttons">
      <input class="btn btn-primary pull-right" type="submit" name="submit" value="Submit">
    </div>
    </div>
  </form>
</div>

</div>
