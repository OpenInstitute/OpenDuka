
<div id="admin-board" class="section">
<h2>Administration Dashboard</h3>
  <h3>Welcome <?php echo $this->session->userdata('user_name'); ?>! <span class="logoff"><?php echo form_open("user/logout", array('id' => 'logoff')); ?><input type="submit" value="Log Off"/> <?php echo form_close(); ?> </span></h3>
  
  
  <div class="three_col">

	<div class="col1 trigger" name="EInsert4">Insert Datasets</div>
  	<div class="col1 trigger" name="EInsert5">Manage Dataset</div>

  	<?php if($this->session->userdata('user_id') ==1){ ?>
  	<div class="col1 trigger" name="EInsert1">Add User</div>
  	<?php } ?>
  	<div class="col1 trigger" name="EInsert3">Entity Merge</div>

  <!--	<div class="col1 trigger" name="EInsert0">Entity Insert</div> -->
	<div class="col1 trigger" name="EInsert2">Entity Edit</div>

  </div>

<div class="backlink">
	<div class="col1">Back to menu </div>
	<div class="col1"></div>
</div>

<div id="form_title"></div>
<div id="result"></div>
<div class="AdminCont">
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
		  <p>
		  <label for="EntityEditName" >Entity Name</label>
		  <input type="text" id="EntityEditName" name="EntityEditName" value="" />
		  </p>
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

 	<div id="EInsert4" class="formdata">


		<div id="Datasets" style="display:block;">
		
		 <img id="loading" src="<?php echo base_url();?>assets/img/loading.gif" style="display:none;">
		 <div class="reg_form" style="display:block;">
		 <?php echo form_open_multipart("", array('id' => 'DatasetAdd')); ?>
		 <p>
		  <label for="cat_name" class="textfield">Category:</label>
		  <select id="cat_name" name="cat_name" value="" /></select>
		  </p>
		  <p>
		  <label for="TblName" class="textfield">Dataset Name:</label>
		 <input type="text" id="TblName" name="TblName" value="" />
		 </p>
		  <p>
		  Upload a comma separated CSV document. Please ensure that it has atleast 2 columns that contain Entity Names.	
		   <label for="fileToUpload" class="textfield">Select File:</label>
		   <input type="file" id="fileToUpload" name="fileToUpload" />
		 </p>
		 <p>
		  <input type="button" class="DatasetAdd" value="Submit"/>
		  </p>
		 <?php echo form_close(); ?>
		</div> 
		  <div id="viwanja"></div>
		</div>
	 </div>


	<div id="EInsert5" class="formdata">
		<div id="Datasets" style="display:block;">
		
		 <img id="loading" src="<?php echo base_url();?>assets/img/loading.gif" style="display:none;">
		 <div class="reg_form" style="display:block;">
		 <?php echo form_open_multipart("", array('id' => 'DatasetEdit')); ?>
		 <p>
		  <label for="dataset_name" class="textfield">Dataset:</label>
		  <select id="dataset_name" name="dataset_name" value="" /></select>
		 </p>
		 <?php echo form_close(); ?>
		</div> 
		  <div id="viwanjaEdit"></div>
		</div>
	 </div>
   </div>
</div>

<script>
$('.formdata').hide();

$("#table_name").change(function() {
	$("#table_name option:selected").each(function() {
	val = $(this).text();
		if (val != 'Select Table'){
			//alert(val);
			field_list(val);
		}
	});
});


$("#dataset_name").change(function() {
	$("#dataset_name option:selected").each(function() {
	val = $(this).text();
		if (val != 'Select Table'){
			//alert(val);
			field_list_edit(val);
		}
	});
});


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
 	
 	if (name=='EInsert4'){
 		$("#form_title").html('<h3>Dataset Insert</h3>');
 		ListDocCat();
 	}


	if (name=='EInsert5'){
 		$("#form_title").html('<h3>Manage Dataset</h3>');
 		ListDataset();
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
	var newSet = ('<div class="spacer spacer'+ currentItem +'"> <select class="select" name="type'+ currentItem +'"><option value="22">Person</option><option value="21">Organization</option></select><input type="text" id="entity'+ currentItem +'" name="entity'+ currentItem +'" value="" class="textfield"><input type="text" id="position'+ currentItem +'" name="position'+ currentItem +'" value=""  class="addrfield"><input type="text" id="address'+ currentItem +'" name="address'+ currentItem +'" value=""  class="addrfield"><input type="text" id="startdate'+ currentItem +'" name="startdate'+ currentItem +'" value=""  class="datefield" required><input type="text" id="enddate'+ currentItem +'" name="enddate'+ currentItem +'" value=""  class="datefield"><select class="select" name="verb'+ currentItem +'"><?php echo $verb_word; ?></select><div class="elementDel" onclick="elementDel(\'spacer'+ currentItem +'\');" name="spacer'+ currentItem +'"><img tag="Del row" src="<?php echo base_url();?>assets/img/less.png" width="20px"></div></div>');
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

$("#EntityEditName").keyup(function() {
	// abort any pending request
    /*clear result div*/
  $("#result").html('');
  //alert(event.keyCode);
	 // Allow: backspace, delete, tab, escape, and enter event.keyCode == 8 
        if ( event.keyCode == 46 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 18 ||
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
            
            if( (/^[a-zA-Z\s'-]*$/.test(chr)) || event.keyCode == 8  ) {
                event.preventDefault();
           	// alert($("#EntityMergeName").val());  
              /*clear result div*/
     		
		     /* Send the data using post and put the results in a div */
		     $.ajax({
		      url: "<?php echo base_url();?>index.php/admin/EntityEditSearch",
		      type: "post",
		      async: false,
		      data: {STerm : $("#EntityEditName").val()},
		      success:function(data){
		      	//alert(data);
			  $("#entity_edit").html(data);
		      },
		      error:function(){
			  alert("failure");
			  $("#result").html('there is error while submit');
		      }
		    });
            }
        }
  

});


function EntityUpdate(id) {
	// abort any pending request
	//alert(id);
    /*clear result div*/
   $("#result").html('');
    // setup some local variables
    var $form = $("#EntityUpdate");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/EntityUpdate",
      type: "post",
      async: false, 

      data:{ID: id},
      success:function(data){
      	//alert(data);
          $("#entity_edit").html(data);
          $("#result").html("Update Done");
      },
      error:function(data){
         // alert(data.error);
          $("#result").html('there is error while submit');
      }
    });

}

function EntityUpdater() {

    $("#result").html('');
    // setup some local variables
    var $form = $("#EntityUpdateForm");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/EntityUpdater",
      type: "post",
      async: false, 
      data: serializedData,
      success:function(dat){

     //    $("#result").html(dat);
        
         $("#result").html("Update Done");
      },
      error:function(d){
          alert("failure"+d);
          $("#result").html('there is error while submit');
      }
    });	
}


