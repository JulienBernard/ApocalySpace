function redirection( seconde, url )
{
	micro = seconde * 1000;	// La gestion du temps en JS ce fait par micro seconde
	self.setTimeout("self.location.href = '" + url + "';", micro) ;	// Redirection vers la page souhaitée
}