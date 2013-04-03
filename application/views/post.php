	<h1>Welcome to Open Duka Entity Extractor!</h1>

	<div id="body">
	<i><?php echo $error;?></i>
	<p><b>Data Extraction:: Select file</b></p>
	<form name="calais" id="calais" action="<?php echo base_url() . index_page();?>/posts/do_upload" method="post"  enctype="multipart/form-data"> 

		<input type="file" name="docurl" size="20" id="docurl" />
		
		<br /><br />
		
		<input type="submit" id="loadDoc" value="upload file" />
		
	</form>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>                          
                function myCall() {
                    var request = $.ajax({
                        url: "<?php echo base_url();?>/index.php/Posts/submit_pdf",
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
	<input type="text" name="file" value="http://labs.appligent.com/presentations/recognizing_malformed_pdf_f.pdf"><br>
	<input type="text" name="title" value="testUploaddocument"><br>
	<input type="text" name="username" value=""><br>
	<input type="password" value="" name="password"><br>
	<input type="text" name="access" value="private">
	<input type="text" name="project" value="7877-openduka">
	<input type="text" name="source" value="sourc"><br>
	</div>
	
	 <div id="mybox">
             
     </div>
     <input type="button" value="Update" onclick="myCall()" />
		
	</div>

	
