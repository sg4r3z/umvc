<?php
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
?>

<div class='row'>
		
		<div class='col-md-12'>
		
			<div class='col-md-12 col-xs-12 col-sm-12'>
				
				<div class='page-header'>
					<h1><?php echo utf8_decode($title)?></h1>
				</div>
				
				<div class='col-md-12 '>

					<form class='form-action' action='<?php echo $link_save_pwd?>' method='POST'>
						<input type='hidden' name='id' value='<?php echo $sys_user_id?>' />
						<div class='row'>
							<div class='col-md-12'>
								<div class='form-group'>
									<label for='#vecchia_password'>Vecchia Password</label>
									<input id='vecchia_password' class='form-control' required='true' type='password' name='vecchia_password' value='' />
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-12'>
								<div class='form-group'>
									<label for='#nuova_password'>Nuova Password</label>
									<input id='nuova_password' class='form-control' required='true' type='password' name='nuova_password' value='' />
								</div>
							</div>
						</div>
					
						<div class='text-right'>
							<input type='submit' value='Procedi' class='btn btn-primary btn-sm' />
						</div>
					</form>
				</div>
		
			
			
			</div>
	
		</div>
		
		
	</div>

<?php
	$view = new View("general/footer");
	$view -> render();
?>
