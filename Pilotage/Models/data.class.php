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
	private $_prodRes1Bonus;
	private $_prodRes2Bonus;
	private $_prodRes3Bonus;
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
		$userData = User::getUserData( (int)$_SESSION['SpaceEngineConnected'] );
		$planetData = Planet::getPlanetData( (int)$_SESSION['ApocalySpaceCurrentPlanet'] );		
		$User = new User( (array)$userData );
		$Planet = new Planet( (array)$planetData );
		$this->_user = $User;
		$this->_planet = $Planet;
		
		
		
		
		
		
		/*				/!\ IMPORTANT /!^
		 *
 		 * TODO : selon la faction, changez les gains (birthrateMultiplier, productionMultiplier, buildTimeMultiplier, attackPowerMultiplier, fleetSpeedMultiplier)
		 * GERER la prise en charge de ses variables !
		 *
		 */
		if( $this->_user->getFaction() == "imperiaux" )
		{
			$this->_birthrateMultiplier = 0.95;		/* -5% */
			$this->_productionMultiplier = 1;
			$this->_attackPowerMultiplier = 1.05;	/* +5% */
			$this->_buildTimeMultiplier = 1.05;		/* +5% */
		}
		else if( $this->_user->getFaction() == "republicains" )
		{
			$this->_birthrateMultiplier = 1.1;		/* +10% */
			$this->_productionMultiplier = 1.1;		/* +10% */
			$this->_attackPowerMultiplier = 1;
			$this->_buildTimeMultiplier = 1;
		}
		else
		{
			$this->_birthrateMultiplier = 1;		/* Neutre */
			$this->_productionMultiplier = 1;
			$this->_attackPowerMultiplier = 1;
			$this->_buildTimeMultiplier = 1;
		}
		
		/* Insère les données des bâtiments dans le dictionnaire $_buildingsList */
		if( $viewBuildings )
			for( $i = 1 ; $i < 12 ; $i++ )
				$this->_buildingsList[] = new Building( $i, $this->getPlanetId() );
				
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
				$this->_technologiesList[$i-1]->setCost( $countLevel, 3.2 );
			}
		}
		
		/* Données de la planète */
		$this->_prodRes1Bonus = 0;	// TO DO : ajouter la gestion de la techno production
		$this->_prodRes2Bonus = 0;
		$this->_prodRes3Bonus = 0;
		$this->_totalProdRes1 = (int)$this->getProdRes1() + (int)$this->getProdRes1Bonus();
		$this->_totalProdRes2 = (int)$this->getProdRes2() + (int)$this->getProdRes2Bonus();
		$this->_totalProdRes3 = (int)$this->getProdRes3() + (int)$this->getProdRes3Bonus();
		$this->_totalProdResPR = (int)$this->getProdPr();

		/* Données sur l'utilisateur */
		$this->_nbMessageNoRead = Message::countUserMessage( (int)$_SESSION['SpaceEngineConnected'] );
		
		/* Fichier des id des bâtiments */
		include("./config_id.php");
		
		/* Configuration générale */
		$officeAreasLevel = Building::getBuildingLevel($officeAreas, $this->getPlanetId());
		$capitalLevel = Building::getBuildingLevel($capital, $this->getPlanetId());
		
		$this->_mapSize = 100;
		$this->_globalSpeedMult = 1;
		$this->_managePopulationMax = ($officeAreasLevel * 40) * 1.4;	/* Taux arbitraire (40 par niveau, multiplicateur de 1.4) */
		
		/* Gestion de la natalité */
		$overcrowding = 0;
		/* Si il y a surpopulation */
		if( $this->_planet->getPopulation() > $this->_managePopulationMax )
			$overcrowding = round(($this->_planet->getPopulation() - $this->_managePopulationMax) + ($officeAreasLevel*2.5) * $this->_globalSpeedMult);
		
		$this->_natalityProduction = round(($capitalLevel * 12) + ($this->getTechnologyLevel($medicalResearchId, $this->getId()) * (0.05*12*$capitalLevel)) * $this->_birthrateMultiplier * $this->_globalSpeedMult - $overcrowding);				/* Taux arbitraire (12 par niveau) */
		/* Si le taux a changé, on modifie dans la base de données */
		if( $this->_natalityProduction != $this->getNatality() )
			$this->_planet->updateNatality( $this->getPlanetId(), $this->_natalityProduction );
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
		return $this->_prodRes1Bonus;
	}
	public function getProdRes2Bonus() {
		return $this->_prodRes2Bonus;
	}
	public function getProdRes3Bonus() {
		return $this->_prodRes3Bonus;
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
		return $this->_planet->getNatality();
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
		return $this->_planet->getProdRes1();
	}
	public function getProdRes2() {
		return $this->_planet->getProdRes2();
	}
	public function getProdRes3() {
		return $this->_planet->getProdRes3();
	}
	public function getProdPr() {
		return $this->_planet->getProdResPr();
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