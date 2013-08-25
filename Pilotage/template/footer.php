			<!--
				Bloc droit du site.
				Right block of website.
			-->
			<nav class="large-3 columns">
				<h1>CONNEXION</h1>
				<div class="row">
					<form action="index.php" method="POST">
					<div class="small-1 columns"></div>
					<div class="small-11 columns">
						<input type="text" name="username" placeholder="Pseudonyme">
						<input type="password" name="password" placeholder="Mot de passe">
						<input type="submit" name="signin" value="Se connecter" class="button prefix"/>
					</div>
					</form>
				</div>
				<h1>INSCRIPTION <span class="smaller"><a href="histoire.php#factions">Que choisir ?</a></span></h1>
				<div class="row">
					<form action="index.php" method="POST" class="custom">
					<div class="small-1 columns"></div>
					<div class="small-11 columns">
						<input type="text" name="username" placeholder="Pseudonyme">
						<input type="password" name="password" placeholder="Mot de passe">
						<select id="customDropdown1" name="faction" class="medium">
							<option DISABLED>Choix de faction (choix définitif)</option>
							<option>Impériaux</option>
							<option SELECTED>Vagabonds</option>
							<option>Républicains</option>
						</select>
						<input type="submit" name="subscribe" value="S'inscrire" class="button prefix"/>
					</div>
					</form>
				</div>
				<h1>INFOS SERVEURS</h1>
				<div class="row">
					<div class="small-1 columns"></div>
					<p class="small-11 columns">
						<span class='smaller'>
						<?php
							date_default_timezone_set('Europe/Paris');
							include_once(PATH_MODELS."myPDO.class.php");
							include_once(PATH_MODELS."user.class.php");
							echo "Il y a ".User::countPlayer()." joueurs actifs.<br />";
							echo "L'heure du serveur est <span id='serverTime'>".date( "H:i:s", time() )."</span><br />";
						?>
						</span>
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
				ApocalySpace © 2012-2013 &nbsp;&nbsp;&nbsp; <a href="./docs/">Version 1.6</a>
			</p>
		</div>
	</header>
	<section>
		<div class="row">
			<nav class="large-8 columns center">
				<p>
					<br />
					<a href="index.php" class="current">Accueil</a> / 
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
