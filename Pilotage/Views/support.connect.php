		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div data-alert class="info-box">
					<span class="important"><span class="bold">ApocalySpace</span> est un <span class="bold">jeu de stratégie et de gestion</span> en ligne gratuit...</span><br />
					<span class="bold">...développé bénévolement !</span><br />
					<span class="bold">Merci</span> d'etre précis et d'<span class="bold">aller à l'essentiel</span> quand vous <span class="bold">me contacter</span>.
					<a href="" class="right close">&times;</a>
				</div>
				<p>
					Vous pouvez utiliser le formulaire suivant pour soumettre votre requête au support. Merci de prendre un peu de temps et de répondre en proposant une multitude d'informations, de cette manière, vous recevrez une réponse plus rapidement et plus complète. Sans une adresse e-mail valide, votre requête peut ne pas être prise au sérieuse et ne pas être gérée.
				</p>
				<p class="small">
					Les informations recueillis ne sont utilisées que pour nos statistiques.
				</p>
				<div data-alert class="info-box">
					Le support n'est pas encore actif. Revenez dans un petit moment ...
					<a href="" class="right close">&times;</a>
				</div>
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