		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				
				<div data-alert class="info-box">
					<p class="smaller">
						<span class="bold">Rappel des règles</span><br />
						Le gestion de plusieurs comptes sur un même serveur (multicompte) est interdit sur ApocalySpace.
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<form style="width: 90%; margin: auto;" action="compte.connect.php" method="POST">
					<table style="width: 100%;" id="step2">
						<fieldset>
							<legend class="smaller">Gestion du compte</legend>
							
							<div class="row">
								<div class="large-6 columns">
									<p>
										Animation du menu du haut (header)<br />
										<span class="small italic">Menu fixe ou scrollable ?</span>
									</p>
								</div>
								<div class="large-6 columns">
									<div class="switch">
										<input id="x" value="flottant" name="headerActived" type="radio" <?php if( isset($_SESSION['ApocalySpaceHeaderAnimation']) && $_SESSION['ApocalySpaceHeaderAnimation'] == "flottant") echo 'checked'; ?>>
										<label for="x" onclick="">Menu flottant</label>

										<input id="x1" value="fixe" name="headerActived" type="radio" <?php if( isset($_SESSION['ApocalySpaceHeaderAnimation']) && $_SESSION['ApocalySpaceHeaderAnimation'] == "fixe") echo 'checked'; ?>>
										<label for="x1" onclick="">Menu fixe</label>
									<span></span>
									</div>
								</div>
							</div>
							<div class="row" style="margin: auto;">
								<div class="large-12">
									<input name="updateSetting" class="button small" style="width: 100%; margin: 0;" type="submit" value="Modifier" />
								</div>	
							</div>
						</fieldset>
					</table>
					
					<table style="width: 100%;" id="step3">
						<fieldset>
							<legend class="smaller">Modifier votre présentation publique</legend>
							<p>
								Votre profil peut être consulté par n'importe quel joueur.<br />
								<span class="small">- Votre présentation doit respecter les règles de bienséance<br />- Pour votre sécurité, ne divulguer aucune information privée</span>
								<br /><br />
							</p>
							
							<div class="row">
								<div class="large-12 columns">
									<p class="center bold">Vagabonds</p>
								</div>
							</div>
							<div class="row">
								<div class="large-4 columns">
									<p class="center"><span class="bold good">Démographie</span><br /><span class="small">5914 points</span></p>
								</div>
								<div class="large-4 columns">
									<p class="center"><span class="bold bad">Technologie</span><br /><span class="small">2550 points</span></p>
								</div>
								<div class="large-4 columns">
									<p class="center"><span class="bold bad">Militaire</span><br /><span class="small">0 points</span></p>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<label for="profilText">Présentation publique <span class="smaller">(facultative)</span></label>
									<textarea id="profilText" style="height: 70px;" placeholder="Ce joueur n'a pas de présentation publique" /></textarea>
								</div>
							</div>
							<div class="row" style="margin: auto;">
								<div class="large-12">
									<input data-dropdown="dropInfo1" class="button small" style="width: 100%; margin: 0;" type="submit" value="Modifier" />
									<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
										<p><span class="bold">Gestion Profil</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
									</ul>
								</div>	
							</div>
						</fieldset>
					</table>
					
					<table style="width: 100%;" id="step2">
						<fieldset>
							<legend class="smaller">Modifier votre mot de passe</legend>
							<p>
								Vous pouvez changer de mot de passe à tout moment mais celui-ci doit avoir une taille supérieure à six caractères.<br />
								<span class="small">- Il est fortement conseillé de renseigner au minimum une lettre en majuscule et un chiffre.</span>
							</p>
							
							<div class="row">
								<div class="large-6 columns">
									<label for="lastPassword">Ancien mot de passe</label>
									<input id="lastPassword" type="password" />
								</div>
								<div class="large-6 columns">
									<label for="newPassword">Nouveau mot de passe</label>
									<input id="newPassword" type="password" />
								</div>
							</div>
							<div class="row" style="margin: auto;">
								<div class="large-12">
									<input data-dropdown="dropInfo3" class="button alert small" style="width: 100%; margin: 0;" type="submit" value="Modifier" />
									<ul id="dropInfo3" class="f-dropdown content" data-dropdown-content>
										<p><span class="bold">Gestion Profil</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
									</ul>
								</div>	
							</div>
						</fieldset>
					</table>
				</form>
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
		
		<div id="validationModal" class="reveal-modal">
			<h2>Modification enregistrée</h2>
			<p class="lead"><?php echo ucfirst($Template->getTitle()); ?> :</p>
			<p><?php echo $Engine->getSuccess(); ?></p>
			<a href="#" class="alert radius button close-reveal-modal">X</a>
		</div>
		
		<?php include_once(PATH_VIEWS."faq.php"); ?>