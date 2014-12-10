<!--Admin Dashboard header-->
<div class="col-lg-12" id="header-bck">
	<div class="col-md-4 headertxt">&nbsp;</div>
	<div class="col-md-7 headertxt" style="font-size:20px; padding-top:18px;"><centre><?php echo $this->session->userdata('user_name'); ?>, Karibu Kaya!</center></div>
	<div class="col-md-1 " style="padding-top:15px;"><span class="logoff"><?php echo form_open("user/logout", array('id' => 'logoff')); ?><input type="submit" class="btn-custom" value="Log Out"/> <?php echo form_close(); ?> </span></div>
</div>
<div id="body" class="container">

    <div id="content" class="row">