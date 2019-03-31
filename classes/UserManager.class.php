<?php

/**
* 
*/
class UserManager
{
	protected $_db;

	function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}

	public function addUser(User $user)
	{
		
		$nom 			=	htmlspecialchars( $user->getNom());
		$prenom 		=	htmlspecialchars( $user->getPrenom());
		$email 			=	htmlspecialchars( $user->getEmail());
		$addresse 		=	htmlspecialchars( $user->getAddresse());
		$codePostale 	=	htmlspecialchars( $user->getCodePostale());
		$ville 			=	htmlspecialchars( $user->getVille());
		$pays 			=	htmlspecialchars( $user->getPays());
		$telephone 		=	htmlspecialchars( $user->getTelephone());

		$requete = $this->_db->exec("INSERT INTO users (nom_user, prenom_user, addresse_user, codePostale_user, ville_user, pays_user, telephone_user, email_user) VALUES ('$nom', '$prenom', '$addresse', '$codePostale', '$ville','$pays', '$telephone', '$email') ");

	}

	public function getLastUserAdd()
	{
		
		$requete = $this->_db->query('SELECT  * FROM users order by id_user DESC limit 1');
		$id_user = $requete->fetch(PDO::FETCH_ASSOC);
		return $id_user['id_user'];
	}

	public function get($id)
	{
		$requete = $this->_db->prepare('SELECT * FROM users WHERE id_user = :id');
		$requete->bindParam(':id',$id);
		$requete->execute();
		$test = $requete->fetch(PDO::FETCH_ASSOC);
		return $test;
	}

	public function getUserParNomEtPrenom($nom, $prenom)
	{
		$requete = $this->_db->prepare('SELECT * FROM users WHERE nom_user = :nom and prenom_user = :prenom');
		$requete->execute(array(':nom'	=> $nom, ':prenom' => $prenom));
		$id_user = $requete->fetch(PDO::FETCH_ASSOC);
		return $id_user;
	}

	public function getUserParEmail($email)
	{	

		$requete = $this->_db->prepare("SELECT * FROM users WHERE email_user = :email");
		$requete->execute(array(':email'	=> $Email));
		$admin = $requete->fetch(PDO::FETCH_ASSOC);

		return $admin;
	}

	public function checkUserExiste($nom, $prenom)
	{	

		$requete = $this->_db->prepare("SELECT * FROM users WHERE nom_user = :nom and prenom_user = :prenom");
		$requete->execute(array(':nom'	=> $nom, ':prenom' => $prenom));
		$user = $requete->rowCount();
		
		return $user;
	}	


	public function update(User $user)
	{
		$id 			=   htmlspecialchars($user->getId());
		$nom 			=	htmlspecialchars( $user->getNom());
		$prenom 		=	htmlspecialchars( $user->getPrenom());
		$email 			=	htmlspecialchars( $user->getEmail());
		$addresse 		=	htmlspecialchars( $user->getAddresse());
		$codePostale 	=	htmlspecialchars( $user->getCodePostale());
		$ville 			=	htmlspecialchars( $user->getVille());
		$pays 			=	htmlspecialchars( $user->getPays());
		$telephone 		=	htmlspecialchars( $user->getTelephone());
		
		$requete = $this->_db->exec("UPDATE users SET nom_user = '$nom', prenom_user = '$prenom', addresse_user = '$addresse', codePostale_user = '$codePostale',ville_user = '$ville', pays_user = '$pays', telephone_user = '$telephone', email_user ='$email' WHERE id_user = '$id'");

		return $reponse = 'ok';
	}

	public function Deconnecter()
		{
			unset($_SESSION["id_user"]);
		    session_destroy();
		}

}

?>