<div id="content">
<div style="border-bottom:1px solid #f6f6f6;padding:10px;"><h3>Login</h3></div>
<div class="signup_wrap">
<div class="signin_form">
 <?php echo form_open("user/login"); ?>
  <input type="text" id="email" name="email" value="" placeholder="Email"/>
  <input type="password" id="pass" name="pass" value="" placeholder="password"/>
  <input type="submit" class="btn btn-primary" value="Sign in"  style="margin-top: -8px;"/>
 <?php echo form_close(); ?>
</div>
<!--<div class="signup_wrap">-->
<div class="reg_form" style="display:none;">
<div class="form_title">Sign Up</div>
<!--<div class="form_sub_title">It's free and anyone can join</div>-->
 <?php echo validation_errors('<p class="error">'); ?>
 <?php echo form_open("user/registration"); ?>
  <p>
  <label for="user_name">User Name:</label>
  <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </p>
  <p>
  <label for="email_address">Your Email:</label>
  <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
  </p>
  <p>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
  </p>
  <p>
  <label for="con_password">Confirm Password:</label>
  <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
  </p>
  <p>
  <input type="submit" class="btn btn-primary" value="Submit"/>
  </p>
 <?php echo form_close(); ?>
</div><!--<div class="reg_form">-->
</div><!--<div id="content">-->