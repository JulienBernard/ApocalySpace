<?php

	/***
	 * 
	 * Configuration du moteur (base de données, inclusions des fonctions, etc.)
	 * @author Julien Bernard
	 * 
	 */
	
	session_start();
	$timeStart = microtime(true);	// Temps d'exécution de la page, voir la fonction foot() (functions.php).
	
	/* Inclusion des fonctions du moteur */
	include_once("./functions.php");
	
	/* Configuration de la base de données */
	define("SQL_DSN", "mysql:host=localhost;dbname=spaceengine");
	define("SQL_USER", "root");
	define("SQL_PASS", "");
	define("SQL_ENCODE", "utf8");
	
	/* Chemin d'accès du site */
	define("BASE_SITE", "http://localhost:8000/Julien/ApocalySpace/SpaceEngine/");
	define('BASE_PATH', '/Julien/ApocalySpace/SpaceEngine/');
	
	/* Informations par défaut */
	define("DEFAULT_DESCRIPTION", "Moteur de site internet. Développer par Julien Bernard pour le projet ApocalySpace (www.apocalyspace.fr) !");
	define("DEFAULT_TITLE", "SpaceEngine - ");
	
	/* Chemin d'accès MVC */
	define("PATH_MODELS", "./Models/");
	define("PATH_CONTROLLERS", "./Controllers/");
	define("PATH_VIEWS", "./Views/");
	
	/* Gestion des erreurs */
	$ERROR = null;
	$SUCCESS = null;
	$INFO = null;
	