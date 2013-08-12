<?php 
	
	
	if( isset($_POST["changePopulation"]) && is_numeric($_POST["changePopulation"]) && $_POST["changePopulation"] > 0
		&& isset($_POST["changeValue"]) && is_numeric($_POST["changeValue"]) && $_POST["changeValue"] >= 0)
	{
		$changeValue = (int)$_POST["changeValue"];
		$buildingId = (int)$_POST["changePopulation"];
		$buildingData = $Data->getBuildingsList()[$buildingId-1];
		$populationManageNow = $Data->getNumberOfPopulationWhoAreManagedNow( $buildingId );
		$populationManageNow += $changeValue;
		
		if( $changeValue <= (int)$buildingData->getMaxPopulation() && $populationManageNow <= $Data->getPopulation() )
		{
			/* Fichier des id des bâtiments */
			include("./config_id.php");
			/* Si on modifie un bâtiment de production, on modifie sa production ! */
			if( $buildingId == $titaneMineId )
			{
				$newProd = 100 + $changeValue * 16; // Production initiale + valeur selon population
				$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 1 );
			}
			else if( $buildingId == $berylMineId )
			{
				$newProd = 60 + $changeValue * 12; // Production initiale + valeur selon population
				$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 2 );
			}
			else if( $buildingId == $hydrogeneExtractorId )
			{
				$newProd = $changeValue * 8; // Production initiale + valeur selon population
				$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 3 );
			}
			else if( $buildingId == $researchCenterId )
			{
				$newProd = $changeValue * 7; // Production initiale + valeur selon population
				$Data->getPlanet()->updateProduction( $Data->getPlanetId(), $newProd, 4 );
			}
			
			$buildingData->updateBuildingPopulation( $Data->getPlanetId(), $buildingId, $changeValue );

			$ERROR = $Engine->setSuccess("<span class=\"bold\">Modification de gestion effectuée !</span><br />La gestion de cette structure a été correctement modifié.<br />Les modifications seront visibles dès l'actualisation de la page !<br /><br /><a href=\"index.connect.php\">Ne pas attendre : actualiser la page maintenant !</a>");
		}
		else
		{
			$ERROR = $Engine->setError("<span class=\"bold\">Mauvaise gestion détectée !</span><br />- Vous ne pouvez pas attribuer à une structure plus d'ouvriers qu'elle ne peut en accueilir<br />- Vous ne pouvez pas attribuer plus d'habitants que vous permet votre population totale");
		}
	}

	/* Gestion des erreurs */
	$INFO = $Engine->getInfo();
	$ERROR = $Engine->getError();
	$SUCCESS = $Engine->getSuccess();
	
	if( !empty($INFO) ) {
		echo "<div data-alert class=\"info-box\"><p class=\"smaller\">".$INFO."</p></div>";
		?>
		<script type="text/javascript">
			// Appel du script de redirection vers la page index.php (3 secondes)
			redirection(3, 'index.connect.php');
		</script>
		<?php
	}
	if( !empty($ERROR) ) {
		echo "<div data-alert class=\"error-box\"><p class=\"smaller\">".$ERROR."</p></div>";
		?>
		<script type="text/javascript">
			// Appel du script de redirection vers la page index.php (3 secondes)
			redirection(3, 'index.connect.php');
		</script>
		<?php
	}
	else if( !empty($SUCCESS) ) {
		echo "<div data-alert class=\"success-box\"><p class=\"smaller\">".$SUCCESS."</p></div>";
		?>
		<script type="text/javascript">
			// Appel du script de redirection vers la page index.php (3 secondes)
			redirection(3, 'index.connect.php');
		</script>
		<?php
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
