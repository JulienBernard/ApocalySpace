<?php
	
	if( isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id']) )
	{
		$id = (int)htmlspecialchars($_GET['id']);
		$communication = Communication::getCommunication( $id, $Data->getId() );
		if( !$communication )
		{
		?>
			<div data-alert class="error-box">
				<p class="smaller">
					<br />
					Vous n'avez pas accès à cette communication !<br />
					<span class="bold">Cette communication est destinée à un autre joueu que vous.</span><br />
					<span class="smaller"><a href="communication.connect.php">(Ne pas attendre la redirection)</a></span>
				</p>
			</div>
			<script type="text/javascript">
				// Appel du script de redirection vers la page index.php (3 secondes)
				redirection(3, 'communication.connect.php');
			</script>
		<?php
		}
		else
		{
			$erreur = Communication::changeView( $id );
			if( $erreur )
				$valide = htmlentities($communication['com_subject'], NULL, 'utf-8');
		}
		include_once( PATH_VIEWS."communication.read.connect.php" );
	}
	else if( isset($_GET['write']) )
	{
		$messageContent = null;
		$messageSubject = null;
		$messageReceiver = null;
		
		if( isset($_POST['send']) )
		{
			$messageContent = htmlspecialchars($_POST['messageContent']);
			$messageSubject = htmlspecialchars($_POST['messageSubject']);
			$messageReceiver = htmlspecialchars(strtolower($_POST['messageReceiver']));
			
			$fields = array('content' => $messageContent, 'subject' => $messageSubject, 'receiver' => $messageReceiver);
			$return = $Engine->checkParams( $fields );
			
			/* Champs valides */
			if( $return == 1  )
			{
				$arrayUsername = explode(",", $messageReceiver);
				for( $i = 0 ; $i < count($arrayUsername) ; $i++ )
				{
					$return = User::checkUsernameExist( $arrayUsername[$i] );
					/* Si le joueur existe */
					if( $return == 0 )
						break;
				}
								
				$stringUsers = "";
				$sendReturn = false;
				if( $return > 0 )
				{
					$stringUsers = "";
					for( $i = 0 ; $i < count($arrayUsername) ; $i++ )
					{
						$return = User::checkUsernameExist( $arrayUsername[$i] );
						/* Si le joueur existe */
						if( $return > 0 )
						{
							$stringUsers .= $arrayUsername[$i].", ";
							$sendReturn = Communication::addCommunications( $messageContent, $messageSubject, "", (int)$return, (int)$Data->getId());
						}
						else
							break;
					}
				}
				
				/* Si le(s) joueur(s) existe(nt) */
				if( $return > 0 && $sendReturn )
				{
					$Engine->setInfo("<span class=\"bold\">Communication envoyée !</span><br />Votre message a bien été envoyé au(x) joueur(s) suivant :<br />$stringUsers");
				
					$messageContent = null;
					$messageSubject = null;
					$messageReceiver = null;
				}
				else
				{
					$Engine->setError("<span class=\"bold\">Un destinataire est introuvable !</span><br />L'un des destinataires est introuvable. Avez-vous renseigné le bon pseudonyme ?<br />Attention : il ne doit pas y avoir d'espace après la ',' !");
				}
			}
			else
			{
				$Engine->setError("Un des champs est vide.");
			}
		}
				
		/* Gestion des erreurs */
		$INFO = $Engine->getInfo();
		$ERROR = $Engine->getError();
		$SUCCESS = $Engine->getSuccess();
		if( !empty($INFO) ) {
			echo "<div data-alert class=\"info-box\"><p class=\"smaller\">".$INFO."</p></div>";
		}
		if( !empty($ERROR) ) {
			echo "<div data-alert class=\"error-box\"><p class=\"smaller\">".$ERROR."</p></div>";
		}
		else if( !empty($SUCCESS) ) {
			echo "<div data-alert class=\"success-box\"><p class=\"smaller\">".$SUCCESS."</p></div>";
		}
		
		include_once( PATH_VIEWS."communication.write.connect.php" );
	}
	else
	{
		$communications = Communication::getCommunications( $Data->getId() );
		/* Inclusion de la vue */
		include_once( $Engine->getViewPath() );
	}
	?>
	