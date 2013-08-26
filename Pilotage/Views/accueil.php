		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<?php
				if( $Engine->getError()!= null ) { echo '<div data-alert class="error-box">'.$Engine->getError().'<a href="" class="right close">&times;</a></div>'; }
				else if( $Engine->getSuccess() != null ) { echo '<div data-alert class="success-box">'.$Engine->getSuccess().'<a href="" class="right close">&times;</a></div>'; }
				if( $Engine->getInfo() != null ) { echo '<div data-alert class="info-box">'.$Engine->getInfo().'<a href="" class="right close">&times;</a></div>'; }
			?>
			<article class="large-9 columns">
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div id="orbit">
					<div class="orbit-container">
						<ul data-orbit="" class="orbit-slides-container" data-options="timer_speed:5000; bullets:false;">
							<li class="active">
							   <a href="http://jibidev.fr/apocalyspace-ouverture-de-la-beta-fermee/"><img src="./img/orbit/26.08.13.png"></a>
							  <div class="orbit-caption"><a href="http://jibidev.fr/apocalyspace-ouverture-de-la-beta-fermee/">Sortie de la V1.6 : participez dès maintenant à la bêta fermée !</a></div>
							</li>
							<li>
							   <a href="http://jibidev.fr/etat-sur-lavancement-dapocalyspace/"><img src="./img/orbit/01.08.13.png"></a>
							  <div class="orbit-caption"><a href="http://jibidev.fr/etat-sur-lavancement-dapocalyspace/">État sur l'avancement du projet : découvrez les pages principales du jeu !</a></div>
							</li>
							<li>
							   <a href="http://jibidev.fr/category/apocalyspace/"><img src="./img/orbit/hackathon.png"></a>
							  <div class="orbit-caption"><a href="http://jibidev.fr/category/apocalyspace/">Lancement de la phase de développement : suivez les 2 premiers jours sur le dév blog !</a></div>
							</li>
							<li>
							   <a href="https://twitter.com/ApocalySpace"><img src="./img/orbit/welcome.png"></a>
							  <div class="orbit-caption"><a href="https://twitter.com/ApocalySpace">Bienvenue sur ApocalySpace.fr ! Retrouvez toute l'actualité du projet (en cours) sur Twitter !</a></div>
							</li>
							<li>
							  <img src="./img/orbit/developers.png">
							  <div class="orbit-caption">Pour les joueurs comme pour les développeurs : appuyez sur Ctrl + U !</div>
							</li>
						</ul>
					</div>
				</div>
				<div data-alert class="info-box">
					<span class="important"><span class="bold">ApocalySpace</span> est un <span class="bold">jeu de stratégie et de gestion</span> en ligne gratuit.</span><br />
					<span class="bold">Space Opéra</span> d'un nouveau genre, <span class="bold">ApocalySpace</span> se démarque par<br />
					sa <span class="bold">communauté</span>, son <span class="bold">originalité</span> et sa <span class="bold">simplicité</span> !
					<a href="" class="right close">&times;</a>
				</div>
				<p>
					Forcé de fuir votre planète natale, vous incarnez le nouveau dirigeant d'un groupe de survivant qui vient d'établir une nouvelle colonie sur une planète de ce nouveau système planètaire.</p><p>Ces années d'érrances vous ayant fait perdre la quasi-totalité de votre savoir, votre peuple a besoin de vous maintenant pour repeupler cette planète et faire revivre votre civilisation !
				</p>
				<p class="italic">
					Conçu et imaginé par une équipe d'étudiants en école informatique puis repris par l'un d'eux, ApocalySpace est désormais disponible dans sa version stable : la 1.6 qui est régulièrement mise à jour. Projet sous licence libre GPL, vous pouvez nous retrouver sur <a href="https://github.com/JulienBernard/ApocalySpace">GitHub</a>. Enjoy!
				</p>
				<h2><a href="histoire.php">EN SAVOIR PLUS</a> <a href="galerie.php">GALERIE</a> <a href="support.php">CONTACT</a></h2>
			</article>