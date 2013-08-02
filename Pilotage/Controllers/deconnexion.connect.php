<?php

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );

	/* Destruction des session de connexion joueur */
	$Engine->destroySession("SpaceEngineConnected");
	session_destroy();
	
?>
	<script type="text/javascript">
		// Appel du script de redirection vers la page index.php (3 secondes)
		redirection(3, 'index.php');
	</script>
<?php
