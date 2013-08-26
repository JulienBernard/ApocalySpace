<?php

	/* On regarde si une construction n'est pas en cours de construction */
	$onGoingBuilds = $Data->getPlanet()->getPlanetBuildTime( $Data->getPlanetId(), 1 );
	if( !empty($onGoingBuilds) )
	{
		$arrayConstruction = array();
		for( $i = 0 ; $i < count($onGoingBuilds) ; $i++ )
		{
			$list = $Data->getBuildingsList();
			$buildingsData = $list[$onGoingBuilds[$i]['gb_buildId']-1];			
			/* La construction est terminée */
			if( time() >= (int)$onGoingBuilds[$i]['gb_endTime'] )
			{
				$Data->getPlanet()->delBuildTime( $onGoingBuilds[$i]['gb_id'] );
				Building::addBuildingLevel( $buildingsData->getId(), $Data->getPlanetId() );
				?><script type="text/javascript">
					// Appel du script de redirection vers la page index.php (3 secondes)
					redirection(0.5, 'structure.connect.php');
				</script><?php
			}
			else
			{
				$arrayConstruction[] = array( "name" => $buildingsData->getName(), "quantity" => $onGoingBuilds[$i]['gb_buildQuantity'], "endTime" => $onGoingBuilds[$i]['gb_endTime'] );
			}
		}

	}

	if( isset($_POST["extendBuilding"]) && is_numeric($_POST["extendBuilding"]) && $_POST["extendBuilding"] > 0 )
	{
		$buildingId = (int)htmlspecialchars($_POST["extendBuilding"]) - 1;
		$list = $Data->getBuildingsList();
		$buildingData = $list[$buildingId];
		
		if( empty($onGoingBuilds) )
		{
			if( (int)$Data->getRes1() >= (int)$buildingData->getCost1() && (int)$Data->getRes2() >= (int)$buildingData->getCost2() && (int)$Data->getRes3() >= (int)$buildingData->getCost3() )
			{
				/* Mise à jour des ressources de la planète */
				$Data->getPlanet()->updateRessource( (int)$Data->getPlanetId(), (int)$Data->getRes1() - (int)$buildingData->getCost1(), (int)$Data->getRes2() - (int)$buildingData->getCost2(), (int)$Data->getRes3() - (int)$buildingData->getCost3(), (int)$Data->getPR(), (int)$Data->getProductionTime() );
				/* Ajout de la structure dans la liste des constructions en cours */
				$Data->getPlanet()->addBuildTime( $Data->getPlanetId(), $Data->getId(), 1, $buildingId, $buildingData->getTime(), 1);
			?>
				<div data-alert class="success-box">
					<p class="smaller">
						<br />
						Vos ouvriers se mettent au travail !<br />
						<span class="bold">L'agrandisement de la superficie de la structure "<?php echo $buildingData->getName(); ?>" prendra environ <?php echo (String)$buildingData->timeToString($buildingData->getTime()); ?>.</span><br />
						<span class="smaller"><a href="structure.connect.php">(Ne pas attendre la redirection)</a></span>
					</p>
				</div>
				
				<script type="text/javascript">
					// Appel du script de redirection vers la page index.php (3 secondes)
					redirection(3, 'structure.connect.php');
				</script>
			<?php
			}
			else
			{
			?>
				<div data-alert class="error-box">
					<p class="smaller">
						<br />
						Vos ouvriers refusent de travailler !<br />
						<span class="bold">Vous n'avez pas les ressources nécessaire pour agrandir la superficie de cette structure.</span><br />
						<span class="smaller"><a href="structure.connect.php">(Ne pas attendre la redirection)</a></span>
					</p>
				</div>
				<script type="text/javascript">
					// Appel du script de redirection vers la page index.php (3 secondes)
					redirection(3, 'structure.connect.php');
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
					Vos ouvriers travaillent déjà sur une autre structure !<br />
					<span class="bold">Vous ne pouvez pas agrandir plus d'une structure à la fois.</span><br />
					<span class="smaller"><a href="structure.connect.php">(Ne pas attendre la redirection)</a></span>
				</p>
			</div>
			<script type="text/javascript">
				// Appel du script de redirection vers la page index.php (3 secondes)
				redirection(3, 'structure.connect.php');
			</script>
		<?php
		}
	}

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
