 
 	 <!--My own!-->
<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Add Entity</h3></center></div>
  <div id="EInsert0" class="formdata">
   
	  	<div class="spacer">&nbsp;<div class="select must">Type</div><div class="textfield must">Entity</div><div class="addrfield">Position</div><div class="addrfield">Unique Box 'P.O. Box NNN'</div><div class="datefield must">Start Date<br>dd/mm/yy	</div><div class="datefield">End Date</div><div class="textfield must">Source '2013_GAZ123'</div><div class="textfield">Appointer</div></div>
	  	
		<?php echo form_open("", array('id' => 'EntityAdd')); ?>
		<div class="spacer"><select class="select" name="type0"><option value="22">Person</option><option value="21" selected>Organization</option></select><input type="text" id="entity0" name="entity0" value=""  class="textfield" required/><input type="text" id="position0" name="position0" value=""  class="addrfield" /><input type="text" id="address0" name="address0" value=""  class="addrfield" /><input type="text" id="startdate0" name="startdate0" value=""  class="datefield" required/><input type="text" id="enddate0" name="enddate0" value=""  class="datefield" /><input type="text" id="src0" name="src0" value=""  class="textfield" required/><input type="text" id="appointer0" name="appointer0" value=""  class="textfield"/> -- root entity</div> 
		<div class="spacer"><select class="select" name="type1"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity1" name="entity1" value=""  class="textfield" required /><input type="text" id="position1" name="position1" value=""  class="addrfield" /><input type="text" id="address1" name="address1" value=""  class="addrfield" /><input type="text" id="startdate1" name="startdate1" value=""  class="datefield" required/><input type="text" id="enddate1" name="enddate1" value=""  class="datefield" /><select class="select" name="verb1"><?php echo $verb_word;?></select><input type="checkbox" name="belong" id="belong" /> -- if belongs to above</div>
		  <input type="hidden" id="items" name="items" value="2"/>
		 <div class="elementAdd" name="EInsert0"><img tag="Add text field" src="<?php echo base_url();?>assets/img/more.png" width="40%"/></div> <br/>
		 <div class="center">&nbsp;<input type="button" class="EntityAdd btn-primary"  value="Submit" /></div>
		  
		 <?php echo form_close(); ?>

	 </div>
	 </div>

	 <script>
	 	$(".elementAdd").click(function() {

	var name = $(this).attr('name'); 
	//$('input#password').after(newInput);
	var newSet = ('<div class="spacer spacer'+ currentItem +'"> <select class="select" name="type'+ currentItem +'"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity'+ currentItem +'" name="entity'+ currentItem +'" value="" class="textfield"><input type="text" id="position'+ currentItem +'" name="position'+ currentItem +'" value=""  class="addrfield"><input type="text" id="address'+ currentItem +'" name="address'+ currentItem +'" value=""  class="addrfield"><input type="text" id="startdate'+ currentItem +'" name="startdate'+ currentItem +'" value=""  class="datefield" required><input type="text" id="enddate'+ currentItem +'" name="enddate'+ currentItem +'" value=""  class="datefield"><select class="select" name="verb'+ currentItem +'"><?php echo $verb_word; ?></select><div class="elementDel" onclick="elementDel(\'spacer'+ currentItem +'\');" name="spacer'+ currentItem +'"><img tag="Del row" src="<?php echo base_url();?>assets/img/less.png" width="20px"></div></div>');
	//alert(newSet);
	
currentItem++;
	$('#items').val(currentItem);

	$('input#items').before(newSet);
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

	 </script>


		

