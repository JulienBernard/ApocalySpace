<?php

class User
{
	private $_login;
	
	/* Constructeur de la classe */
	public function __construct( $login )
	{
		$this->_login = $login;
	}
	
	public function getLogin()
	{
		return $this->_login;
	}
	
	/**
	 * Vérifie si le login et le password sont exactes. Attention, dans cet exemple le mdp est en clair (bouhhhh ^^) 
	 * @param String login
	 * @param String password
	 */
	public static function checkConnection( $login, $password ) {
		if( (String)$login == "test" && (String)$password == "test" )
			return 1;
		else
			return 0;
	}
	
}