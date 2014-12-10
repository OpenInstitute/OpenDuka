<div class="row col-lg-10 col-md-10 bgmain bgheight">
<div><center><h3>Edit Entity</h3></center></div>
<div class="admline"></div>
	
		<div class="admcontent">
		  <p>
		  <div class="adminstructions">Enter the entity name to edit in the text-box then press enter</div>	
		  <br>
		  <label for="EntityEditName" >Entity Name</label>
		  <input type="text" id="EntityEditName" name="EntityEditName" value="" />
		  <div id=result></div>
		  </p>
		</div>
		<div id="entity_edit"></div>
</div>

		
	   
<script>
$("#EntityEditName").keyup(function(event) {
	// abort any pending request

    /*clear result div*/
  
  $("#result").html('');
 
    
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
		      //async: false,
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

</script>