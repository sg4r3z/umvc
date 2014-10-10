<?php

	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
		
?>

	<div class='row'>
		
		<div class='col-md-12'>
		
			<div class='col-md-3 hidden-xs hidden-sm'>
				<?php
					$view = new View("general/sidebar");
					$view -> title = $title;
					$view -> link_list_anagrafica = $link_anagrafica_listing;
					$view -> link_list_operatori = $link_sys_user_listing;
					$view -> link_logout = $link_logout;
					$view -> render();
				?>
			</div>
			<div class='col-md-9 col-xs-12 col-sm-12'>
				
				<div class='page-header'>
					<h1><?php echo utf8_decode($title)?></h1>
				</div>
				
				<div class='col-md-12'>
					<div class='well'>
						<div class='row'>
							<div class='col-md-10'>
								<h2>Riepilogo Pazienti</h2>
								<?php
									printf("Numero Record: <strong>%s</strong><br /><br />",$quanti_pazienti);
									printf("<a class='btn btn-primary' href='%s'>ELENCO RECORD	</a> - <a class='btn btn-primary' href='%s'>AGGIUNGI NUOVO</a>",
										   $link_anagrafica_listing,
										   $link_anagrafica_add);
								?>
							</div>
							<div class='col-md-2'>
								<img class='img-thumbnail' src="<?php echo IMAGE_URL.US."patient-icon.png" ?>">
							</div>
						</div>
					</div>

					<div class='well'>
						<div class='row'>
							<div class='col-md-10'>
								<h2>Riepilogo Operatori</h2>
								<?php
									printf("Numero Record: <strong>%s</strong><br /><br />",$quanti_operatori);
									
									// solo amministratore
									if(intval($role_id) == 1){
										printf("<a class='btn btn-primary' href='%s'>ELENCO RECORD</a> - <a class='btn btn-primary' href='%s'>AGGIUNGI NUOVO</a>",
											   $link_sys_user_listing,
											   $link_sys_user_add);
									}
									// solo operatore
									else{
										printf("<a class='btn btn-primary' href='%s'>ELENCO RECORD</a>","index.php/sys_user/listing");
									}
								?>
							</div>
							<div class='col-md-2'>
								<img class='img-thumbnail' src="<?php echo IMAGE_URL.US."doctor-icon.png"?>">
							</div>					
						</div>
					</div>
				</div>

				
		
			
			
			</div>
	
		</div>
		
		
	</div>
	


<?php
	
	
	
	$view = new View("general/footer");
	$view -> render();
?>
