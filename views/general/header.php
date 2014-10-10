<!DOCTYPE html>
<html lang="it">
  <head>
	<!-- <meta charset="utf-8"> -->
	<meta charset="iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title?></title>

	<!-- Bootstrap css -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">    
	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">	
	
	<link rel="stylesheet" href="<?php echo SITE_URL.US."views".US."general".US."css".US."theme.css";?>" />	
	
	<!-- select2 css -->
	<link rel="stylesheet" href="<?php echo SITE_URL.US."views".US."general".US."js".US."select2-3.5.1".US."select2.css"?>" />
	<link rel="stylesheet" href="<?php echo SITE_URL.US."views".US."general".US."css".US."select2-bootstrap.css";?>" />	

		
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
   	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
	<!-- carico l'input type file per twitter bootstrap --> 
	<script src="<?php echo SITE_URL.US."views".US."general".US."js".US."bootstrap-filetype.min.js"?>"></script>
	
	<!-- carico il select2 per l'autocompletamento -->
	<script src="<?php echo SITE_URL.US."views".US."general".US."js".US."select2-3.5.1".US."select2.js"?>"></script>
    
    <?php
		// includo i css opzionali
		if(isset($css) && count($css) > 0){
			foreach($header_css as $css)
				printf("<link rel=\"stylesheet\" href=\"%s\ />",$css['url']);	
		}
    ?>
    
	<?php
	
		// includo i javascript opzionali
		if(isset($js) && count($js) > 0)
			foreach($js as $js_line)
				printf("<script src=\"%s\"></script>\n", $js_line['url']);
	?>
    
  </head>
  <body role='document'>

	<?php
		
		$registry = Registry::get_instance();
		$sys_user = $registry -> object['sys_user'];
		
		// includo la navbar
		$view = new View("general/navbar");
		$view -> logged = $sys_user -> checkLogin();
		$view -> render();
		
	?>
	
	<div class='container' role='main'>


	
