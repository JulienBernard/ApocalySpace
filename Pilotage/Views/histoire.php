		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1><?php echo strtoupper($title); ?></h1>
				<div data-alert class="info-box">
					<span class="important"><span class="bold">ApocalySpace</span> est un <span class="bold">jeu de stratégie et de gestion</span> en ligne gratuit.</span><br />
					<span class="bold">Space Opéra</span> d'un nouveau genre, <span class="bold">ApocalySpace</span> se démarque par<br />
					sa <span class="bold">communauté</span>, son <span class="bold">originalité</span> et sa <span class="bold">simplicité</span> !
					<a href="" class="right close">&times;</a>
				</div>
				
				<h1>Préambule</h1>
				<p>
					Forcé de fuir votre planète natale, vous incarnez le nouveau dirigeant d'un groupe de survivant qui vient d'établir une nouvelle colonie sur une planète de ce nouveau système planètaire. Ces années d'érrances vous ayant fait perdre la quasi-totalité de votre savoir, votre peuple a besoin de vous maintenant pour repeupler cette planète et faire revivre votre civilisation !
				</p>
				<h1>Fonctionnalités</h1>
				<p>
					ApocalySpace est un jeu en ligne jouable par navigateur internet combinant les dernières technologies du web. ApocalySpace est un jeu multijoueur dans un monde persistant permettant à différents joueurs de jouer ensemble sur un même serveur !
				</p>
			</article>
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
						<input type="text" placeholder="Pseudonyme">
						<input type="password" placeholder="Mot de passe">
						<input type="submit" value="Se connecter" class="button prefix"/>
					</div>
					</form>
				</div>
				<h1>INSCRIPTION <small><a href="">Que choisir ?</a></small></h1>
				<div class="row">
					<form action="index.php" method="POST" class="custom">
					<div class="small-1 columns"></div>
					<div class="small-11 columns">
						<input type="text" placeholder="Pseudonyme">
						<input type="password" placeholder="Mot de passe">
						<select id="customDropdown1" class="medium">
							<option DISABLED>Choix de faction (choix définitif)</option>
							<option>Impériaux</option>
							<option SELECTED>Vagabonds</option>
							<option>Républicains</option>
						</select>
						<input type="submit" value="S'inscrire" class="button prefix"/>
					</div>
					</form>
				</div>
			</nav>
		</div>