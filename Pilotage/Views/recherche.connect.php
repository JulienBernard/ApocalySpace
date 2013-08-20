		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1>RECHERCHES TECHNOLOGIQUES</h1>
				<div data-alert class="success-box">
					<p class="smaller">
						Que ce soit pour l'armement ou pour la médecine, la recherche scientifique est primordiale pour l'évolution d'un empire.<br />
						Une amélioration ou une découverte scientifique vaut un certain  nombre de PR que produisent vos chercheurs.<br />
						<span class="bold">Vous avez actuellement 210 Points Recherche (PR) pour une production de 20 par heure.</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>

				<section class="ac-container">
				<?php
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
				</section>
				
				<section class="ac-container">
					<div>
						<input id="ac-1" name="accordion-1" type="radio" />
						<label for="ac-1">Énergie</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress success round"><span class="meter" style="width: 100%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">" Que ferions-nous sans énergie ? "</span><br />Ressource ultime de toute civilisation, l'amélioration de l'énergie vous permettra d'améliorer et de découvrir de nouvelles technologies.</p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-2" name="accordion-1" type="radio" />
						<label for="ac-2">Production Minière</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress success round"><span class="meter" style="width: 90%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">La technologie au service de l'homme !</span><br />Améliorer la vitesse de collecte des ressources vous octroi - pour chaque niveau d'amélioration - 10 % de production en plus sur toutes les ressources (or PR).</p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-3" name="accordion-1" type="radio" />
						<label for="ac-3">Recherche Médicale</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress info round"><span class="meter" style="width: 80%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">Pour une santé de fer !</span><br />La médecine permet à votre peuple de vivre dans de meilleures conditions. Chaque niveau d'amélioration augmente votre taux de natalité de 5 %.<br /><span class="italic smaller">Attention, ce bonus n'est plus pris en compte en cas de surpopulation !</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-4" name="accordion-1" type="radio" />
						<label for="ac-4">Contrôle des Flottes</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress info round"><span class="meter" style="width: 70%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">" Toujours avoir l'avantage numérique "</span><br />L'évolution permanente de l'informatique dans l'empire vous permet de contrôler plus de flottes depuis votre centre de commande. Un niveau d'amélioration c'est un nouveau slot de flotte disponible !</p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-5" name="accordion-1" type="radio" />
						<label for="ac-5">Ingénierie</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress info round"><span class="meter" style="width: 60%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">Former pour détruire ?</span><br />La formation de jeunes ingénieurs ajouter à une technologique de pointe permet à tout empire digne de ce nom de posséder de plus gros vaisseau de guerre.<br /><span class="italic smaller">L'ingénierie vous permet d'obtenir des châssis de plus en plus évolués.</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-6" name="accordion-1" type="radio"  />
						<label for="ac-6">Armement</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress info round"><span class="meter" style="width: 50%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">" Le nerf de la guerre se trouve ici, mon grand ... "</span><br />La recherche en armement vous permettra d'avoir l'avantage en puissance sur vos ennemis. Chaque niveau d'amélioration vous octroi 5 % de puissance en plus.<br /><span class="italic smaller">Améliorer cette technologie pour obtenir des modules d'armement plus évolués.</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-7" name="accordion-1" type="radio" />
						<label for="ac-7">Bouclier</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress info round"><span class="meter" style="width: 40%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">" ... mais également ici ! "</span><br />Qui n'a jamais rêvé d'une sécurité renforcée pour son vaisseau pour un poids minime ? Chaque niveau d'amélioration vous octroi 5 % de bouclier en plus.<br /><span class="italic smaller">Améliorer cette technologie pour obtenir des modules de boucliers plus évolués.</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-8" name="accordion-1" type="radio" />
						<label for="ac-8">Blindage</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress alert round"><span class="meter" style="width: 30%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">Il n'y a que cela qui te protège du vide de l'espace !</span><br />Le renforcement de la coque de chaque vaisseau est un processus long et coûteux, mais chaque niveau d'amélioration vous octroi 5 % de coque en plus.<br /><span class="italic smaller">Améliorer cette technologie pour obtenir de nouveau modules de coques !</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
					<div>
						<input id="ac-9" name="accordion-1" type="radio" checked />
						<label for="ac-9">Propulsion</label>
						<div style="float: right; margin-top: -19px;" class="small-8 center progress alert round"><span class="meter" style="width: 20%"></span></div>
						<article class="ac-small">
							<p><span class="bold smaller">Plus vite que la lumière !</span><br />Plus un propulseur est puissant, plus votre vaisseau ira vite. Il faut également prendre en compte le poids des modules ce qui agace souvent de nombreux chercheurs !<br /><span class="italic smaller">Améliorer cette technologie pour obtenir des modules de propulsion plus évolués.</span></p>
							<form action="<?php echo $namePage; ?>.connect.php" method="POST">
								<div class="small-12 columns">
									<input type="submit" value="Améliorer pour 9999 PR" class="button prefix"/>
								</div>
							</form>
						</article>
					</div>
				</section>
			</article>