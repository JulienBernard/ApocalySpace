<?php
	/***
	 * 
	 * Point d'entrée de la page d'accueil.
	 * @author Julien Bernard
	 * 
	 */

	/* Le namePage permet d'identifier votre page. Il doit être être écrit en minuscule et tenir en un seul mot. */
	$namePage = "classement";
	
	/* Appel du moteur [ne pas modifier] */
	include_once("./config.php");
	
	$Engine = new Engine( $namePage );
	$Template = new Template();
	
	/* Informations sur la page [valeurs à modifier] */
	$Template->setTitle("Classement");
	//$Template->setDescription("");
	$Template->addCss("normalize.css");
	$Template->addCss("foundation.css");
	$Template->addCss("apocalyspace.css");
	$Template->addScript("time.js");
	$Template->addScript("jquery.min.js");
	$Template->addScript("vendor/custom.modernizr.js");
	$Template->addScript("redirection.js");

	global $timeStart;
	$timeStart = microtime(true);
	
	/* Lancement du moteur [ne pas modifier] */
	$Engine->startEngine( $Engine, $Template, $timeStart );
	
	if( !Engine::isConnected() )
	{
		?>
		<script type="text/javascript">
			redirection(0, 'index.php');
		</script>
		<?php
	}
?>