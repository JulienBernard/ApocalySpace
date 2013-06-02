
	<header>
		<h1>PRESENTATION</h1>
	</header>
	
	<article>
		<p>
			<?php echo nl2br($presentation->getText()); ?>
		</p>
		<form action="index.php" method="POST">
			<input type="submit" name="retrieveText" value="Récuperer le texte" />
		</form>
		<br />
		<h2>Modifier ce texte via PDO :</h2>
		<form action="index.php" method="POST">
			<textarea name="text" cols="96" rows="6"><?php echo $presentation->getText(); ?></textarea>
			<input type="submit" name="updateText" value="Modifier" />
		</form>
	</article>
	