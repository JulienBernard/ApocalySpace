<?php

class Top
{
	private $_topName;
	private $_size;
	private $_startPosition;
	private $_usersList = array();		// Informations sur les utilisateurs
	private $_valueList = array();		// "Points" selon classement (niveau tech, res militaire, nb pop)

	/* Constructeur de la classe */
	public function __construct( $see = "demography", $startPosition = 0, $size = 10 ) {
		$this->_startPosition = $startPosition;
		$this->_size = $size;
		
		/* Compte les niveaux des technologies des utilisateurs */
		if( $see == "technology" )
		{
			$this->_topName = "Classement technologiques";
		}
		/* Compte le ressources dépensés en vaisseaux construit par les utilisateurs*/
		else if( $see == "military" )
		{
			$this->_topName = "Classement militaires";
		}
		/* Compte la population des utilisateurs */
		else 
		{
			$this->_topName = "Classement démographique";
			$this->_usersList = $this->getUsers( $startPosition, $size );
		}
	}
	
	/** Récupère une liste de utilisateurs (selon $size [DEFAUT : 10]) pour le classement de type "Démographique"
	 * @param int $size				:	taille de la liste (plus elle est grande, plus la requête sera longue à effectuer !)
	 * @param int $startPosition	:	position de départ
	 */
	private function getUsers( $startPosition = 0, $size = 0 )
	{
		/* Si on arrive sur la page de classement "principale",
			on effectue une recherche sur la moitié supérieur aux nombre d'habitants
			moyen retournée par MySql [SELECT AVG(pl_population)] */
		if( $startPosition == 0 )
		{
			$sql = MyPDO::get();
			$rq = $sql->prepare('
				SELECT planets.pl_population, users.id, users.username, users.factionName
				FROM planets
				JOIN users ON planets.pl_userId = users.id
				WHERE planets.pl_population > (SELECT AVG(pl_population) FROM planets)
				ORDER BY planets.pl_population DESC
				LIMIT :startPosition, :size
			');
			$rq->bindValue('startPosition', (int)$startPosition, PDO::PARAM_INT);
			$rq->bindValue('size', (int)$size, PDO::PARAM_INT);
			$rq->execute() or die(print_r($rq->errorInfo()));
			
			$array = array();
			while( $row = $rq->fetch() )
				$array[] = $row;
			
			/* Au cas où :
				si le nombre de retour est inférieur à la taille souhaitée,
				on check sur toute la BDD. Dans tous les cas, on renvoit les mêmes données. */
			if( count($array) < $size )
			{
				unset($array);
				$rq = $sql->prepare('
					SELECT planets.pl_population, users.id, users.username, users.factionName
					FROM planets
					JOIN users ON planets.pl_userId = users.id
					ORDER BY planets.pl_population DESC
					LIMIT :startPosition, :size
				');
				$rq->bindValue('startPosition', (int)$startPosition, PDO::PARAM_INT);
				$rq->bindValue('size', (int)$size, PDO::PARAM_INT);
				$rq->execute() or die(print_r($rq->errorInfo()));
				
				while( $row = $rq->fetch() )
					$array[] = $row;
			}
			return $array;
		}
		else {
		
		}
	}
	
	/* Getters */
	public function getUsersList() {
		return $this->_usersList;
	}
	public function getSize() {
		return $this->_size;
	}
	public function getStartPosition() {
		return $this->_startPosition;
	}
}