<?php

	if( isset($_POST["researchTechnology"]) && is_numeric($_POST["researchTechnology"]) && $_POST["researchTechnology"] > 0 )
	{
		$technologyId = (int)$_POST["researchTechnology"];
		$technologyData = $Data->getTechnologiesList()[$technologyId-1];
		
		if( (int)$Data->getPr() >= (int)$technologyData->getCost() )
		{
			if( $technologyData->getLevel() < 10 )
			{
				/* Mise à jour des ressources de la planète */
				$Data->getPlanet()->updateRessource( (int)$Data->getPlanetId(), (int)$Data->getRes1(), (int)$Data->getRes2(), (int)$Data->getRes3(), (int)$Data->getPR() - (int)$technologyData->getCost(), (int)$Data->getProductionTime() );
				/* Ajout d'un niveau à cette technologie */
				$technologyData->addTechnologyLevel( $technologyData->getId(), $technologyData->getUserId() );
			?>
				<div data-alert class="success-box">
					<p class="smaller">
						<br />
						Vos chercheurs viennent de découvrir quelque chose !<br />
						<span class="bold">Votre compréhension sur la technologie "<?php echo $technologyData->getName(); ?>" évolue.</span><br />
						<span class="smaller"><a href="recherche.connect.php">(Ne pas attendre la redirection)</a></span>
					</p>
				</div>
				
				<script type="text/javascript">
					// Appel du script de redirection vers la page index.php (3 secondes)
					redirection(3, 'recherche.connect.php');
				</script>
			<?php
			}
			else
			{
			?>
				<div data-alert class="error-box">
					<p class="smaller">
						<br />
						Vos chercheurs refusent de travailler !<br />
						<span class="bold">Ils disent en savoir suffisamment à propos de cette technologie.</span><br />
						<span class="smaller"><a href="recherche.connect.php">(Ne pas attendre la redirection)</a></span>
					</p>
				</div>
				<script type="text/javascript">
					// Appel du script de redirection vers la page index.php (3 secondes)
					redirection(3, 'recherche.connect.php');
				</script>
			<?php
			}
		}
		else
		{
		?>
			<div data-alert class="error-box">
				<p class="smaller">
					<br />
					Vos chercheurs n'ont pas assez d'expérience !<br />
					<span class="bold">Vous n'avez pas les ressources nécessaire pour améliorer votre recherche scientifique.</span><br />
					<span class="smaller"><a href="recherche.connect.php">(Ne pas attendre la redirection)</a></span>
				</p>
			</div>
			<script type="text/javascript">
				// Appel du script de redirection vers la page index.php (3 secondes)
				redirection(3, 'recherche.connect.php');
			</script>
		<?php
		}
	}
	else
	{
	
	}

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
