 <?php
	
	$nav_html = "";			   

	if($logged){
		
		$registry = Registry::get_instance();
		$active_controller = trim($registry -> request['controller']);
		
		$userrole_fk = intval($_SESSION['userrole_fk']);
		
		$nav_items = array(
							array("controller" => "sys_user", "label" => "Utenti"),
							array("controller" => "anagrafica" , "label" => "Atleti")
						  );
		
		// preparo i tasti per il nav
		if(count($nav_items) > 0){
			foreach($nav_items as $nav_item){
									
				$active = "";
				if(isset($nav_item['controller']) && trim($nav_item['controller']) == $active_controller)
					$active = "class='active'";

				// link esterno
				if(isset($nav_item['href']))
					$href = $nav_item['href'];
					
				// link interno a controller
				else
					$href = SITE_URL.US.$nav_item['controller'];

				$target = "";
				if(isset($nav_item['target']))
					$target = $nav_item['target'];
				
				$nav_html .= "<li {$active}><a href='{$href}' target='{$target}'>{$nav_item['label']}</a></li>";	
			}
		}		
		
		$href = SITE_URL.US."sys_user".US."do_logout";
		$nav_html .= "<li ><a href='{$href}'>Disconnetti</a></li>";	
			
	}
 ?>
 
 
 
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo SITE_URL?>"><?php echo NAVBAR_TITLE?></a>
        </div>

		  <div class="collapse navbar-collapse">
			  <ul class="nav navbar-nav">
					<?php echo $nav_html?>
			  </ul>
		  </div><!--/.nav-collapse -->
		
      </div>
    </div>
