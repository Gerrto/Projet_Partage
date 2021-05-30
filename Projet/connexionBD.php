<?php

	class ConnexionBD{

		protected static $bdMySQLI;

		public function __construct(){
			self::initConnexion();
		}

		public static function initConnexion(){

			$nom_du_serveur ="localhost";
			$nom_de_la_base ="nt1_projet";
			$nom_utilisateur ="root";
			$passe ="";
			
			self::$bdMySQLI = mysqli_connect ($nom_du_serveur,$nom_utilisateur,$passe,$nom_de_la_base);

			if (!self::$bdMySQLI){
				echo "Désolé, connexion au serveur impossible\n";
				exit;
			}

			if (!mysqli_select_db (self::$bdMySQLI, "nt1_projet")){
				echo "Désolé, accés à la base de donnée impossible\n";
				exit;
			}

			self::$bdMySQLI->set_charset( "utf8" );
		}
	}

?>