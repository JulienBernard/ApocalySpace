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
		$sql = MyPDO::get();
		
		$message .= '
		
		'.$preview.'';
		
		$req = $sql->prepare('INSERT INTO communications VALUES("", :senderId, :recipientId, :subject, :message, :sendTime, :view)');
		$result = $req->execute( array(
			':senderId' => $senderId,
			':recipientId' => $recipientId,
			':subject' => $subject,
			':message' => $message,
			':sendTime' => time(),
			':view' => 0
			));
		// Si PDO renvoie une erreur
		if( !$result )
			return 0;
		else
			return 1;
	}
	
}