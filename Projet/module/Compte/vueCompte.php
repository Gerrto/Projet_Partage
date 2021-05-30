<?php

    class VueCompte {

        public function __construct() {
            ?>
            
            <?php
        }

        function afficheFormConnexion(){
            ?>
                <div class="jumbotron d-flex align-items-center min-vh-100">
                    <div class="container text-center">
                        <h1>Connexion</h1>
                        <form action="index.php?action=Connexion&module=Compte" method="post">
                            <label>Entrer votre login :</label></br>
                            <input type="text" name="login"  placeholder="Login" required class="form-control col-4 ml-auto mr-auto"></br>
                            <label>Entrer votre mot de passe :</label></br>
                            <input type="password" name="mdp" placeholder="Mot de passe" required class="form-control col-4 ml-auto mr-auto"></br>
                            </br>
                            <input type="submit" name="Validé" class="btn btn-light">
                        </form>
                    </div>
                </div>
            <?php
        }

        function menu(){
            echo '<a href="index.php">Accueil</a></br>';
        }
        
        function afficheFormInscription(){
            ?>
                <div class="jumbotron d-flex align-items-center min-vh-100">
                    <div class="container text-center">
                        <h1>Inscription</h1>
                        <form action="index.php?action=Inscription&module=Compte" method="post">
                            <label>Entrer votre login :</label></br>
                            <input type="text" name="login"  placeholder="Login" required class="form-control col-4 ml-auto mr-auto"></br>
                            <label>Entrer votre mot de passe :</label></br>
                            <input type="password" name="mdp" placeholder="Mot de passe" required class="form-control col-4 ml-auto mr-auto"></br>
                            </br>
                            <input type="submit" name="Validé" class="btn btn-light">
                        </form>
                    </div>
                </div>
            <?php
        }

        function reponse($info,$lien){
            ?>
                <div class="jumbotron d-flex align-items-center min-vh-100">
                    <div class="container text-center">
                        <h2><?php echo $info ?></h2>
                    </div>
                </div>
                <script>
                    location.replace("<?php echo $lien ?>");
                </script>
            <?php
        }

    }

?>