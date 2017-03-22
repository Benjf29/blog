<?php

// Renvoie la liste de tous les billets, tri�s par identifiant d�croissant
function getBillet($idBillet) {
	$bdd = getBdd ();
	$billet = $bdd->prepare ( 'select BIL_ID as id, BIL_DATE as date,' . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET' . ' where BIL_ID=?' );
	$billet->execute ( array (
			$idBillet 
	) );
	if ($billet->rowCount () == 1)
		return $billet->fetch (); // Acc�s � la premi�re ligne de r�sultat
	else
		throw new Exception ( "Aucun billet ne correspond � l'identifiant '$idBillet'" );
}
function getBillets() {
	$bdd = getBdd ();
	$billets = $bdd->query ( 'select BIL_ID as id, BIL_DATE as date,' . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET' . ' order by BIL_ID desc' );
	return $billets;
}
// Renvoie la liste des commentaires associ�s � un billet
function getCommentaires($idBillet) {
	$bdd = getBdd ();
	$commentaires = $bdd->prepare ( 'select COM_ID as id, COM_DATE as date,' . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE' . ' where BIL_ID=?' );
	$commentaires->execute ( array (
			$idBillet 
	) );
	return $commentaires;
}

// Effectue la connexion � la BDD
// Instancie et renvoie l'objet PDO associ�
function getBdd() {
	$bdd = new PDO ( 'mysql:host=localhost;dbname=blog;charset=utf8', 'ts1', 'ts1', array (
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
	) );
	return $bdd;
}