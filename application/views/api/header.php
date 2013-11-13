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
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar" class="api">
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
            <li><a href="<?php echo base_url() . index_page(); ?>/api">API</a></li>
            <li><a href="<?php echo base_url() . index_page(); ?>/api/documentation">Documentation</a></li>
            <li><a href="https://www.github.com/OpenInstitute/OpenDuka">Github</a></li>
            <li><a href="#">Blog</a></li>
            <li class="divider-vertical"></li>
            <li><a href="<?php echo base_url() . index_page(); ?>">Open Duka</a></li>
          </ul>
        </div> <!--/.nav-collapse -->
    </div>
