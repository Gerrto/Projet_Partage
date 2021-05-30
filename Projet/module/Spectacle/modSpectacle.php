<?php
    require_once('./module/Spectacle/contSpectacle.php');

    $controleur = new ContSpectacle();

    $action =!isset($_GET['action'])?"":htmlspecialchars($_GET['action']);
	switch($action){
		case 'Recherche':
			$controleur->recupSpectacle();
		break;
		case 'AffRecherche':
			$controleur->affRecherche();
		break;
		case 'ListeSpectacle':
			$controleur->listeSpectacle();
		break;
		case 'Commentaire':
			$controleur->spectacleCommentaire();
		break;
		default :
            echo "Spectacle pas de module";
		break;
	}
?>