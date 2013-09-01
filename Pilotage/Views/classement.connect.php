		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1 id="step1"><?php echo strtoupper($Template->getTitle()); ?></h1>
				
				<table style="margin: auto; width: 90%;">
					<thead>
						<tr>
							<td colspan="3" class="center"><?php if( isset($_GET['technology']) ) echo "Classement Technologique"; else if( isset($_GET['military']) ) echo "Classement Militaire"; else echo "Classement Démographique"; ?></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$usersList = $Top->getUsersList();
						for( $i = 0 ; $i < count($usersList) ; $i++ )
						{
						?>
							<tr>
								<td class="center <?php if( $i == 0 ) echo "bold"; ?>" <?php if( $Data->getFaction() == $usersList[$i]['factionName'] ) echo 'style="width: 40%; background: #CFFFB0;"'; else echo "width: 40%;" ?>><a href="#" data-dropdown="dropInfo1"><?php echo (string)ucwords($usersList[$i]['username']); ?></a></td>
								<td class="center <?php if( $i == 0 ) echo "bold"; ?>" <?php if( $Data->getFaction() == $usersList[$i]['factionName'] ) echo 'style="width: 40%; background: #CFFFB0;"'; else echo "width: 40%;" ?>><?php echo (int)$usersList[$i]['pl_population']; ?></td>
								<td class="smaller center <?php if( $i == 0 ) echo "bold"; ?>" <?php if( $Data->getFaction() == $usersList[$i]['factionName'] ) echo 'style="background: #CFFFB0;"'; ?>><?php echo (string)ucwords($usersList[$i]['factionName']); ?></td>
							</tr>
						<?php
						}
						
						if( count($usersList) == 0 )
						{
							echo "<tr><td colspan='3'>Classement à venir.<br />Pagination à venir</td></tr>";
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="center">Nom</th>
							<th class="center">Population</th>
							<th class="smaller center">Faction</th>
						</tr>
					</tfoot>
				</table>
				
				<dl class="sub-nav" style="width: 90%; margin: auto;">
					<dt>Conditions de victoire : </dt>
					<dd <?php if( !isset($_GET['technology']) && !isset($_GET['military']) ) echo 'class="active"'; ?>><a href="top.connect.php?demography">Démographique</a></dd>
					<dd <?php if( isset($_GET['technology']) ) echo 'class="active"'; ?>><a href="top.connect.php?technology">Technologique</a></dd>
					<dd <?php if( isset($_GET['military']) ) echo 'class="active"'; ?>><a href="top.connect.php?military">Militaire</a></dd>
				</dl>
				
				<ul id="dropInfo1" class="f-dropdown content" data-dropdown-content>
					<p><span class="bold">Profil Joueur</span><br /><br />Fonctionnalité à venir<br /><span class="italic">Priorité faible</span></p>
				</ul>
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