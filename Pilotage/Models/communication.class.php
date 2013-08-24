<?php

abstract class Communication
{
	/** Fonction qui ajoute une communication
		*@param string $message	:	contenu du message
		*@param string $subject	:	sujet du message
		*@param string $preview	:	si c'est un réponse à une communnication, contient l'ancien message
		*@param int $recipientId:	id du joueur qui reçoit
		*@param int $senderId	:	id du joueur qui envoie
		Retourne 1 si valide, 0 si non
	*/
	public static function addCommunications( $message, $subject, $preview, $recipientId, $senderId )
	{
		/* Validation des paramètres */
		if( !is_string($message) || !is_string($subject) || !is_string($preview) || !is_numeric($recipientId) || !is_numeric($senderId) || empty($message) || $recipientId < 0 || $senderId < 0 )
			return false;
			
		$sql = MyPDO::get();
		
		$message .= '
		
		'.$preview.'';
		
		$req = $sql->prepare('INSERT INTO communications VALUES("", :senderId, :recipientId, :subject, :message, :sendTime, :view)');
		$result = $req->execute( array(
			':senderId' => (int)$senderId,
			':recipientId' => (int)$recipientId,
			':subject' => (String)$subject,
			':message' => (String)$message,
			':sendTime' => (int)time(),
			':view' => 0
			));
		// Si PDO renvoie une erreur
		if( !$result )
			return 0;
		else
			return 1;
	}
	
	/** Fonction qui récupère les communications du joueur
	 * @param int $userId	:	id du joueur
	 * Retourne un tableau de données contenant les informations des communications
	 */
	public static function getCommunications( $userId )
	{
		/* Validation des paramètres */
		if( !is_numeric($userId) || $userId < 0 )
			return false;
	
		$sql = MyPDO::get();
	
		$req = $sql->prepare('SELECT * FROM communications WHERE com_recipientId=:idUser ORDER BY com_sendTime DESC');
		$req->execute( array(':idUser' => (int)$userId));
		
		// Si PDO renvoie une erreur
		if( !$req->execute() )
			die("<h1 style='color: white'>Oups !</h1>
				<p style='color: white'>
					Une erreur est survenue lors de la récupération des communications.
				</p>");
		else {
			$array = array();
			
			// Boucle de toutes les informations contenant dans la table
			for( $i = 0 ; $row = $req->fetch() ; $i++ )
			{
				$array[$i] = $row;
				$array[$i]['com_username'] = getUsernameById( $row['com_senderId'] );
			}
			
			// Retourne un tableau de données
			return $array;
		}
	}
	
	/** Fonction qui récupère une communications par son id
	 * @param int $communicationId	:	id de la communication
	 * Retourne un tableau de données contenant les informations de la communication
	 */
	public static function getCommunication( $communicationId, $userId )
	{
		/* Validation des paramètres */
		if( !is_numeric($userId) || !is_numeric($communicationId) || $userId < 0 || $communicationId < 0 )
			return false;
			
		$sql = MyPDO::get();
	
		$req = $sql->prepare('SELECT * FROM communications WHERE com_id=:communicationId AND com_recipientId=:userId');
		$result = $req->execute( array(':communicationId' => (int)$communicationId, ':userId' => (int)$userId));
		
		// Si PDO renvoie une erreur
		if( !$result )
			die("<h1 style='color: white'>Oups !</h1>
				<p style='color: white'>
					Une erreur est survenue lors de la récupération de la communication.
				</p>");
		else {
		
			$array = array();
			$row = $req->fetch();
			$array[0] = $row;
			$array[0]['com_username'] = getUsernameById( $row['com_senderId'] );
			
			if( $row['com_recipientId'] != $userId )
			{
				return 0;
			}
			
			// Retourne un tableau de données
			return $array;
		}
	}
	
	/** Fonction qui récupère le pseudo du membre qui a envoyé la communication
	 * @param int $senderId	:	id du joueur envoyeur
	 * Retourne le pseudo du joueur
	 */
	public static function getUsernameById( $senderId )
	{
		/* Validation des paramètres */
		if( !is_numeric($senderId) || $senderId < 0 )
			return false;
			
		$sql = MyPDO::get();
	
		$req = $sql->prepare('SELECT username FROM users WHERE id=:idUser');
		$result = $req->execute( array(':idUser' => (int)$senderId));
		
		// Si PDO renvoie une erreur
		if( !$result )
			die("<h1 style='color: white'>Oups !</h1>
				<p style='color: white'>
					Une erreur est survenue lors de la récupération des communications.
				</p>");
		else {
			$row = $req->fetch();
			return $row['username'];
		}
	}
	
	/** Fonction qui change à 1 le champ com_view (si on ouvert la communication)
	 * @param int $communicationId	:	id de la communication
	 * Retourne 1 si valide, 0 si non
	 */
	public static function changeView( $communicationId )
	{
		/* Validation des paramètres */
		if( !is_numeric($communicationId) || $communicationId < 0 )
			return false;
			
		$sql = MyPDO::get();
	
		$req = $sql->prepare('UPDATE communications SET com_view=:change WHERE com_id=:communicationId');
		$result = $req->execute( array(':change' => (int)1, ':communicationId' => (int)$communicationId));
		
		// Si PDO renvoie une erreur
		if( !$result )
			die("<h1 style='color: white'>Oups !</h1>
				<p style='color: white'>
					Une erreur est survenue lors de la récupération des communications.
				</p>");
		else {
			return 1;
		}
	}
	
	/** Supprimer une communication par son id
	 * @param int $userId	:	id de l'utilisateur (vérification)
	 * @param int $id		:	id de la communication
	 * Retourne 1 si valide, 0 si non
	 */
	public static function deleteCommunication( $userId, $id )
	{
		/* Validation des paramètres */
		if( !is_numeric($userId) || !is_numeric($id) || $userId < 0 || $id < 0 )
			return false;
			
		$sql = MyPDO::get();

		$rq = $sql->prepare('DELETE FROM communications WHERE com_id=:deleteId AND com_recipientId=:userId');
		$result = $rq->execute(array(':deleteId' => $id, ':userId' => $userId));
		
		if( !$result )
			return 0;
		else
			return 1;
	}
	
	/** Retourne le nombre de message non-lu par le joueur
	 *@param int $id	: id du joueur
	 */
	public static function countUserMessage( $id )
	{
		/* Validation des paramètres */
		if( !is_numeric($id) ||  $id < 0 )
			return false;
	
		$sql = MyPDO::get();

		$rq = $sql->prepare('SELECT com_recipientId FROM communications WHERE com_recipientId=:idUser AND com_view=:status');
		$data = array(':idUser' => (int)$id, ':status' => (int)0);
		$rq->execute($data);

		// On retourne le nombre de message non-lu compté
		return $rq->rowCount();
	}
	
}