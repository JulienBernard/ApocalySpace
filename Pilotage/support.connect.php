<?php

	/***
	 * 
	 * Point d'entrée de la page de support et contact
	 * @author Julien Bernard
	 * 
	 */
	
	/* Le namePage permet d'identifier votre page. Il doit être être écrit en minuscule et tenir en un seul mot. */
	$namePage = "support";
	
	/* Appel du moteur [ne pas modifier] */
	include_once("./config.php");
	
	$Engine = new Engine( $namePage );
	$Template = new Template();
	
	/* Informations sur la page [valeurs à modifier] */
	$Template->setTitle("Contact et support");
	$Template->setDescription("Contact et support du jeu en ligne ApocalySpace.");
	$Template->addCss("normalize.css");
	$Template->addCss("foundation.css");
	$Template->addCss("apocalyspace.connect.css");
	if( isset($_COOKIE['ApocalySpaceHeaderAnimation']) && $_COOKIE['ApocalySpaceHeaderAnimation'] == "fixe")
		$Template->addCss("menuFixe.css");
	else
		$Template->addCss("menuFlottant.css");	$Template->addCss("faq.css");
	$Template->addScript("jquery.min.js");
	$Template->addScript("vendor/custom.modernizr.js");
	
	/* Lancement du moteur [ne pas modifier] */
	$Engine->startEngine( $Engine, $Template );
	
	if( !Engine::isConnected() )
	{
		?>
		<script type="text/javascript">
			redirection(0, 'support.php');
		</script>
		<?php
	}
?>