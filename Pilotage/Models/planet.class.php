<?php

class Planet extends User
{
	private $_planetId;
	private $_planetName;
	private $_planetSize;
	private $_planetPopulation;
	private $_planetUserId;
	private $_planetPosX;
	private $_planetPosY;
	private $_planetResource1;
	private $_planetResource2;
	private $_planetResource3;
	private $_planetPR;
	private $_planetProduction1;
	private $_planetProduction2;
	private $_planetProduction3;
	private $_planetProductionPR;	// Point Recherche
	private $_planetProductionTime;	// Dernière interaction avec la planète (pour le calcul de production).
	private $_primaryPlanet;		// Si 1, cette planète est la planète primaire d'un joueur.
	
	/* Constructeur de la classe */
	public function __construct( $dataPlanet, $dataUser )
	{
		$this->_planetId = (int)$dataPlanet['pl_id'];
		$this->_planetName = (string)$dataPlanet['pl_name'];
		$this->_planetSize = (int)$dataPlanet['pl_planetSize'];
		$this->_planetPopulation = (int)$dataPlanet['pl_population'];
		$this->_planetUserId = (int)$dataPlanet['pl_userId'];
		$this->_planetPosX = (int)$dataPlanet['pl_posX'];
		$this->_planetPosY = (int)$dataPlanet['pl_posY'];
		$this->_planetResource1 = (int)$dataPlanet['pl_res1'];
		$this->_planetResource2 = (int)$dataPlanet['pl_res2'];
		$this->_planetResource3 = (int)$dataPlanet['pl_res2'];
		$this->_planetPR = (int)$dataPlanet['pl_pr'];
		$this->_planetProduction1 = (int)$dataPlanet['pl_prod_res1'];
		$this->_planetProduction2 = (int)$dataPlanet['pl_prod_res2'];
		$this->_planetProduction3 = (int)$dataPlanet['pl_prod_res3'];
		$this->_planetProductionPR = (int)$dataPlanet['pl_prod_pr'];
		$this->_planetProductionTime = (int)$dataPlanet['pl_prod_time'];
		$this->_primaryPlanet = (int)$dataPlanet['pl_primary'];
		
		User::setId( (int)$dataUser['id'] );
		User::setUsername( (string)$dataUser['username'] );
		User::setFaction( (string)$dataUser['factionName'] );
	}
	
	/**
	 * Recupère les données d'une planète depuis la base de données.
	 * @param int planetId
	 * @return array or 0 (error)
	 */
	public static function getPlanetData( $planetId ) {
		$sql = MyPDO::get();

		$rq = $sql->prepare('SELECT * FROM planets WHERE pl_id=:idPlanet');
        $data = array(':idPlanet' => (int)$planetId );
		$rq->execute($data);
						
		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cette planète !');
		$row = $rq->fetch();
		return $row;
	}
	
	/**
	 * Ajoute une planète à un utilisateur selon son id.
	 * Appelle la fonction getPlanetSlot() pour trouver une place libre.
	 *
	 * @param int userId
	 * @param String name
	 * @param String primary	Vaut 1 si cette planète est la planète primaire du joueur (inscription).
	 * return int lastInsertId	Retourne le dernier ID inséré dans la bdd, ici l'user id !
	 */
	public static function addPlanet( $userId, $primary = 0, $name = 'P042' ) {
		$sql = MyPDO::get();
		
		$initialX = (rand(0, 5) - 2)*2; 
		$initialY = (rand(0, 5) - 2)*2;
		$coords = Map::getPlanetSlot( $initialX, $initialY );
		
		$req = $sql->prepare('INSERT INTO planets VALUES(null, :name, :size, :population, :userId, :posX, :posY, :res1, :res2, :res3, :pr, :prod_res1, :prod_res2, :prod_res3, :prod_respr, :prod_time, :primary)');
		$result = $req->execute( array(
			':name' => $name,
			':size' => 100,
			':population' => 10,
			':userId' => $userId,
			':posX' => $coords[0],
			':posY' => $coords[1],
			':res1' => 900,
			':res2' => 600,
			':res3' => 0,
			':pr' => 0,
			':prod_res1' => 100,
			':prod_res2' => 60,
			':prod_res3' => 0,
			':prod_respr' => 0,
			':prod_time' => time(),
			':primary' => $primary,
		));
		
		if( $result )
			return $sql->lastInsertId();
		return 0;
	}
	
