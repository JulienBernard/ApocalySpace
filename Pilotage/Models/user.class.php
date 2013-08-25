<?php

class User
{
	private $_id;
	private $_username;
	private $_faction;
	
	/* Constructeur de la classe */
	public function __construct( $data ) {
		$this->_id = (int)$data['id'];
		$this->_username = (string)$data['username'];
		$this->_faction = (string)$data['factionName'];
	}
	
	/**
	 * Vérifie si l'username et le password sont exactes. 
	 * @param String username
	 * @param String password
	 * @return userID or 0 (error)
	 */
	public static function checkUserAccountMatch( $username, $password ) {
		
		/* Validation des paramètres */
		if( !is_string($username) || !is_string($password) || empty($username) || empty($password) )
			return false;
		
		$sql = MyPDO::get();
		
		$rq = $sql->prepare('SELECT id FROM users WHERE username=:username AND passwordHash=:password');
		$data = array(':username' => (String)$username, ':password' => (String)md5('apocalyspace'.$password.'aime42'));
		$rq->execute($data);

		if( $rq->rowCount() != 0)
		{
			$row = $rq->fetch();
			return (int)$row['id'];
		}
		else
			return 0;
	}
	
	/**
	 * Recupère les données utilisateur depuis la base de données.
	 * @param int userId
	 * @return array or 0 (error)
	 */
	public static function getUserData( $userId ) {
		
		/* Validation des paramètres */
		if( !is_numeric($userId) || $userId < 0 )
			return false;
		
		$sql = MyPDO::get();

		$rq = $sql->prepare('SELECT id, username, factionName FROM users WHERE id=:idUser');
        $data = array(':idUser' => $userId );
		$rq->execute($data);
		
		if( $rq->rowCount() == 0 ) throw new Exception('Une importante erreur est survenue : Impossible de récupérer les données de cet utilisateur !');
		$row = $rq->fetch();
		return $row;
	}
	
	/**
	 * Vérifie si l'username existe dans la bdd.
	 * @param String username
	 */
	public static function checkUsernameExist( $username ) {
		
		/* Validation des paramètres */
		if( !is_string($username) || empty($username) )
			return false;
			
		$sql = MyPDO::get();
		$rq = $sql->prepare('SELECT id FROM users WHERE username=:username');
		$data = array(':username' => (String)$username);
		$rq->execute($data);
		
		if( $rq->rowCount() != 0)
			return true;
		return false;
	}
	
	/**
	 * Vérifie si l'username est supérieur à 4 caractères et inférieur à 20.
	 * @param String username
	 */
	public static function checkUsernameLength( $username ) {
		if( strlen($username) < 4 || strlen($username) > 20 )
			return false;
		return true;
	}
	
	/**
	 * Vérifie si le password est supérieur à 6 caractères.
	 * @param String password
	 */
	public static function checkPasswordLength( $password ) {
		if( strlen($password) < 6 )
			return false;
		return true;
	}
	
	/**
	 * Enregistre le nouvel utilisateur dans la base de donnée.
	 * @param String username
	 * @param String password
	 * @param String faction
	 * return int lastInsertId	Retourne le dernier ID inséré dans la bdd, ici l'user id !
	 */
	public static function addUser( $username, $password, $faction ) {
		
		/* Validation des paramètres */
		if( !is_string($username) || !is_string($password) || !is_string($faction) || empty($username) || empty($password) || empty($faction)  )
			return false;
		
		$sql = MyPDO::get();
		$req = $sql->prepare('INSERT INTO users VALUES("", :username, :password, :faction)');
		$result = $req->execute( array(
			':username' => $username,
			':password' => md5('apocalyspace'.$password.'aime42'),
			':faction' => $faction
		));
		
		if( $result )
			return $sql->lastInsertId();
		return 0;
	}
	
	/**
	 * Ajoutes les données du nouveau joueur (modules, bâtiments, technologies ..)
	 * @param inr userId
	 * return int userId	Retourne l'id de l'utilisateur.
	 */
	public static function addDataForUser( $userId ) {
		$sql = MyPDO::get();
		
		/* Modules */
		$req = $sql->prepare('INSERT INTO MtoU VALUES
			(1, :userId, 0, 0),
			(2, :userId, 0, 0),
			(3, :userId, 0, 0),
			(4, :userId, 0, 0),
			(5, :userId, 0, 0),
			(6, :userId, 0, 0),
			(7, :userId, 0, 0),
			(8, :userId, 1, 0),
			(9, :userId, 1, 0),
			(10, :userId, 1, 0),
			(11, :userId, 1, 0),
			(12, :userId, 2, 0),
			(13, :userId, 2, 0),
			(14, :userId, 2, 0),
			(15, :userId, 2, 0),
			(16, :userId, 3, 0),
			(17, :userId, 3, 0),
			(18, :userId, 3, 0),
			(19, :userId, 4, 0),
			(20, :userId, 4, 0),
			(21, :userId, 5, 0),
			(22, :userId, 5, 0),
			(23, :userId, 5, 0),
			(24, :userId, 5, 0),
			(25, :userId, 6, 0),
			(26, :userId, 6, 0),
			(27, :userId, 7, 0),
			(28, :userId, 7, 0),
			(29, :userId, 7, 0),
			(30, :userId, 7, 0);'
		);
		$result = $req->execute(array(':userId' => $userId));
		if( !$result )
			return 0;
		
		/* Technologies */
		$req = $sql->prepare('INSERT INTO TtoU (userId, techId, techLevel) VALUES
            (:userId, 1, 0),
			(:userId, 2, 0),
			(:userId, 3, 0),
			(:userId, 4, 0),
			(:userId, 5, 0),
			(:userId, 6, 0),
			(:userId, 7, 0),
			(:userId, 8, 0),
			(:userId, 9, 0);'
		);
		$result = $req->execute(array(':userId' => $userId));
		if( $result )
			return $userId;
		return 0;
	}
	
	/**
	 *	Retourne le nombre de joueur
	 */
	public static function countPlayer() {
		$sql = MyPDO::get();
		$req = $sql->prepare('SELECT id FROM users');
		$req->execute();
		return $req->rowCount();
	}
	
	public function getId() {
		return $this->_id;
	}
	public function getUsername() {
		return $this->_username;
	}
	public function getFaction() {
		return $this->_faction;
	}
}