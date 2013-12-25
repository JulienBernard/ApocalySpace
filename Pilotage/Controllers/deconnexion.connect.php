<?php

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );

	/* Destruction des session de connexion joueur */
	$Engine->destroySession("SpaceEngineConnected");
	$Engine->destroySession("ApocalySpaceCurrentPlanet");
	session_destroy();
	
?><script type="text/javascript">redirection(3, 'index.php');</script><?php
