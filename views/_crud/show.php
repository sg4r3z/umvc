<?php
	// includo l'header delle crud
	$view = new View("_crud/header");
	$view -> title = $title;
	$view -> render();	
		
?>

<div class='row'>
	<div class='col-md-12'>
	    <h1><?php echo $title?></h1><br />
	    
	    <?php
	    	// show message 
	    	if(isset($message_text) && isset($message_type)){
				echo "<div class='alert $message_type'>$message_text</div>";
			}
	    ?>
	    
	    <table class='table'>
	    <?php 
	    			
	    	// show fields header
	    	if(count($fields_header) > 0){
				echo "<tr><th></th>";
	    		foreach($fields_header as $key => $label){
	    			echo "<th>$label</th>";
	    		}
	    		echo "</tr>";
	    	}
			
			// show rows of table
			if(count($rows) > 0){
				
				$keys = array_keys($fields_header);
				
				echo "<tr>";
	    		foreach($rows as $row){
	    			
					## td operazioni
					?>
					<td style='text-align:center;'>
						<a href='<?php echo $link_view.$row -> id;?>' title='Dettaglio' class='button btn-default btn-xs'><span class='glyphicon glyphicon-search'></span></a>
						<a href='<?php echo $link_edit.$row -> id;?>' title='Modifica' class='button btn-default btn-xs'><span class='glyphicon glyphicon-pencil'></span></a>
						<a href='<?php echo $link_delete.$row -> id;?>' title='Elimina' class='button btn-default btn-xs'><span class='glyphicon glyphicon-trash'></span></a>
					</td>
					<?php
					
	    			foreach($keys as $key)
	    				echo "<td>{$row -> $key}</td>";
	    		}
	    		echo "</tr>";
			}
			else{
				$colspan = count($fields_header)+1;
				echo "<tr><td colspan='$colspan'><center><div class='alert alert-danger'>$text_noresult</td></center></tr>";
			}
			
			
	    ?>
	    </table>
   	</div>
</div>   	

<?php
	// includo il footer delle crud
	$view = new View("_crud/footer");
	$view -> footer = "testo nel footer";
	$view -> render();
?>
