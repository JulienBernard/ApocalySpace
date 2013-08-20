<?php

	if( isset($_POST["researchTechnology"]) && is_numeric($_POST["researchTechnology"]) && $_POST["researchTechnology"] > 0 )
	{
		$technologyId = (int)$_POST["researchTechnology"];
		$buildingData = $Data->getBuildingsList()[$buildingId-1];
	}
	else
	{
	
	}

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
