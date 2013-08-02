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
	<meta charset="utf-8" />
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
		
		var_dump($Data);

	?>
	
	<script type="text/javascript">
	window.onload = function(){
		setInterval("displayServerTime()", 1000);
	}
	var ctime = '<?php echo date( "F d, Y H:i:s", time() ); ?>';
	var sdate = new Date(ctime);
</script>
</head>
<body>

<!--
	Section principale qui sépare le header du site du corps du site.
	Main section to separate the header part with the body part of the website.
-->
<section id="main" style="padding-top: 0;">

	<header>
		<div id="header_infobar"><?php echo $Template->getTitle(); ?></div>
		<a href="index.connect.php"><div id="header_infobar_logo"></div></a>
		
		<nav id="nav-board">
			<a href="#"><img id="img-account" /></a>
			<a href="#" class="img-message-new"><img id="img-message" /></a>
			<a href="deconnexion.connect.php"><img id="img-exit" /></a>
		</nav>
		
		<div class="row" id="second-nav-board" class="center">
			<div class="large-4 columns center">
				<a href="#"><img id="img-friend" /></a>
				<a href="#"><img id="img-map" /></a>
				<a href="#"><img id="img-top" /></a>
			</div>
			<div class="large-4 columns center">
				<a href="recherche.connect.php"><img id="img-techno" /></a>
				<a href="index.connect.php"><img id="img-general" /></a>
				<a href="structure.connect.php"><img id="img-build" /></a>
			</div>
			<div class="large-4 columns center">
				<a href="#"><img id="img-shed" /></a>
				<a href="#"><img id="img-fleet" /></a>
				<a href="#"><img id="img-factory" /></a>
			</div>
		</div>
		
		<div id="header_infobar_border"></div>
		<div id="header_image">
			<div id="header_image_left"></div>
			<div id="header_image_right"></div>
		</div>
		
		<!--
			Affiche flèche + message si le curseur est au dessus du header.
			Display arrow + message if cursor is hovering the header.
		-->
		<div class="row">
			<div class="large-12 columns">
				<p class="center" style="width: 100%;">POUR REVENIR, POINTER LE CURSOR VERS LE BAS<br /><img src="img/arrow.png" /></p>
			</div>
		</div>
	</header>
	
	<section>
		<div class="row">
			<nav class="large-12 breadcrumbs" id="links">
				<a href="index.connect.php" <?php if( $Engine->getNamepage() == "accueil" ) echo 'class="current"'; ?>>Accueil</a>
				<a href="compte.connect.php" <?php if( $Engine->getNamepage() == "compte" ) echo 'class="current"'; ?>>Compte</a>
				<a href="communication.connect.php" <?php if( $Engine->getNamepage() == "communication" ) echo 'class="current"'; ?>>Communication</a>
				<a href="deconnexion.connect.php" <?php if( $Engine->getNamepage() == "deconnexion" ) echo 'class="current"'; ?>>Déconnexion</a>
				<span id="serverTime" style="display: block; float: right;"><?php echo date( "H:i:s", time() ); ?></span>
			</nav>
		</div>
		<br />
	