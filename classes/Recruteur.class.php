<?php

/*
*Classe represantant un Admin
*/

class Recruteur
{
	private $id;
	private $civilite;
	private $nom;
	private $prenom;
	private $addresse;
	private $ville;
	private $pays;
	private $codePostale;
	private $nomCompany;

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

	public function getCivilite(){
		return $this->civilite;
	}

	public function setCivilite($civilite){
		if (is_string($civilite) && !empty($civilite)) 
		{
			$this->civilite = $civilite;
		}
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

	public function getNomCompany(){
		return $this->nomCompany;
	}

	public function setNomCompany($nomCompany){
		if (is_string($nomCompany) && !empty($nomCompany))
		{
			$this->nomCompany = $nomCompany;
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