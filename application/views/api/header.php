<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title.' | OpenDuka';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/docs.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png">

  </head>
  <body data-spy="scroll" data-target=".bs-docs-sidebar">
  	<div class="container" style="background:#fff;padding:5px">
	<div class="row">
  	  <div class="navbar navbar-inverse">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  
                  <a class="brand" href="#">OpenDuka API</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li><a href=""><i class="icon-home"></i></a></li>
                    </ul>
                    <form class="navbar-search pull-left" action="" method="post" id="form1">
                    <div class="input-append">
                    <input class="span5" id="inputIcon" type="text" name="keyword" autocomplete="off" placeholder="Search">
                    <script> 
	     function formSubmit()
{
document.getElementById("form1").submit();
}
</script>
	      <span class="add-on btn" onclick="formSubmit()" type="button"><i class="icon-search"></i></span>
	    </div>
                    </form>
                    <ul class="nav pull-right">
                    	
                       <li><a href="<?php echo base_url();?>index.php/api/documentation">Documentation</a></li>
                      <li><a href="">Blog</a></li>
                      <li class="divider-vertical"></li>
                      <li><a href="">Downloads</a></li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
