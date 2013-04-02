	<p><b>Data Extraction:: Confirmation</b></p>
	<p><i><?php echo $error; ?></i></p>
	<p><b>Content from</b>  : <?php echo $filename; ?> </p>
	<?php if (strlen($error)==0){ ?>
	<form name="calais" action="<?php echo base_url() . index_page();?>/posts/entity" method="post"  enctype="multipart/form-data"> 
	<p><textarea name="content" id="detail" style="width:80%; height:600px;"><?php echo $content;?></textarea>
	<script language="javascript">generate_wysiwyg('detail');</script></p>
	<p><input type="submit" name="submit" value="Get Tags!" />
	<input type="hidden" name="filename" value="<?php echo $filename; ?>" /></p>
	</form>
	<?php } else { ?>
	<p><a href="<?php echo base_url() . index_page();?>/posts/do_upload">Try again </a> </p>
	<?php } ?>
