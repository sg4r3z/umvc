<?php
	if($inError){
		
		?>
		<div class='row'>
			<div class='col-md-12'>
				<div class="alert alert-danger" role="alert"><?php printf("%s - %s",$error_string,$debug_string)?></div>
		</div> 
		<?php
	}
?>
