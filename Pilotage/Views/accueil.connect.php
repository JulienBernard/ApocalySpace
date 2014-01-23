		<div class="row">
			<!--
				Bloc principal du corps du site.
				Main body of website.
			-->
			<section class="large-12 columns">
				<img src="./img/player_planet.png" style="border: 0;" />
			</section>
			
			<article class="large-12 columns">
				<p class="right small"><a href="">Liste d'amis <img src="./img/playersG.png" style="height: 20px; margin-top: -4px;" /></a></p>
				<h1 id="step1">&nbsp;<?php echo strtoupper($Template->getTitle()); ?></h1>

				<p class="center small">
					Véritable centre de contrôle de votre empire,<br />c'est grâçe aux informations affichées ici que vous prendrez vos décisions les plus importantes ! 
				</p>
				
				<div class="large-12">
					<section class="large-4 columns">
						<p class="center lead" style="color: #1abc9c">Républicains</p>
						<canvas id="canvasRep" height="125"></canvas>
					</section>
					<section class="large-4 columns">
						<p class="center lead" style="color: #f1c40f">Vagabonds</p>
						<canvas id="canvasVag" height="125"></canvas>
					</section>
					<section class="large-4 columns">
						<p class="center lead" style="color: #e74c3c">Impériaux</p>
						<canvas id="canvasImp" height="125"></canvas>
					</section>
					<p class="center">
						Choix de développement<br /><span class="smaller">(<span style="color: #69D2E7">Démographique</span>, <span style="color: #E0E4CC">Technologique</span>, <span style="color: #F38630">Offensif</span>)</span>
					</p>
				</div>
				
				<br /><br />
				
				<section class="large-7 columns center">
					<canvas id="canvasBar" width="450"></canvas>
					<p>
						Taux de victoire<br /><span class="smaller">(<span style="color: #1abc9c">Républicains</span>, <span style="color: #f1c40f">Vagabonds</span>, <span style="color: #e74c3c">Impériaux</span>)</span>
					</p>
				</section>
				<section class="large-5 columns center">
					<canvas id="canvas"></canvas>
					<p>
						Taux de tension<br /><span class="smaller">(<span style="color: #1abc9c">Républicains</span>, <span style="color: #f1c40f">Vagabonds</span>, <span style="color: #e74c3c">Impériaux</span>)</span>
					</p>
				</section>
				
				<section class="large-12 columns center">
					<br />
					<p>
						<a href="#" class="alert button small">Stats</a> <a href="#" class="success button">Mettre à jour mes données</a>  <a href="#" class="button small">Aide</a>
					</p>
				</section>
			</article>
			
			<script>
				// Choix dev
                var pieRep = [
					{value: <?php echo 100; ?>, color:"#69D2E7"},
					{value : <?php echo 50; ?>,color:"#E0E4CC"},
					{value : <?php echo 75; ?>,color:"#F38630"}
				];
				var pieVag = [
					{value: <?php echo 20; ?>, color:"#69D2E7"},
					{value : <?php echo 40; ?>,color:"#E0E4CC"},
					{value : <?php echo 60; ?>,color:"#F38630"}
				];
				var pieImp = [
					{value: <?php echo 40; ?>, color:"#69D2E7"},
					{value : <?php echo 35; ?>,color:"#E0E4CC"},
					{value : <?php echo 25; ?>,color:"#F38630"}
				];

				var drawPie;
				drawPie = new Chart(document.getElementById("canvasRep").getContext("2d")).Pie(pieRep);
				drawPie = new Chart(document.getElementById("canvasVag").getContext("2d")).Pie(pieVag);
				drawPie = new Chart(document.getElementById("canvasImp").getContext("2d")).Pie(pieImp);

				// Taux tension
				var chartData = [
					{value: <?php echo 25; ?>, color:"#1abc9c"},
					{value : <?php echo 30; ?>,color:"#f1c40f"},
					{value : <?php echo 45; ?>,color:"#e74c3c"}
				];
				var drayDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(chartData);

				// Taux victoire
                var barChartData = {
					labels:["Démographique","Technologique","Militaire"],
					datasets:[{
						fillColor : "rgba(26,188,156,0.5)",
						strokeColor : "rgba(26,188,156,1)",
						data : [50,30,10]
					},{
						fillColor : "rgba(241,196,15,0.5)",
						strokeColor : "rgba(241,196,15,1)",
						data : [30,40,40]
					},{
						fillColor : "rgba(231,76,60,0.5)",
						strokeColor : "rgba(231,76,60,1)",
						data : [20,30,50]
					}]
                }
				var drawBar = new Chart(document.getElementById("canvasBar").getContext("2d")).Bar(barChartData);
			</script>