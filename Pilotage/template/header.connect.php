<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="fr" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr" > <!--<![endif]-->

<!--

	Bonjour,
	ApocalySpace est un projet distribué sous licence GPL. Retrouver son code source en libre utilisation sur GitHub : https://github.com/JulienBernard/ApocalySpace
	
	Hi,
	ApocalySpace is a project distributed under GPL licence. Find his source code at free use on GitHub: https://github.com/JulienBernard/ApocalySpace
	
		 _    _ _   _ _____  ______ _____  	   _____ _____  _         _      _____ _____ ______ _   _  _____ ______ 
		| |  | | \ | |  __ \|  ____|  __ \ 	  / ____|  __ \| |       | |    |_   _/ ____|  ____| \ | |/ ____|  ____|
		| |  | |  \| | |  | | |__  | |__) |	 | |  __| |__) | |       | |      | || |    | |__  |  \| | |    | |__   
		| |  | | . ` | |  | |  __| |  _  / 	 | | |_ |  ___/| |       | |      | || |    |  __| | . ` | |    |  __|  
		| |__| | |\  | |__| | |____| | \ \ 	 | |__| | |    | |____   | |____ _| || |____| |____| |\  | |____| |____ 
		 \____/|_| \_|_____/|______|_|  \_\	  \_____|_|    |______|  |______|_____\_____|______|_| \_|\_____|______|

		ApocalySpace Copyright (C) 2012-2013 Julien Bernard

		ApocalySpace is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		ApocalySpace is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		ApocalySpace is based on "ApocalySpace BETA version" by Etienne Rocipon, Benjamin Crosnier and Julien Bernard (2012).
		
		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <http://www.gnu.org/licenses/>.
				
		Contact:
			jbernard at intechinfo dot fr
-->

<head>
	<title><?php echo DEFAULT_TITLE.$Template->getTitle(); ?></title>
	<meta name="viewport" content="width=device-width" />
	<meta charset="UTF-8" />
	<meta name="Author" lang="fr" content="Julien BERNARD">
	
	<base href="<?php echo BASE_SITE; ?>" />
	
	<?php
		global $timeStart;
		$timeStart = microtime(true);
	
		/* Chargement de la description */
		$rt = $Template->getDescription();
		if( !empty( $rt ) )
		{
			echo '<meta name="description" content="'.$Template->getDescription().'" />
			';
		}
		else
		{
			echo '<meta name="description" content="'.DEFAULT_DESCRIPTION.'" />
			';
		}
		
		/* Chargement des CSS */
		foreach( $Template->getCss() as $css )
		{
			echo '<link rel="stylesheet" media="screen" href="css/'.$css.'" />
			';
		}
	
		/* Chargement des scripts */
		foreach( $Template->getScript() as $script )
		{
			echo '<script type="text/javascript" src="./js/'.$script.'"></script>
			';
		}
		
		include("./config_id.php");
		// Calcul des % de stockage
		$titanePourcent = 100-(pow(2, Building::getBuildingLevel($titaneStorageId, $Data->getPlanetId()))*$titaneStorageSizePerLevel - $Data->getRes1())/(pow(2, Building::getBuildingLevel($titaneStorageId, $Data->getPlanetId()))*$titaneStorageSizePerLevel)*100;
		$berylPourcent = 100-(pow(2, Building::getBuildingLevel($berylStorageId, $Data->getPlanetId()))*$berylStorageSizePerLevel - $Data->getRes2())/(pow(2, Building::getBuildingLevel($berylStorageId, $Data->getPlanetId()))*$berylStorageSizePerLevel)*100;
		$hydroPourcent = 100-(pow(2, Building::getBuildingLevel($hydrogeneStorageId, $Data->getPlanetId()))*$hydrogeneStorageSizePerLevel - $Data->getRes3())/(pow(2, Building::getBuildingLevel($hydrogeneStorageId, $Data->getPlanetId()))*$hydrogeneStorageSizePerLevel)*100;		
	?>
</head>
<body>

