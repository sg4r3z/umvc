<?php
	header('HTTP/1.0 404 Not Found');
	
	$title = "Errore - La pagina che cercavi non &egrave; stata trovata";
	
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
	
	?>
		
		<div class='page-header'>
			<h1>404 - Risorsa non Trovata</h1>
		</div>
		
		<div class='row'>
			<div class='col-md-12'>
				<?php echo $title ?>
			</div>
			
			<div class='col-md-12'>
			<br />
				<?php 
					// visualizzo error string umana
					if(isset($error_string))
						printf("<p>%s</p><br />",utf8_decode($error_string));	
						
					// visualizzo stringa di debug
					// solo se runmode = debug
					if(RUN_MODE == "debug" && isset($debug_string))
						printf("<pre>%s</pre>",$debug_string);
						
				?>
			</div>
		</div>
		
	
	<?php

    $view = new View("general/footer");
    $view -> render();
    
    
?>
