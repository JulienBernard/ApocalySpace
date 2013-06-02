
	<header>
		<h1>PRESENTATION</h1>
	</header>
	
	<article>
		<p>
			<?php echo nl2br( $presentation->getText() ) ; ?>
			<?php // Si je voulais protéger contre le HTLM : echo nl2br(htmlentities($presentation->getText(), NULL, 'utf-8')); ?>
		</p>
		<form action="index.php" method="POST">
			<input type="submit" name="retrieveText" value="Récuperer le texte" />
		</form>
		<br />
		<h2>Modifier ce texte via PDO :</h2>
		<p>
			Vous devez être connecté pour modifier ce texte.
		</p>
		<form action="index.php" method="POST">
			Pseudo <input type="text" name="login" value="test" /><?php if( isset($returnError) && $returnError['login'] == 0) echo "Ce champ ne doit pas être vide."; ?><br />
			Mot de passe <input type="password" name="password" value="test" /><?php if( isset($returnError) && $returnError['password'] == 0 ) echo "Ce champ ne doit pas être vide."; ?><br />
			<input type="submit" name="connection" value="Connexion" />
		</form>
		<?php
			if( !empty($INFO) )
				echo "<p class=\"Info\">".$INFO."</p>";
			if( !empty($ERROR) )
				echo "<p class=\"Error\">".$ERROR."</p>";
			else if( !empty($SUCCESS) )
				echo "<p class=\"Success\">".$SUCCESS."</p>";
			?>
	</article>
	