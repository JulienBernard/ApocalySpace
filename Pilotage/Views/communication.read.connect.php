		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1><?php echo strtoupper($Template->getTitle()); ?></h1>
				<div data-alert class="info-box">
					<p class="small">
						Cette communication a été envoyée par <a href="#" data-dropdown="dropInfo1"><?php echo htmlentities(ucwords($communication['com_username']), NULL, 'utf-8'); ?></a> le <?php echo date('d/m/y à H\hi', $communication['com_sendTime']); ?>.
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<table style="margin: auto; width: 90%;">
					<tbody>
						<tr>
							<td><?php echo nl2br(htmlentities($communication['com_message'])); ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="smaller center"><?php echo htmlentities($communication['com_subject'], NULL, 'utf-8'); ?></th>
						</tr>
					</tfoot>
				</table>
				
				<p>
					<br />
					<a href="communication.connect.php">Retour aux communications</a> - <a href="#" data-dropdown="dropInfo2">Répondre à ce joueur</a>
				</p>
				
				<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Profil Joueur</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
				</ul>
				<ul id="dropInfo2" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Répondre Communication</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité haute</span></p>
				</ul>
			</article>