<?php

	require_once('./connexionBD.php');
    require_once('./lib/sparqllib.php');


	class ModeleSpectacle extends ConnexionBD{

        private $sparQL;
        private $pas;

		public function __construct(){
            parent::__construct();

            $this->sparQL = sparql_connect("https://data.bnf.fr/sparql");
            if( !$this->sparQL ) {
                print sparql_errno() . ": " . sparql_error(). "\n";
                exit;
            }
            $this->pas = 50;
        }

        public function verifSaisieRech(){
            $_POST["titre"] = htmlspecialchars($_POST["titre"]);
            $_POST["lieu"] = htmlspecialchars($_POST["lieu"]);
            $_POST["date"] = htmlspecialchars($_POST["date"]);
            $_POST["latitude"] = htmlspecialchars($_POST["latitude"]);
            $_POST["longitude"] = htmlspecialchars($_POST["longitude"]);
        }

        /*
        * Les spectacles organisés dans différents lieux à différentes dates
        * La limite est implémenter uniquement pour raccoursir le temps de chargement de la requete SPARQL
		*/
        public function recherche($page) {
            $this->verifSaisieRech();

            $precision = 0.0001; //Precision pour la latitude et longitude
            
            $limitMax = $page*$this->pas;

			sparql_ns( "geo","http://www.w3.org/2003/01/geo/wgs84_pos#" );
            sparql_ns( "rdfs","http://www.w3.org/2000/01/rdf-schema#" );
            sparql_ns( "rdagroup1elements","http://rdvocab.info/Elements/" );
            sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
            sparql_ns( "dcterms","http://purl.org/dc/terms/" );
            sparql_ns( "rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#" );
            sparql_ns( "dcmitype","http://purl.org/dc/dcmitype/" );

            $this->sparQL = "SELECT ?Titre ?Date ?Nom_Lieu ?Latitude ?Longitude WHERE {
                ?Spectacle rdf:type dcmitype:Event .
                ?Spectacle dcterms:title ?Titre .
                ?Spectacle dcterms:date ?Date .
                ?Spectacle rdagroup1elements:placeOfProduction ?Lieu .
                ?Lieu foaf:focus ?focus .
                ?focus rdfs:label ?Nom_Lieu .
                ?focus geo:lat ?Latitude .
                ?focus geo:long ?Longitude .";
                if($_POST["titre"] == ""){
                    $this->sparQL = $this->sparQL."?Spectacle dcterms:title ?Titre .";
                }
                else{
                    $this->sparQL = $this->sparQL."?Spectacle dcterms:title \"".$_POST["titre"]."\"@fr .";
                }

                if($_POST["date"] == ""){
                    $this->sparQL = $this->sparQL."?Spectacle dcterms:date ?Date .";
                }
                else{
                    $this->sparQL = $this->sparQL."?Spectacle dcterms:date \"".$_POST["date"]."\"^^<http://www.w3.org/2001/XMLSchema#date> .";
                }

                if($_POST["lieu"] == ""){
                    $this->sparQL = $this->sparQL."?focus rdfs:label ?Nom_Lieu .";
                }
                else{
                    $this->sparQL = $this->sparQL."?focus rdfs:label \"".$_POST["lieu"]."\"@fr .";
                }

                if($_POST["latitude"] == ""){
                    $this->sparQL = $this->sparQL."?focus geo:lat ?Latitude .";
                }else{
                    //$this->sparQL = $this->sparQL."?focus geo:lat \"".$_POST["latitude"]."\"^^<http://www.w3.org/2001/XMLSchema#double> .";
                    $this->sparQL = $this->sparQL."FILTER (?Latitude < ".(floatval($_POST["latitude"])+$precision).")";
                    $this->sparQL = $this->sparQL."FILTER (?Latitude > ".(floatval($_POST["latitude"])-$precision).")";
                }

                if($_POST["longitude"] == ""){
                    $this->sparQL = $this->sparQL."?focus geo:long ?Longitude .";
                }
                else{
                    //$this->sparQL = $this->sparQL."?focus geo:long \"".$_POST["longitude"]."\"^^<http://www.w3.org/2001/XMLSchema#double> .";
                    $this->sparQL = $this->sparQL."FILTER (?Longitude < ".(floatval($_POST["longitude"])+$precision).")";
                    $this->sparQL = $this->sparQL."FILTER (?Longitude > ".(floatval($_POST["longitude"])-$precision).")";
                }

            $this->sparQL = $this->sparQL."}LIMIT $limitMax";

            $result = sparql_query( $this->sparQL ); 
            if( !$result ) {
                print sparql_errno() . ": " . sparql_error(). "\n";
                exit;
            }

            return $result;
		}

        public function getCommentaireOf($nomSpectacle){
            $requete = "SELECT nomUtilisateur,description FROM commentaire WHERE nomOeuvre = '$nomSpectacle';";
            $resultat = mysqli_query(parent::$bdMySQLI, $requete);
            return $resultat;
        }

	}

?>