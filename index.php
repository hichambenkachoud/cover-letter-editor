<?php
    
    require  __DIR__ . '/vendor/autoload.php';
    require  __DIR__ . '/classes/autoload.inc.php';
    
    $db                  = DBFactory::getMySqlConnexionWithPDO();
    $UserManager         = new UserManager($db);
    $recruteurManager    = new RecruteurManager($db);
    $lettreManager       = new LettreManager($db);

    $laoder = new Twig_Loader_Filesystem(__DIR__ . '\templates');
    $twig = new Twig_Environment($laoder, ['cache' => false,], array('debug' => true));
    $twig->addExtension(new Twig_Extension_Debug());
    
    
    //routing
    if (isset($_POST['Nom']) && isset($_POST['Prenom'])) {

        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);

        $user = new User([
        'nom' => $nom,
        'prenom' => $prenom,
        'addresse' => '',
        'email' => '',
        'ville' => '',
        'pays' => '',
        'codePostale' => 0,
        'telephone' => ''
      ]);

        $recruteur = new Recruteur([
        'civilite' => '',
        'nom' => '',
        'prenom' => '',
        'addresse' => '',
        'email' => '',
        'ville' => '',
        'pays' => '',
        'codePostale' => 0,
        'nomEntreprise' => ''
      ]);


        $idUserConnect = $UserManager->getUserParNomEtPrenom($nom,$prenom);
        $nombreUser = $UserManager->checkUserExiste($nom,$prenom);
        if ($nombreUser == 0) { 
            $UserManager->addUser($user);
            $recruteurManager->addRecruteur($recruteur);
            $id_recruteur = $recruteurManager->getLastRecruteurAdd();
            $idUser = $UserManager->getLastUserAdd();

                $lettre = new lettre([
                    'objet' => '',
                    'ville' => '',
                    'date' => '',
                    'paragOuverture' => '',
                    'paragCorps' => '',
                    'paragFermeture' => '',
                    'paragPolitisse' => '',
                    'idUser' => $idUser,
                    'idRecruteur' => $id_recruteur
              ]);

            $lettreManager->addLettre($lettre);
            $id_lettre = $lettreManager->getLettreParUserEtRecruteur($idUser,$id_recruteur);
            $_SESSION['id_user'] = $idUser;
            $_SESSION['id_recruteur'] = $id_recruteur;
            $_SESSION['id_lettre'] = $id_lettre['id_lettre'];

            echo $twig->render('home.twig', array(

            'User' => array(
                'id' => $idUser,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => '',
                'addresse' => '',
                'ville' => '',
                'pays' => '',
                'codePostale' => '',
                'telephone' => ''
            ),

            'Recruteur' => array(
                'id'                => $id_recruteur,
                'nom'               => '',
                'prenom'            => '',
                'addresse'          => '',
                'ville'             => '',
                'pays'              => '',
                'NomCompany'        => '',
                'codePostale'       => '',
                'civilite'          => ''
            ),

            'Lettre' => array(
                'idLettre'          => $id_lettre['id_lettre'],
                'objet'             => '',
                'ville'             => '',
                'date'              => '',
                'paragOuverture'    => '',
                'paragCorps'        => '',
                'paragFermeture'    => '',
                'paragPolitisse'    => '',
                'idUser'            => $idUser,
                'idRecruteur'       => $id_recruteur
            )

        ));

            //echo $twig->render('home.twig',['nom' => $nom , 'prenom' => $prenom]);
        }
        else{
            $id_recruteur = $lettreManager->getLettreParUser($idUserConnect['id_user']);
            $id_lettre = $lettreManager->getLettreParUserEtRecruteur($idUserConnect['id_user'],$id_recruteur);
            $idRecruteurConnect =  $recruteurManager->get($id_recruteur);
            $_SESSION['id_user'] = $id_lettre['id_user'];
            $_SESSION['id_recruteur'] = $idRecruteurConnect['id_recruteur'];
            $_SESSION['id_lettre'] = $id_lettre['id_lettre'];

            echo $twig->render('home.twig', array(

            'User' => array(
                'id' => $idUserConnect['id_user'],
                'nom' => $idUserConnect['nom_user'],
                'prenom' => $idUserConnect['prenom_user'],
                'email' => $idUserConnect['email_user'],
                'addresse' => $idUserConnect['addresse_user'],
                'ville' => $idUserConnect['ville_user'],
                'pays' => $idUserConnect['pays_user'],
                'codePostale' => $idUserConnect['codePostale_user'],
                'telephone' => $idUserConnect['telephone_user']
            ),

            'Recruteur' => array(
                'id'                => $idRecruteurConnect['id_recruteur'],
                'nom'               => $idRecruteurConnect['nom_recruteur'],
                'prenom'            => $idRecruteurConnect['prenom_recruteur'],
                'addresse'          => $idRecruteurConnect['addresse_recruteur'],
                'ville'             => $idRecruteurConnect['ville_recruteur'],
                'pays'              => $idRecruteurConnect['pays_recruteur'],
                'NomCompany'        => $idRecruteurConnect['company_recruteur'],
                'codePostale'       => $idRecruteurConnect['codePostale_recruteur'],
                'civilite'          => $idRecruteurConnect['civilite_recruteur']
            ),

            'Lettre' => array(
                'idLettre'          => $id_lettre['id_lettre'],
                'objet'             => htmlspecialchars_decode($id_lettre['objet_lettre'],ENT_QUOTES),
                'ville'             => $id_lettre['ville_lettre'],
                'date'              => $id_lettre['date_lettre'],
                'paragOuverture'    => htmlspecialchars_decode($id_lettre['paragOuverture'],ENT_QUOTES),
                'paragCorps'        => htmlspecialchars_decode($id_lettre['paragCorps'],ENT_QUOTES),
                'paragFermeture'    => htmlspecialchars_decode($id_lettre['paragFermeture'],ENT_QUOTES),
                'paragPolitisse'    => htmlspecialchars_decode($id_lettre['paragPolitisse'],ENT_QUOTES),
                'idRecruteur'       => $id_lettre['id_recruteur']
            )
));
        }
    }

    else if (isset($_SESSION['id_user']) && isset($_SESSION['id_recruteur']) && isset($_SESSION['id_lettre'])){
        $idUserConnect      = $UserManager->get($_SESSION['id_user']);
        $idRecruteurConnect =  $recruteurManager->get($_SESSION['id_recruteur']);
        $id_lettre          = $lettreManager->getLettre($_SESSION['id_lettre']);
        $mod=0;
            if (isset($_GET['mod'])) {
                $mod = $_GET['mod'];
            }
        echo $twig->render('home.twig', array(

            'User' => array(
                'id' => $idUserConnect['id_user'],
                'nom' => $idUserConnect['nom_user'],
                'prenom' => $idUserConnect['prenom_user'],
                'email' => $idUserConnect['email_user'],
                'addresse' => $idUserConnect['addresse_user'],
                'ville' => $idUserConnect['ville_user'],
                'pays' => $idUserConnect['pays_user'],
                'codePostale' => $idUserConnect['codePostale_user'],
                'telephone' => $idUserConnect['telephone_user']
            ),

            'Recruteur' => array(
                'id'                => $idRecruteurConnect['id_recruteur'],
                'nom'               => $idRecruteurConnect['nom_recruteur'],
                'prenom'            => $idRecruteurConnect['prenom_recruteur'],
                'addresse'          => $idRecruteurConnect['addresse_recruteur'],
                'ville'             => $idRecruteurConnect['ville_recruteur'],
                'pays'              => $idRecruteurConnect['pays_recruteur'],
                'NomCompany'        => $idRecruteurConnect['company_recruteur'],
                'codePostale'       => $idRecruteurConnect['codePostale_recruteur'],
                'civilite'          => $idRecruteurConnect['civilite_recruteur']
            ),

            'Lettre' => array(
                'idLettre'                => $id_lettre['id_lettre'],
                'objet'                   => htmlspecialchars_decode($id_lettre['objet_lettre'],ENT_QUOTES),
                'ville'                 => $id_lettre['ville_lettre'],
                'date'             => $id_lettre['date_lettre'],
                'paragOuverture'    => htmlspecialchars_decode($id_lettre['paragOuverture'],ENT_QUOTES),
                'paragCorps'        => htmlspecialchars_decode($id_lettre['paragCorps'],ENT_QUOTES),
                'paragFermeture'    => htmlspecialchars_decode($id_lettre['paragFermeture'],ENT_QUOTES),
                'paragPolitisse'    => htmlspecialchars_decode($id_lettre['paragPolitisse'],ENT_QUOTES),
                'idUser'      => $id_lettre['id_user'],
                'idRecruteur'  => $id_lettre['id_recruteur']
            ),
            'Model' => array(
                'id'          => $mod
            )
));
    }
    else{
        echo $twig->render('connexion.twig');
    }

?>

