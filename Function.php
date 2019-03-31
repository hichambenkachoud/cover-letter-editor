
<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/classes/autoload.inc.php';

	$db                  = DBFactory::getMySqlConnexionWithPDO();
    $UserManager         = new UserManager($db);
    $recruteurManager    = new RecruteurManager($db);
    $lettreManager    = new LettreManager($db);


    if ($_GET['action'] == 'ModifierUser') {

    		  $idUser 			= $_GET['IdE'];
			  $nomUser 			= $_GET['NomE'];
			  $prenomUser 		= $_GET['PrenomE'];
			  $emailUser		= $_GET['EmailE'];
			  $adresseUser 		= $_GET['AddresseE'];
			  $villeUser 		= $_GET['VilleE'];
			  $paysUser 		= $_GET['PaysE'];
			  $telephoneUser 	= $_GET['TeleE'];
			  $codePostale 		= $_GET['CodePostaleE'];

		$user = new User([
		'id'	=> $idUser,
        'nom' => $nomUser,
        'prenom' => $prenomUser,
        'addresse' => $adresseUser,
        'email' => $emailUser,
        'ville' => $villeUser,
        'pays' => $paysUser,
        'codePostale' => $codePostale,
        'telephone' => $telephoneUser
      ]);
		$reponse = $UserManager->update($user);
		echo json_encode(['reponse' => $reponse]);

	
	}

	if ($_GET['action'] == 'deconnecter') {

		$UserManager->Deconnecter();
		echo json_encode(['reponse' => 'ok']);
	}

	if ($_GET['action'] == 'ModifierDestinataire') {
			
			  $idRecruteur					= $_GET['IdD'];
			  $civiliteRecruteur			= $_GET['Civilite'];
			  $nomRecruteur					= $_GET['NomD'];
			  $prenomRecruteur				= $_GET['PrenomD'];
			  $nomCompany				    = $_GET['EntrepriseD'];
			  $adresseRecruteur				= $_GET['AddresseD'];
			  $villeRecruteur				= $_GET['VilleD'];
			  $paysRecruteur				= $_GET['PaysD'];
			  $codePostaleRecruteur 		= $_GET['CodePostaleD'];

		$recruteur = new Recruteur([
		'id'	=> $idRecruteur,
		'civilite' => $civiliteRecruteur,
        'nom' => $nomRecruteur,
        'prenom' => $prenomRecruteur,
        'addresse' => $adresseRecruteur,
        'ville' => $villeRecruteur,
        'pays' => $paysRecruteur,
        'codePostale' => $codePostaleRecruteur,
        'nomCompany' => $nomCompany
      ]);
		$reponse = $recruteurManager->update($recruteur);
		echo json_encode(['reponse' => $reponse]);
	}

	if ($_GET['action'] == 'modifierLettre') {
			
			  $idLettre					    = $_GET['IdLettre'];
			  $idUser					    = $_GET['IdUser'];
			  $idRecruteur					= $_GET['IdRecruteur'];
			  $objetLettre					= $_GET['ObjetL'];
			  $dateLettre					= $_GET['DateL'];
			  $villeLettre					= $_GET['VilleL'];
			  $paragOuverture				= $_GET['paragOuverture'];
			  $paragCorps					= $_GET['paragCorps'];
			  $paragFermeture				= $_GET['paragFermeture'];
			  $paragPolitisse				= $_GET['paragPolitisse'];

			 $lettre = new lettre([
			 		'idLettre'  		=> $idLettre,
                    'objet' 			=> $objetLettre,
                    'ville' 			=> $villeLettre,
                    'date' 				=> $dateLettre,
                    'paragOuverture' 	=> $paragOuverture,
                    'paragCorps' 		=> $paragCorps,
                    'paragFermeture' 	=> $paragFermeture,
                    'paragPolitisse' 	=> $paragPolitisse,
                    'idUser' 			=> $idUser,
                    'idRecruteur' 		=> $idRecruteur
              ]);
		$reponse = $lettreManager->update($lettre);
		echo json_encode(['reponse' => $reponse]);
	}

?>