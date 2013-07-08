

<div class="content">
<h2>Administration Dashboard</h3>
  <h3>Welcome <?php echo $this->session->userdata('user_name'); ?>! <span class="logoff"><?php echo form_open("user/logout", array('id' => 'logoff')); ?><input type="submit" value="Log Off"/> <?php echo form_close(); ?> </span></h3>
  
  
  <div class="three_col">
  	<div class="col1 trigger" name="EInsert0">Entity Insert</div>
  	<div class="col1 trigger" name="EInsert1">Entity Edit</div>
  	<div class="col1"></div>
  </div>

<div class="backlink">
	<div class="col1">Back to menu </div>
	<div class="col1"></div>
</div>

  <div class="AdminCont">
	  <div id="EInsert0" class="formdata">
	  	
	  	<div class="spacer">&nbsp;</div><div class="select must">Type</div><div class="textfield must">Entity</div><div class="addrfield">Address <br/>'P.O. Box NNN'</div><div class="datefield must">Start Date</div><div class="datefield">End Date</div><div class="textfield must">Source</div>
	  	
		 <?php echo form_open("admin/entityAdd", array('id' => 'EInsert')); ?>
		 <div class="valid"></div>
		<div class="spacer"><b>!</b></div> <select class="select" name="type0"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity0" name="entity0" value=""  class="textfield" required/><input type="text" id="address0" name="address0" value=""  class="addrfield" /><input type="text" id="startdate0" name="startdate0" value=""  class="datefield" required/><input type="text" id="enddate0" name="enddate0" value=""  class="datefield" /><input type="text" id="src0" name="src0" value=""  class="textfield" required/> -- root entity
		<br/>
		<div class="spacer">&nbsp;</div> <select class="select" name="type1"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity1" name="entity1" value=""  class="textfield" required /><input type="text" id="address1" name="address1" value=""  class="addrfield" /><input type="text" id="startdate1" name="startdate1" value=""  class="datefield" required/><input type="text" id="enddate1" name="enddate1" value=""  class="datefield" /><select class="select" name="verb1"><option value="appointed">appointed</option><option value="employed">employed</option></select>
		  <input type="hidden" id="items" name="items" value="2"/>
		 <div class="elementAdd" name="EInsert0"><img tag="Add text field" src="<?php echo base_url();?>assets/img/more.png" width="40%"/></div> <br/>
		 <div class="center">&nbsp;<input type="submit" class="btn btn-primary"  value="Submit" /></div>
		  
		 <?php echo form_close(); ?>

	 </div>
	 <div id="EInsert1" class="formdata">
	  	<div class="signin_form">
		 <?php echo form_open("user/login"); ?>
		  <input type="text" id="email" name="email" value="" placeholder="Email"/>
		  <input type="password" id="pass" name="pass" value="" placeholder="password"/>
		  <input type="submit" class="btn btn-primary" value="Sign in"/>
		 <?php echo form_close(); ?>
		 </div>
	 </div>
 </div>
 
</div><!--<div class="content">-->

<script>
$('.formdata').hide();

$(".trigger").click(function() {
	$('.formdata').hide();
        var name = $(this).attr('name');
      	//alert(name);
	$('#'+name +'.formdata').show();
	
	$(".three_col").fadeOut("slow");
	$(".backlink").fadeIn("slow");
});

$(".backlink").click(function() {
	$(".backlink").fadeOut("slow");
	$(".three_col").fadeIn("slow");
	
	$('.formdata').hide();
	
});

$(".btn-primary").click(function() {
	$("#EInsert").validate();
});


var currentItem = 2;
$(".elementAdd").click(function() {

	var name = $(this).attr('name');
	//$('input#password').after(newInput);
	var newSet = ('<br /><div class="spacer">&nbsp;</div> <select class="select" name="type'+ currentItem +'"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity'+ currentItem +'" name="entity'+ currentItem +'" value=""  class="textfield" required /><input type="text" id="address'+ currentItem +'" name="address'+ currentItem +'" value=""  class="addrfield" /><input type="text" id="startdate'+ currentItem +'" name="startdate'+ currentItem +'" value=""  class="datefield" required /><input type="text" id="enddate'+ currentItem +'" name="enddate'+ currentItem +'" value=""  class="datefield" /><select class="select" name="verb'+ currentItem +'"><option value="appointed">appointed</option><option value="employed">employed</option></select>');
	//alert(newSet);
	
currentItem++;
$('#items').val(currentItem);

	$('input#items').before(newSet);
});
</script>
