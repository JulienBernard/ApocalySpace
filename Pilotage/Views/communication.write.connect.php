		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div data-alert class="info-box" id="step2">
					<p class="small">
						<span class="bold">Le saviez-vous ?</span><br />Un peu de politesse n'a jamais fait de mal !<br />Cela augmentera même votre réputation de "joueur fairplay" auprès de la communauté.
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<form action="communication.connect.php?write&send" method="POST">
				<table style="margin: auto; width: 90%;">
					<tbody>
						<tr>
							<td colspan="2"><textarea required="required" name="messageContent" style="min-height: 200px;" placeholder="Que souhaitez-vous communiquer à ce joueur ?"><?php echo $messageContent; ?></textarea></td>
						</tr>
						<tr>
							<th class="smaller center" style="width: 55%;"><input type="text" required="required" name="messageSubject" placeholder="Quel est le sujet ?" value="<?php echo $messageSubject; ?>" /></th>
							<th class="smaller center"><input type="text" required="required" name="messageReceiver" placeholder="Destinataire (plusieurs : séparés par une virgule)" value="<?php echo $messageReceiver; ?>" /></th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2"><input type="submit" name="send" value="Envoyer la communication" class="button alert" style="width: 100%;" /></th>
						</tr>
					</tfoot>
				</table>
				</form>
				
				<p>
					<br />
					<a href="communication.connect.php">Retour aux communications</a> - <a href="#" data-dropdown="dropInfo2" id="step4">Répondre à ce joueur</a>
				</p>
				
				<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Profil Joueur</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
				</ul>
				<ul id="dropInfo2" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Répondre Communication</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité haute</span></p>
				</ul>
			</article>
			
		<!-- Foundation4 Joyride : Aide & Tuto de la page -->
		<ol class="joyride-list" data-joyride>
			<li data-id="step1" data-text="Continuer">
				<h4>Où suis-je ?</h4><br />
				<div class="center">Communications</div>
				<p>Vous êtes en train de lire un message que vous a envoyé un joueur.</p>
			</li>
			<li data-id="step2" data-text="Continuer">
				<h4>Infos #1</h4>
				<p>Le <span class="bad">nom de l'expéditeur</span> et la <span class="bad">date de réception</span> du message sont rappelés dans ce cadre d'information.</p>
				<p class="good">En cliquant sur le nom de l'expéditeur vous accéderez à son profil de joueur.</p>
			</li>
			<li data-id="step3" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
				<h4>Info #2</h4>
				<p>Ce cadre représente le <span class="bad">contenu du message</span> que vous a envoyé le joueur.</p>
			</li>
			<li data-id="step4" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
				<h4>Info #3</h4>
				<p>Vous pouvez à tout moment <span class="good">répondre à ce joueur</span> en suivant le lien ci-dessous.</p>
			</li>
			<li data-button="Merci !">
				<h4>A vous de jouer !</h4><br />
				<p>Vous savez tout sur cette page.</p>
				<p>Encore besoin d'aide :<br />- <a data-reveal-id="FAQ">Lire la F.A.Q.</a><br />- <a href="communication.connect.php">Contactez Jibi !</a></p>
			</li>
		</ol>
		<?php include_once(PATH_VIEWS."faq.php"); ?>