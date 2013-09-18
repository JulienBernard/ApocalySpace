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
		$buildingId = (int)htmlspecialchars($_POST["extendBuilding"]);
		$list = $Data->getBuildingsList();
		$buildingData = $list[$buildingId-1];
		
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
	else if( isset($_POST["changePopulation"]) && is_numeric($_POST["changePopulation"]) && $_POST["changePopulation"] > 0 )
	{
		if( isset($_POST["manuallyChangeValue"]) && is_numeric($_POST["manuallyChangeValue"]) && $_POST["manuallyChangeValue"] >= 0 )
		{
			$changeValue = (int)htmlspecialchars($_POST["manuallyChangeValue"]);
			$buildingId = (int)htmlspecialchars($_POST["changePopulation"]);
			$list = $Data->getBuildingsList();
			$buildingData = $list[$buildingId-1];
			$populationManageNow = $Data->getNumberOfPopulationWhoAreManagedNow( $buildingId );
			$newPopulationManage = ($buildingData->getPopulation() + $changeValue);
			
			if( $newPopulationManage >= 0 && $changeValue <= (int)$buildingData->getMaxPopulation() && $populationManageNow <= (int)$Data->getPopulation() )
			{
				/* Fichier des id des bâtiments */
				include("./config_id.php");
				/* Si on modifie un bâtiment de production, on modifie sa production ! */
				if( $buildingId == $titaneMineId )
				{	
					$newProd = 100 + $newPopulationManage * 16; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 1 );
				}
				else if( $buildingId == $berylMineId )
				{
					$newProd = 60 + $newPopulationManage * 12; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 2 );
				}
				else if( $buildingId == $hydrogeneExtractorId )
				{
					$newProd = $newPopulationManage * 8; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 3 );
				}
				else if( $buildingId == $researchCenterId )
				{
					$newProd = $newPopulationManage * 7; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 4 );
				}
				
				$buildingData->updateBuildingPopulation( $Data->getPlanetId(), $buildingId, $changeValue );
				
				/* Modification OK */
				$Engine->setSuccess("Il y a désormais ".$changeValue." habitants qui travaille dans cette structure.");
				?>
				<script>
					$(document).ready(function() {
						$('#successModal').foundation('reveal', 'open');
					});
				</script>
				<?php
			}
			else
			{
				/* Modification NO */
				$Engine->setError("- Vous ne pouvez pas attribuer à une structure plus d'ouvriers qu'elle ne peut en accueilir<br />- Vous ne pouvez pas attribuer plus d'habitants que vous permet votre population totale");
				?>
				<script>
					$(document).ready(function() {
						$('#errorModal').foundation('reveal', 'open');
					});
				</script>
				<?php
			}
		}
		else if( isset($_POST["fastChangeValue"]) && $_POST["fastChangeValue"] != 0)
		{
			$changeValue = (int)htmlspecialchars($_POST["fastChangeValue"]);
			if( $changeValue < -100 && $changeValue > 100 )
				$changeValue = 0;
				
			$buildingId = (int)htmlspecialchars($_POST["changePopulation"]);
			$list = $Data->getBuildingsList();
			$buildingData = $list[$buildingId-1];
			$populationManageNow = $Data->getNumberOfPopulationWhoAreManagedNow( $buildingId );
			$newPopulationManage = ($buildingData->getPopulation() + $changeValue);
			
			if( $newPopulationManage >= 0 && $changeValue <= (int)$buildingData->getMaxPopulation() && $populationManageNow <= (int)$Data->getPopulation() )
			{
				/* Fichier des id des bâtiments */
				include("./config_id.php");
				/* Si on modifie un bâtiment de production, on modifie sa production ! */
				if( $buildingId == $titaneMineId )
				{	
					$newProd = 100 + $newPopulationManage * 16; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 1 );
				}
				else if( $buildingId == $berylMineId )
				{
					$newProd = 60 + $newPopulationManage * 12; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 2 );
				}
				else if( $buildingId == $hydrogeneExtractorId )
				{
					$newProd = $newPopulationManage * 8; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 3 );
				}
				else if( $buildingId == $researchCenterId )
				{
					$newProd = $newPopulationManage * 7; // Production initiale + valeur selon population
					$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 4 );
				}
				
				$buildingData->updateBuildingPopulation( $Data->getPlanetId(), $buildingId, $buildingData->getPopulation()+$changeValue );
				
				/* Modification OK */
				$Engine->setSuccess("Il y a désormais ".($buildingData->getPopulation())." habitants qui travaille dans cette structure.");
				?>
				<script>
					$(document).ready(function() {
						$('#successModal').foundation('reveal', 'open');
					});
				</script>
				<?php
			}
			else
			{
				/* Modification NO */
				$Engine->setError("- Vous ne pouvez pas attribuer à une structure plus d'ouvriers qu'elle ne peut en accueilir<br />- Vous ne pouvez pas attribuer plus d'habitants que vous permet votre population totale");
				?>
				<script>
					$(document).ready(function() {
						$('#errorModal').foundation('reveal', 'open');
					});
				</script>
				<?php
			}
		}
		else if( $_POST["manuallyChangeValue"] < 0 )
		{
			/* Valeur incorrecte */
			$Engine->setError("Votre structure ne peut - certes - gérer qu'un certain nombre d'habitants, mais elle ne peut certainement pas gérer un nombre négatif d'habitants !");
			?>
			<script>
				$(document).ready(function() {
					$('#errorModal').foundation('reveal', 'open');
				});
			</script>
			<?php
		}
		else
		{
			/* Valeur incorrecte */
			$Engine->setError("Aucun changement n'a été détecté.");
			?>
			<script>
				$(document).ready(function() {
					$('#errorModal').foundation('reveal', 'open');
				});
			</script>
			<?php
		}
	}
	
	$populationManageNow = (int)$Data->getNumberOfPopulationWhoAreManagedNow();
	$difPopulation = (int)$Data->getPopulation() - (int)$populationManageNow;
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
