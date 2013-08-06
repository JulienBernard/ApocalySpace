<?php

	// ICI : check si une construction est en cours !
	

	if( isset($_POST["extendBuilding"]) )
	{
		$buildingId = (int)$_POST["extendBuilding"];
		$buildingData = $Data->getBuildingsList()[$buildingId-1];
		
		if( (int)$Data->getRes1() >= (int)$buildingData->getCost1() && (int)$Data->getRes2() >= (int)$buildingData->getCost2() && (int)$Data->getRes3() >= (int)$buildingData->getCost3() )
		{
		?>
			<div data-alert class="success-box">
				<p class="smaller">
					<br />
					Vos ouvriers se mettent au travail !<br />
					<span class="bold">L'agrandisement de la superficie de la structure "<?php echo $buildingData->getName(); ?>" prendra environ <?php echo (String)$buildingData->timeToString($buildingData->getTime()); ?>.</span><br />
					<a href="" class="right close">&times;</a>
				</p>
			</div>
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
					<a href="" class="right close">&times;</a>
				</p>
			</div>
		<?php
		}
	}

	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );
