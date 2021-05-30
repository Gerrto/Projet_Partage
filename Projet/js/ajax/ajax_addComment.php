<?php
/*
    header('Content-type: application/json');
    $nom_du_serveur ="localhost";
    $nom_de_la_base ="nt1_projet";
    $nom_utilisateur ="root";
    $passe ="";
    
    $bdMySQLI = mysqli_connect ($nom_du_serveur,$nom_utilisateur,$passe,$nom_de_la_base);

    if (!$bdMySQLI){
        echo "Désolé, connexion au serveur impossible\n";
        exit;
    }

    if (!mysqli_select_db ($bdMySQLI, "nt1_projet")){
        echo "Désolé, accés à la base de donnée impossible\n";
        exit;
    }

    $bdMySQLI->set_charset( "utf8" );
    
    //Recupere data dans body de l'option du fetch
    $data = file_get_contents('php://input');
    $param = json_decode($data);
    $login = $param[0];
    $mdp = $param[1];
    $requete = "SELECT nomUtilisateur,description FROM utilisateur WHERE login = \'".$login."\' mdp = \'".$mdp."\';";
    $resultat = mysqli_query($bdMySQLI, $requete);
    //js to JSON
    $resJson = json_encode($resultat);
    $_SESSION["login"] = $login;
    echo $resJson;

    */

    $oeuvre = htmlspecialchars($_GET["oeuvre"]);
    $description = htmlspecialchars($_GET["description"]);
    $login = htmlspecialchars($_GET['login']);

    $nom_du_serveur ="localhost";
    $nom_de_la_base ="nt1_projet";
    $nom_utilisateur ="root";
    $passe ="";
    
    $bdMySQLI = mysqli_connect ($nom_du_serveur,$nom_utilisateur,$passe,$nom_de_la_base);

    if (!$bdMySQLI){
        echo "Désolé, connexion au serveur impossible\n";
        exit;
    }

    if (!mysqli_select_db ($bdMySQLI, "nt1_projet")){
        echo "Désolé, accés à la base de donnée impossible\n";
        exit;
    }

    $bdMySQLI->set_charset( "utf8" );
    
    $requete = "SELECT idCommentaire FROM commentaire WHERE description = '".$description."' AND nomUtilisateur = '".$login."';";
    $resultat = mysqli_query($bdMySQLI, $requete);
    
    if($resultat->num_rows<=0){
        $requete = "INSERT INTO commentaire VALUE(DEFAULT,'".$oeuvre."','".$description."','".$login."');";
        $resultat = mysqli_query($bdMySQLI, $requete);
        if($resultat){
            echo json_encode(true);
        }
        else{
            echo json_encode($requete);
        }
    }
    else{
        echo json_encode($requete);
    }
    
?>