		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1>GESTION PLANETAIRE</h1>
				<div data-alert class="info-box">
					<p class="smaller-2">
						<span class="important-alert">Une flotte en provenance de Prometheus entrera dans votre système planétaire dans 3h et 47min</span><br />
						<span class="important-return">Votre flotte en provenance de Prometheus sera de retour sur votre planète dans 3h et 32min</span><br />
						<span class="important-send">La flotte en partance pour LegendStar entrera dans son système planétaire dans 56min</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<div data-alert class="success-box">
					<p class="smaller">
						La gestion de votre population est votre outil principal pour commander d'une main de fer votre empire.<br />
						Vous pouvez attribuer à vos bâtiments autant d'habitants que vous le souhaitez dans les limites de leurs superficies.<br />
						<span class="bold">Il y a actuellement 452 habitants sur votre planète et vous pouvez en administrer 460</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<ul>
					<?php
					$buildings = $Data->getBuildingsList( 2 );
					for( $j = 0 ; $j < count($buildings) ; $j++ )
					{
						$canChange = false;
						if( (int)$buildings[$j]->getSuperficie() != 0 )
							$canChange = true;
					?>
						<li>
							<span class="float-left"><img src="./img/bat/<?php echo (String)$buildings[$j]->getPicture(); ?>" alt="[IMAGE]" /></span><?php echo (int)$buildings[$j]->getSuperficie(); ?> m²<br />
							<form action="index.connect.php" method="POST">
								<div class="small-6 columns">
									<input type="text" class="center" placeholder="<?php echo (int)$buildings[$j]->getPopulation(); ?> / <?php echo (int)$buildings[$j]->getMaxPopulation(); ?>">
									<input type="submit" <?php if( !$canChange ) echo 'disabled="disabled"'; ?> value="Changer" class="button prefix"/>
								</div>
							</form>
							<span class="smaller">
								<span class="bold"><?php echo (String)$buildings[$j]->getName(); ?></span><br />
								<?php echo (String)$buildings[$j]->getDescription(); ?>
							</span>
						</li>
					<?php
					}
					?>
				</ul>
				<ul>
					<?php
					$buildings = $Data->getBuildingsList( 4 );
					for( $j = 0 ; $j < count($buildings) ; $j++ )
					{
						$canChange = false;
						if( (int)$buildings[$j]->getSuperficie() != 0 )
							$canChange = true;
					?>
						<li>
							<span class="float-left"><img src="./img/bat/<?php echo (String)$buildings[$j]->getPicture(); ?>" alt="[IMAGE]" /></span><?php echo (int)$buildings[$j]->getSuperficie(); ?> m²<br />
							<form action="index.connect.php" method="POST">
								<div class="small-6 columns">
									<input type="text" class="center" placeholder="<?php echo (int)$buildings[$j]->getPopulation(); ?> / <?php echo (int)$buildings[$j]->getMaxPopulation(); ?>">
									<input type="submit" <?php if( !$canChange ) echo 'disabled="disabled"'; ?> value="Changer" class="button prefix"/>
								</div>
							</form>
							<span class="smaller">
								<span class="bold"><?php echo (String)$buildings[$j]->getName(); ?></span><br />
								<?php echo (String)$buildings[$j]->getDescription(); ?>
							</span>
						</li>
					<?php
					}
					?>
				</ul>
			</article>