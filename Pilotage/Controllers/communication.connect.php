<?php
	
	if( isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id']) )
	{
		$id = (int)htmlspecialchars($_GET['id']);
		$communication = Communication::getCommunication( $id, $Data->getId() );
		if( !$communication )
		{
		?>
			<div data-alert class="error-box">
				<p class="smaller">
					<br />
					Vous n'avez pas accès à cette communication !<br />
					<span class="bold">Cette communication est destinée à un autre joueu que vous.</span><br />
					<span class="smaller"><a href="communication.connect.php">(Ne pas attendre la redirection)</a></span>
				</p>
			</div>
			<script type="text/javascript">
				// Appel du script de redirection vers la page index.php (3 secondes)
				redirection(3, 'communication.connect.php');
			</script>
		<?php
		}
		else
		{
			$erreur = Communication::changeView( $id );
			if( $erreur )
				$valide = htmlentities($communication['com_subject'], NULL, 'utf-8');
		}
		include_once( PATH_VIEWS."communication.read.connect.php" );
	}
	else
	{
		$communications = Communication::getCommunications( $Data->getId() );
		/* Inclusion de la vue */
		include_once( $Engine->getViewPath() );
	}
	?>
	