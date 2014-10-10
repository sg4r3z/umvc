<?php
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
?>	
	
	<div class='page-header'>
		<h1><?php echo $title?></h1><br />
	</div>

	
	<form role='form' method='post' action='<?php echo SITE_URL.US."sys_user".US."save" ?>' >		
	
	<div class='row'>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="name">Nome</label><br />
				<span><input class='form-control' id='name' type='text' name='name' value='' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="username">Username</label><br />
				<span><input class='form-control' id='username' type='text' name='username' value='' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="username">Password</label><br />
				<span><input class='form-control' id='password' type='password' name='password' value='' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="email">Email</label><br />
				<span><input class='form-control' id='email' type='text' name='email' value='' /></span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='blocked'>Bloccato</label><br />
				<span>
					<select name='blocked' class='form-control'>
						<option value='0'>No</option>
						<option value='1'>Si</option>
					</select>
				</span>
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='sendemail'>Email Inviata</label><br />
				<span>
					<select name='sendemail' class='form-control'>
						<option value='0'>No</option>
						<option value='1'>Si</option>
					</select>
				</span>
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='sys_userrole_fk'>Ruolo</label><br />
				<span>
					<select name='sys_userrole_fk' class='form-control'>
						
						<?php
						
							if(count($items_role) > 0){
								foreach($items_role as $item_role){
									printf("<option value=\"%s\">%s</option>",$item_role -> id,$item_role -> description);
								}
							}
							
						?>
						
					</select>
				</span>
			</div>
		</div>
	</div>
	

	
	<div class='row'>
		<div class='col-md-12'>
		  <div class="form-group text-right">
			<input type='submit' value='Salva' class='btn btn-primary' />
		  </div>
		</div>
	</div>
		  
	</form>
	

<?php
	$view = new View("general/footer");
	$view -> render();
?>
