<?php

class Technology
{
	private $_id;
	private $_userId;
	private $_name;
	private $_pitch;
	private $_description;
	private $_informations;
	private $_level;
	private $_cost;
	
	public function __construct( $technologyId, $userId ) {
		$dataFromDb = $this->getTechnologyData( $technologyId, $userId );

		$this->_id = (int)$dataFromDb['th_id'];
		$this->_userId = (int)$dataFromDb['userId'];
		$this->_name = (String)$dataFromDb['th_name'];
		$this->_pitch = (String)$dataFromDb['th_pitch'];
		$this->_description = (String)$dataFromDb['th_description'];
		$this->_informations = (String)$dataFromDb['th_informations'];
		$this->_level = (int)$dataFromDb['techLevel'];
		$this->_cost = 120;		// Le coût est défini après calcul du nombre de niveau de recherche total !
	}
	
	/**
	 * Recupère les données d'une technologie depuis la base de données.
	 * @param int technologyId
	 * @param int userId
	 * @return array or throw an exception!
	 */
	private static function getTechnologyData( $technologyId, $userId ) {
		/* Validation des paramètres */
		if( !is_numeric($userId) || !is_numeric($technologyId) || $technologyId < 0 || $userId < 0 )
			return false;
		
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT * FROM technologies JOIN TtoU ON techId=th_id WHERE th_id=:technologyId AND userId=:userId');
		$data = array(':technologyId' => (int)$technologyId, ':userId' => (int)$userId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cette technologie !');
		$row = $rq->fetch();
		return $row;
	}
	
	/**
	 * Recupère le niveau d'une technologie depuis la base de données.
	 * @param int technologyId
	 * @param int userId
	 * @return int or throw an exception!
	 */
	public static function getTechnologyLevel( $technologyId, $userId ) {
		/* Validation des paramètres */
		if( !is_numeric($userId) || !is_numeric($technologyId) || $technologyId < 0 || $userId < 0 )
			return false;
			
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT techLevel FROM TtoU WHERE techId=:technologyId AND userId=:userId');
		$data = array(':technologyId' => (int)$technologyId, ':userId' => (int)$userId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer le niveau de cette technologie !');
		$row = $rq->fetch();
		return $row["techLevel"];
	}
	
	/* Ajout d'un niveau à la technologie d'un joueur
		*@param integer $technologyId	: ID technologie
		*@param integer $userId			: ID user
		Retourne false si il y a un problème, sinon true
		*/
	public static function addTechnologyLevel( $technologyId, $userId )
	{
		/* Validation des paramètres */
		if( !is_numeric($technologyId) || !is_numeric($userId) || $technologyId < 0 || $userId < 0 )
			return false;
		
		$pdo = MyPDO::get();
		
		$queryString = 'SELECT techId, techLevel FROM TtoU WHERE userId =:userId AND techId = :techId;';
		$queryData = array(':userId' => (int)$userId, ':techId' => (int)$technologyId);
		$query = $pdo->prepare($queryString);
		$query->execute($queryData);
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if( $row === false )
		{
			/* Le batiment n'existe pas dans BtoP; level = 1 */
			$queryString = '
				INSERT INTO TtoU
				(userId, techId, techLevel)
				VALUES (:userId, :techId, 1);
			';
		} else {
			/* Le batiment existe déja dans BtoP; level++ */
			$queryString = '
				UPDATE TtoU
				SET techLevel = (techLevel + 1)
				WHERE userId = :userId AND techId = :techId;
			';
		}
		$queryData = array(':userId' => (int)$userId, ':techId' => (int)$technologyId);
		
		$query = $pdo->prepare($queryString);
		if( $query->execute($queryData) )
		{
			return true;
		}
		else
		{
			var_dump($query->errorInfo());
			return false;
		}
	}
	
	/* Getters */
	public function getId() {
		return $this->_id;
	}
	public function getUserId() {
		return $this->_userId;
	}
	public function getName() {
		return $this->_name;
	}
	public function getPitch() {
		return $this->_pitch;
	}
	public function getDescription() {
		return $this->_description;
	}
	public function getInformations() {
		return $this->_informations;
	}
	public function getCost() {
		return (int)$this->_cost;
	}
	public function getLevel() {
		return (int)$this->_level;
	}
	
	/* Setters */
	public function setCost( $totalLevel, $costMultiplier ) {
		$this->_cost = (182 * $totalLevel * $costMultiplier) + 100;
	}
}