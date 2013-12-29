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
		// Chargement de la description
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
		
		// Chargement des CSS
		foreach( $Template->getCss() as $css )
		{
			echo '<link rel="stylesheet" media="screen" href="css/'.$css.'" />
			';
		}
	
		// Chargement des scripts
		foreach( $Template->getScript() as $script )
		{
			echo '<script type="text/javascript" src="./js/'.$script.'"></script>
			';
		}
	?>
</head>
<body>

<!--
	Section principale qui sépare le header du site du corps du site.
	Main section to separate the header part with the body part of the website.
-->
<main id="main" style="padding-top: 0;">
	<section>
		<!-- Desktop navigation -->
		<nav id="navigation" class="hide-for-large-down">
			<ul class="first">
				<li><img src="./img/arrow.png" alt="->" /></li>
				<li class="border-bottom"></li>
				<li class="border-top-bottom"><img src="./img/home.png" alt="[H]" /></li>
				<li class="border-top-bottom"><img src="./img/about.png" alt="[A]" /></li>
				<li class="border-top-bottom"><img src="./img/gallery.png" alt="[G]" /></li>
				<li class="border-top-bottom"><img src="./img/contact.png" alt="[C]" /></li>
				<li class="border-top"></li>
				<div class="f-bottom">
					<li class="border-bottom"></li>
					<li class="border-top-bottom"><img src="./img/players.png" alt="[H]" /></li>
					<li class="border-top-bottom"><img src="./img/privacy.png" alt="[C]" /></li>
					<li class="border-top center copyright">Version<br /><a href="#">1.7</a></li>
				</div>
			</ul>
			<ul>
				<span>
					<li><img src="./img/arrow.png" alt="->" /><a href="#" style="padding: 0;">&nbsp;<img src="./img/logo.png" style="width: 150px;" alt="->" /></a></li>
					<li class="border-bottom"></li>
					<li class="border-top-bottom"><a href="index.php"><img src="./img/home.png" alt="[H]" />&nbsp;&nbsp;&nbsp;Accueil</a></li>
					<li class="border-top-bottom"><a href="histoire.php"><img src="./img/about.png" alt="[A]" />&nbsp;&nbsp;&nbsp;Histoire</a></li>
					<li class="border-top-bottom"><a href="galerie.php"><img src="./img/gallery.png" alt="[G]" />&nbsp;&nbsp;&nbsp;Galerie</a></li>
					<li class="border-top-bottom"><a href="support.php"><img src="./img/contact.png" alt="[S]" />&nbsp;&nbsp;&nbsp;Support</a></li>
					<li class="border-top center"><div class="small alert button" data-reveal-id="registerModal">Inscription</div><div class="small button" data-reveal-id="loginModal">Connexion</div></li>
					<div class="f-bottom">
						<li class="border-bottom"></li>
						<li class="border-top-bottom center">12 : 55 : 45</li>
						<li class="border-top-bottom"><a href="#"><img src="./img/players.png" alt="[H]" />&nbsp;&nbsp;&nbsp;Players: 7</a></li>
						<li class="border-top-bottom"><a href="#"><img src="./img/privacy.png" alt="[C]" />&nbsp;&nbsp;&nbsp;Privacy</a></li>
						<li class="border-top center copyright">© ApocalySpace</a> 2012-2014<br /><a href="">Contact</a> - <a href="./docs/">Version 1.7</a></li>
					</div>
				</span>
			</ul>
		</nav>
		<!-- End Desktop navigation -->
		<!-- Mobile or Desktop < 1280 navigation -->
		<div class="small-nav show-for-large-down">
			<nav class="large-9 columns">
				<a href="index.php"><img src="./img/home.png" width="40" alt="[H]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "accueil" ) echo 'Accueil'; ?></a>
				<a href="histoire.php"><img src="./img/about.png" width="30" alt="[A]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "histoire" ) echo 'Histoire'; ?></a>
				<a href="galerie.php"><img src="./img/gallery.png" width="30" alt="[G]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "galerie" ) echo 'Galerie'; ?></a>
				<a href="support.php"><img src="./img/contact.png" width="30" alt="[S]" />&nbsp;&nbsp;<?php if( $Engine->getNamepage() == "support" ) echo 'Support'; ?></a>
			</nav>
			<nav class="large-3 columns">
				<span class="small alert button" data-reveal-id="registerModal">Inscription</span>
				<span class="small button" data-reveal-id="loginModal">Connexion</span>
			</nav>
			<br />
		</div>
		<!-- End Mobile or Desktop <1280 navigation -->

		