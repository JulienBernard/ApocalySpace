		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<br />
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				
				<div data-alert class="success-box">
					<p class="small">
						Les communications subspatiales utilisent des fréquences plus basses que la lumière,<br />
						ce qui permet des transmissions de données plus rapides.<br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<table style="width: 100%;">
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
							<th class="smaller center">Expéditeur</th>
							<th class="smaller center">Date</th>
						</tr>
					</tfoot>
				</table>
				
				<p>
					<a href="#" data-dropdown="dropInfo2">Envoyer une communication à un joueur</a>
				</p>
				
				<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Profil Joueur</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
				</ul>
				<ul id="dropInfo2" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Envoyer Communication</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité haute</span></p>
				</ul>
			</article>