<?php

class Message
{

	/* Constructeur de la classe */
	public function __construct() {

	}

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