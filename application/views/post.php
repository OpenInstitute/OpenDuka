	<h1>Welcome to Open Duka Entity Extractor!</h1>

	<div id="body">
	<i><?php echo $error;?></i>
	<p><b>Data Extraction:: Select file</b></p>

		<div id="pdfupload">
		<form enctype="multipart/form-data" action="" method="post" class="putImages">
			<input type="text" id="title" name="title" value="testUploaddocument">< - >
			<input type="file" id="file" name="file" multiple><br>
			<input type="button" value="Update" onclick="myCall()" />
		</form>
		</div>
		<div id="mybox">     </div>

	</div>

	
    <script>                          
                function myCall() {
			var data = new FormData($('input[name^="file"]'),$('input[name^="title"]'));     
			jQuery.each($('input[name^="file"]')[0].files, function(i, file) {
			    //data.append(i, file);
			    data.append('file-'+i, file);

			});
			//alert($('input[name^="title"]').val());
			for (var i = 0; i < $('input[name^="title"]').length; i++) {
			data.append('title-'+i, $('input[name^="title"]').val());
			}
			$.ajax({
			    url: '<?php echo base_url() . index_page();?>/posts/submit_pdf',
			    data: data,
			    cache: false,
			    contentType: false,
			    processData: false,
			    type: 'POST',
			    success: function(data){
			        alert(data);
			    }
			});

/*
				var file = $("input#file").val();;
				var title = $("input#title").val();;
                    var request = $.ajax({
                        url: "<?php echo base_url() . index_page();?>/posts/submit_pdf",
				data: "file="+file+"&title="+title,
                        type: "POST",            
                        dataType: "html"
                    });
 
                    request.done(function(msg) {
                        $("#mybox").html(msg);          
                    });
 
                    request.fail(function(jqXHR, textStatus) {
                        alert( "Request failed: " + textStatus );
                    });*/
                }
             
    </script>
	
	