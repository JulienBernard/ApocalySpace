<?php

/**
 * Interface moteur. Contrat entre les fonctions principales du moteur SpaceEngine.
 * @author Julien Bernard
 */
interface IEngine {
	public static function isConnected();
	public static function isAdmin();
	public function createSession( $name, $content );
	public function destroySession( $name );
	public function checkParams( $array, $strictPositive );
	public function getControllerPath();
	public function getViewPath();
	public function startEngine( $engine, $template );
}

/**
 * Interface du template. Contrat dédié à la gestion du template.
 * @author Julien Bernard
 */
interface ITemplate {
	public function setTitle( $title );
	public function getTitle();
	public function setDescription( $desc );
	public function getDescription();
	public function addCss( $path );
	public function getCss();
	public function addScript( $path );
	public function getScript();
	public function startTemplate( $path, $template );
}
