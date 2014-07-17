<div id="login-form">
  <div style="padding:20px;">
    <h3>Login</h3>
  </div>
  <div class="signup_wrap col-md-offset-2 col-lg-offset-2">
    <div class="signin_form">
       <?php echo form_open("user/login"); ?>
        <input type="text" id="email" name="email" value="" placeholder="Email"/>
        <input type="password" id="pass" name="pass" value="" placeholder="Password"/>
        <br /><br />
        <input type="submit" value="Sign in"  style="margin-top: -8px;" class="btn btn-primary"/>
      <?php echo form_close(); ?>
    </div>
  </div>
</div><!--<div id="login-form">-->
