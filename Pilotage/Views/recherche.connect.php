		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div data-alert class="success-box">
					<p class="smaller">
						Que ce soit pour l'armement ou pour la médecine, la recherche scientifique est primordiale pour l'évolution d'un empire.<br />
						Une amélioration ou une découverte scientifique vaut un certain  nombre de PR que produisent vos chercheurs.<br />
						<span class="bold">Vous avez actuellement <?php echo $Data->getPr(); ?> Points Recherche (PR) pour une production de <?php echo $Data->getProdPr(); ?> par heure.</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>

				<section class="ac-container">
					<?php
					$technologies = $Data->getTechnologiesList();
					for( $j = 0 ; $j < count($technologies) ; $j++ )
					{
						$canBuy = true;
						$charge = (int)$technologies[$j]->getLevel() * 10;
					?>
						<div>
							<input id="ac-<?php echo $j+1; ?>" name="accordion-1" type="radio" checked />
							<label for="ac-<?php echo $j+1; ?>"><?php echo (String)$technologies[$j]->getName(); ?></label>
							<div style="float: right; margin-top: -19px;" class="small-8 center progress <?php if($charge >= 80) echo "success"; else if($charge <= 20) echo "alert"; ?> round"><span class="meter smaller" style="color: #fafafa; padding-top: 4px; width: <?php echo (int)$charge; ?>%"><?php echo (int)$charge; ?>%</span></div>
							<article class="ac-small">
								<p><span class="bold smaller"><?php echo (String)$technologies[$j]->getPitch(); ?></span><br /><?php echo (String)$technologies[$j]->getDescription(); ?><br /><span class="italic smaller"><?php echo (String)$technologies[$j]->getInformations(); ?></span></p>
								<form action="<?php echo $namePage; ?>.connect.php" method="POST">
									<div class="small-12 columns">
										<input type="hidden" name="researchTechnology" value="<?php echo (int)$technologies[$j]->getId(); ?>" />
										<input type="submit" value="Améliorer pour <?php echo (String)$technologies[$j]->getCost(); ?> PR" class="button prefix"/>
									</div>
								</form>
							</article>
						</div>
					<?php
					}
					?>
				</section>
			</article>