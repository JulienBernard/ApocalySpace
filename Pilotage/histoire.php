<?php
	/***
	 * 
	 * Point d'entrée de la page histoire.
	 * @author JulienBernard
	 * 
	 */
	
	/* Fichier de configuration du projet */
	include_once("./config.php");

	/* Fonctionnement de ce point d'entrée */
	if( isConnected() )
	{
		$controllerPath = "./Controllers/histoire.connect.php";
		$viewPath = "./Views/histoire.connect.php";
	}
	else
	{
		$controllerPath = "./Controllers/histoire.php";
		$viewPath = "./Views/histoire.php";
	}
	
	/* Informations sur la page */
	$title = "Histoire";
	$description = "Histoire et présentation du jeu en ligne ApocalySpace.";
	
	/* Appel des styles */
	$t_css = array();
	$t_css[0] = "normalize.css";
	$t_css[1] = "foundation.css";
	$t_css[2] = "apocalyspace.css";
	
	/* Appel des scripts */
	$t_script = array();
	$t_script[0] = "jquery.min.js";
	$t_script[1] = "vendor/custom.modernizr.js";
	
	/* Appel du template : header */
	if( isConnected() )
		head( $title, $description, $t_css, $t_script, "connect");
	else
		head( $title, $description, $t_css, $t_script);
		
	/* Appel du controller */
	include_once( $controllerPath );
	
	/* Appel du template : footer */
	if( isConnected() )
		foot( "connect" );
	else
		foot();
?>