<?php

	if( isset($_POST["researchTechnology"]) && is_numeric($_POST["researchTechnology"]) && $_POST["researchTechnology"] > 0 )
	{
		$technologyId = (int)$_POST["researchTechnology"];
		$technologyData = $Data->getTechnologiesList()[$technologyId-1];
		
		// TODO : recherche de la techno (level+1) si PR suffisant !
	}
	else
	{
	
	}

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
