<?php

class Planet
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
	private $_prodRes1Bonus;
	private $_prodRes2Bonus;
	private $_prodRes3Bonus;
	private $_planetProduction1;
	private $_planetProduction2;
	private $_planetProduction3;
	private $_planetProductionPR;	// Point Recherche
	private $_planetProductionTime;	// Dernière interaction avec la planète (pour le calcul de production).
	private $_planetNatality;
	private $_primaryPlanet;		// Si 1, cette planète est la planète primaire d'un joueur.
	
	/* Constructeur de la classe */
	public function __construct( $dataPlanet )
	{
		$this->_planetId = (int)$dataPlanet['pl_id'];
		$this->_planetName = (string)$dataPlanet['pl_name'];
		$this->_planetSize = (int)$dataPlanet['pl_planetSize'];
		$this->_planetUserId = (int)$dataPlanet['pl_userId'];
		$this->_planetPosX = (int)$dataPlanet['pl_posX'];
		$this->_planetPosY = (int)$dataPlanet['pl_posY'];
		$this->_planetPR = (int)$dataPlanet['pl_pr'];
		$this->_planetProduction1 = (int)$dataPlanet['pl_prod_res1'];
		$this->_planetProduction2 = (int)$dataPlanet['pl_prod_res2'];
		$this->_planetProduction3 = (int)$dataPlanet['pl_prod_res3'];
		$this->_planetProductionPR = (int)$dataPlanet['pl_prod_pr'];
		$this->_planetProductionTime = (int)$dataPlanet['pl_prod_time'];
		$this->_planetNatality = (int)$dataPlanet['pl_natality'];
		$this->_primaryPlanet = (int)$dataPlanet['pl_primary'];
		
		/* Ressources & Population */
		
		
		
		
		
		//		/!\ IMPORTANT /!\
		// 	TODO : ajouter dans la fct checkRessource les bonus (techno prod)

		
		$benefitRes1 = (int)$this->checkRessource( $this->getProductionTime(), $this->getProdRes1(), $this->getProdRes1Bonus() );
		$benefitRes2 = (int)$this->checkRessource( $this->getProductionTime(), $this->getProdRes2(), $this->getProdRes2Bonus() );
		$benefitRes3 = (int)$this->checkRessource( $this->getProductionTime(), $this->getProdRes3(), $this->getProdRes3Bonus() );
		$benefitResPR = (int)$this->checkRessource( $this->getProductionTime(), $this->getProdResPR() );
		$benefitPopulation = (int)$this->checkRessource( $this->getProductionTime(), $this->getNatality() );
		
		/* Fichier des id des bâtiments */
		include_once("./config_id.php");

		/* Ressources réelles */
		$this->_planetResource1 = (int)$dataPlanet['pl_res1'] + $benefitRes1;
		$this->_planetResource2 = (int)$dataPlanet['pl_res2'] + $benefitRes2;
		$this->_planetResource3 = (int)$dataPlanet['pl_res3'] + $benefitRes3;
		$this->_planetPR = (int)$dataPlanet['pl_pr'] + $benefitResPR;
		$this->_planetPopulation = (int)$dataPlanet['pl_population'] + $benefitPopulation;
		
		include_once(PATH_MODELS."building.class.php");
		if( $this->_planetResource1 > pow(2, Building::getBuildingLevel($titaneStorageId, $this->_planetId))*$titaneStorageSizePerLevel )
			$this->_planetResource1 = pow(2, Building::getBuildingLevel($titaneStorageId, $this->_planetId))*$titaneStorageSizePerLevel;
		if( $this->_planetResource2 > pow(2, Building::getBuildingLevel($berylStorageId, $this->_planetId))*$berylStorageSizePerLevel )
			$this->_planetResource2 = pow(2, Building::getBuildingLevel($berylStorageId, $this->_planetId))*$berylStorageSizePerLevel;
		if( $this->_planetResource3 > pow(2, Building::getBuildingLevel($hydrogeneStorageId, $this->_planetId))*$hydrogeneStorageSizePerLevel )
			$this->_planetResource3 = pow(2, Building::getBuildingLevel($hydrogeneStorageId, $this->_planetId))*$hydrogeneStorageSizePerLevel;
		/* Modification dans la base de données, si il y a modification ! */
		if( $benefitRes1 >= 1 OR $benefitRes2 >= 1 OR $benefitRes3 >= 1 OR $benefitResPR >= 1 )
			$this->updateRessource( $this->_planetId, $this->_planetResource1, $this->_planetResource2, $this->_planetResource3, $this->_planetPR );
		if( $benefitPopulation != 0 )
			$this->updatePopulation( $this->_planetId, $this->_planetPopulation );
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
	 * @param String faction	nécessaire pour le taux de natalité de départ
	 * @param String primary	Vaut 1 si cette planète est la planète primaire du joueur (inscription).
	 * return int lastInsertId	Retourne le dernier ID inséré dans la bdd, ici l'user id !
	 */
	public static function addPlanet( $userId, $faction, $primary = 0, $name = 'P042' ) {
		$sql = MyPDO::get();
		
		$initialX = (rand(0, 5) - 2)*2; 
		$initialY = (rand(0, 5) - 2)*2;
		$coords = Map::getPlanetSlot( $initialX, $initialY );
		if( $faction == "impériaux" )
			$natality = 11;
		else
			$natality = 12;
		
		$req = $sql->prepare('INSERT INTO planets VALUES(null, :name, :size, :population, :userId, :posX, :posY, :res1, :res2, :res3, :pr, :prod_res1, :prod_res2, :prod_res3, :prod_respr, :prod_time, :natality, :primary)');
		$result = $req->execute( array(
			':name' => $name,
			':size' => 100,
			':population' => 10,
			':userId' => $userId,
			':posX' => $coords[0],
			':posY' => $coords[1],
			':res1' => 900,
			':res2' => 600,
			':res3' => 100,
			':pr' => 0,
			':prod_res1' => 100,
			':prod_res2' => 60,
			':prod_res3' => 0,
			':prod_respr' => 0,
			':prod_time' => time(),
			':natality' => $natality,
			':primary' => $primary
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
		global $capital, $titaneMineId, $berylMineId, $hydrogeneExtractorId, $officeAreas,
				$titaneStorageId, $berylStorageId, $hydrogeneStorageId, $atelierId, $usineId, $researchCenterId;

		$pdo = MyPDO::get();
		
		$queryString = 'INSERT INTO BtoP
		(`buildingId`, `planetId`, `buildingLevel`, `buildingPopulation`)
		VALUES
		(:capital, :planetId, 1, 0), -- Centre de commande niveau 1
		(:officeAreas, :planetId, 1, 0), -- Habitation
		(:mine1BID, :planetId, 0, 0), -- Mines
		(:mine2BID, :planetId, 0, 0),
		(:mine3BID, :planetId, 0, 0), 
		(:atelierBID, :planetId, 0, 0), -- Atelier
		(:usineBID, :planetId, 0, 0), -- Usine
		(:stock1BID, :planetId, 0, 0), -- Entrepôts
		(:stock2BID, :planetId, 0, 0),
		(:stock3BID, :planetId, 0, 0),
		(:rechercheBID, :planetId, 0, 0); -- Centre de recherche
		';
		$queryData = array(
		':planetId' => $planetId,
		':capital' => $capital,
		':officeAreas' => $officeAreas,
		':mine1BID' => $titaneMineId,
		':mine2BID' => $berylMineId,
		':mine3BID' => $hydrogeneExtractorId,
		':atelierBID' => $atelierId,
		':usineBID' => $usineId,
		':stock1BID' => $titaneStorageId,
		':stock2BID' => $berylStorageId,
		':stock3BID' => $hydrogeneStorageId,
		':rechercheBID' => $researchCenterId
		);
		
		$query = $pdo->prepare($queryString);
		if( !$query->execute($queryData) )
		{
			// Gestion d'erreurs PDO
			$errorInfo = $query->errorInfo();
			
			$errorText = '<p data-alert class="error-box">';
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
	
	/**
	 * Vérifie si un changement de ressource a eu lieu (par seconde !).
	 * @param int dbTime
	 * @param int productionPerHour
	 * @return int benefit				:	retourne le gain en ressource à rajouter
	 */
	public function checkRessource( $dbTime, $productionPerHour, $bonus = 0 )
	{
		$productionPerSecond = round(($productionPerHour+$bonus) / 3600, 6);
		$differentTime = round(time() - $dbTime, 6);
		$benefit = $differentTime * $productionPerSecond;
		
		if( $benefit > 1 )
			return round($benefit);
		else
			return 0;
	}
	
	/**
	 * Modifie dans la base de données les ressources et le timer de la planète
	 * @param int planetId
	 * @param int newRes1, newRes2, newRes3, newResPR
	 */
	public function updateRessource( $planetId, $newRes1, $newRes2, $newRes3, $newResPR )
	{
		$newTime = time();
		$sql = MyPDO::get();

		$rq = $sql->prepare('UPDATE planets SET pl_prod_time=:newTime, pl_res1=:newRes1, pl_res2=:newRes2, pl_res3=:newRes3, pl_pr=:newResPR WHERE pl_id=:idPlanet');
        $data = array(':idPlanet' => (int)$planetId, ':newTime' => (int)$newTime, ':newRes1' => (int)$newRes1, ':newRes2' => (int)$newRes2, ':newRes3' => (int)$newRes3, ':newResPR' => (int)$newResPR );
		$rq->execute($data);
	}
	
	/**
	 * Modifie dans la base de données le taux de natalité d'une planète
	 * @param int planetId
	 * @param int newNatality
	 */
	public function updateNatality( $planetId, $newNatality )
	{
		$newTime = time();
		$sql = MyPDO::get();

		$rq = $sql->prepare('UPDATE planets SET pl_prod_time=:newTime, pl_natality=:newNatality WHERE pl_id=:idPlanet');
        $data = array(':idPlanet' => (int)$planetId, ':newTime' => (int)$newTime, ':newNatality' => (int)$newNatality );
		$rq->execute($data);
	}
	
	/**
	 * Modifie dans la base de données la population d'une planète
	 */
	public function updatePopulation( $planetId, $newPopulation )
	{
		$newTime = time();
		$sql = MyPDO::get();

		$rq = $sql->prepare('UPDATE planets SET pl_prod_time=:newTime, pl_population=:newPopulation WHERE pl_id=:idPlanet');
        $data = array(':idPlanet' => (int)$planetId, ':newTime' => (int)$newTime, ':newPopulation' => (int)$newPopulation );
		$rq->execute($data);	}
	
	/**
	 * Modifie dans la base de données les ressources et le timer de la planète
	 * @param int planetId
	 * @param int newProd
	 * @param int resId		:	ressources classées par position (1: titane, 2: béryl, 3: hydro, 4: pts rech)
	 */
	public function updateProduction( $planetId, $newProd, $resId )
	{
		$sql = MyPDO::get();

		if( $resId == 1 )
			$rq = $sql->prepare('UPDATE planets SET pl_prod_res1=:newProd WHERE pl_id=:planetId');
		if( $resId == 2 )
			$rq = $sql->prepare('UPDATE planets SET pl_prod_res2=:newProd WHERE pl_id=:planetId');
		if( $resId == 3 )
			$rq = $sql->prepare('UPDATE planets SET pl_prod_res3=:newProd WHERE pl_id=:planetId');
		if( $resId == 4 )
			$rq = $sql->prepare('UPDATE planets SET pl_prod_pr=:newProd WHERE pl_id=:planetId');
		
		$data = array(':planetId' => $planetId, ':newProd' => $newProd);
		$result = $rq->execute( $data );
	}
	
	/**
	 * Récupère la liste des structures en cours d'agrandisement
	 * @param int planetId
	 * @param int constructionType
	 */
	public function getPlanetBuildTime( $planetId, $constructionType = NULL )
	{
		$sql = MyPDO::get();
	
		if( !empty($constructionType) )
		{
			$req = $sql->prepare('SELECT * FROM ongoingBuilds WHERE gb_planetId=:planetId AND gb_buildType=:constructionType ORDER BY gb_endTime');
			$req->execute( array(':planetId' => $planetId, ':constructionType' => $constructionType) );
		}
		else
		{
			$req = $sql->prepare('SELECT * FROM ongoingBuilds WHERE gb_planetId=:planetId ORDER BY gb_endTime');
			$req->execute( array(':planetId' => $planetId) );
		}
		
		$array = array();
		while( $row = $req->fetch() )
		{
			$array[] = $row;
		}

		return $array;
	}
	
	/** Fonction qui ajoute à la liste des constructions en cours un bâtiment ou une tech ou un module ou un vaisseau ou une défense
	 * @param int $planetId				: id de la planète sélectionné
	 * @param int $userId				: id du joueur
	 * @param int $constructionType		: 1 => bâtiment, 2 => technologie, 3 => modules, 4 => vaisseaux
 	 * @param int $constructionId		: id du module sélectionné
	 * @param int $constructionTime		: temps de construction du module
	 * @param int $constructionQuantity	: nombre de module à "acheter"
	 */
	public function addBuildTime( $planetId, $userId, $constructionType, $constructionId, $constructionTime, $constructionQuantity )
	{
		// On check si une construction n'est pas en cours de construction
		$check = $this->getPlanetBuildTime( $planetId, $constructionType );
	
		$checkSize = count($check);
		if(!empty($check))
			$startTime = $check[$checkSize-1]['gb_endTime'];
		else
			$startTime = time();
		$endTime = $startTime + $constructionTime;
	
		$sql = MyPDO::get();

		$req = $sql->prepare('INSERT INTO ongoingBuilds VALUES(null, :type, :id, :quantity, :planetId, :userId, :startTime, :endTime)');
		$result = $req->execute( array(
			':type' => $constructionType,
			':id' => $constructionId,
			':quantity' => $constructionQuantity,
			':planetId' => $planetId,
			':userId' => $userId,
			':startTime' => $startTime,
			':endTime' => $endTime
			));
			
		if( !$result )
		{
			$errorInfo = $req->errorInfo();
			
			die("<h1 style='color: white'>Oups !</h1>
			<p  style='color: white'>
				Une erreur est survenue pendant l'ajout du module à la liste des constructions.<br />
				[".$errorInfo[0].' - '.$errorInfo[1].'] '.$errorInfo[2]."
			</p>");
		}
		else
			return 1;
	}
	
	/** Supprime de la table "ongoingbuilds" l'entré correspondant à une construction terminée.
	 * @param int $gbId		:	id de la construction
	 */
	public function delBuildTime( $gbId )
	{
		$sql = MyPDO::get();

		$rq = $sql->prepare('DELETE FROM ongoingBuilds WHERE gb_id=:gbId');
		$result = $rq->execute(array(':gbId' => $gbId));
		
		if( !$result ) throw new Exception('Une importante erreur est survenue : Impossible de supprimer le temps de construction de cette structure !');
		return 1;
	}
	
	/* Setters */
	
	public function setProdRes1Bonus( $value ) {
		$this->_prodRes1Bonus = $value;
	}
	public function setProdRes2Bonus( $value ) {
		$this->_prodRes2Bonus = $value;
	}
	public function setProdRes3Bonus( $value ) {
		$this->_prodRes3Bonus = $value;
	}
	public function setNatality( $value ) {
		$this->_planetNatality = $value;
	}
	
	/* Getters */
	
	public function getPlanetId() {
		return $this->_planetId;
	}
	public function getPlanetName() {
		return $this->_planetName;
	}
	public function getPosX() {
		return $this->_planetPosX;
	}
	public function getPosY() {
		return $this->_planetPosY;
	}
	public function getPopulation() {
		return $this->_planetPopulation;
	}
	public function getNatality() {
		return $this->_planetNatality;
	}
	public function getRes1() {
		return $this->_planetResource1;
	}
	public function getRes2() {
		return $this->_planetResource2;
	}
	public function getRes3() {
		return $this->_planetResource3;
	}
	public function getPR() {
		return $this->_planetPR;
	}
	public function getProdRes1Bonus() {
		return $this->_prodRes1Bonus;
	}
	public function getProdRes2Bonus() {
		return $this->_prodRes2Bonus;
	}
	public function getProdRes3Bonus() {
		return $this->_prodRes3Bonus;
	}
	public function getProdRes1() {
		return $this->_planetProduction1;
	}
	public function getProdRes2() {
		return $this->_planetProduction2;
	}
	public function getProdRes3() {
		return $this->_planetProduction3;
	}
	public function getProdResPR() {
		return $this->_planetProductionPR;
	}
	public function getProductionTime() {
		return $this->_planetProductionTime;
	}
}