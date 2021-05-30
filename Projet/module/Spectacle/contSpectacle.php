<?php

	require_once('./module/Spectacle/modeleSpectacle.php');
    require_once('./module/Spectacle/vueSpectacle.php');


	class ContSpectacle {

        private $modele;
        private $vue;

		public function __construct(){
			$this->modele = new ModeleSpectacle();
            $this->vue = new VueSpectacle();
		}

        public function recupSpectacle(){
            $this->vue->affRepSparQL($this->modele->recherche(1),"recup spectacle");
        }

        public function affRecherche(){
            $this->vue->affRecherche();
        }

        public function listeSpectacle(){
            $_POST["titre"] = "";
            $_POST["date"] = "";
            $_POST["lieu"] = "";
            $_POST["latitude"] = "";
            $_POST["longitude"] = "";
            $this->vue->affRepSparQL($this->modele->recherche(1),"recup spectacle");
        }

        public function spectacleCommentaire(){
            $nomSpectacle = htmlspecialchars($_GET["nomSpectacle"]);
            $this->vue->affCommentaire($nomSpectacle, $this->modele->getCommentaireOf($nomSpectacle));
        }

	}

?>