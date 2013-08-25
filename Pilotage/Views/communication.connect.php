		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				
				<div data-alert class="success-box">
					<p class="small">
						Les communications subspatiales utilisent des fréquences plus basses que la lumière,<br />
						ce qui permet des transmissions de données plus rapides.<br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<table style="width: 100%;" id="step2">
					<tbody>
						<?php
						for( $i = 0 ; $i < count($communications) ; $i++ )
						{
						?>
							<tr>
								<td width="60%"><a href="communication.connect.php?id=<?php echo $communications[$i]['com_id']; ?>" <?php if( !$communications[$i]['com_view'] ) echo 'class="bold"'; ?>><?php echo htmlentities($communications[$i]['com_subject'], NULL, 'utf-8'); ?></a></td>
								<td class="center"><a href="#" data-dropdown="dropInfo1"><?php echo htmlentities(ucwords($communications[$i]['com_username']), NULL, 'utf-8'); ?></a></td>
								<td class="center"><?php echo date('d/m/y - H\hi', $communications[$i]['com_sendTime']); ?></td>
							</tr>
						<?php
						}
						
						if( empty($communications) )
						{ ?>
							<tr>
								<td colspan="3">Aucune communications dans la base de données.</td>
							</tr>
						<?php }
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="smaller center">Titre de la communication</th>
							<th class="smaller center" id="step3">Expéditeur</th>
							<th class="smaller center">Date</th>
						</tr>
					</tfoot>
				</table>
				
				<p>
					<a href="#" data-dropdown="dropInfo2" id="step4">Envoyer une communication à un joueur</a>
				</p>
				
				<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Profil Joueur</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
				</ul>
				<ul id="dropInfo2" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Envoyer Communication</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité haute</span></p>
				</ul>
			</article>
			
		<!-- Foundation4 Joyride : Aide & Tuto de la page -->
		<ol class="joyride-list" data-joyride>
			<li data-id="step1" data-text="Continuer">
				<h4>Où suis-je ?</h4><br />
				<div class="center">Communications</div>
				<p>C'est ici que vous pourrez communiquer avec les autres joueurs.</p>
			</li>
			<li data-id="step2" data-text="Continuer">
				<h4>Infos #1</h4>
				<p>Les communications sont classées dans ce tableau par <span class="bad">titre</span>, <span class="bad">expéditeur</span> et <span class="bad">date de réception</span>.</p>
				<p class="good">Si le titre est en gras, c'est que vous ne l'avez pas encore lu. Il vous suffit de cliquer dessus pour le lire.</p>
			</li>
			<li data-id="step3" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
				<h4>Info #2</h4>
				<p>En cliquant sur le <span class="bad">nom de l'expéditeur</span> vous accéderez à son profil de joueur.</p>
			</li>
			<li data-id="step4" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
				<h4>Info #3</h4>
				<p>Vous pouvez à tout moment <span class="bad">envoyer un message à un joueur</span> en suivant le lien ci-dessous.</p>
			</li>
			<li data-button="Merci !">
				<h4>A vous de jouer !</h4><br />
				<p>Vous savez tout sur cette page.</p>
				<p>Encore besoin d'aide ?<br /><a href="communication.connect.php">Contactez Jibi !</a></p>
			</li>
		</ol>