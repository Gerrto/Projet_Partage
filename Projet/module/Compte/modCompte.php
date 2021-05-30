<?php

	require_once('./module/Compte/contCompte.php');


	$controleur = new ContCompte();
	$action =!isset($_GET['action'])?"":$_GET['action'];
	switch($action){
		case 'FormConnexion': 
			$controleur->formConnexion();
		break;
        case 'FormInscription': 
            $controleur->formInscription();
        break;
        case 'Connexion': 
            $controleur->connexion();
        break;
        case 'Deconnexion': 
            $controleur->deconnexion();
        break;
        case 'Inscription': 
            $controleur->inscription();
        break;
		default :
            echo "Compte pas de module";
		break;
	}
    
?>