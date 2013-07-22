		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<article class="large-9 columns">
				<h1>GESTION PLANETAIRE</h1>
				<div data-alert class="info-box">
					<p class="smaller-2">
						<span class="important-alert">Une flotte en provenance de Prometheus entrera dans votre système planétaire dans 3h et 47min</span><br />
						<span class="important-return">Votre flotte en provenance de Prometheus sera de retour sur votre planète dans 3h et 32min</span><br />
						<span class="important-send">La flotte en partance pour LegendStar entrera dans son système planétaire dans 56min</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<div data-alert class="success-box">
					<p class="smaller">
						La gestion de votre population est votre outil principal pour commander d'une main de fer votre empire.<br />
						Vous pouvez attribuer à vos bâtiments autant d'habitants que vous le souhaitez dans les limites de leurs superficies.<br />
						<span class="bold">Il y a actuellement 452 habitants sur votre planète et vous pouvez en administrer 460</span><br />
						<a href="" class="right close">&times;</a>
					</p>
				</div>
				
				<ul>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>300 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="13 / 30">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Mine de Titane</span><br />
							Matière première de votre planète, le titane doit être maintenu à un taux de rendement assez elevé.
						</span>
					</li>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>200 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="10 / 20">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Mine de Béryl</span><br />
							Le béryl est un matériau proche du cristal utilisé fréquemment dans les technologies de pointes.
						</span>
					</li>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>100 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="7 / 10">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Extracteur d'Hydrogène</span><br />
							Carburant écologique mais difficile à extraire, l'hydrogène doit être condensé avant son utilisation.
						</span>
					</li>
				</ul>
				<ul>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>200 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="12 / 20">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Usine d'Assemblage</span><br />
							Plus vous aurez d'ouvriers travaillant à l'usine, plus la vitesse de construction de vos vaisseaux sera élevée.
						</span>
					</li>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>100 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="10 / 10">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Atelier de Production</span><br />
							Vos pièces et modules sortiraient plus vite de l'atelier si davantage d'ouvriers y était affilié.
						</span>
					</li>
					<li>
						<span class="float-left"><img src="./img/bat/aucun.png" alt="[IMAGE]" /></span>100 m²
						<form action="index.connect.php" method="POST">
							<div class="small-6 columns">
								<input type="text" class="center" placeholder="2 / 10">
								<input type="submit" value="Changer" class="button prefix"/>
							</div>
						</form>
						<span class="smaller">
							<span class="bold">Centre de Recherche</span><br />
							Vous produirez plus de Point Recherche (PR) si le nombre de chercheurs est elevé.
						</span>
					</li>
				</ul>
			</article>