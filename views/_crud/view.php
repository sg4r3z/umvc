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
		
	<div class='col-md-12'>
		
		<!-- barra strumenti -->
		<?php
			if(isset($header_toolbar) && count($header_toolbar) > 0){
				?>
					<div class='col-md-12 text-right'>
						<p>
							<?php
							foreach($header_toolbar as $item){
								?>
									<a class='<?php echo $item['html_class']?>' href='<?php echo $item['href']?>' target='<?php echo isset($item['target']) ? $item['target'] : "";?>'>
										<span class='<?php echo isset($item['icon']) ? $item['icon'] : "" ?>'></span> <?php echo $item['label']?>
									</a>
								<?php
							}
							?>
						</p>
					</div>
				<?php
			}
		?>		
	
	    <table class='table table-hover table-bordered'>
	    <?php 
	    			
	    	// show fields header
	    	if(count($fields_header) > 0 && isset($row)){
				
	    		foreach($fields_header as $key => $value){
					
					echo "<tr>";
					
					// stampo l'intestazione del campo
					if(is_array($value)){
						
						// implemento le funzionalita dell'array di fieldheader
						isset($value['html_class']) ? $html_class = $value['html_class'] : $html_class = "";
						isset($value['label']) ? $label = $value['label'] : $label = "";
		
						printf("<td class='%s'>%s</td>",$html_class,$label);
					}
						
					else
						echo "<th>$value</th>";
					
					
					// stampo il parametro
					printf("<td>%s</td>",$row -> $key);
					
					echo "</tr>";
					
	    		}
	    		
	    	}
					
			
			else{
				$colspan = count($fields_header)+1;
				printf("<tr><td colspan='%s'><center><div class='alert alert-danger'>%s</td></center></tr>",$colspan,$text_noresult);
			}
			
			
	    ?>
	    </table>
	    
	    <!-- barra strumenti -->
		<?php
			if(isset($footer_toolbar) && count($footer_toolbar) > 0){
				?>
					<div class='col-md-12 text-right'>
						<p>
							<?php
							foreach($footer_toolbar as $item){
								?>
									<a class='<?php echo $item['html_class']?>' href='<?php echo $item['href']?>' target='<?php echo isset($item['target']) ? $item['target'] : "";?>'>
										<span class='<?php echo isset($item['icon']) ? $item['icon'] : "" ?>'></span> <?php echo $item['label']?>
									</a>
								<?php
							}
							?>
						</p>
					</div>
				<?php
			}
		?>				
		
		
   	</div>
	</div>
	

<?php
	$view = new View("general/footer");
	$view -> render();
?>   	


