		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				
			<?php
			if(!empty($arrayConstruction))
			{
			?>
				<div data-alert class="info-box">
					<p class="small">
						<?php
						for($i = 0; $i < count($arrayConstruction); $i++)
						{
							?>
							<span class="important-send">
								L'agrandisement de la structure "<?php echo $arrayConstruction[$i]['name']; ?>" se terminera dans 
								<?php
								echo "<span class='ModuleProductionTime' id='countdown".$i."'>".date('d/m à H\hi', $arrayConstruction[$i]['endTime'])."</span>
									<script type=\"text/javascript\">
									endRedirect = 1;
									stripGetRedirect = 1;
									createCountdown('countdown".$i."', ".(int)($arrayConstruction[$i]['endTime'] - time() ).");
									</script>";
								?>
							</span>
							<a href="" class="right close">&times;</a>
						<?php
						}
						?>
					</p>
				</div>
			<?php
			}

			$buildingsArray = array();
			for( $i = 1 ; $i <= 4 ; $i++ )
			{	?>
				<ul class="large-ul" >
				<?php
				$buildings = $Data->getBuildingsList( $i );
				$buildingsArray[$i] = $buildings;
				for( $j = 0 ; $j < count($buildings) ; $j++ )
				{
					$canBuy = true;
				?>
					<li>
						<span class="float-left">
							<?php
							if( $buildings[$j]->getType() == 2 || $buildings[$j]->getType() == 4 )
							{
							?>
								<div class="player-building" id="step3">
									<a href="" data-reveal-id="informationsModal<?php echo $i.'-'.$j; ?>">
									<div class="player-building-hidden smaller"><?php echo strtoupper($buildings[$j]->getPopulation().'/'.$buildings[$j]->getMaxPopulation()); ?></div>
									<p>
										<img src="./img/bat/<?php echo (String)$buildings[$j]->getPicture(); ?>" alt="[Structure]" />
									</p>
									</a>
								</div>
							<?php } else { ?>
								<img src="./img/bat/<?php echo (String)$buildings[$j]->getPicture(); ?>" alt="[IMAGE]" />
							<?php } ?>
						</span>
						<?php echo (int)$buildings[$j]->getSuperficie(); ?> m²<br />
						<span class="smaller">
							<span class="<?php if( (int)$Data->getRes1() >= (int)$buildings[$j]->getCost1() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost1(); ?> Titane</span><br />
							<span class="<?php if( (int)$Data->getRes2() >= (int)$buildings[$j]->getCost2() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost2(); ?> Béryl</span><br />
							<span class="<?php if( (int)$Data->getRes3() >= (int)$buildings[$j]->getCost3() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost3(); ?> Hydro.</span><br />
							&nbsp;<br />
							<span class="bold"><?php echo (String)$buildings[$j]->getName(); ?></span><br />
							<?php echo (String)$buildings[$j]->getDescription(); ?>
							<br />
						</span>
						<form action="<?php echo $namePage; ?>.connect.php" method="POST" id="step2">
							<div class="small-12 columns">
								<input type="hidden" name="extendBuilding" value="<?php echo (int)$buildings[$j]->getId(); ?>" />
								<input type="submit" <?php if( !$canBuy ) echo 'disabled="disabled"'; ?> value="Agrandir (<?php echo (String)$buildings[$j]->timeToString($buildings[$j]->getTime()); ?>)" class="button prefix" />
							</div>
						</form>
					</li>
				<?php
				}
				?>
				</ul>
		<?php
			}
		?>
	</article>
	
	<?php
	for( $i = 1 ; $i <= 4 ; $i++ )
	{
		$buildings = $buildingsArray[$i];
		for( $j = 0 ; $j < count($buildings) ; $j++ )
		{
			if( $buildings[$j]->getType() == 2 || $buildings[$j]->getType() == 4 )
			{
				$canChange = false;
				if( (int)$buildings[$j]->getSuperficie() != 0 )
					$canChange = true;
			?>
				<div id="informationsModal<?php echo $i.'-'.$j; ?>" class="reveal-modal">
					<h2><?php echo (String)$buildings[$j]->getName(); ?></h2>
					<p class="lead"><?php echo (String)$buildings[$j]->getDescription(); ?></p>
					<p>
						<div data-alert class="success-box">
							<p class="smaller">
								La gestion de votre population est votre outil principal pour commander d'une main de fer votre empire.<br />
								Vous pouvez attribuer à vos bâtiments autant d'habitants que vous le souhaitez dans les limites de leurs superficies.<br />
								<span class="bold">Il y a actuellement <?php echo $Data->getPopulation(); ?> habitants sur votre planète et vous pouvez en administrer <?php echo $Data->getManagePopulationMax(); ?>.</span><br />
								<a href="" class="right close">&times;</a>
							</p>
						</div>

						<form action="structure.connect.php" method="POST" class="custom">
							<div class="row">
								<div class="large-3 columns">&nbsp;</div>
								<div class="large-6 columns">
									<div data-alert class="info-box">
										<p>
											Cette structure gère <?php echo (int)$buildings[$j]->getPopulation(); ?> habitants sur <?php echo (int)$buildings[$j]->getMaxPopulation(); ?>.<br />
											Il vous reste <?php echo (int)$difPopulation; ?> habitants à administrer.<br />
											<a href="" class="right close">&times;</a>
										</p>
									</div>
								</div>
								<div class="large-3 columns">&nbsp;</div>
							</div>
							
							<div class="row">
								<div class="large-3 columns">&nbsp;</div>
								<div class="large-3 columns">
									<label for="fastChangeValue">Administration rapide</label>
									<select id="fastChangeValue" name="fastChangeValue">
										<?php
											for( $x = -100 ; $x <= 100 ; $x += 10 )
											{
												if( $x == 0 )
													echo '<option value="'.$x.'" selected>Ne rien changer</option>';
												else if( $x > 0 )
													echo '<option value="'.$x.'">+'.$x.'</option>';
												else
													echo '<option value="'.$x.'">'.$x.'</option>';

											}
										?>
									</select>
								</div>
								<div class="large-3 columns">
									<label for="manuallyChangeValue">Administration manuelle</label>
									<input type="number" class="center" name="manuallyChangeValue" placeholder="<?php echo (int)$buildings[$j]->getPopulation(); ?>" id="manuallyChangeValue">
								</div>
								<input type="hidden" name="changePopulation" value="<?php echo (int)$buildings[$j]->getId(); ?>" />
								<div class="large-3 columns">&nbsp;</div>
							</div>

							<div class="row">
								<div class="large-3 columns">&nbsp;</div>
								<div class="large-6 columns">
									<input type="submit" <?php if( !$canChange ) echo 'disabled="disabled"'; ?> value="Mettre à jour" class="button prefix"/>
								</div>
								<div class="large-3 columns">&nbsp;</div>
							</div>
						</form>
					</p>
					<a href="#" class="alert radius button close-reveal-modal">X</a>
				</div>
			<?php
			}
		}
	}
	?>
			
	<!-- Foundation4 Joyride : Aide & Tuto de la page -->
	<ol class="joyride-list" data-joyride>
		<li data-id="step1" data-text="Continuer">
			<h4>Où suis-je ?</h4><br />
			<div class="center">Structures</div>
			<p>La page structure vous permet de <span class="good">créer ou d'améliorer</span> vos bâtiments. Vous pouvez également <span class="good">administrer</span> votre population.</p>
		</li>
		<li data-id="step2" data-text="Continuer">
			<h4>Infos : Structure</h4>
			<p>Les <span class="bad">informations de la structures</span> et notamment son <span class="bad">côut d'amélioration ou de création</span> et sa <span class="bad">durée de construction</span> sont indiquées dans leur cadre d'informations respectifs.</p>
			<p class="good">En cliquant sur Agrandir (si vous avez les ressources suffisantes) vous augmenterez la taille de la structure.</p>
		</li>
		<li data-id="step3" data-text="Continuer">
			<h4>Infos : Administration</h4>
			<p class="good">En cliquant sur l'image représentative de la structure vous accèderez à la gestion de la population de celle-ci.</p>
		</li>
		<li data-button="Merci !">
			<h4>A vous de jouer !</h4><br />
			<p>Vous savez tout sur cette page.</p>
			<p>Encore besoin d'aide :<br />- <a data-reveal-id="FAQ">Lire la F.A.Q.</a><br />- <a href="communication.connect.php">Contactez Jibi !</a></p>
		</li>
	</ol>
	
	
	<div id="successModal" class="reveal-modal">
		<h2>Administration de la structure</h2>
		<p class="lead">Mise à jour effectuée avec succès !</p>
		<p><?php echo $Engine->getSuccess(); ?></p>
		<a href="#" class="success radius button close-reveal-modal">X</a>
	</div>
	
	<div id="errorModal" class="reveal-modal">
		<h2>Administration de la structure</h2>
		<p class="lead">La mise à jour a rencontré un problème !</p>
		<p><?php echo $Engine->getError(); ?></p>
		<a href="#" class="alert radius button close-reveal-modal">X</a>
	</div>
	
	<?php include_once(PATH_VIEWS."faq.php"); ?>