<!--
	Section principale qui sépare le header du site du corps du site.
	Main section to separate the header part with the body part of the website.
-->
<main id="main" style="padding-top: 0;">
	<section id="main-section">
		<!-- Ressources informations -->
		<div class="ressource-nav center">
			<div class="large-1 columns">&nbsp;</div>
			<div class="large-3 columns" data-dropdown="dropTitane"><div class="smaller" style="width: 100%; position: absolute; z-index: 1; margin-top: 5px; margin-left: 10px; text-align: center; color: #EDEDED;">Titane (<?php echo $Data->getRes1(); ?>)</div><div class="progress large-12 alert round" style="padding: 1px; border: 1px solid #E8653C;"><span class="meter smaller" style="width: <?php echo $titanePourcent; ?>%;"></span></div></div>
			<div class="large-3 columns" data-dropdown="dropBeryl"><div class="smaller" style="width: 100%; position: absolute; z-index: 1; margin-top: 5px; margin-left: 10px; text-align: center; color: #EDEDED;">Béryl (<?php echo $Data->getRes2(); ?>)</div><div class="progress large-12 success round" style="padding: 1px; border: 1px solid #69B52C;"><span class="meter smaller" style="width: <?php echo $berylPourcent; ?>%;"></span></div></div>
			<div class="large-3 columns" data-dropdown="dropHydro"><div class="smaller" style="width: 100%; position: absolute; z-index: 1; margin-top: 5px; margin-left: 10px; text-align: center; color: #EDEDED;">Hydrogène (<?php echo $Data->getRes3(); ?>)</div><div class="progress large-12 info round" style="padding: 1px; border: 1px solid #61C2ED;"><span class="meter smaller" style="width: <?php echo $hydroPourcent; ?>%;"></span></div></div>
			<div class="large-1 columns">&nbsp;</div>
		</div>
		
		<ul id="dropTitane" class="f-dropdown" data-dropdown-content>
			<p class="smaller"><strong>Titane :</strong> <?php echo $Data->getRes1(); ?> / <?php echo pow(2, Building::getBuildingLevel($titaneStorageId, $Data->getPlanetId()))*$titaneStorageSizePerLevel; ?></p>
		</ul>
		<ul id="dropBeryl" class="f-dropdown" data-dropdown-content>
			<p class="smaller"><strong>Béryl :</strong> <?php echo $Data->getRes2(); ?> / <?php echo pow(2, Building::getBuildingLevel($berylStorageId, $Data->getPlanetId()))*$berylStorageSizePerLevel; ?></p>
		</ul>
		<ul id="dropHydro" class="f-dropdown" data-dropdown-content>
			<p class="smaller"><strong>Hydrogène :</strong> <?php echo $Data->getRes3(); ?> / <?php echo pow(2, Building::getBuildingLevel($hydrogeneStorageId, $Data->getPlanetId()))*$hydrogeneStorageSizePerLevel; ?></p>
		</ul>
	
		<!-- Desktop navigation -->
		<nav id="navigation" class="hide-for-large-down">
			<ul class="first">
				<li><img src="./img/arrow.png" alt="->" /></li>
				<li class="border-bottom"></li>
				<li class="border-top-bottom"><img src="./img/gallery.png" alt="[H]" /></li>
				<li class="border-top-bottom"><img src="./img/home.png" alt="[A]" /></li>
				<li class="border-top-bottom"><img src="./img/about.png" alt="[G]" /></li>
				<li class="border-top-bottom"><img src="./img/about.png" alt="[C]" /></li>
				<li class="border-top"></li>
				<div class="f-bottom">
					<li class="border-bottom"></li>
					<li class="border-top-bottom"><img src="./img/privacy.png" alt="[C]" /></li>
					<li class="border-top center copyright">Version<br />1.7</li>
				</div>
			</ul>
			<ul>
				<span>
					<li><img src="./img/arrow.png" alt="->" /><a href="#" style="padding: 0;">&nbsp;<img src="./img/logo.png" style="width: 150px;" alt="->" /></a></li>
					<li class="border-bottom"></li>
					<li class="border-top-bottom"><a href="index.connect.php"><img src="./img/gallery.png" alt="[H]" />&nbsp;&nbsp;&nbsp;Vue stratégique</a></li>
					<li class="border-top-bottom"><a href="structure.connect.php"><img src="./img/home.png" alt="[G]" />&nbsp;&nbsp;&nbsp;Capitale</a></li>
					<li class="border-top-bottom"><a href="recherche.connect.php"><img src="./img/about.png" alt="[A]" />&nbsp;&nbsp;&nbsp;Technologies</a></li>
					<li class="border-top-bottom"><a href="top.connect.php"><img src="./img/about.png" alt="[C]" />&nbsp;&nbsp;&nbsp;Classement</a></li>
					<li class="border-top"></li>
					<div class="f-bottom">
						<li class="border-bottom center" id="serverTime" style="text-align: center; margin-top: 0px;"><?php echo date( "H:i:s", time()+3600 ); ?></lo>
						<li class="border-bottom center">&nbsp;&nbsp;&nbsp;
							<a href="compte.connect.php"><img id="img-account" /></a>
							<a href="communication.connect.php" <?php if( $Data->getNbMessageNoRead() != 0 ) echo 'class="img-message-new"'; else echo 'class="img-message"'; ?>><img id="img-message" /></a>
							<a href="deconnexion.connect.php"><img id="img-exit" /></a>
						</li>
						<li class="border-top center copyright">© ApocalySpace</a> 2012-2014<br /><a href="./docs/">Version 1.7</a> - <a href="https://github.com/JulienBernard/ApocalySpace/blob/1.7/CHANGELOG.md" target="blank">Changelog</a></li>
					</div>
				</span>
			</ul>
		</nav>
		<!-- End Desktop navigation -->
		<!-- Mobile or Desktop < 1440 navigation -->
		<div class="small-nav show-for-large-down hide-for-small">
			<nav class="large-8 columns">
				<a href="index.connect.php"><img src="./img/gallery.png" width="40" alt="[V]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "accueil" ) echo 'Vue stratégique'; ?></a>
				<a href="structure.connect.php"><img src="./img/home.png" width="30" alt="[C]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "structure" ) echo 'Capitale'; ?></a>
				<a href="recherche.connect.php"><img src="./img/about.png" width="30" alt="[T]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "recherche" ) echo 'Technologies'; ?></a>
				<a href="top.connect.php"><img src="./img/about.png" width="30" alt="[C]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "classement" ) echo 'Classement'; ?></a>
			</nav>
			<nav class="large-4 columns">
				<a href="compte.connect.php"><img id="img-account" style="margin-top: 10px" /></a>
				<a href="communication.connect.php" <?php if( $Data->getNbMessageNoRead() != 0 ) echo 'class="img-message-new"'; else echo 'class="img-message"'; ?>><img id="img-message" style="margin-top: 5px" /></a>
				<a href="deconnexion.connect.php"><img id="img-exit" style="margin-top: 10px" /></a>
			</nav>
			<br />
		</div>
		<!-- End Mobile or Desktop < 1440 navigation -->
		<!-- Mobile or Desktop < 1280 navigation -->
		<div class="small-nav show-for-small">
			<nav class="large-12">
				<a href="index.connect.php">Vue stratégique</a>
				<a href="structure.connect.php">Capitale</a>
				<a href="recherche.connect.php">Technologies</a>
				<a href="top.connect.php">Classement</a>
			</nav>
			<nav class="large-12">
				<a href="compte.connect.php"><img id="img-account" style="margin-top: 20px" /></a>
				<a href="communication.connect.php" <?php if( $Data->getNbMessageNoRead() != 0 ) echo 'class="img-message-new"'; else echo 'class="img-message"'; ?>><img id="img-message" style="margin-top: 15px" /></a>
				<a href="deconnexion.connect.php"><img id="img-exit" style="margin-top: 15px" /></a>
			</nav>
			<br />
		</div>
		<!-- End Mobile or Desktop < 1280 navigation -->
		