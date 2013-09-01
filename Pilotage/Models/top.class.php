<?php

class Top
{	
	private $_playerList = array();		// Informations sur les joueurs
	private $_valueList = array();		// "Points" selon classement (niveau tech, res militaire, nb pop)

	/* Constructeur de la classe */
	public function __construct( $see = "demography" ) {
		/* Compte les niveaux des technologies des joueurs */
		if( $see == "technology" )
		{
		
		}
		/* Compte le ressources dépensés en vaisseaux construit par les joueurs*/
		else if( $see == "military" )
		{
		
		}
		/* Compte la population des joueurs */
		else 
		{
		
		}
	}
}