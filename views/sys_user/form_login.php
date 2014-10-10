<!DOCTYPE html>
<html lang="it">
  <head>
	<!-- <meta charset="utf-8"> -->
	<meta charset="iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITE_TITLE?></title>

	<!-- Bootstrap css -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">    
	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">	
	
	<link rel="stylesheet" href="<?php echo SITE_URL.US."views".US."general".US."css".US."theme.css";?>">	
		
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
    

    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="<?php echo SITE_URL.US."views".US."general".US."css".US."signin.css"?>">	

  </head>

  <body>
	  
    <div class="container">
	
	  <?php
		if(isset($error_string)){
			?>
			  <div class='row'>
			    <div class='col-md-12'>
				  <div class="alert alert-danger" role="alert"><?php echo $error_string?></div>
			    </div>
			  </div>
			<?php
		}
	  
	  ?>
	 

      <form class="form-signin" role="form" method="POST" action="<?php echo SITE_URL.US."sys_user".US."do_login"?>">
        <h3 class="form-signin-heading"><?php echo TITLE?></h3>
        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
		<div class="checkbox">
		</div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Accedi</button>
        <br />
        <div class='text-center'>
			<?php echo FOOTER;?>
        </div>
      </form>
      
	  <div class='row'>
		<div class='col-md-12'>
			<hr />
		</div>
	  </div>
	  
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
