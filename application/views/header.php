<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9"> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page_title;?></title>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/wysiwyg.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/js/arbor.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/arbor-tween.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/graphics.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/renderer.js"></script>
  	
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/ajaxfileupload.js"></script>
    	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.qtip.min.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/raphael-min.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/chronoline.js"></script>

  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.ias.css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ias.js"></script>
  	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/chronoline.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/wysiwyg.css"/>
	<!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/styles.css"/> -->

	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/docs.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css"/>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.css"/>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css"/>
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Caudex:400,700|Lato:400,700|Raleway:400,500,700|Merriweather:400,300,700|Monteserrat:400,700|Istok+Web:400,700|Monda:400,700|Roboto:400,700"/>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

	 <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/ico/favicon-114.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/ico/favicon-72.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/ico/favicon-57.png">
                                   <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon-16.png">
	<script type="text/javascript">
		function showDiv() {
		   document.getElementById('vis_checkbox').style.display = "block";
		   var element = document.getElementById('vis_checkbox');
		  	element.scrollIntoView(true);
		}
	</script>
	 <script type="text/javascript">
        $(document).ready(function() {
            jQuery.ias({
                container : '.results',
                item: '.post',
                pagination: '#content .navigation',
                next: '.next-posts a',
                loader: '<img src="<?php echo base_url();?>assets/img/loader.gif"/>',
                triggerPageThreshold: 2
            });
        });
    </script>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
<!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand pull-left" href="<?php echo base_url() . index_page(); ?>">

          <img src="<?php echo base_url();?>assets/img/odlogo-200x50.png">

        </a>
      </div>
      <div class="collapse navbar-collapse menu-items pull-right">
        <ul class="nav navbar-nav nav-pills">
          <li><a href="<?php echo base_url() . index_page(); ?>">Home</a></li>
          <li><a href="<?php echo base_url() . index_page(); ?>/about">About</a></li>
          <li><a href="<?php echo base_url() . index_page(); ?>/api">API</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>

	<div id="body" class="container">
		<div id="content" class="row">

