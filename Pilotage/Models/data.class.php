<?php

/**
 * Classe Data. Centralise, analyse et modifie les données d'un compte.
 * @author Julien Bernard
 */
class Data {
	private $_user;
	private $_planet;
	private $_buildingsList = array();		// Liste des bâtiments
	private $_technologiesList = array();	// Liste des technologies
	
	/* Données de la planète */
	private $_totalProdRes1;
	private $_totalProdRes2;
	private $_totalProdRes3;
	private $_totalProdResPR;
	private $_stockMaxRes1;
	private $_stockMaxRes2;
	private $_stockMaxRes3;
	
	/* Données sur l'utilisateur */
	private $_nbMessageNoRead;
	
	/* Configuration générale */
	private $_mapSize;					// [NE PAS METTRE A : 0][DEFAUT : 100] Taille de la carte
	private $_globalSpeedMult;			// [NE PAS METTRE A : 0][DEFAUT : 1] Multiplicateur de la vitesse globale du jeu (temps de construction, vitesse des flottes .etc)
	private $_managePopulationMax;
	private $_natalityProduction;
		/* Valeur selon faction */
		private $_birthrateMultiplier;
		private $_productionMultiplier;
		private $_attackPowerMultiplier;
		private $_buildTimeMultiplier;
	
	/**
	 * Constructeur de la classe.
	 * Charge les donnés selon les arguments disponible (bâtiments et technologies)
	 */
	public function __construct( $viewBuildings, $viewTechnologies ) {
	
		/* Validation des SESSIONS */
		if( !is_numeric($_SESSION['SpaceEngineConnected']) || !is_numeric($_SESSION['ApocalySpaceCurrentPlanet']) || $_SESSION['SpaceEngineConnected'] < 0 || $_SESSION['ApocalySpaceCurrentPlanet'] < 0 )
			return false;
	
		$userData = User::getUserData( (int)$_SESSION['SpaceEngineConnected'] );
		$planetData = Planet::getPlanetData( (int)$_SESSION['ApocalySpaceCurrentPlanet'] );		
		$User = new User( (array)$userData );
		$Planet = new Planet( (array)$planetData );
		$this->_user = $User;
		$this->_planet = $Planet;

		if( $this->_user->getFaction() == "impériaux" )
		{
			$this->_birthrateMultiplier = 0.95;
			$this->_productionMultiplier = 1;
			$this->_attackPowerMultiplier = 1.1;
			$this->_buildTimeMultiplier = 1;
		}
		else if( $this->_user->getFaction() == "républicains" )
		{
			$this->_birthrateMultiplier = 1.05;
			$this->_productionMultiplier = 1;
			$this->_attackPowerMultiplier = 1;
			$this->_buildTimeMultiplier = 1.05;
		}
		else
		{
			$this->_birthrateMultiplier = 1;
			$this->_productionMultiplier = 1.1;
			$this->_attackPowerMultiplier = 1;
			$this->_buildTimeMultiplier = 1.05;
		}
		
		/* Configuration générale */
		$this->_mapSize = 100;
		$this->_globalSpeedMult = 2;
		
		/* Insère les données des bâtiments dans le dictionnaire $_buildingsList */
		if( $viewBuildings )
			for( $i = 1 ; $i < 12 ; $i++ )
				$this->_buildingsList[] = new Building( $i, $this->getPlanetId(), $this->_buildTimeMultiplier, $this->_globalSpeedMult );
				
		/* Insère les données des technologies dans le dictionnaire $_technologiesList */
		if( $viewTechnologies )
		{
			$countLevel = 0;
			for( $i = 1 ; $i < 10 ; $i++ )
			{
				$this->_technologiesList[] = new Technology( $i, $this->_user->getId() );
				$countLevel += $this->_technologiesList[$i-1]->getLevel();
			}
			for( $i = 1 ; $i < 10 ; $i++ )
			{
				$this->_technologiesList[$i-1]->setCost( $countLevel, 3.2, $this->_globalSpeedMult );
			}
		}
		
		/* Fichier des id des bâtiments */
		include("./config_id.php");
		
		/* Données de la planète */
		$productionTechnologyLevel = $this->getTechnologyLevel($mineProductionResearchId, $this->getId());
		
		/* Le joueur n'est pas en surpopulation maximum : il a droit aux bonus technologiques ! */
		if( $this->getNatality() != 0 )
		{
			$this->_planet->setProdRes1Bonus( round(((int)$this->getProdRes1()*(5*$productionTechnologyLevel)/100)) );
			$this->_planet->setProdRes2Bonus( round(((int)$this->getProdRes2()*(5*$productionTechnologyLevel)/100)) );
			$this->_planet->setProdRes3Bonus( round(((int)$this->getProdRes3()*(5*$productionTechnologyLevel)/100)) );
		}
		$this->_totalProdRes1 = round(((int)$this->getProdRes1() + (int)$this->getProdRes1Bonus()) * $this->_productionMultiplier);
		$this->_totalProdRes2 = round(((int)$this->getProdRes2() + (int)$this->getProdRes2Bonus()) * $this->_productionMultiplier);
		$this->_totalProdRes3 = round(((int)$this->getProdRes3() + (int)$this->getProdRes3Bonus()) * $this->_productionMultiplier);
		$this->_totalProdResPR = round((int)$this->getProdPr());
		$officeAreasLevel = Building::getBuildingLevel($officeAreas, $this->getPlanetId());
		$capitalLevel = Building::getBuildingLevel($capital, $this->getPlanetId());
		$this->_managePopulationMax = $this->_planet->_managePopulationMax;	/* Taux arbitraire (50 par niveau, multiplicateur de 1.4) */

		/* Gestion de la natalité */
		$overcrowding = 0;
		$difPopulation = $this->_planet->getPopulation() - $this->_managePopulationMax;
		
		/* Si il y a surpopulation */
		if( $this->_planet->getPopulation() > $this->_managePopulationMax )
		{
			if( $difPopulation >= 100 )
				$this->_natalityProduction = 0;
			else if ( $difPopulation > 50 ) 
			{
				$overcrowding = round(($this->_planet->getPopulation() - $this->_managePopulationMax) + ($officeAreasLevel*12) * $this->_globalSpeedMult);
				$this->_natalityProduction = round(($capitalLevel * 10) + ($this->getTechnologyLevel($medicalResearchId, $this->getId()) * (0.05*12*$capitalLevel)) * $this->_globalSpeedMult - $overcrowding) * $this->_birthrateMultiplier;
			}
			else
			{
				$overcrowding = round(($this->_planet->getPopulation() - $this->_managePopulationMax) + ($officeAreasLevel*11) * $this->_globalSpeedMult);
				$this->_natalityProduction = round(($capitalLevel * 10) + ($this->getTechnologyLevel($medicalResearchId, $this->getId()) * (0.05*12*$capitalLevel)) * $this->_globalSpeedMult - $overcrowding) * $this->_birthrateMultiplier;
			}
		}
		else
			$this->_natalityProduction = round(($capitalLevel * 10) + ($this->getTechnologyLevel($medicalResearchId, $this->getId()) * (0.05*12*$capitalLevel)) * $this->_globalSpeedMult - $overcrowding) * $this->_birthrateMultiplier;				/* Taux arbitraire (10 par niveau) */
		
		if( $this->_natalityProduction < 0 )
			$this->_natalityProduction = 0;
	
		/* Si le taux a changé, on modifie dans la base de données */
		if( $this->_natalityProduction != $this->getNatality() )
		{
			$this->_planet->updateNatality( $this->getPlanetId(), $this->_natalityProduction*$this->_globalSpeedMult );
			$this->_planet->setNatality( $this->_natalityProduction );
		}
		
		$this->_nbMessageNoRead = Communication::countUserMessage( $this->_user->getId() );
	}
	
