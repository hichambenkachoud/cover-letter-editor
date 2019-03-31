<?php

/*
*Classe represantant un Admin
*/

class User
{
	private $id;
	private $nom;
	private $prenom;
	private $addresse;
	private $email;
	private $ville;
	private $pays;
	private $codePostale;
	private $telephone;

	public function __construct($valeur = array())
	{
		if (!empty($valeur)) 
		{
			$this->hydrate($valeur);
		}
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = (int) $id;
	}

	public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		if (is_string($nom) && !empty($nom)) 
		{
			$this->nom = $nom;
		}
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function setPrenom($prenom){
		if (is_string($prenom) && !empty($prenom)) 
		{
			$this->prenom = $prenom;
		}
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		if (is_string($email) && !empty($email)) 
		{
			$this->email = $email;
		}
	}
	
	public function getAddresse(){
		return $this->addresse;
	}

	public function setAddresse($addresse){
		if (is_string($addresse) && !empty($addresse))
		{
			$this->addresse = $addresse;
		}
	}

	public function getVille(){
		return $this->ville;
	}

	public function setVille($ville){
		if (is_string($ville) && !empty($ville))
		{
			$this->ville = $ville;
		}
	}

	public function getPays(){
		return $this->pays;
	}

	public function setPays($pays){
		if (is_string($pays) && !empty($pays))
		{
			$this->pays = $pays;
		}
	}

	public function getCodePostale(){
		return $this->codePostale;
	}

	public function setCodePostale($codePostale){
		if (is_string($codePostale) && !empty($codePostale))
		{
			$this->codePostale = $codePostale;
		}
	}

	public function getTelephone(){
		return $this->telephone;
	}

	public function setTelephone($telephone){
		if (is_string($telephone) && !empty($telephone))
		{
			$this->telephone = $telephone;
		}
	}


	public function hydrate(array $donnees)
	{
		foreach ($donnees as $attribut => $valeur) {
			$method = 'set'.ucfirst($attribut);
			if (method_exists($this, $method)) {
				$this->$method($valeur);
			}
		}
	}

	public function Nouveau()
	{
		return empty($this->id);
	}
}
?>