<?php

	include_once(PATH_MODELS."top.class.php");
	
	if( isset($_GET['technology']) )
	{
		$Top = new Top( "technology" );
	}
	else if( isset($_GET['military']) )
	{
		$Top = new Top( "military" );
	}
	else
	{
		$Top = new Top( "demography", 0, 10 );
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
