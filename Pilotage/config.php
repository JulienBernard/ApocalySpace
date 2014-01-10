<?php

	/***
	 * 
	 * Configuration du moteur (base de données, inclusions des fonctions, etc.)
	 * @author Julien Bernard
	 * 
	 */
	
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	
	/* Configuration de la base de données */
	define("SQL_DSN", "mysql:host=localhost;dbname=apocalyspace");
	define("SQL_USER", "root");
	define("SQL_PASS", "root");
	define("SQL_ENCODE", "utf8");
	
	/* Chemin d'accès du site */
	define("BASE_SITE", "http://localhost/Perso/ApocalySpace/Pilotage/");
	define('BASE_PATH', '/Perso/ApocalySpace/Pilotage/');
	
	/* Informations par défaut */
	define("DEFAULT_DESCRIPTION", "ApocalySpace est un jeu en ligne jouable gratuitement et directement sur votre navigateur web mêlant stratégie et gestion dans l'espace.");
	define("DEFAULT_TITLE", "ApocalySpace - ");
	define("FIRST_SALT", "Se8SpdLz6q8F5");
	define("SECOND_SALT", "F4sDme2sEos69D0");
	
	/* Chemin d'accès MVC */
	define("PATH_MODELS", "./Models/");
	define("PATH_CONTROLLERS", "./Controllers/");
	define("PATH_VIEWS", "./Views/");
		
	include_once("./SpaceEngine/ISpaceEngine.php");
	include_once("./SpaceEngine/engine.class.php");
	include_once("./SpaceEngine/template.class.php");
	