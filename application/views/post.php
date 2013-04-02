
	<h1>Welcome to Open Duka Entity Extractor!</h1>

	<div id="body">
	<i><?php echo $error;?></i>
	<p><b>Data Extraction:: Select file</b></p>
	<form name="calais" id="calais" action="<?php echo base_url() . index_page();?>/posts/do_upload" method="post"  enctype="multipart/form-data"> 

		<input type="file" name="docurl" size="20" id="docurl" />
		
		<br /><br />
		
		<input type="submit" id="loadDoc" value="upload file" />
		
	</form>
	</div>

	
