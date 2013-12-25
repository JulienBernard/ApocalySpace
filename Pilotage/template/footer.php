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
					<a id="returnTop">Retourner en haut</a> - <a href="https://github.com/JulienBernard/ApocalySpace">Dépôt sur GitHub</a><br />
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
