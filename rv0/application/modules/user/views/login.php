login page
<form method="post" name="login_user" id="login_user" action="<?php echo base_url('user/doLogin'); ?>">
  <input name="email" id="email" placeholder="Email" />
  <input name="pass" id="pass" placeholder="password" />
  <input type="submit" name="submit" id="submit" value="Login"/>
</form>