	/* Créée les bâtiments et liens nécéssaires pour que la planète puisse fonctionner
	 * @param int $planetId - ID planète
	 *
	 * Infos :
	 * Sont visibles 1 à 8 (CdC, Habitations, Mines, Entrepôts)
	 * Centre de commande (1), Habitation (5) niv. 1, reste 0
	*/
	public static function initializePlanet( $planetId )
	{
		global $commandCenterId, $titaneMineId, $berylMineId, $hydrogeneExtractorId, $habitationId,
				$titaneStorageId, $berylStorageId, $hydrogeneStorageId, $atelierId, $usineId, $researchCenterId,
				$planetaryCongressId;

		$pdo = MyPDO::get();
		
		$queryString = 'INSERT INTO BtoP
		(`buildingId`, `planetId`, `buildingLevel`, `buildingPopulation`, `buildingView`)
		VALUES
		(:commandCenterBID, :planetId, 1, 0, 1), -- Centre de commande niveau 1
		(:habitationBID, :planetId, 1, 0, 1), -- Habitation
		(:mine1BID, :planetId, 0, 0, 1), -- Mines
		(:mine2BID, :planetId, 0, 0, 1),
		(:mine3BID, :planetId, 0, 0, 1), 
		(:atelierBID, :planetId, 0, 0, 0), -- Atelier
		(:usineBID, :planetId, 0, 0, 0), -- Usine
		(:stock1BID, :planetId, 0, 0, 1), -- Entrepôts
		(:stock2BID, :planetId, 0, 0, 1),
		(:stock3BID, :planetId, 0, 0, 1),
		(:rechercheBID, :planetId, 0, 0, 0), -- Centre de recherche
		(:congresBID, :planetId, 0, 0, 0); -- Congrès
		';
		$queryData = array(
		':planetId' => $planetId,
		':commandCenterBID' => $commandCenterId,
		':habitationBID' => $habitationId,
		':mine1BID' => $titaneMineId,
		':mine2BID' => $berylMineId,
		':mine3BID' => $hydrogeneExtractorId,
		':atelierBID' => $atelierId,
		':usineBID' => $usineId,
		':stock1BID' => $titaneStorageId,
		':stock2BID' => $berylStorageId,
		':stock3BID' => $hydrogeneStorageId,
		':rechercheBID' => $researchCenterId,
		':congresBID' => $planetaryCongressId,
		);
		
		$query = $pdo->prepare($queryString);
		if( !$query->execute($queryData) )
		{
			// Gestion d'erreurs PDO
			$errorInfo = $query->errorInfo();
			
			$errorText = '<p class="Error">';
			$errorText .= 'initializePlanet: Une erreur SQL est survenue (bâtiments).<br />';
			$errorText .= '['.$errorInfo[0].' - '.$errorInfo[1].'] '.$errorInfo[2].'<br />';
			$errorText .= 'Requête: '.var_export($queryString, true) . '<br />';
			$errorText .= 'Données: '.var_export($queryData, true) . '<br />';
			$errorText .= '</p>';
			
			die($errorText);
		}
		
		return true;
	}
	
	/**	Permet de récupérer l'id de la planète primaire du joueur (utilisé pour la connexion notamment -> on arrive sur la première planète du joueur)
	 *@param int $userId	:	id du joueur
	 Retourne l'id de la planète primaire du joueur.
	 */
	public static function getUserPrimaryPlanet( $userId )
	{
		$sql = MyPDO::get();

		$rq = $sql->prepare('SELECT pl_id FROM planets WHERE pl_userId=:idUser AND pl_primary=:statut');
		$data = array(':idUser' => $userId, ':statut' => (int)1 );
		$rq->execute( $data );
	
		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cette planète !');
		$row = $rq->fetch();
		return $row['pl_id'];
	}
}