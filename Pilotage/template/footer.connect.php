		</div>
	</section>
</main>

<footer>
	<section>
		<div class="row">
			<nav class="large-6 columns center">
				<p>
					<a href="deconnexion.connect.php">Déconnexion</a> - <a class="pointer">
					<?php	
						if( isset($timeStart) ){
							$timeend = microtime(true);
							$mtime = $timeend - $timeStart;
							$execution = number_format($mtime, 3);
							echo 'Généré en '.$execution.'s';
						}
					?></a><br />
					Apocalyspace est un projet libre de jeu en ligne développé par Julien Bernard.
				</p>
			</nav>
			<article class="large-6 columns center">
					<p>
						© Apocalyspace 2012 - 2014<br />
						<a href="support.php">Contact</a> - <a target="blank" href="https://github.com/JulienBernard/ApocalySpace/blob/master/README.md">Privacy</a> - <a href="./docs/">Version 1.7.1</a>					</p>
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
