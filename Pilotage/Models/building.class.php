<?php

class Building
{
	private $_id;
	private $_planetId;
	private $_name;
	private $_description;
	private $_type;
	private $_picture;
	private $_costMultiplier;
	private $_level;
	private $_population;
	private $_maxPopulation;
	private $_superfie;
	private $_cost1;
	private $_cost2;
	private $_cost3;
	private $_time;
	
	/* Constantes */
	private $_garnisonPerLevel = 20;
	private $_buildingSuperficie = 100;

	/* Constructeur de la classe */
	public function __construct( $buildingId, $planetId ) {
		$dataFromDb = $this->getBuildingData( $buildingId, $planetId );
	
		$this->_id = (int)$dataFromDb['bl_id'];
		$this->_planetId = (int)$dataFromDb['planetId'];
		$this->_name = (String)$dataFromDb['bl_name'];
		$this->_description = (String)$dataFromDb['bl_description'];
		$this->_type = (int)$dataFromDb['bl_buildingType'];
		$this->_picture = (String)$dataFromDb['bl_picture'];
		$this->_costMultiplier = (double)$dataFromDb['bl_costMultiplier'];
		$this->_level = (int)$dataFromDb['buildingLevel'];
		$this->_population = (int)$dataFromDb['buildingPopulation'];
		$this->_maxPopulation = (int)$this->_level * (int)$this->_garnisonPerLevel;
		$this->_superfie = (int)$this->_level * (int)$this->_buildingSuperficie;

		if( $this->_level == 0 )
		{
			$this->_cost1 = (int)$dataFromDb['bl_cost1'];
			$this->_cost2 = (int)$dataFromDb['bl_cost2'];
			$this->_cost3 = (int)$dataFromDb['bl_cost3'];
			$this->_time = (int)$dataFromDb['bl_buildingTime'] * (double)$this->_costMultiplier;
		}
		else
		{
			$this->_cost1 = (int)$dataFromDb['bl_cost1'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost2 = (int)$dataFromDb['bl_cost2'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost3 = (int)$dataFromDb['bl_cost3'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_time = (int)$this->_level * (int)$dataFromDb['bl_buildingTime'] * (double)$this->_costMultiplier;
		}
	}
	
	/**
	 * Recupère les données d'un bâtiment depuis la base de données.
	 * @param int buildingId
	 * @param int planetId
	 * @return array or throw an exception!
	 */
	private static function getBuildingData( $buildingId, $planetId ) {
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT * FROM buildings JOIN BtoP ON buildingId=bl_id WHERE bl_id=:buildingId AND planetId=:planetId');
		$data = array(':buildingId' => (int)$buildingId, ':planetId' => (int)$planetId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cette structure !');
		$row = $rq->fetch();
		return $row;
	}
	
	/**
	 * Recupère le niveau d'un bâtiment depuis la base de données.
	 * @param int buildingId
	 * @param int planetId
	 * @return int or throw an exception!
	 */
	public static function getBuildingLevel( $buildingId, $planetId ) {
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT buildingLevel FROM BtoP WHERE buildingId=:buildingId AND planetId=:planetId');
		$data = array(':buildingId' => (int)$buildingId, ':planetId' => (int)$planetId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer le niveau de cette structure !');
		$row = $rq->fetch();
		return $row["buildingLevel"];
	}
	
	public function timeToString( $seconds )
	{
		$time = "";
		$days = floor( $seconds / (60*60*24) );
		$seconds = $seconds % (60*60*24);
		
		$hours = floor( $seconds / (60*60) );
		$seconds = $seconds % (60*60);
		
		$minutes = floor( $seconds / (60) );
		$seconds = $seconds % (60);
		
		if( $days > 0 )
		{
			$time = $days . ' jour';
			if( $days > 1 )
				$time .= 's';
			
			$time .= ' ';
		}

		$time .= sprintf('%02d', $hours) . ':' . sprintf('%02d', $minutes) . ':' . sprintf('%02d', $seconds);
		
		return $time;
	}
	
	/* Ajout d'un niveau au batiment d'une planète
		*@param integer $buildingId		: ID batiment
		*@param integer $planetId		: ID planète
		Retourne false si il y a un problème, sinon true
		*/
	public static function addBuildingLevel( $buildingId, $planetId )
	{
		/* Validation des paramètres */
		if( !is_numeric($buildingId) || !is_numeric($planetId) || $buildingId < 0 || $planetId < 0 )
			return false;
		
		$pdo = MyPDO::get();
		
		/* Récupération du niveau de bâtiment de l'utilisateur */
		$queryString = '
			SELECT buildingId, buildingLevel
			FROM BtoP
			WHERE planetId = :planetId;
		';
		$queryData = array(':planetId' => (int)$planetId);
		
		$query = $pdo->prepare($queryString);
		$query->execute($queryData);
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if( $row === false )
		{
			/* Le batiment n'existe pas dans BtoP; level = 1 */
			$queryString = '
				INSERT INTO BtoP
				(buildingId, planetId, buildingLevel, buildingPopulation)
				VALUES (:buildingId, :planetId, 1, 0);
			';
		} else {
			/* Le batiment existe déja dans BtoP; level++ */
			$queryString = '
				UPDATE BtoP
				SET buildingLevel = (buildingLevel + 1)
				WHERE planetId = :planetId AND buildingId = :buildingId;
			';
		}
		$queryData = array(':planetId' => (int)$planetId, ':buildingId' => (int)$buildingId);
		
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
	
	/**
	 * Modifie dans la base de données le nombre d'ouvriers d'un bâtiment.
	 * @param int planetId
	 * @param int buildingId
	 * @param int newValue
	 */
	public function updateBuildingPopulation( $planetId, $buildingId, $newValue )
	{
		$newTime = time();
		$sql = MyPDO::get();

		$rq = $sql->prepare('UPDATE BtoP SET buildingPopulation=:values WHERE planetId=:planetId AND buildingId=:idBuilding');
        $data = array(':idBuilding' => $buildingId, ':planetId' => $planetId, ':values' => $newValue);
	
		if( !$rq->execute($data) )
		{
			die("<p>Une erreur est survenue pendant la modification des données sur la population.</p>");
		}
		else
		{
			return 1;
		}
	}
	
	/* Getters */
	public function getId() {
		return $this->_id;
	}
	public function getPlanetId() {
		return $this->_planetId;
	}
	public function getName() {
		return $this->_name;
	}
	public function getDescription() {
		return $this->_description;
	}
	public function getType() {
		return $this->_type;
	}
	public function getPicture() {
		return $this->_picture;
	}
	public function getSuperficie() {
		return $this->_superfie;
	}
	public function getPopulation() {
		return $this->_population;
	}
	public function getMaxPopulation() {
		return $this->_maxPopulation;
	}
	public function getCost1() {
		return (int)$this->_cost1;
	}
	public function getCost2() {
		return (int)$this->_cost2;
	}
	public function getCost3() {
		return (int)$this->_cost3;
	}
	public function getTime() {
		return $this->_time;
	}
}