<!DOCTYPE html>

<html lang="fr">
<head>
	<title><?php echo DEFAULT_TITLE.$Template->getTitle(); ?></title>
	<meta charset="utf-8" />
	<meta name="google-site-verification" content="v2Ddq6qw70xR2UAFJGCzfMQhrB-gJQDQjaRlS1J2dts" /> 
	<meta name="Author" lang="fr" content="Julien BERNARD">
	<meta name="Publisher" content="Julien BERNARD">
	
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
<section id="main" style="padding-top: 0;">

	<header>
		<div id="header_infobar">ACCUEIL</div>
		<a href=""><div id="header_infobar_logo"></div></a>
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
			<div class="large-4 columns"></div>
			<div class="large-8 columns">
				<p>POUR AFFICHER, CLIQUER OU ALLER VERS LE BAS<br /><img src="img/arrow.png" /></p>
			</div>
		</div>
	</header>
	
	<section>
		<div class="row">
			<nav class="large-12 breadcrumbs" id="links">
				<a href="index.php" <?php if( $title == "Accueil" ) echo 'class="current"'; ?>>Accueil</a>
				<a href="histoire.php" <?php if( $title == "Histoire" ) echo 'class="current"'; ?>>Histoire</a>
				<a href="galerie.php" <?php if( $title == "Galerie" ) echo 'class="current"'; ?>>Galerie</a>
				<a href="support.php" <?php if( $title == "Support" ) echo 'class="current"'; ?>>Contact et Support</a>
			</nav>
		</div>
		<br />
	