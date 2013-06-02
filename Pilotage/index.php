<?php
	/***
	 * 
	 * Point d'entrée de la page d'accueil.
	 * @author JulienBernard
	 * 
	 */
	
	/* Fichier de configuration du projet */
	include_once("./config.php");

	/* Fonctionnement de ce point d'entrée */
	if( isConnected() )
	{
		$controllerPath = "./Controllers/accueil.connect.php";
		$viewPath = "./Views/accueil.connect.php";
	}
	else
	{
		$controllerPath = "./Controllers/accueil.php";
		$viewPath = "./Views/accueil.php";
	}
	
	/* Informations sur la page */
	$title = "Accueil";
	$description = "Description de la page d'accueil";
	
	/* Appel des styles */
	$t_css = array();
	$t_css[0] = "style.css";
	
	/* Appel des scripts */
	$t_script = array();
	
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