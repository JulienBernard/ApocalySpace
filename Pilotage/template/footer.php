		</div>
	</section>
</main>

<footer class="hide-for-large-down">
</footer>

<footer class="show-for-large-down">
	<section>
		<div class="row">
			<nav class="large-6 columns center">
				<p>
					<a style="cursor: pointer;" id="returnTop">Retourner en haut</a> - <a href="https://github.com/JulienBernard/ApocalySpace">Dépôt sur GitHub</a><br />
					Apocalyspace est un projet libre développé par Julien Bernard.
				</p>
			</nav>
			<article class="large-6 columns center">
					<p>
						Apocalyspace 2012 - 2014<br />
						<a href="#">Contact</a> - <a href="#">Privacy</a> - <a href="./docs/">Version 1.7</a>
					</p>
			</article>
		</div>
	</section>
</footer>

	<!-- Modals -->
	<div id="loginModal" class="large-12 small-6 reveal-modal">
		<h2>Se connecter</h2>
		<p class="lead">Merci de renseigner votre nom d'utilisateur et votre mot de passe pour vous connecter.</p>
		
		<form action="index.php" method="POST">
			<div class="row">
				<div class="large-4 columns">
					<label for="usr">Nom d'utilisateur</label>
					<input id="usr" type="text" name="username" placeholder="Nom d'utilisateur" />
				</div>
				<div class="large-4 columns">
					<label for="pwd">Mot de passe</label>
					<input id="pwd" type="password" name="password" placeholder="Mot de passe" />
				</div>
				<div class="large-4 columns">
					<br />
					<input class="small button" type="submit" name="login" value="Se connecter" />
				</div>
			</div>
		</form>
	</div>
	<div id="registerModal" class="large-12 small-6 reveal-modal">
		<h2>Rejoignez la communauté d'ApocalySpace !</h2>
		<p>
			Merci de choisir un nom d'utilisateur, la faction et le mot de passe qui sera associés à votre compte. <a href="histoire.php">Comment choisir ma faction ?</a>
		</p>

		<form action="index.php" method="POST">
			<div class="row large-8">
				<div class="large-6 columns">
					<label for="username">Nom d'utilisateur</label>
					<input id="username" type="text" name="username" placeholder="Nom d'utilisateur" title="Votre nom d'utilisateur doit être supérieur à 3 caractères et être inférieur à 100 caractères." />
				</div>
				<div class="large-6 columns">
					<label for="pwd2">Mot de passe</label>
					<input id="pwd2" type="password" name="password" placeholder="Mot de passe" title="Votre mot de passe doit être supérieur à 3 caractères et être inférieur à 100 caractères." />
				</div>
				<div class="large-4 columns"></div>
			</div>
			<div class="row large-8">
				<div class="large-12">
					<span class="button" id="fI" style="cursor: pointer;">Impériaux</span>
					<span class="button" id="fV" style="cursor: pointer;">Vagabonds</span>
					<span class="button" id="fR" style="cursor: pointer;">Républicains</span>
				</div>
				<div class="large-12">
					<br />
					<input type="hidden" id="faction" name="faction" value="vagabonds" />
					<input class="small button" type="submit" name="subscribe" value="Valider mon inscription" />
				</div>
			</div>
		</form>
		<a class="close-reveal-modal">&#215;</a>
	</div>

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
			$('#fI').click(function() {
				$('#faction').val('imp');
			});
			$('#fV').click(function() {
				$('#faction').val('vag');
			});
			$('#fR').click(function() {
				$('#faction').val('rep');
			});
		})
								
		/*window.onload = function(){
			setInterval("displayServerTime()", 1000);
		}
		var ctime = '<?php echo date( "F d, Y H:i:s", time() ); ?>';
		var sdate = new Date(ctime);*/
	</script>
</body>
</html>
