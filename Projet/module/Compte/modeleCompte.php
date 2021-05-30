<?php

	require_once('./connexionBD.php');


	class ModeleCompte extends ConnexionBD {
		public function __construct(){
			parent::initConnexion();
		}

		public function verifConnexion($login,$mdp) {
			if (!isset($_POST['login']) || !isset($_POST['mdp'])) {
				die("il manque le mot de passe ou le login");
			}
			else{
				$requete = "SELECT login FROM Utilisateur WHERE login='$login' AND mdp='$mdp'";
      			$response = mysqli_query (self::$bdMySQLI, $requete);

				return $response;
			}
		}

		public function deconnexion(){
			session_unset();
		}	


		public function inscription($login,$mdp){
			$requete = "SELECT login FROM Utilisateur WHERE login='$login'";
			$response = mysqli_query (self::$bdMySQLI, $requete);
            if ($response->num_rows>0) {
                return false;
            }
            else{
				$requete = "INSERT into utilisateur values('$login','$mdp')";
				$response = mysqli_query(self::$bdMySQLI, $requete);
                return $response;
			}
		}
	}

?>