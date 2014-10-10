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
			<a href='<?php echo $link_add?>' class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span> Nuovo</a>
		</p>
		<hr />
	</div>
	
	<div class='col-md-12'>
		
	    <?php
	    	// show message 
	    	if(isset($message_text) && isset($message_type)){
				echo "<div class='alert $message_type'>$message_text</div>";
			}
	    ?>
	    
	    <table class='table table-striped table-hover'>
	    <?php 
	    			
	    	// show fields header
	    	if(count($fields_header) > 0){
				echo "<tr><th></th>";
	    		foreach($fields_header as $key => $value){
					
					if(is_array($value)){
						
						// implemento le funzionalita dell'array di fieldheader
						isset($value['html_class']) ? $html_class = $value['html_class'] : $html_class = "";
						isset($value['label']) ? $label = $value['label'] : $label = "";
		
						printf("<th class='%s'>%s</th>",$html_class,$label);
					}
						
						
						
					else
						echo "<th>$value</th>";
	    		}
	    		echo "</tr>";
	    	}
					
			// show rows of table
			if(count($rows) > 0){
				
				$keys = array_keys($fields_header);

	    		foreach($rows as $row){
	    			
					## td operazioni
					?>
					<tr>
					<td style='text-align:center;'>
						<?php
							if(!isset($view_btn) || $view_btn) 
								printf("<a href='%s' title='Dettaglio' class='button btn-default btn-xs'><span class='glyphicon glyphicon-search'></span></a>\n",$link_view.$row -> id);
							if(!isset($edit_btn) || $edit_btn)
								printf("<a href='%s' title='Modifica' class='button btn-default btn-xs'><span class='glyphicon glyphicon-pencil'></span></a>\n",$link_edit.$row -> id);
							if(!isset($delete_btn) || $delete_btn)
								printf("<a href='%s' title='Elimina' class='button btn-default btn-xs'><span class='glyphicon glyphicon-trash'></span></a>\n",$link_delete.$row -> id);
						?>
					</td>
					<?php
					
					
	    			foreach($keys as $key)
						printf("<td>%s</td>",$row -> $key);
						
	    			?>
	    			</tr>
	    			<?php
	    		}
	    		
			}
			else{
				$colspan = count($fields_header)+1;
				printf("<tr><td colspan='%s'><center><div class='alert alert-danger'>%s</td></center></tr>",$colspan,$text_noresult);
			}
			
			
	    ?>
	    </table>
   	</div>
	</div>
	
	<?php
				
		// stampo la pulsantiera 
		// della paginazione		
		if(count($rows) > 0){
			if(isset($paginator) && is_array($paginator)){				
				$view = new View("general/paginator");
				$view -> paginator = $paginator;
				$view -> render();
			}
		}
    ?>

<?php
	$view = new View("general/footer");
	$view -> render();
?>   	