	/**
	 * Recupère le niveau d'une technologie depuis la base de données.
	 * CETTE FONCTION EST PRESENTE ICI POUR DES GAINS DE PERFORMANCE : inclure la classe Technology à chaque page serait plus couteux que de faire la fonction ici !
	 *
	 * @param int technologyId
	 * @param int userId
	 * @return int or throw an exception!
	 */
	private function getTechnologyLevel( $technologyId, $userId ) {
		
		/* Validation des paramètres */
		if( !is_numeric($technologyId) || !is_numeric($userId) || $technologyId < 0 || $userId < 0 )
			return false;
	
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT techLevel FROM TtoU WHERE techId=:technologyId AND userId=:userId');
		$data = array(':technologyId' => (int)$technologyId, ':userId' => (int)$userId);
		$rq->execute($data);

		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer le niveau de cette technologie !');
		$row = $rq->fetch();
		return $row["techLevel"];
	}
	
	/*
	 * Simple fonction de calcul :)
	 */
	public function calculProdRes( $normal, $bonus ) {
		return $normal + $bonus;
	}
	
	/* Getters Data */
	public function getUser() {
		return $this->_user;
	}
	public function getPlanet() {
		return $this->_planet;
	}
	public function getProdRes1Bonus() {
		return $this->_planet->getProdRes1Bonus() * $this->_globalSpeedMult;
	}
	public function getProdRes2Bonus() {
		return $this->_planet->getProdRes2Bonus() * $this->_globalSpeedMult;
	}
	public function getProdRes3Bonus() {
		return $this->_planet->getProdRes3Bonus() * $this->_globalSpeedMult;
	}
	public function getTotalProdRes1() {
		return $this->_totalProdRes1;
	}
	public function getTotalProdRes2() {
		return $this->_totalProdRes2;
	}
	public function getTotalProdRes3() {
		return $this->_totalProdRes3;
	}
	public function getTotalProdResPR() {
		return $this->_totalProdResPR;
	}
	public function getNbMessageNoRead() {
		return $this->_nbMessageNoRead;
	}
	public function getBuildingsList( $type = null ) {
		if( $type != null )
			return $this->sortBuildingListByType( $this->_buildingsList, $type );
		else
			return $this->_buildingsList;
	}
	public function getTechnologiesList() {
		return $this->_technologiesList;
	}
	
