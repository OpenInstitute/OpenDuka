
<?php 
function verb_words(){
$verb = array("appointed","employed","nominated","temporary","suspended","reappoints","revoked");

	for ($j=0; $j < sizeof($verb); $j++) {
		echo "<option value=" . $verb[$j] . ">" . $verb[$j] ."</option>";
	}
	//return $v;
}
?>
<div class="content">
<h2>Administration Dashboard</h3>
  <h3>Welcome <?php echo $this->session->userdata('user_name'); ?>! <span class="logoff"><?php echo form_open("user/logout", array('id' => 'logoff')); ?><input type="submit" value="Log Off"/> <?php echo form_close(); ?> </span></h3>
  
  
  <div class="three_col">
  	<div class="col1 trigger" name="EInsert0">Entity Insert</div>
  	<div class="col1 trigger" name="EInsert2">Entity Edit</div>
  	<?php if($this->session->userdata('user_id') ==1){ ?>
  	<div class="col1 trigger" name="EInsert1">Add User</div>
  	<?php } ?>
  	<div class="col1 trigger" name="EInsert3">Entity Merge</div>
  	<div class="col1"></div>
  </div>

<div class="backlink">
	<div class="col1">Back to menu </div>
	<div class="col1"></div>
</div>

<div id="form_title"></div>
<div id="result"></div>
<div class="AdminCont">
  	  <div id="EInsert0" class="formdata">
   
	  	<div class="spacer">&nbsp;<div class="select must">Type</div><div class="textfield must">Entity</div><div class="addrfield">Unique Box 'P.O. Box NNN'</div><div class="datefield must">Start Date<br>dd/mm/yy	</div><div class="datefield">End Date</div><div class="textfield must">Source '2013_GAZ123'</div><div class="textfield">Appointer</div></div>
	  	
		<?php echo form_open("", array('id' => 'EntityAdd')); ?>
		<div class="spacer"><select class="select" name="type0"><option value="22">Person</option><option value="21" selected>Organization</option></select><input type="text" id="entity0" name="entity0" value=""  class="textfield" required/><input type="text" id="address0" name="address0" value=""  class="addrfield" /><input type="text" id="startdate0" name="startdate0" value=""  class="datefield" required/><input type="text" id="enddate0" name="enddate0" value=""  class="datefield" /><input type="text" id="src0" name="src0" value=""  class="textfield" required/><input type="text" id="appointer0" name="appointer0" value=""  class="textfield"/> -- root entity</div> 
		<div class="spacer"><select class="select" name="type1"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity1" name="entity1" value=""  class="textfield" required /><input type="text" id="address1" name="address1" value=""  class="addrfield" /><input type="text" id="startdate1" name="startdate1" value=""  class="datefield" required/><input type="text" id="enddate1" name="enddate1" value=""  class="datefield" /><select class="select" name="verb1"><?php verb_words();?></select><input type="checkbox" name="belong" id="belong" /> -- if belongs to above</div>
		  <input type="hidden" id="items" name="items" value="2"/>
		 <div class="elementAdd" name="EInsert0"><img tag="Add text field" src="<?php echo base_url();?>assets/img/more.png" width="40%"/></div> <br/>
		 <div class="center">&nbsp;<input type="button" class="EntityAdd btn-primary"  value="Submit" /></div>
		  
		 <?php echo form_close(); ?>

	 </div>
	  <div id="EInsert1" class="formdata">
	  	<!--<div class="signup_wrap">-->
		<div class="reg_form" style="display:block;">
		<div style="border-bottom:1px solid #f6f6f6;padding:10px;"><h3>Sign Up</h3></div>
		<!--<div class="form_sub_title">It's free and anyone can join</div>-->
		 <?php echo validation_errors('<p class="error">'); ?>
		 <?php echo form_open("user/registration", array('id' => 'signup')); ?>
		  <p>
		  <label for="user_name" class="signup">User Name:</label>
		  <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
		  </p>
		  <p>
		  <label for="email_address" class="signup">Your Email:</label>
		  <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
		  </p>
		  <p>
		  <label for="password" class="signup">Password:</label>
		  <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
		  </p>
		 <!-- <p>
		  <label for="con_password" class="signup">Confirm Password:</label>
		  <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
		  </p>-->
		  <p>
		  <input type="submit" class="UserAdd btn-primary" value="Submit"/>
		  </p>
		 <?php echo form_close(); ?>
		</div><!--<div class="reg_form">-->
	 </div>
	 <div id="EInsert2" class="formdata">
		<div class="reg_form" style="display:block;">
		 <?php echo form_open("", array('id' => 'EntityEdit')); ?>
		  <p>
		  <label for="user_name" >GAZ Number: '2013_GAZ123'</label>
		  <input type="text" id="GazID" name="gazID" value="" />
		   
		  <input type="button" class="EntityEdit" value="Submit"/>
		  </p>
		 <?php echo form_close(); ?>
		</div>
		<div id="entity_edit"></div>
	 </div>
	 
	 <div id="EInsert3" class="formdata">
		<div class="reg_form" style="display:block;">

		  <p>
		  <label for="EntityMergeName" >Entity Name</label>
		  <input type="text" id="EntityMergeName" name="EntityMergeName" value="" />
		  </p>

		</div>
		<div id="entity_merge"></div>
	 </div>
 </div>
 
</div><!--<div class="content">-->

<script>
$('.formdata').hide();