$(".DatasetAdd").click(function() {
	// abort any pending request
    /*clear result div*/
   $("#result").html('');
    // setup some local variables
    $("#DatasetAdd")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});
	if ($("#TblName").val().length<=4){
	alert("The Table name needs to be more than 5 characters");
	return false;
	}
  	
  	$.ajaxFileUpload ({

		url: "<?php echo base_url();?>index.php/admin/DatasetAdd",
		secureuri:false,
		fileElementId:'fileToUpload',
		dataType: 'json',
		data:{TblName: $("#TblName").val(), DocumentType:$("#cat_name").val()},
		success: function (data, status)
		{
			if(typeof(data.error) != 'undefined')
			{
				if(data.error != '')
				{
					alert(data.error);
				}else
				{
					alert(data.msg);
					field_list($("#TblName").val(), $("#cat_name").val());
				}
			}
		},
		error: function (data, status, e)
		{
			alert(e);
		}
	})

	return false;

	// let's select and cache all the fields
/*    var $inputs = $form.find("input, select, textarea"); /
    // serialize the data in the form
    var serializedData = $form.serialize();
     /* Send the data using post and put the results in a div 
     alert (serializedData);
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/DatasetAdd",
      type: "post",
      enctype: 'multipart/form-data',
      async: false, 
      data: serializedData,
      success:function(data){
      	//alert(data);
          $("#result").html(data);
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while submit');
      }
    });
*/
});


$("#EntityMergeName").keyup(function() {
  $("#result").html('');
  //alert(event.keyCode);
	 // Allow: backspace, delete, tab, escape, and enter event.keyCode == 8 
        if ( event.keyCode == 46 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 18 ||
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
            
            if( (/^[a-zA-Z\s'-]*$/.test(chr)) || event.keyCode == 8  ) {
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

function ListTables() {
 
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/ListTable",
      type: "post",
      async: false, 
      data: "",
      success:function(data){
      	//alert(data);
          $("#table_name").html(data);
          $("#result").html("select table");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while listing tables');
      }
    });	
}

function ListDataset() {
 
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/ListTable",
      type: "post",
      async: false, 
      data: "",
      success:function(data){
      	//alert(data);
          $("#dataset_name").html(data);
          $("#result").html("select table");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while listing tables');
      }
    });	
}

function ListDocCat() {
 
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/ListDocCat",
      type: "post",
      async: false, 
      data: "",
      success:function(data){
      	//alert(data);
          $("#cat_name").html(data);
          $("#result").html("Select Category");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while listing categories');
      }
    });	
}

function field_list(meza,DocType){
	//alert(table);
	$.ajax({
	      url: "<?php echo base_url();?>index.php/admin/ListField",
	      type: "post",
	      async: false, 
	      data: {STab : meza, DType : DocType},
	      success:function(data){
	      	//alert(data);

		 $("#viwanja").html(data);
		   
		 $(".selectfield").click(function(){
	
		   var op = $(this).parent().find(':checkbox').attr('checked');
		    $(':checkbox', this).each(function() {
			this.checked = !this.checked;
		    });
		   var verbcont  = $("div#verbs").html();
		    if (op) {
		    	$(this).parent().find('.selectverb').html(verbcont);
		    } else { 
		    	$(this).parent().find('.selectverb').html('');
		    }
	//alert(verbcont);
		});

	
		  $("#result").html("select fields");
	      },
	      error:function(){
		  alert("failure");
		  $("#result").html('there is error while listing fields');
	      }
	 });

}

	
		
function EntityExtract() {

    $("#result").html('');
    // setup some local variables
    var $form = $("#DatasetInsert");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();
     /* Send the data using post and put the results in a div */
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/EntityExtract",
      type: "post",
      async: false, 
      data: serializedData,
      success:function(dat){

         $("#result").html(dat);
        
        // $("#result").html("Update Done");
      },
      error:function(d){
          alert("failure"+d);
          $("#result").html('there is error while submit');
      }
    });	
}



</script>
