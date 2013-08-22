<!DOCTYPE html>
<html lang="en">
<head>
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
  	
  	
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.qtip.min.css" />
    	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.qtip.min.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/raphael-min.js"></script>
  	<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/chronoline.js"></script>

  	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/chronoline.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/wysiwyg.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/styles.css"/>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/docs.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.css"/>
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Caudex:400,700|Lato:400,700|Raleway:400,500,700|Merriweather:400,300,700|Monteserrat:400,700|Istok+Web:400,700|Monda:400,700|Roboto:400,700"/>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet"/>

	<script type="text/javascript">
		function showDiv() {
		   document.getElementById('vis_checkbox').style.display = "block";
		   var element = document.getElementById('vis_checkbox');
		  	element.scrollIntoView(true);
		}
	</script>
	
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div id="thenav" class="navbar navbar-fixed-top navbar-default" style="background-position: 0px 0px;">
    <div class="navbar-header"></div>
      	<div class="top-cont">
        	<div class="container navigation-main row" style="margin-left:auto;margin-right:auto;">
         		<div class="navbar-collapse col-md-12">
         			<div class="logo col-md-6 col-lg-6" style="margin-bottom: 0;">
         				<a href="<?php echo base_url()?>">
         					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/od-temp-orange.png">
         				</a>
         			</div>
         			<div class="menu-items pull-right">
	            		<ul class="nav navbar-nav nav-pills">
	            			<li><a href="<?php echo base_url(); ?>">Home</a></li>
	            			<li><a href="<?php echo base_url(); ?>/about">About Us</a></li>
	            			<li><a href="#">How It Works</a></li>
	            			<li><a href="#">Blog</a></li>
	            			<li><a href="#">Contact</a></li>
	            		</ul>
	            	</div>
            	</div>
            </div>
        </div>
    </div>
	
	<div id="body" class="container">
		<div id="content" class="col-md-12 col-lg-12" style="padding:0">

