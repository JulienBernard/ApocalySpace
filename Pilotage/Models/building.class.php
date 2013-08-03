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
	private $_cost1;
	private $_cost2;
	private $_cost3;
	private $_time;

	/* Constructeur de la classe */
	public function __construct( $buildingId, $planetId ) {
		$dataFromDb = $this->getBuildingData( $buildingId, $planetId );
	
		$this->_id = (int)$dataFromDb['bl_id'];
		$this->_planetId = (int)$dataFromDb['planetId'];
		$this->_name = (string)$dataFromDb['bl_name'];
		$this->_description = (string)$dataFromDb['bl_description'];
		$this->_type = (int)$dataFromDb['bl_buildingType'];
		$this->_picture = (string)$dataFromDb['bl_picture'];
		$this->_costMultiplier = (double)$dataFromDb['bl_costMultiplier'];
		$this->_level = (int)$dataFromDb['buildingLevel'];
		$this->_population = (int)$dataFromDb['buildingPopulation'];
		if( $this->_level == 0 )
		{
			$this->_cost1 = (int)$dataFromDb['bl_cost1'];
			$this->_cost2 = (int)$dataFromDb['bl_cost2'];
			$this->_cost3 = (int)$dataFromDb['bl_cost3'];
		}
		else
		{
			$this->_cost1 = (int)$dataFromDb['bl_cost1'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost2 = (int)$dataFromDb['bl_cost2'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost3 = (int)$dataFromDb['bl_cost3'] * (int)$this->_level * (double)$this->_costMultiplier;
		}
		$this->_time = (int)$this->_level * (int)$dataFromDb['bl_buildingTime'] * (double)$this->_costMultiplier;
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
}