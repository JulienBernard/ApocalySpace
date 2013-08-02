<?php

	/***
	 * 
	 * Point d'entrée de la page de support et contact
	 * @author Julien Bernard
	 * 
	 */
	
	/* Le namePage permet d'identifier votre page. Il doit être être écrit en minuscule et tenir en un seul mot. */
	$namePage = "deconnexion";
	
	/* Appel du moteur [ne pas modifier] */
	include_once("./config.php");
	
	$Engine = new Engine( $namePage );
	$Template = new Template();
	
	/* Informations sur la page [valeurs à modifier] */
	$Template->setTitle("Deconnexion");
	$Template->setDescription("Contact et support du jeu en ligne ApocalySpace.");
	$Template->addCss("normalize.css");
	$Template->addCss("foundation.css");
	$Template->addCss("apocalyspace.connect.css");
	$Template->addScript("jquery.min.js");
	$Template->addScript("vendor/custom.modernizr.js");
	$Template->addScript("redirection.js");

	/* Lancement du moteur [ne pas modifier] */
	$Engine->startEngine( $Engine, $Template );
?>