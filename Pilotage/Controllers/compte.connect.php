<?php

	if( isset($_POST['updateSetting']) )
	{
		if( isset($_POST['headerActived']) && ($_POST['headerActived'] == "flottant" || $_POST['headerActived'] == "fixe") )
		{
			if( !$Engine->createSession("ApocalySpaceHeaderAnimation", $_POST['headerActived'] ) )
				$_SESSION["ApocalySpaceHeaderAnimation"] = $_POST['headerActived'];
				
			/* Modification OK */
			$Engine->setSuccess("L'animation du menu du haut (header) est désormais : menu ".$_POST['headerActived'].".<br /><span class='bold'>Cette mise à jour nécessite de recharger la page. <a href='compte.connect.php'>Cliquer ici pour recharger la page</a>.</span>");
			?>
			<script>
				$(document).ready(function() {
					$('#validationModal').foundation('reveal', 'open');
				});
			</script>
			<?php
		}
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
	