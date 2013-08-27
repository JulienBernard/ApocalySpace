			<?php
				/* Fichier des id des bâtiments */
				include("./config_id.php");
			?>

			<!--
				Bloc droit du site.
				Right block of website.
			-->
			<nav class="large-3 columns">
				<h1>INFORMATIONS <img id="help" style="width: 25px; cursor: pointer;" class="right" src="./img/aide.png" alt="[AIDE]" /></h1>
				<div class="row">
					<div class="player-planet">
						<div id="player-planet-hidden"><?php echo strtoupper($Data->getPlanetName()); ?></div>
						<p>
							<img src="img/player_planet.png" alt="[image planète]" />
						</p>
					</div>
				</div>
				
				<div class="row">
					<p class="smaller">
						<span class="player-planet-name"><?php echo ucwords($Data->getPlanetName()); ?> ( <?php echo ucwords($Data->getUsername()); ?> )</span><br />
						<span class="player-planet-text">
							Coord : x <?php echo $Data->getPosX(); ?> | y <?php echo $Data->getPosY(); ?><br />
							Population : <?php echo $Data->getPopulation(); ?> sur <?php echo $Data->getManagePopulationMax(); ?><br />
							Natalité : <?php if( $Data->getPopulation() >= $Data->getManagePopulationMax() ) echo "<span class='bad'>"; echo $Data->getNatality(); ?> par jour<?php if( $Data->getPopulation() >= $Data->getManagePopulationMax() ) echo "</span>"; ?><br />
							<br />
							<a href="structure.connect.php">Pas de construction en cours</a><br />
							<a href="index.connect.php">Aucune activité spatiale détectée</a>
						</span>
					</p>
				</div>

				<div class="row">					
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td class="center"><?php echo $Data->getRes1(); ?></td>
								<td class="center"><?php echo $Data->getRes2(); ?></td>
								<td class="center"><?php echo $Data->getRes3(); ?></td>
								<td class="center"><?php echo $Data->getPR(); ?></td>
							</tr>
							<tr class="smaller">
								<td class="center">&nbsp;/ <?php echo pow(2, Building::getBuildingLevel($titaneStorageId, $Data->getPlanetId()))*$titaneStorageSizePerLevel; ?></td>
								<td class="center">&nbsp;/ <?php echo pow(2, Building::getBuildingLevel($berylStorageId, $Data->getPlanetId()))*$berylStorageSizePerLevel; ?></td>
								<td class="center">&nbsp;/ <?php echo pow(2, Building::getBuildingLevel($hydrogeneStorageId, $Data->getPlanetId()))*$hydrogeneStorageSizePerLevel; ?></td>
								<td class="center">-</td>
							</tr>
						</tbody>
						
						<tfoot>
							<tr>
								<th class="smaller center">Titane</th>
								<th class="smaller center">Béryl</th>
								<th class="smaller center">Hydro.</th>
								<th class="smaller center">Pts. Rech.</th>
							</tr>
						</tfoot>
					</table>
				</div>
				
				<h1>PRODUCTION</h1>
				<div class="row">					
					<table style="width: 100%;">						
						<tbody>
							<tr>
								<td>Titane</td>
								<td class="smaller center"><?php echo $Data->getProdRes1(); ?></td>
								<td class="smaller center"><?php echo $Data->getProdRes1Bonus(); ?></td>
								<td class="center"><?php echo $Data->getTotalProdRes1(); ?></td>
							</tr>
							<tr>
								<td>Béryl</td>
								<td class="smaller center"><?php echo $Data->getProdRes2(); ?></td>
								<td class="smaller center"><?php echo $Data->getProdRes2Bonus(); ?></td>
								<td class="center"><?php echo $Data->getTotalProdRes2(); ?></td>
							</tr>
							<tr>
								<td>Hydro</td>
								<td class="smaller center"><?php echo $Data->getProdRes3(); ?></td>
								<td class="smaller center"><?php echo $Data->getProdRes3Bonus(); ?></td>
								<td class="center"><?php echo $Data->getTotalProdRes3(); ?></td>
							</tr>
							<tr>
								<td>Pts. Rech.</td>
								<td class="smaller center"><?php echo $Data->getProdPR(); ?></td>
								<td class="smaller center">-</td>
								<td class="center"><?php echo $Data->getTotalProdResPR(); ?></td>
							</tr>
						</tbody>
	   
						<tfoot>
							<tr>
								<th></th>
								<th class="smaller center">Normal</th>
								<th class="smaller center">Bonus</th>
								<th class="smaller center">TOTAL</th>
							</tr>
						</tfoot>
					</table>
				</div>
				
				<h1>RENDEMENT</h1>
				<div class="row">
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td>Usine</td>
								<td class="bad smaller center">(a venir)</td>
							</tr>
							<tr>
								<td>Atelier</td>
								<td class="good smaller center">(a venir)</td>
							</tr>
						</tbody>
	   
						<tfoot>
							<tr>
								<th></th>
								<th class="smaller center">Pourcentage (%)</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</nav>
		</div>
	</section>
</section>

<footer>
	<header>
		<div class="row">
			<div id="returnTop" class="large-1 columns">
			</div>
			<p class="large-7 columns">
				« Ce n’est pas possible ; cela n’est pas français. »<br />
				<span class="italic small">Citation de Napoléon Bonaparte</span>
			</p>
			<p class="large-4 columns">
				ApocalySpace © 2012-2013 &nbsp;&nbsp;&nbsp; <a href="./docs/">Version 1.6.3</a><br />
			<?php	
				if( isset($timeStart) ){
					$timeend = microtime(true);
					$mtime = $timeend - $timeStart;
					$execution = number_format($mtime, 3);
					echo 'Généré en '.$execution.'s';
				}
			?>
			</p>
		</div>
	</header>
	<section>
		<div class="row">
			<nav class="large-8 columns center">
				<p>
					<br />
					<a href="deconnexion.connect.php">Déconnexion</a> / 
					<a href="support.connect.php">Contact et Support</a>
				</p>
			</nav>
			<article class="large-4 columns center">
				<p>
					Projet sous licence GPL réalisé initialement par
					<a href="http://jibidev.fr/a-propos">Julien Bernard</a>, Benjamin Crosnier et Etienne Rocipon.<br />
					<br />
					Le projet est désormais repris par Julien.<br />
					<a href="support.php">Contact</a> - <a href="histoire_projet.php">Histoire du projet</a> - <a href="mentions.php">Mentions légales</a>
				</p>
			</article>
		</div>
	</section>
</footer>

	<!--
		Script de Foundation 4.
		Foundation 4 script.
	-->
	<script>
		document.write('<script src=' +
		('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
		'.js><\/script>')
	</script>
	
	<script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.orbit.js"></script>
	
	<script>
		$(function(){
			$(document).foundation();    
		})
		// Start Joyride
		
		// JQuery Script: return to the top of the page with a animation
		$(document).ready( function () {
			$('#returnTop').click(function() {
				$('html,body').animate({scrollTop: $("#main").offset().top}, 'slow');
			});
			$('#help').click(function() {
				$(document).foundation('joyride', 'start');
			});
			
		})
								
		window.onload = function(){
			setInterval("displayServerTime()", 1000);
		}
		var ctime = '<?php echo date( "F d, Y H:i:s", time() ); ?>';
		var sdate = new Date(ctime);
	</script>
</body>
</html>
