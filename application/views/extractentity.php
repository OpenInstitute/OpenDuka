<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Extract Entity</h3></center></div>
<div class="admline"></div>
<div class="admcontent">
		 <?php echo form_open("", array('id' => 'DatasetEntityAdd')); ?>
		  	<img id="loading" src="<?php echo base_url();?>assets/img/loading.gif" style="display:none;">
			<div class="reg_form">
			 <?php echo form_open_multipart("", array('id' => 'DatasetEntityEdit')); ?>
			 <p>
			  <label for="dataset_entity_name" class="textfield">Dataset:</label>
			  <select id="dataset_name" class="dataset_entity_name" name="dataset_entity_name" value="" /></select>
			 </p>
			 
			 <?php echo form_close(); ?>
			</div> 
			<div id="viwanjaEdit"></div>
		</div> 
</div> 
</div>
<script>
ListDataset();
function ListDataset() {
 
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/ListTable",
      type: "post",
      async: false, 
      data: "",
      success:function(d){
      	//alert(data);
          $("#dataset_name").html(d);
          $("#result").html("select table");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while listing tables');
      }
    });	
}

$("#dataset_name").change(function() {
	var name = $(this).attr('name');
      	//alert(name);
      	
	$("#dataset_name option:selected").each(function() {
	val = $(this).text();
		if (val != 'Select Table'){
			//alert(val);
			if (name=='dataset_entity_name'){
			field_list_edit_entity(val);
			}
		}
	});
});

function field_list_edit_entity(meza){
	//alert(meza);
	$.ajax({
	      url: "<?php echo base_url();?>index.php/admin/ListFieldEntityEdit",
	      type: "post",
	      async: false, 
	      data: {STab : meza},
	      success:function(data){
	      	//alert(data);

		 $("#viwanjaEdit").html(data);
		   
		 $(".selectfield").click(function(){
	
		   var op = $(this).parent().find(':checkbox').attr('checked');
		    $(':checkbox', this).each(function() {
			this.checked = !this.checked;
		    });
		    /*
		   var verbcont  = $("div#verbs").html();
		    if (op) {
		    	$(this).parent().find('.selectverb').html(verbcont);
		    } else { 
		    	$(this).parent().find('.selectverb').html('');
		    }*/
		//alert(verbcont);
		});
		
		$("#DatasetEditBT").click(function(){
		//	var $form = $("#DatasetEntityAdd");
		//	var $inputs = $form.find("input, select, textarea");
		    // serialize the data in the form
		//    var forminfo = $form.serialize();
		    //alert (forminfo);
			EntityExtract();
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
    var $form = $("#DatasetEntityAdd");
	// let's select and cache all the fields
    var $inputs = $form.find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();
   
    var checked = [] ;
	$("input[name='Extract[]']:checked").each(function (){
	    checked.push(parseInt($(this).val()));
	});
	//alert(checked.length);
	if (checked.length < 2 ) { alert("Please select at-least two fields to extract entities from!");}	
	
	else {
    // setup some local variables
     /* Send the data using post and put the results in a div */
		    $.ajax({
		      url: "<?php echo base_url();?>index.php/admin/EntityExtract",
		      type: "post",
		      async: false, 
		      data: serializedData,
		      success:function(dat){

			 	$("#result").html(dat);
		       		//ListDataset();
			 	$("#result").html("Update Done");
		      },
		      error:function(d){
			  	alert("failure"+d);
			  	$("#result").html('there is error while submit');
		      }
		    });	
	}
}

</script>
