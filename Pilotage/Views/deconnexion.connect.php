		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div data-alert class="error-box">
					La <span class="bold">déconnexion</span> est un moyen sûr de ne pas vous faire <span class="bold">pirater</span> votre compte.<br />
					Penser à bien vous déconnecter dès votre <span class="bold">session de jeu terminée</span> !
					<a href="" class="right close">&times;</a>
				</div>
				<div data-alert class="success-box">
					Vous n'êtes désormais plus connecté à votre compte.
					<a href="" class="right close">&times;</a>
				</div>
				<p>
					Si la redirection automatique ne fonctionne pas, merci de <a href="index.php">suivre ce lien</a>.
				</p>
			</article>