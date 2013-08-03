<?php

/**
 * Classe Data. Centralise, analyse et modifie les données d'un compte.
 * @author Julien Bernard
 */
class Data {
	private $_user;
	private $_planet;
	private $_buildingsList = array();	// Liste des bâtiments
	
	/* Données de la planète */
	private $_prodRes1Bonus;
	private $_prodRes2Bonus;
	private $_prodRes3Bonus;
	private $_totalProdRes1;
	private $_totalProdRes2;
	private $_totalProdRes3;
	private $_totalProdResPR;
	
	/* Données sur l'utilisateur */
	private $_nbMessageNoRead;
	
	/* Configuration générale */
	private $_mapSize;					// [NE PAS METTRE A : 0][DEFAUT : 100] Taille de la carte
	private $_globalSpeedMult;			// [NE PAS METTRE A : 0][DEFAUT : 1] Multiplicateur de la vitesse globale du jeu (temps de construction, vitesse des flottes .etc)
	
	/**
	 * Constructeur de la classe.
	 */
	public function __construct( $viewBuildings, $viewTechnologies ) {
		$userData = User::getUserData( (int)$_SESSION['SpaceEngineConnected'] );
		$planetData = Planet::getPlanetData( (int)$_SESSION['ApocalySpaceCurrentPlanet'] );		
		$User = new User( (array)$userData );
		$Planet = new Planet( (array)$planetData );
		$this->_user = $User;
		$this->_planet = $Planet;
		
		/* On force le premier élément à null,
		   histoire d'avoir les indices du tableau correspondant aux id des bâtiments */
		$this->_buildingsList[] = null;
		if( $viewBuildings )
			for( $i = 1 ; $i < 12 ; $i++ )
				$this->_buildingsList[] = new Building( $i, $this->getPlanetId() );
		
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
		
		/* Configuration générale */
		$this->_mapSize = 100;
		$this->_globalSpeedMult = 1;
	}
	
	public function calculProdRes( $normal, $bonus ) {
		return $normal + $bonus;
	}
	
	/* Getters Data */
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
}