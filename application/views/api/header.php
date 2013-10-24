<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9"> 
    <meta charset="utf-8">
    <title><?php echo $title.' | OpenDuka';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/docs.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css"/>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Caudex:400,700|Lato:400,700|Raleway:400,500,700|Merriweather:400,300,700|Monteserrat:400,700|Istok+Web:400,700|Monda:400,700|Roboto:400,700"/>
    <link href="<?php echo base_url();?>assets/js/google-code-prettify/prettify.css" rel="stylesheet">

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
<!--     <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png"> -->
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar" class="api">
    <div class="navbar navbar-fixed-top navbar-default" style="background-position: 0px 0px;">
        <div class="navbar-header">
<!--           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>index.php/api">Open Duka API</a> -->
        </div>
        <div class="api-top-cont row">
          <div class="container navigation-main" style="margin-left:auto;margin-right:auto;">
            <div class="navbar-collapse col-md-12">
              <div class="logo col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 0;">
                <a href="<?php echo base_url()?>/api">
                  <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/od-temp-orange.png">
                </a>
              </div>
              <div class="menu-items pull-right">
                  <ul class="nav navbar-nav nav-pills">
                    <li><a href="<?php echo base_url() . index_page(); ?>/api/documentation">Documentation</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="https://www.github.com/OpenInstitute/OpenDuka">Github</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo base_url() . index_page(); ?>">Open Duka</a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
        <!-- <div class="pull-right">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url();?>index.php/api/documentation">Documentation</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="http://github.com/OpenInstitute/OpenDuka">Github</a></li>
            <li class="divider-vertical"></li>
            <li><a href="<?php echo base_url();?>">Open Duka</a></li>
          </ul>
        </div> --><!--/.nav-collapse -->
    </div>

<!--   	<div class="container" style="background:#fff;padding:5px">
      <div class="row">
        <div class="navbar nav navbar-inverse">
            <div class="container">
              <a class="btn navbar-btn btn-default" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <a class="navbar-brand" href="<?php echo base_url();?>index.php/api"></a>
              <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                  <li><a href="<?php echo base_url();?>index.php/api"><i class="icon-home"></i></a></li>
                </ul>
                <form class="navbar-search pull-left" action="" method="post" id="form1">
                  <div class="input-group">
                      <input class="col-md-5 col-lg-5" id="inputIcon" type="text" name="keyword" autocomplete="off" placeholder="Search">
                      <script> 
                      function formSubmit()
                      {
                      document.getElementById("form1").submit();
                      }
                      </script>
                      <span class="add-on btn btn-default" onclick="formSubmit()" type="button"><i class="icon-search"></i></span>
                  </div>
                </form>
                <ul class="nav pull-right">
                  <li><a href="<?php echo base_url();?>index.php/api/documentation">Documentation</a></li>
                  <li><a href="">Blog</a></li>
                  <li><a href="http://github.com/OpenInstitute/OpenDuka" target="_blank">Github</a></li>
                  <li class="divider-vertical"></li>
                  <li><a href="<?php echo base_url();?>">OpenDuka</a></li>
                </ul>
              </div>
            </div>
        </div> -->
