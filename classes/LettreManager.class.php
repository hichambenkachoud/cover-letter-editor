<?php
/**
* 
*/
class LettreManager
{
	protected $_db;

	function __construct($db)
	{
		$this->setDb($db);
	}

	public function addLettre(lettre $lettre)
	{
		
		$idlettre 			=	htmlspecialchars( $lettre->getIdLettre());
		$object 			=	htmlspecialchars( $lettre->getObjet());
		$ville 				=	htmlspecialchars( $lettre->getVille());
		$date 				=	htmlspecialchars( $lettre->getDate());
		$paragOuverture 	=	htmlspecialchars( $lettre->getParagOuverture());
		$paragCorps 		=	htmlspecialchars( $lettre->getParagCorps());
		$paragFermeture 	=	htmlspecialchars( $lettre->getParagFermeture());
		$paragPolitisse 	=	htmlspecialchars( $lettre->getParagPolitisse());
		$id_user 			=	htmlspecialchars( $lettre->getIdUser());
		$id_recruteur 		=	htmlspecialchars( $lettre->getIdRecruteur());
		

		$requete = $this->_db->exec("INSERT INTO lettre (objet_lettre, ville_lettre, date_lettre, paragOuverture, paragCorps, paragFermeture, paragPolitisse, id_user,id_recruteur) 
			VALUES 
			('$object', '$ville', '$date', '$paragOuverture' , '$paragCorps', '$paragFermeture', '$paragPolitisse', '$id_user', '$id_recruteur')");

	}



	public function delete(lettre $lettre)
	{
		$requete = $this->_db->exec('DELETE FROM lettre WHERE id = '.$lettre->getIdLettre());
	}

	public function getLettre($id)
	{

		$requete = $this->_db->prepare('SELECT * FROM lettre WHERE id_lettre = :id');
		$requete->bindParam(':id',$id);
		$requete->execute();
		$lettre = $requete->fetch(PDO::FETCH_ASSOC);
		return $lettre;
	}

	public function getLettreParUserEtRecruteur($idUser, $idRecruteur)
	{
		$requete = $this->_db->prepare('SELECT * FROM lettre WHERE id_user = :idUser and id_recruteur = :idRecruteur');
		$requete->execute(array(':idUser'	=> $idUser, ':idRecruteur' => $idRecruteur));
		$id_lettre = $requete->fetch(PDO::FETCH_ASSOC);
		return $id_lettre;
	}

	public function getLettreParUser($idUser)
	{
		$requete = $this->_db->prepare('SELECT * FROM lettre WHERE id_user = :idUser');
		$requete->execute(array(':idUser'	=> $idUser));
		$id_lettre = $requete->fetch(PDO::FETCH_ASSOC);
		return $id_lettre['id_recruteur'];
	}

	public function update(Lettre $lettre)
	{	
		$idlettre 			=	htmlspecialchars( $lettre->getIdLettre());
		$object 			=	htmlspecialchars( $lettre->getObjet(),ENT_QUOTES);
		$ville 				=	htmlspecialchars( $lettre->getVille());
		$date 				=	htmlspecialchars( $lettre->getDate());
		$paragOuverture 	=	htmlspecialchars( $lettre->getParagOuverture(),ENT_QUOTES);
		$paragCorps 		=	htmlspecialchars( $lettre->getParagCorps(),ENT_QUOTES);
		$paragFermeture 	=	htmlspecialchars( $lettre->getParagFermeture(),ENT_QUOTES);
		$paragPolitisse 	=	htmlspecialchars( $lettre->getParagPolitisse(),ENT_QUOTES);
		$id_user 			=	htmlspecialchars( $lettre->getIdUser());
		$id_recruteur 		=	htmlspecialchars( $lettre->getIdRecruteur());


		 $date=date_create($date);
		$date= date_format($date,"d - m - Y");
		

		$requete = $this->_db->exec("UPDATE lettre SET objet_lettre = '$object', ville_lettre = '$ville', date_lettre = '$date', paragOuverture = '$paragOuverture', paragCorps = '$paragCorps', paragFermeture = '$paragFermeture', paragPolitisse = '$paragPolitisse', id_user = '$id_user', id_recruteur = '$id_recruteur' WHERE id_lettre = '$idlettre'");

		return $reponse = 'ok';
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>