		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				
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

			for( $i = 1 ; $i <= 4 ; $i++ )
			{	?>
				<ul class="large-ul">
				<?php
				$buildings = $Data->getBuildingsList( $i );
				for( $j = 0 ; $j < count($buildings) ; $j++ )
				{
					$canBuy = true;
				?>
					<li>
						<span class="float-left"><img src="./img/bat/<?php echo (String)$buildings[$j]->getPicture(); ?>" alt="[IMAGE]" /></span><?php echo (int)$buildings[$j]->getSuperficie(); ?> m²<br />
						<span class="smaller">
							<span class="<?php if( (int)$Data->getRes1() >= (int)$buildings[$j]->getCost1() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost1(); ?> Titane</span><br />
							<span class="<?php if( (int)$Data->getRes2() >= (int)$buildings[$j]->getCost2() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost2(); ?> Béryl</span><br />
							<span class="<?php if( (int)$Data->getRes3() >= (int)$buildings[$j]->getCost3() ) echo 'good'; else { echo 'bad'; $canBuy = false; } ?>"><?php echo (int)$buildings[$j]->getCost3(); ?> Hydro.</span><br />
							&nbsp;<br />
							<span class="bold"><?php echo (String)$buildings[$j]->getName(); ?></span><br />
							<?php echo (String)$buildings[$j]->getDescription(); ?>
							<br />
						</span>
						<form action="<?php echo $namePage; ?>.connect.php" method="POST">
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