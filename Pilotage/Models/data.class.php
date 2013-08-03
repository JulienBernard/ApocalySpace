<?php

/**
 * Classe Data. Centralise, analyse et modifie les données d'un compte.
 * @author Julien Bernard
 */
class Data {
	private $_user;
	private $_planet;
	
	private $_prodRes1Bonus;
	private $_prodRes2Bonus;
	private $_prodRes3Bonus;
	private $_totalProdRes1;
	private $_totalProdRes2;
	private $_totalProdRes3;
	private $_totalProdResPR;
	
	private $_nbMessageNoRead;
	
	/**
	 * Constructeur de la classe.
	 */
	public function __construct() {
		$userData = User::getUserData( (int)$_SESSION['SpaceEngineConnected'] );
		$planetData = Planet::getPlanetData( (int)$_SESSION['ApocalySpaceCurrentPlanet'] );		
		$User = new User( (array)$userData );
		$Planet = new Planet( (array)$planetData );
		
		$this->_user = $User;
		$this->_planet = $Planet;
		$this->_prodRes1Bonus = 0;	// TO DO : ajouter la gestion de la techno production
		$this->_prodRes2Bonus = 0;
		$this->_prodRes3Bonus = 0;
		$this->_totalProdRes1 = $this->getProdRes1() + $this->getProdRes1Bonus();
		$this->_totalProdRes2 = $this->getProdRes2() + $this->getProdRes2Bonus();
		$this->_totalProdRes3 = $this->getProdRes3() + $this->getProdRes3Bonus();
		$this->_totalProdResPR = $this->getProdPr();
		
		$this->_nbMessageNoRead = Message::countUserMessage( (int)$_SESSION['SpaceEngineConnected'] );
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