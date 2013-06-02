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
				ApocalySpace © 2012-2013 &nbsp;&nbsp;&nbsp; <a href="changelog">Version 1.0.0</a>
			</p>
		</div>
	</header>
	<section>
		<div class="row">
			<nav class="large-8 columns center">
				<p>
					<br />
					<a href="" class="current">Accueil</a> / 
					<a href="">Histoire</a> /
					<a href="">Galerie</a> /
					<a href="" class="unavailable">Contact et Support</a>
				</p>
			</nav>
			<article class="large-4 columns center">
				<p>
					Projet sous licence GPL réalisé initialement par
					<a href="https://twitter.com/ProJibi">Julien Bernard</a>, Benjamin Crosnier et Etienne Rocipon.<br />
					<br />
					Le projet est désormais repris par Julien.<br />
					<a href="">Contact</a> - <a href="">Histoire du projet</a> - <a href="">Mentions légales</a>
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
	</script>
</body>
</html>
