<?php
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();
?>	
	<div class='row'>
		<div class='page-header'>
			<h1><?php echo $title?></h1><br />
		</div>
		
		
		<!-- barra strumenti -->
		<div class='col-md-12 text-right'>
			<p>
				<a href='<?php echo $link_edit.$row -> id?>' class="btn btn-primary "><span class="glyphicon glyphicon-pencil"></span> Modifica</a>
			</p>
			<hr />
		</div>
		
		<div class='col-md-12'>
		
			<table class='table table-bordered table-striped'>
				<tr>
					<td class='col-md-3'>Nome</td>
					<td class='col-md-9'><?php echo $row -> name?></td>
				</tr>
				<tr>
					<td class='col-md-3'>Username</td>
					<td class='col-md-9'><?php echo $row -> username?></td>
				</tr>
				<tr>
					<td class='col-md-3'>Password</td>
					<td class='col-md-9'>*****</td>
				</tr>
				<tr>
					<td class='col-md-3'>Email</td>
					<td class='col-md-9'><?php echo $row -> email?></td>
				</tr>
				<tr>
					<td class='col-md-3'>Bloccato?</td>
					<td class='col-md-9'><?php intval($row -> blocked) == 0 ? $f = "No" : $f = "Si"; echo $f;?></td>
				</tr>
				<tr>
					<td class='col-md-3'>Email Inviata?</td>
					<td class='col-md-9'><?php intval($row -> sendemail) == 0 ? $f = "No" : $f = "Si"; echo $f;?></td>
				</tr>
				<tr>
					<td class='col-md-3'>Ruolo</td>
					<td class='col-md-9'><?php echo $item_role -> description; ?></td>
				</tr>
			</table>
		</div>
	</div>


	
	

<?php
	$view = new View("general/footer");
	$view -> render();
?>
