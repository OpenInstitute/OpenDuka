 
	<h1>Welcome to Open Duka Entity Extractor!</h1>

	<div id="body">
	<i><?php echo $error;?></i>
	<p><b>Project List:: Select file</b></p>
	
	<?php if(!isset($content)){ ?>
	<p>sorry no documents found</p>
	<?php	
		} else {	
		//echo $content;
			foreach ($content as $row){
	?>
	<p><a href="<?php echo base_url().  index_page(); ?>/projects/do_doc_request/<?php echo $row['ID']?>" ><?php echo $row['title']?></a></p>
	<?php
			}
		}
	?>
	<i><?php echo $pages;?></i>
	</div>