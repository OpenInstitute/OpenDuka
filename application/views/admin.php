<div class="content">
  <b>Welcome back, <?php echo $this->session->userdata('user_name'); ?>!</b><br />
  <h3>Administration Dashboard</h3>
  <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
</div><!--<div class="content">-->