$(".trigger").click(function() {
 
 $("#result").html('');
 
	$('.formdata').hide();
        var name = $(this).attr('name');
      	//alert(name);
	$('#'+name +'.formdata').show();
	
	if (name=='EInsert0'){
 		$("#form_title").html('<h3>Entity Add</h3>');
 	}
 	if (name=='EInsert1'){
 		$("#form_title").html('<h3>User Add</h3>');
 	}
 	if (name=='EInsert2'){
 		$("#form_title").html('<h3>Entity Edit</h3>');
 	}
 	
 	if (name=='EInsert3'){
 		$("#form_title").html('<h3>Entity Merge</h3>');
 	}
	
	$(".three_col").fadeOut("slow");
	$(".backlink").fadeIn("slow");
});

$(".backlink").click(function() {
	$(".backlink").fadeOut("slow");
	$(".three_col").fadeIn("slow");
	
	$('.formdata').hide();
	$('#form_title').hide();
	$("#result").hide("slow");
});


$(".EntityAdd").click(function() {

	
// abort any pending request
    /*clear result div*/
   $("#result").html('');
   
    // setup some local variables
    var $form = $("#EntityAdd");
    
    // let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();

    // let's disable the inputs for the duration of the ajax request
    //$inputs.prop("disabled", true);
    
   //alert(serializedData);
       
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/entityAdd",
      type: "post",
      async: false, 
      data: serializedData,
      success:function(d){
     // alert(d);
        data_in = $.parseJSON(d); //JSONparses(data)
          
          if (data_in['submit']==0){
		   $inputs.prop("disabled", false);
		   $("#result").html(data_in['errors']);
           } else {
		   $inputs.prop("disabled", false);
		   $("#result").html("Submit Successful");
		   $(':input','#EntityAdd').not(':button, :submit, :reset, :hidden')
			.val('')
			.removeAttr('checked');
			//.removeAttr('selected');
	   }
      },
      error:function(d){
          alert("failure: ");
          $("#result").html('there is error while submit');
      }
    });	    
});

$(".UserAdd").click(function() {
	$("#signup").validate();
});

var currentItem = 2;

$(".elementAdd").click(function() {

	var name = $(this).attr('name'); 
	//$('input#password').after(newInput);
	var newSet = ('<div class="spacer spacer'+ currentItem +'"> <select class="select" name="type'+ currentItem +'"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity'+ currentItem +'" name="entity'+ currentItem +'" value="" class="textfield"><input type="text" id="address'+ currentItem +'" name="address'+ currentItem +'" value=""  class="addrfield"><input type="text" id="startdate'+ currentItem +'" name="startdate'+ currentItem +'" value=""  class="datefield" required><input type="text" id="enddate'+ currentItem +'" name="enddate'+ currentItem +'" value=""  class="datefield"><select class="select" name="verb'+ currentItem +'"><?php verb_words();?></select><div class="elementDel" onclick="elementDel(\'spacer'+ currentItem +'\');" name="spacer'+ currentItem +'"><img tag="Del row" src="<?php echo base_url();?>assets/img/less.png" width="20px"></div></div>');
	//alert(newSet);
	
currentItem++;
	$('#items').val(currentItem);

	$('input#items').before(newSet);
});


function elementDel(val) {
 	if (confirm('continue delete?')) {//alert('tuko');
		currentItem--;
		$('#items').val(currentItem);
		$('.'+val).remove();
	//alert(newSet);
	}
}

$(".EntityEdit").click(function() {
	// abort any pending request
    /*clear result div*/
   $("#result").html('');
    // setup some local variables
    var $form = $("#EntityEdit");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/entityEdit",
      type: "post",
      async: false, 
      data: serializedData,
      success:function(data){
      	//alert(data);
          $("#entity_edit").html(data);
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while submit');
      }
    });

});

function EntityUpdate() {
	// abort any pending request
//	alert('test');
    /*clear result div*/
   $("#result").html('');
    // setup some local variables
    var $form = $("#EntityUpdate");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/entityupdate",
      type: "post",
      async: false, 
      data: serializedData,
      success:function(data){
      	//alert(data);
          $("#entity_edit").html(data);
          $("#result").html("Update Done");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while submit');
      }
    });

}

$("#EntityMergeName").keyup(function() {
  $("#result").html('');
	 // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 18 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Allow only permitted chars
            var chr = String.fromCharCode( event.keyCode );
            //alert(chr);
            
            if( (/^[a-zA-Z\s'-]*$/.test(chr)) ) {
                event.preventDefault();
           	// alert($("#EntityMergeName").val());  
              /*clear result div*/
     		
		     /* Send the data using post and put the results in a div */
		     $.ajax({
		      url: "<?php echo base_url();?>index.php/admin/EntityMergeSearch",
		      type: "post",
		      async: false,
		      data: {STerm : $("#EntityMergeName").val()},
		      success:function(data){
		      	//alert(data);
			  $("#entity_merge").html(data);
		      },
		      error:function(){
			  alert("failure");
			  $("#result").html('there is error while submit');
		      }
		    });
            }
        }
  

});

function EntityMerge() {
	var checked = [] ;
	$("input[name='Merge[]']:checked").each(function ()
	{
	    checked.push(parseInt($(this).val()));
	});
	
	if (checked.length>1){
	//alert(checked);
		$.ajax({
		      url: "<?php echo base_url();?>index.php/admin/EntityMerger",
		      type: "post",
		      async: false,
		      data: {MergeEnt : checked+""},
		      success:function(d){
		      	//alert(data);
			  $("#entity_merge").html(d);
		      },
		      error:function(){
			  alert("failure");
			  $("#result").html('there is error while submit');
		      }
		    });
	
	} else {
	
	alert('You need to select more than 1 Entity to Merge');
	
	}	
			
}
</script>
