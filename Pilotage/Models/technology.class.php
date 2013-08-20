<?php

class Technology
{
	private $_id;
	private $_userId;
	private $_name;
	private $_description;
	private $_costMultiplier;
	private $_level;
	private $_cost1;
	private $_cost2;
	private $_cost3;
	
	public function __construct( $technologyId, $userId ) {
		$dataFromDb = $this->getTechnologyData( $technologyId, $userId );

		$this->_id = (int)$dataFromDb['th_id'];
		$this->_userId = (int)$dataFromDb['userId'];
		$this->_name = (String)$dataFromDb['th_name'];
		$this->_description = (String)$dataFromDb['th_description'];
		$this->_costMultiplier = (double)$dataFromDb['th_costMultiplier'];
		$this->_level = (int)$dataFromDb['techLevel'];
		
		if( $this->_level == 0 )
		{
			$this->_cost1 = (int)$dataFromDb['th_cost1'];
			$this->_cost2 = (int)$dataFromDb['th_cost2'];
			$this->_cost3 = (int)$dataFromDb['th_cost3'];
		}
		else
		{
			$this->_cost1 = (int)$dataFromDb['th_cost1'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost2 = (int)$dataFromDb['th_cost2'] * (int)$this->_level * (double)$this->_costMultiplier;
			$this->_cost3 = (int)$dataFromDb['th_cost3'] * (int)$this->_level * (double)$this->_costMultiplier;
		}
	}
	
	/**
	 * Recupère les données d'une technologie depuis la base de données.
	 * @param int technologyId
	 * @param int userId
	 * @return array or throw an exception!
	 */
	private static function getTechnologyData( $technologyId, $userId ) {
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT * FROM technologies JOIN TtoU ON techId=th_id WHERE th_id=:technologyId AND userId=:userId');
		$data = array(':technologyId' => (int)$technologyId, ':userId' => (int)$userId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cette technologie !');
		$row = $rq->fetch();
		return $row;
	}
}