	/* Getters User */
	public function getId() {
		return $this->_user->getId();
	}
	public function getUsername() {
		return $this->_user->getUsername();
	}
	public function getFaction() {
		return $this->_user->getFaction();
	}
	
	/* Getters Planet */
	public function getPlanetId() {
		return $this->_planet->getPlanetId();
	}
	public function getPlanetName() {
		return $this->_planet->getPlanetName();
	}
	public function getPosX() {
		return $this->_planet->getPosX();
	}
	public function getPosY() {
		return $this->_planet->getPosY();
	}
	public function getPopulation() {
		return $this->_planet->getPopulation();
	}
	public function getNatality() {
		return $this->_planet->getNatality() * $this->_globalSpeedMult;
	}
	public function getManagePopulationMax() {
		return $this->_managePopulationMax;
	}
	public function getRes1() {
		return $this->_planet->getRes1();
	}
	public function getRes2() {
		return $this->_planet->getRes2();
	}
	public function getRes3() {
		return $this->_planet->getRes3();
	}
	public function getPR() {
		return $this->_planet->getPR();
	}
	public function getProdRes1() {
		return $this->_planet->getProdRes1() * $this->_globalSpeedMult;
	}
	public function getProdRes2() {
		return $this->_planet->getProdRes2() * $this->_globalSpeedMult;
	}
	public function getProdRes3() {
		return $this->_planet->getProdRes3() * $this->_globalSpeedMult;
	}
	public function getProdPr() {
		return $this->_planet->getProdResPr() * $this->_globalSpeedMult;
	}
	public function getProductionTime() {
		return $this->_planet->getProductionTime();
	}
	
	/** Tri une liste de bâtiment par type.
	 * @param array $array	:	liste de tous les bâtiments 
	 * @param int $type		:	id du type de bâtiment à trier
	 * @return array		:	Retourne la liste de bâtiment triée
	 */
	public function sortBuildingListByType( $array, $type )
	{
		/* Validation des paramètres */
		if( !is_array($array) || !is_numeric($type) || empty($array) || $type < 0 )
			return false;
	
		$newArray = array();
		for( $i = 0 ; $i < count($array) ; $i++ )
		{
			if( $array[$i]->getType() == $type)
				$newArray[] = $array[$i];
		}
		return $newArray;
	}
	
	/** Récupère le nombre d'habitants déjà administrés.
	 * @param int $buildingId	:	id du bâtiment en cours de modification (gestion population)
	 * @return int				:	Somme de tous les habitants déjà administrés
	 * Note						:	superNomDeLaMortQuiTue!
	*/
	public function getNumberOfPopulationWhoAreManagedNow( $buildingId = null )
	{
		/* Validation des paramètres */
		if( (!is_numeric($buildingId) && $buildingId != null)  || $buildingId < 0 )
			return false;
	
		$array = $this->getBuildingsList();
		$sum = 0;

		for( $i = 0 ; $i < count($array) ; $i++ )
		{
			$sum += $array[$i]->getPopulation();
		}
		
		if( !empty($buildingId) )
			$sum -= $array[$buildingId-1]->getPopulation();
		
		return $sum;
	}
}