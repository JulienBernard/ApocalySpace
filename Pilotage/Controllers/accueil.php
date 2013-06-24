<?php
	
	if( isset($_POST['subscribe']) || isset($_POST['signin']) )
	{
		$Engine->setInfo("L'inscription au jeu n'est pas encore activé. Merci de revenir prochainement !");
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );