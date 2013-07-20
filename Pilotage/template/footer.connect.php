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
						<span class="player-planet-name">My planet</span><br />
						<span class="player-planet-text">
							Coord : x 58 | y 80<br />
							Population : 452 sur 486<br />
							Natalité : 23 par jour<br />
							<br />
							<a href="">Pas de construction en cours</a><br />
							<a href="">Pas de recherche en cours</a>
						</span>
					</p>
				</div>
				<div class="row">
					<p class="smaller">
						(tableau ressource)
					</p>
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
				ApocalySpace © 2012-2013 &nbsp;&nbsp;&nbsp; <a href="./docs/">Version 1.4</a>
			</p>
		</div>
	</header>
	<section>
		<div class="row">
			<nav class="large-8 columns center">
				<p>
					<br />
					<a href="index.connect.php" class="current">Accueil</a> / 
					<a href="histoire.php">Histoire</a> /
					<a href="galerie.php">Galerie</a> /
					<a href="support.php" class="unavailable">Contact et Support</a>
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
		$(document).ready( function () {
			$('#header_image').click(function() {
				$('html,body').animate({scrollTop: $("#links").offset().top}, 'slow');
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
