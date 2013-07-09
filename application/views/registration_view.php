<div id="content">
<div style="border-bottom:1px solid #f6f6f6;padding:10px;"><h3>Login</h3></div>
<div class="signup_wrap">
<div class="signin_form">
 <?php echo form_open("user/login"); ?>
  <input type="text" id="email" name="email" value="" placeholder="Email"/>
  <input type="password" id="pass" name="pass" value="" placeholder="password"/>
  <input type="submit" value="Sign in"  style="margin-top: -8px;"/>
 <?php echo form_close(); ?>
</div>

</div><!--<div id="content">-->
