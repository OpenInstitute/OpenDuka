 
<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Merge Entity</h3></center></div>
<div class="admline"></div>
 <div class="admcontent">
	  	<div class="adminstructions">Enter entity name in the text-box below then press enter</div>
		<br>
		  <p>
		  <label for="EntityMergeName" >Entity Name</label>
		  <input type="text" id="EntityMergeName" name="EntityMergeName" value="" />
		  </p>
		</div>
		<div id="entity_merge"></div>
	   
 	</div>
 </div>

 <script>
$("#EntityMergeName").keyup(function(event) {
	//var code = e.keyCode;
	//alert(code);

	//alert("I have a dog");
  //$("#result").html('Hii si mchezo!');
  
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

	var radioanswer = 'none';
	if ($('.radioEnt:checked').val() != null) {           
	   Ent_id = $('input[name=radioEnt]:checked').val();
	   
	} else {
		Ent_id = $("input[name='Merge[]']:checked").val();
	}
	//alert(Ent_id); exit;
	if (checked.length>1){
	//alert(checked);
		$.ajax({
		      url: "<?php echo base_url();?>index.php/admin/EntityMerger",
		      type: "post",
		      async: false,
		      data: {MergeEnt : checked+"",MergeTo : Ent_id},
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