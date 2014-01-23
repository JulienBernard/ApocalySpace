		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>

				<div data-alert class="info-box">
					<p class="smaller-2">
						<span class="important-alert">Une flotte en provenance de Prometheus entrera dans votre système planétaire dans 3h et 47min</span><br />
						<span class="important-return">Votre flotte en provenance de Prometheus sera de retour sur votre planète dans 3h et 32min</span><br />
						<span class="important-send">La flotte en partance pour LegendStar entrera dans son système planétaire dans 56min</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>

				<p class="lead">
					Page en cours de création.
				</p>
				<p>
					La page Gestion Planétaire et le centre de commande de votre empire.<br />
					Seul ou à plusieurs, c'est grâçe aux informations que vous verrez ici que vous allez prendre vos décisions les plus importantes !
				</p>
				<p class="small">
					Retrouvez prochainement :<br />
					- Statistique du serveur<br />
					- % de victoire des trois factions (démographie, technologie, militaire)<br />
					- Le choix de votre orientation en tant que joueur (Offensive, Productif, Défensif etc.)<br />
					- Votre réputation dans la faction<br />
					- Sondage de guerre<br />
					- Amis connecté<br />
					- Et plein d'autre chose encore !<br />
				</p>
			</article>
			
		<!-- Foundation4 Joyride : Aide & Tuto de la page -->
		<ol class="joyride-list" data-joyride>
			<li data-id="step1" data-text="Continuer">
				<h4>Oups !</h4><br />
				<p>Il semble que cette page ne dispose pas encore d'aide !</p>
			</li>
			<li data-button="Merci !">
				<h4>A vous de jouer !</h4><br />
				<p>Vous savez tout sur cette page.</p>
				<p>Encore besoin d'aide :<br />- <a data-reveal-id="FAQ">Lire la F.A.Q.</a><br />- <a href="communication.connect.php">Contactez Jibi !</a></p>
			</li>
		</ol>
		<?php include_once(PATH_VIEWS."faq.php"); ?>