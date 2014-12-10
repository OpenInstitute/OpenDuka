<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Add User</h3></center></div>
<div class="admline"></div>
<?php if($this->session->userdata('user_id') ==14){ ?>
  	  <div class="admcontent">
	  	<div class="adminstructions">Sign up the user</div>
	  	<br>
		<!--<div class="form_sub_title">It's free and anyone can join</div>-->
		 <?php echo validation_errors('<p class="error">'); ?>
		 <?php echo form_open("user/registration", array('id' => 'signup')); ?>

		  <p>
		  <label for="user_name">User Name:</label>
		  <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
		  </p>
		  <p>
		  <label for="email_address" >Your Email:</label>
		  <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
		  </p>
		  <p>
		  <label for="password" >Password:</label>
		  <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
		  </p>
		
		  <p>
		  <input type="submit" class="UserAdd btn-custom " value="Submit" />
		  </p>
		 <?php echo form_close(); ?>
		</div><!--<div class="reg_form">-->
	 </div>
  	<?php }
  	else { ?>
  	 <div class="admcontent">
  	<div><p><h3>You do not have enough permission to add a new user</h3></p></div>
  	<?php } ?>
  </div>

  </div>