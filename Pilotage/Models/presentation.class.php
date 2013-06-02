<?php

/**
 * Classe banale, permet de récupèrer et de modifier un texte dans une base de donnée.
 * @author Julien Bernard
 *
 */
class Presentation
{
	private $_text;
	private $_id;
	
	/* Constructeur de la classe */
	public function __construct()
	{
		$this->_id = (int)1;
		$this->_text = (String)Presentation::getTextFromDatabase( $this->_id );
	}
	
	private function setText( $text ) {
		$this->_text = $text;
		return 1;
	}
	public function getText() {
		return $this->_text;
	}
	public function getId() {
		return $this->_id;
	}
	
	/**
	 * Récupère le texte présent dans la base de donnée selon $id.
	 * @param int $id
	 */
	public function getTextFromDatabase( $id ) {
		$sql = MyPDO::get();
		$result = (String)null;
		
		try {
			$req = $sql->prepare('SELECT text FROM presentation WHERE id=:id_text');
			$req->execute( array(':id_text' => (int)$id) );
			
			$row = $req->fetch();
			$result = $row['text'];				
		} catch( Exception $e ) {
			echo $e->getMessage();
		}			
			
		try {				
			Presentation::setText( $result );
			return $result;
		} catch( Exception $e ) {
			echo $e->getMessage();
		}
	}
	
	/**
	 * Modifie le texte présent dans la base de donnée par $text selon $id.
	 * @param String $text
	 * @param int $id
	 */
	public function setTextFromDatabase( $text, $id ) {
		$sql = MyPDO::get();
		
		try {
			$req = $sql->prepare('UPDATE presentation SET Text=:text WHERE id=:id_text');
			$req->execute( array('text' => (String)$text, ':id_text' => (int)$id) );
		} catch( Exception $e ) {
			echo $e->getMessage();
		}
		
		try {
			Presentation::setText( $text );
		} catch( Exception $e ) {
			echo $e->getMessage();
		}
	}
	
	/**
	 * Remplace $_text par le texte de présentation du moteur.
	 */
	public function retrieveText() {
		try {
			Presentation::setText( "<h2>Bienvenue sur le moteur de site web : Space Engine.</h2>
Créer à l'origine pour le projet <a href=\"http://www.apocalyspace.fr\">ApocalySpace</a>, ce moteur ce veut très simpliste et utilisable par n'importe quel développeurs, pros ou amateurs !

Ce moteur utilise entre autre :
- pattern MVC
- PHP5, en orienté objet
- PDO pour la connexion à la base de donnée
	
Vous souhaitez savoir comment a été développé ce moteur ? <a href=\"http://jibidev.fr/hackathon-1-24h-sur-apocalyspace/\">Lire l'article sur JibiDev.fr !</a>
	
<a href=\"index.php?p=1\">Lire la suite : Architecture du moteur</a>
				" );
		} catch( Exception $e ) {
			echo $e->getMessage();
		}
	}	
}