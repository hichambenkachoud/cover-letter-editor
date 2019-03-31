<?php
/**
* 
*/
class RecruteurManager
{
	protected $_db;

	function __construct($db)
	{
		$this->setDb($db);
	}

	public function addRecruteur(Recruteur $recruteur)
	{
		
		$nom 			=	htmlspecialchars( $recruteur->getNom());
		$civilite 		=	htmlspecialchars( $recruteur->getCivilite());
		$prenom 		=	htmlspecialchars( $recruteur->getPrenom());
		$addresse 		=	htmlspecialchars( $recruteur->getAddresse());
		$codePostale 	=	htmlspecialchars( $recruteur->getCodePostale());
		$ville 			=	htmlspecialchars( $recruteur->getVille());
		$pays 			=	htmlspecialchars( $recruteur->getPays());
		$nomCompany 	=	htmlspecialchars( $recruteur->getNomCompany());
		

		$requete = $this->_db->exec("INSERT INTO recruteur (nom_recruteur, prenom_recruteur, civilite_recruteur, company_recruteur, addresse_recruteur, ville_recruteur, pays_recruteur, codePostale_recruteur) 
			VALUES ('$nom', '$prenom', '$civilite' , '$nomCompany', '$addresse', '$ville', '$pays', '$codePostale')");


	}

	public function delete(Recruteur $recruteur)
	{
		$requete = $this->_db->exec('DELETE FROM recruteur WHERE id = '.$recruteur->getId());
	}

	public function getLastRecruteurAdd()
	{
		
		$requete = $this->_db->query('SELECT  * FROM recruteur order by id_recruteur DESC limit 1');
		$id_recruteur = $requete->fetch(PDO::FETCH_ASSOC);
		return $id_recruteur['id_recruteur'];
	}

	public function get($id)
	{

		$requete = $this->_db->prepare('SELECT * FROM recruteur WHERE id_recruteur = :id');
		$requete->bindParam(':id',$id);
		$requete->execute();
		$recruteur = $requete->fetch(PDO::FETCH_ASSOC);
		return $recruteur;
	}


	public function getList()
	{
		$recruteurs = array();
		$requete = $this->_db->query('SELECT * FROM recruteur');

		while ($perso = $requete->fetch(PDO::FETCH_ASSOC)) {
			$recruteurs[] = $perso;
		}

		return $recruteurs;
	}

	public function update(Recruteur $recruteur)

	{	
		$id 			= 	htmlspecialchars( $recruteur->getId());
		$nom 			=	htmlspecialchars( $recruteur->getNom());
		$civilite 		=	htmlspecialchars( $recruteur->getCivilite());
		$prenom 		=	htmlspecialchars( $recruteur->getPrenom());
		$addresse 		=	htmlspecialchars( $recruteur->getAddresse());
		$codePostale 	=	htmlspecialchars( $recruteur->getCodePostale());
		$ville 			=	htmlspecialchars( $recruteur->getVille());
		$pays 			=	htmlspecialchars( $recruteur->getPays());
		$nomCompany 	=	htmlspecialchars( $recruteur->getNomCompany());
		

		$requete = $this->_db->exec("UPDATE recruteur SET nom_recruteur = '$nom', prenom_recruteur = '$prenom', civilite_recruteur = '$civilite', company_recruteur = '$nomCompany', addresse_recruteur = '$addresse', ville_recruteur = '$ville', pays_recruteur = '$pays', codePostale_recruteur = '$codePostale' WHERE id_recruteur = '$id'");

		return $reponse = 'ok';
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>