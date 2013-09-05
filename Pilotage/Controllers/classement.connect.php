<?php

	include_once(PATH_MODELS."top.class.php");
	
	/* Variables */
	$size = 10;
	$start = 0;
	
	if( isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 )
		$start = (int)$_GET['p'] * $size;
	
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
		$Top = new Top( "demography", $start, $size );
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
