<?php

	require_once('./module/Compte/modeleCompte.php');
    require_once('./module/Compte/vueCompte.php');


	class ContCompte {

        private $modele;
        private $vue;

		public function __construct(){
			$this->modele = new ModeleCompte();
            $this->vue = new VueCompte();
		}

        public function formConnexion(){
            $this->vue->afficheFormConnexion();
        }

        public function formInscription(){
            $this->vue->afficheFormInscription();
        }

        public function connexion(){
            $login = htmlspecialchars($_POST['login']);
			$mdp = htmlspecialchars($_POST['mdp']);
            $result = $this->modele->verifConnexion($login,$mdp);
            if($result->num_rows>0){
                $info = "Bonjour ".$login." ! o/";
                $_SESSION['login']=$login;
                $lien = "index.php";
            }
            else{
                $info = "Désolé je ne vous connait pas";
                $lien = "index.php?action=FormConnexion&module=Compte";
            }
            $this->vue->reponse($info,$lien);
            
        }

        public function deconnexion(){
            $this->modele->deconnexion();
            $info = "Vous êtes déconnecté";
            $lien = "index.php";
            $this->vue->reponse($info,$lien);
        }

        public function inscription(){
            $login = htmlspecialchars($_POST['login']);
			$mdp = htmlspecialchars($_POST['mdp']);
            if($this->modele->inscription($login,$mdp)){
                $info = "Vous êtes inscrit";
                $lien = "index.php?action=FormConnexion&module=Compte";
            }
            else{
                $info = "Désolé je connais déjà quelqu'un de ce nom ^^";
                $lien = "index.php?action=FormInscription&module=Compte";
            }
            $this->vue->reponse($info,$lien);
            $this->modele->inscription();
        }

	}

?>