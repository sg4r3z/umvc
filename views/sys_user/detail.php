<?php

	// includo l'header delle crud
	$view = new View("general/header");
	$view -> title = $title;
	$view -> render();	
	
	?>
	<div class='row'>
		<div class='page-header'>
			<h1><?php echo $title?></h1>
		</div>
		
		<!-- barra strumenti -->
		<div class='col-md-12 text-right'>
			<p>
				<a href='<?php echo $link_edit.$row -> id?>' class="btn btn-primary "><span class="glyphicon glyphicon-pencil"></span> Modifica</a>
			</p>
			<hr />
		</div>
			
		
		<div class='col-md-12'>
						
			<div class="form-horizontal" >
				
			  <?php
					if(count($fields_header) > 0){
					
						foreach($fields_header as $key => $value){
													
							?>
								 <div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $value?></label>
									<div class="col-sm-10">
									  <input type="text" name='<?php echo $key?>' class="form-control" id="inputEmail3" placeholder="Email">
									</div>
								 </div>
							<?php
						
						}
					
					}
			  
			  ?>	

			</div>
			
		</div>
		
	</div>
	<?php

	
	$view = new View("general/footer");
	$view -> render();
	
?>
