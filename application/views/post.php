	<h1>Welcome to Open Duka Entity Extractor!</h1>

	<div id="body">
	<i><?php echo $error;?></i>
	<p><b>Data Extraction:: Select file</b></p>
	<!--<form name="calais" id="calais" action="<?php echo base_url() . index_page();?>/posts/do_upload" method="post"  enctype="multipart/form-data"> 

		<input type="file" name="docurl" size="20" id="docurl" />
		
		<br /><br />
		
		<input type="submit" id="loadDoc" value="upload file" />
		
	</form>
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>                          
                function myCall() {
				var file = $("input#file").val();;
				var title = $("input#title").val();;
                    var request = $.ajax({
                        url: "<?php echo base_url();?>index.php/Posts/submit_pdf",
						data: "file="+file+"&title="+title,
                        type: "POST",            
                        dataType: "html"
                    });
 
                    request.done(function(msg) {
                        $("#mybox").html(msg);          
                    });
 
                    request.fail(function(jqXHR, textStatus) {
                        alert( "Request failed: " + textStatus );
                    });
                }
             
    </script>
	<div id="pdfupload">
	<input type="text" id="file" name="file" value="http://labs.appligent.com/presentations/recognizing_malformed_pdf_f.pdf"><br>
	<input type="text" id="title" name="title" value="testUploaddocument"><br>
	</div>
	<div id="mybox">     
     </div>
    <input type="button" value="Submit" onclick="myCall()" />	
	</div>

	
