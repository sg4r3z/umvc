
<div class='row'>
	<div class='col-md-12 text-right'>
		<div class="btn-group btn-group-sm" >
			
			<?php
				
			
				if($paginator['previous']['enabled']){
					
					$link = $paginator['previous']['link'];
					$label = $paginator['previous']['label'];
						
					?>
						<a type="button" href='<?php echo $link?>' class="btn btn-default"><?php echo $label?></a>
					<?php
				}
				
				if($paginator['current']['enabled']){
					
					$link = $paginator['current']['link'];
					$label = $paginator['current']['label'];
					
					?>
						<a type="button" href='<?php echo $link?>' class="btn btn-default"><?php echo $label?></a>
					<?php
				}
				if($paginator['forward']['enabled']){
					
					$link = $paginator['forward']['link'];
					$label = $paginator['forward']['label'];
					
					?>
						<a type="button" href='<?php echo $link?>' class="btn btn-default"><?php echo $label?></a>
					<?php
				}
			?>
			
		</div>
	</div>
</div>
