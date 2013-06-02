<!DOCTYPE html>

<html lang="fr">
<head>
	<title><?php echo DEFAULT_TITLE.$title; ?></title>
	<meta charset="utf-8" />
	<meta name="google-site-verification" content="v2Ddq6qw70xR2UAFJGCzfMQhrB-gJQDQjaRlS1J2dts" /> 
	<meta name="Author" lang="fr" content="Julien BERNARD">
	<meta name="Publisher" content="Julien BERNARD">
	
	<base href="<?php echo BASE_SITE; ?>" />
	
	<?php
		// Chargement de la description
		if( !empty( $description ) )
		{
			echo '<meta name="description" content="'.$description.'" />
			';
		}
		else
		{
			echo '<meta name="description" content="'.DEFAULT_DESCRIPTION.'" />
			';
		}
		
		// Chargement des CSS
		foreach( $t_css as $css )
		{
			echo '<link rel="stylesheet" media="screen" href="css/'.$css.'" />
			';
		}
	
		// Chargement des scripts
		foreach( $t_script as $script )
		{
			echo '<script type="text/javascript" src="./js/'.$script.'"></script>
			';
		}
	?>

</head>

<body>
	
	<section>
		<header id="Top">
			<p>
				<span id="SmallOne">JULIEN BERNARD présente SpaceEngine, un moteur web imaginé pour <a href="http://www.apocalyspace.fr" style="color: white;">www.apocalyspace.fr</a></span>
				SpaceEngine : moteur de site internet, simple et rapide !<br />
				<span id="SmallTwo">PHP5 - ORIENTE OBJET - PDO - PATTERN MVC</span>
			</p>
		</header>
		
		<article id="Link">
			<a href="index.php">Présentation</a>
		</article>
	</section>

	<section class="Body">		
		
	