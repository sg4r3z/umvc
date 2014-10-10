<?php
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
?>	
	
	<div class='page-header'>
		<h1><?php echo $title?></h1><br />
	</div>

	
	<form role='form' method='post' action='<?php echo SITE_URL.US."sys_user".US."modify" ?>' >	
	<input type='hidden' name='id' value='<?php echo $row -> id?>' />
	
	<div class='row'>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="name">Nome</label><br />
				<span><input class='form-control' id='name' type='text' name='name' value='<?php echo $row -> name?>' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="username">Username</label><br />
				<span><input class='form-control' id='username' type='text' name='username' value='<?php echo $row -> username?>' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="username">Password</label><br />
				<span><input class='form-control' disabled id='password' type='password' name='password' value='<?php echo $row -> password?>' /></span>
			</div>
		</div>
		<div class='col-md-3'>
			<div class="form-group" >
				<label for="email">Email</label><br />
				<span><input class='form-control' id='email' type='text' name='email' value='<?php echo $row -> email?>' /></span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='blocked'>Bloccato</label><br />
				<span>
					<select name='blocked' class='form-control'>
						
						<?php 
							if(intval($row -> blocked) == 1){
								?>
									<option value='0'>No</option>
									<option value='1' selected>Si</option>
								<?php
							}
							else{
								?>
									<option value='0' selected>No</option>
									<option value='1'>Si</option>
								<?php
							}
						?>
						
					</select>
				</span>
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='sendemail'>Email Inviata</label><br />
				<span>
					<select name='sendemail' class='form-control'>
						<?php 
							if(intval($row -> sendemail) == 1){
								?>
									<option value='0'>No</option>
									<option value='1' selected>Si</option>
								<?php
							}
							else{
								?>
									<option value='0' selected>No</option>
									<option value='1'>Si</option>
								<?php
							}
						?>
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
									
									if($row -> sys_userrole_fk == $item_role -> id)
										printf("<option value=\"%s\" selected>%s</option>",$item_role -> id,$item_role -> description);
									
									else
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
