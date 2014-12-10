
	 <!--My own!-->
<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Insert Dataset</h3></center></div>
<div class="admline"></div>

		 
		 <div class="admcontent">
		 	<div class="reg_form"></div>
		 <?php echo form_open_multipart("", array('id' => 'DatasetAdd')); ?>
		
		  <p>
		  	<div class="adminstructions">Upload a comma separated CSV document. Please ensure that it has atleast 2 columns that contain Entity Names.</div>  
		  <br>
		  <div id="result"></div><br>
		  <div id="upload-bg">	
		   <label for="fileToUpload" class="textfield">Select File:</label>
		   <input type="file" id="fileToUpload" name="fileToUpload" class="btn-custom"/>
		   <img id="loading1" src="<?php echo base_url();?>assets/img/loading.gif" style="display:none;">
		  </div>
		 </p>
		 <p>
		 	<br>
		  <input type="button " class="DatasetAdd btn-custom" value="Submit"/>
		  </p>
		 <?php echo form_close(); ?>
		</div> 
		  <div id="viwanja"></div>
		  
	       
	 </div>


<script>
ListDocCat();
function ListDocCat() {
 
    $.ajax({
      url: "<?php echo base_url();?>index.php/admin/ListDocCat",
      type: "post",
      async: false, 
      data: "",
      success:function(data){
      	//alert(data);
          $("#cat_name").html(data);
         // $("#result").html("Select Category");
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while listing categories');
      }
    });	
}


    $('.DatasetAdd').click(function() {
    	alert("Just work");
        $("#result").html('');
        $.ajaxFileUpload({
            url             :'<?php echo base_url();?>index.php/bckend/upload_file',
            secureuri       :false,
            fileElementId   :'fileToUpload',
            dataType        :'json',
            //data            : {'title': $('#title').val()},
            beforeSend:function()
				{
					$("#loading1").show();
				},
				complete:function()
				{
					$("#loading1").hide();
				},				
				success: function (data, status)
				{
				$('#result').html(data.msg);
				$('.reg_form').html('');
				field_list('NewTable', '1');
				//alert(data.msg);
					/*if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							
						}
					}*/
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			});
        return false;
    });


function field_list(meza,DocType){
	alert(table);
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

</script>
		
	




