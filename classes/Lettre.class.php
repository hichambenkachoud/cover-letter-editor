<?php

/*
*Classe represantant un Admin
*/

class Lettre
{
	private $idLettre;
	private $objet;
	private $ville;
	private $date;
	private $paragOuverture;
	private $paragCorps;
	private $paragFermeture;
	private $paragPolitisse;
	private $idUser;
	private $idRecruteur;

	public function __construct($valeur = array())
	{
		if (!empty($valeur)) 
		{
			$this->hydrate($valeur);
		}
	}

	public function getIdLettre(){
		return $this->idLettre;
	}

	public function setIdLettre($idLettre){
		$this->idLettre = (int) $idLettre;
	}

	public function getIdUser(){
		return $this->idUser;
	}

	public function setIdUser($idUser){
		$this->idUser = (int) $idUser;
	}

	public function getIdRecruteur(){
		return $this->idRecruteur;
	}

	public function setIdRecruteur($idRecruteur){
		$this->idRecruteur = (int) $idRecruteur;
	}

	public function getObjet(){
		return $this->objet;
	}

	public function setObjet($objet){
		if (is_string($objet) && !empty($objet)) 
		{
			$this->objet = $objet;
		}
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		if (is_string($date) && !empty($date))
		{
			$this->date = $date;
		}
	}

	public function getParagOuverture(){
		return $this->paragOuverture;
	}

	public function setParagOuverture($paragOuverture){
		if (is_string($paragOuverture) && !empty($paragOuverture)) 
		{
			$this->paragOuverture = $paragOuverture;
		}
	}

	public function getParagCorps(){
		return $this->paragCorps;
	}

	public function setParagCorps($paragCorps){
		if (is_string($paragCorps) && !empty($paragCorps)) 
		{
			$this->paragCorps = $paragCorps;
		}
	}
	
	public function getParagFermeture(){
		return $this->paragFermeture;
	}

	public function setParagFermeture($paragFermeture){
		if (is_string($paragFermeture) && !empty($paragFermeture))
		{
			$this->paragFermeture = $paragFermeture;
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

	public function getParagPolitisse(){
		return $this->paragPolitisse;
	}

	public function setParagPolitisse($paragPolitisse){
		if (is_string($paragPolitisse) && !empty($paragPolitisse))
		{
			$this->paragPolitisse = $paragPolitisse;
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