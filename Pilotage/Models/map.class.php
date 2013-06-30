<?php

abstract class Map extends Planet
{
	/**
	 * Vérifie si une planète est libre, et recherche un emplacement libre autour.
	 * Quand une place libre est trouvée, renvoie les coordonnées. Récursive quand une planète existe, ou à 50%.
	 * @param int $x Abscisse
	 * @param int $y Ordonnée
	 * @return array [0] = X; [1] = Y
	 */
	public static function getPlanetSlot( $x, $y )
	{
		if( rand(0, 1) && !Map::getPlanetFromCoords( $x, $y ) )
		{
			return array( $x, $y );
		} else {
			/* On change de cordonnées */
			/* Coords: Random (+4, -4), avec 1 espace entre chaque planète */
			$delta_x = 0;
			$delta_y = 0;
			while( $delta_x == 0 && $delta_y == 0 )
			{
				$delta_x = (rand(0, 4) - 2)*2;
				$delta_y = (rand(0, 4) - 2)*2;
			}
			$new_x = $x + $delta_x;
			$new_y = $y + $delta_y;
			
			/* Récursion avec les nouvelles coords */
			return Map::getPlanetSlot( $new_x, $new_y );
		}
	}
	
	/** Fonction qui récupère les coordonnées des différentes planètes dans la zone ciblé
	 * @param int $xMin	Position minimale sur l'axe X
	 * @param int $xMax	Position maximale sur l'axe X
	 * @param int $yMin	Position minimale sur l'axe Y
	 * @param int $yMax	Position maximale sur l'axe Y
	 * @return array	Retourne un tableau de coordonnées contenant le nom des planètes et leurs id
	*/
	public static function getPlanetsCoordonnees( $xMin, $xMax, $yMin, $yMax )
	{
		$sql = MyPDO::get();
	
		$req = $sql->prepare('SELECT id, username, clanId, pl_id, pl_name, pl_posX, pl_posY, pl_population FROM planets JOIN users ON id=pl_userId WHERE pl_posX BETWEEN :xMin AND :xMax AND pl_posY BETWEEN :yMin AND :yMax ORDER BY pl_posY ASC, pl_posX ASC');
		$result = $req->execute( array(':xMin' => $xMin, ':xMax' => $xMax, ':yMin' => $yMin, ':yMax' => $yMax) );
		
		// Si PDO renvoie une erreur
		if( !$result )
			die("<h1 style='color: white'>Oups !</h1>
				<p style='color: white'>
					Une erreur est survenue pendant la récupération des coordonnées des planètes.
				</p>");
		else {
			$array = array();
			$i = 0;
			while( $row = $req->fetch() )
			{
				$array[$i] = $row;
				
				if( !empty($row['clanId']) )
				{
					$rq = $sql->prepare('SELECT cl_name FROM clans WHERE cl_id=:clanId');
					$rq->execute( array(':clanId' => $row['clanId']) );
					$rw = $rq->fetch();
					$array[$i]['clanName'] = $rw['cl_name'];
				}
				$i++;
			}
			// Retourne un tableau de données
			return $array;
		}
	}
	
	/**
	 * Récupère les données d'une planète et de son utilisateur par ses coordonnées
	 * @param int $coordX Abscisse
	 * @param int $coordY Ordonnée
	 * @return false|array false quand la planète n'existe pas; sinon, tableau avec données
	 */
	public static function getPlanetFromCoords( $coordX, $coordY )
	{
		$pdo = MyPDO::get();
		
		$queryString = 'SELECT
			P.pl_id AS planetId,
			P.pl_name AS planetName,
			P.pl_population AS population,
			P.pl_userId AS userId,
			P.pl_posX AS posX,
			P.pl_posY AS posY,
			U.username AS username,
			U.factionName AS factionName
		FROM planets P
		JOIN users U
		  ON P.pl_userId = U.id
		WHERE P.pl_posX = :coordX AND P.pl_posY = :coordY ;';
		$queryData = array(':coordX' => (int)$coordX, ':coordY' => (int)$coordY );
		
		$query = $pdo->prepare($queryString);
		if( !$query->execute($queryData) )
		{
			// Gestion d'erreurs PDO
			$errorInfo = $query->errorInfo();
			$errorText = '<p class="Error">';
			$errorText .= 'getPlanetFromCoords: Une erreur SQL est survenue.<br />';
			$errorText .= '['.$errorInfo[0].' - '.$errorInfo[1].'] '.$errorInfo[2].'<br />';
			$errorText .= 'Requête: '.var_export($queryString, true) . '<br />';
			$errorText .= 'Données: '.var_export($queryData, true) . '<br />';
			$errorText .= '</p>';
			die($errorText);
		}
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		return $row;
	}

}