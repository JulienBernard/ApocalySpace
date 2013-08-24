<?php
	
	$communications = Communication::getCommunications( $Data->getId() );
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
