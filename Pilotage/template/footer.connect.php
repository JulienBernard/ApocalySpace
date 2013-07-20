			<!--
				Bloc droit du site.
				Right block of website.
			-->
			<nav class="large-3 columns">
				<h1>INFORMATIONS</h1>
				<div class="row">
					<div class="player-planet">
						<div id="player-planet-hidden">PLANET NAME</div>
						<p>
							<img src="img/player_planet.png" alt="[image planète]" />
						</p>
					</div>
				</div>
				<div class="row">
					<p class="smaller">
						<span class="player-planet-name">My planet ( Jibi )</span><br />
						<span class="player-planet-text">
							Coord : x 58 | y 80<br />
							Population : 452 sur 460<br />
							Natalité : 23 par jour<br />
							<br />
							<a href="">Pas de construction en cours</a><br />
							<a href="">Pas de recherche en cours</a>
						</span>
					</p>
				</div>

				<br />
				<h1>PRODUCTIONS</h1>
				<div class="row">					
					<table style="width: 100%;">
						<thead>
							<tr>
								<th></th>
								<th class="center" colspan="3">Ressources</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<td>Actuelle</td>
								<td class="smaller center">250</td>
								<td class="smaller center">130</td>
								<td class="smaller center">50</td>
							</tr>
							<tr>
								<td>Bonus</td>
								<td class="bonus smaller center">50</td>
								<td class="bonus smaller center">20</td>
								<td class="bonus smaller center">0</td>
							</tr>
							<tr>
								<td>Totale</td>
								<td class="center">300</td>
								<td class="center">150</td>
								<td class="center">50</td>
							</tr>
						</tbody>
	   
						<tfoot>
							<tr>
								<th></th>
								<th class="smaller center">Titane</th>
								<th class="smaller center">Béryl</th>
								<th class="smaller center">Hydro.</th>
							</tr>
						</tfoot>
					</table>
					
					<table style="width: 100%;">
						<thead>
							<tr>
								<th></th>
								<th class="center" colspan="3">Rendement</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<td>Usine</td>
								<td class="smaller center">60</td>
							</tr>
							<tr>
								<td>Atelier</td>
								<td class="good 	smaller center">100</td>
							</tr>
							<tr>
								<td>Centre Rech.</td>
								<td class="bad smaller center">20</td>
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
				ApocalySpace © 2012-2013 &nbsp;&nbsp;&nbsp; <a href="./docs/">Version 1.4</a><br />
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
		
		// JQuery Script: return to the top of the page with a animation
		$(document).ready( function () {
			$('#returnTop').click(function() {
				$('html,body').animate({scrollTop: $("#main").offset().top}, 'slow');
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
