	<?php

	include_once(PATH_MODELS."myPDO.class.php");
	include_once(PATH_MODELS."presentation.class.php");
		
	$presentation = new Presentation();
	
	/* Une action sur un formulaire (envoie par POST) a été effectuée.  */
	if( isset($_POST) ) {
		if( isset($_POST['retrieveText']) ) {
			$presentation->retrieveText();
		}
		
		if( isset($_POST['updateText']) ) {
			$text = (String)$_POST['text'];
			$presentation->setTextFromDatabase( $text, $presentation->getId() );
		}
	}

	/* Inclusion de la vue */
	include_once( $viewPath );