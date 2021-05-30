<?php

    class VueSpectacle {

        public function __construct() {}

        function menu(){
            echo '<a href="index.php">Accueil</a></br>';
        }

        function affRepSparQL($result, $info){
            $fields = sparql_field_array( $result );
        
            echo "<div class=\"jumbotron text-center\"><h1>".$info."</h1>
                <input type=\"button\" id=\"ButtAffRepRechTabl\" value=\"affichage tableau\"></button>
            </div>";
            echo "<div id=\"AffRepRechTabl\">";
            echo "<p class=\"text-center\">Number of rows: ".sparql_num_rows( $result )." results.</p>";

            ?>
            <table class="tableMap" style="width:100vw">
                <thead>
                    <tr>
                        <?php 
                            for($i=0;$i<3;$i++){
                                echo "<th>".$fields[$i]."</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                while( $row = sparql_fetch_array( $result ) ){
                    ?>
                    <tr data-titre="<?php echo $row["Titre"] ?>" data-lat="<?php echo $row["Latitude"] ?>" data-long="<?php echo $row["Longitude"] ?>">
                        <td>
                            <?php echo "<a href=\"index.php?action=Commentaire&module=Spectacle&nomSpectacle=".$row["Titre"]."\">".$row["Titre"] ?> </a>
                        </td>
                        <td>
                            <?php echo $row["Date"] ?>
                        </td>
                        <td>
                            <?php echo $row["Nom_Lieu"] ?>
                        </td>
                        
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            </div>

            
            <!--CSS Personnalisé-->
            <link rel="stylesheet" type="text/css" href="./module/Spectacle/style.css"/>

            <div id="map"></div>

            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfJgYv7X98svOoIiJlIN7ItVilKsr8WgQ&callback=initMap&libraries=&v=weekly"
            async
            ></script>

            <script language="javascript" src="./js/map.js"></script>
            <!-- <script language="javascript" type="module" src="./js/index.js"></script> -->

            <script type="text/javascript">
                document.getElementById("AffRepRechTabl").style.display="none";

                document.getElementById("ButtAffRepRechTabl").onclick = function(){
                    if(document.getElementById("AffRepRechTabl").style.display==="none"){
                        document.getElementById("AffRepRechTabl").style.display="block";
                        document.getElementById("map").style.display="none";
                        document.getElementById("ButtAffRepRechTabl").value="affichage Map";
                    }else{
                        document.getElementById("AffRepRechTabl").style.display="none";
                        document.getElementById("map").style.display="block";
                        document.getElementById("ButtAffRepRechTabl").value="affichage tableau";
                    }
                }
                
            </script>
                
            <?php

        }

        public function affRecherche(){
            ?>
                <div class="jumbotron d-flex align-items-center min-vh-100">
                    <div class="container text-center">
                        <h1>Recherche</h1>
                        <form action="index.php?action=Recherche&module=Spectacle" method="post">
                            <label>titre</label></br>
                            <input type="text" name="titre"  placeholder="titre du spectacle" class="form-control col-4 ml-auto mr-auto"></br>
                            <div id="affMoreRecherche" >
                                <label>Date</label></br>
                                <input type="date" id="start" name="date" value="2021-22-05" class="form-control col-4 ml-auto mr-auto"></br>
                                <label>Lieu</label></br>
                                <input type="text" name="lieu"  placeholder="lieu du spectacle" class="form-control col-4 ml-auto mr-auto"></br>
                                <label>Latitude</label></br>
                                <input type="number" step="0.00001" name="latitude" class="form-control col-4 ml-auto mr-auto"></br>
                                <label>Longitude</label></br>
                                <input type="number" step="0.00001" name="longitude" class="form-control col-4 ml-auto mr-auto"></br>
                            </div>
                            </br>
                            <input type="button" value="plus de parametre de recherche" id="ButtAffMoreRecherche" class="btn btn-light">
                            </br>
                            </br>
                            <input type="submit" value="Rechercher !" class="btn btn-light">
                        </form>

                        <script type="text/javascript">
                            document.getElementById("affMoreRecherche").style.display = "none";
                            document.getElementById("ButtAffMoreRecherche").onclick = function(){
                                var moreRech = document.getElementById("affMoreRecherche");
                                if(moreRech.style.display==="none"){
                                    moreRech.style.display="block";
                                    document.getElementById("ButtAffMoreRecherche").value="moins de parametre de recherche"
                                }else{
                                    moreRech.style.display="none";
                                    document.getElementById("ButtAffMoreRecherche").value="moins de parametre de recherche"
                                }
                            }
                        </script>
                    </div>
                </div>
                
                
            <?php
        }

        public function affCommentaire($nomSpectacle, $result){
            ?>
                <div class="jumbotron text-center">
                    <h2 data-oeuvre="<?php echo $nomSpectacle; ?>"> <?php echo $nomSpectacle; ?></h2>
                    <h4> Commentaires : </h4>
                </div>
                <div class="container">
                    <!--Ajouter Commentaire-->
                    <?php
                        if(isset($_SESSION['login'])){
                            ?>
                                <div class="row">
                                    <div class="col-auto"></div>
                                    <div class="col-10" style="text-align:justify">
                                        <h5>Ajouter un commentaire :</h5>
                                        <div id="form">
                                            <div data-login="<?php echo $_SESSION['login'] ?>" style="display:none"></div>
                                            <textarea id="description" style="width:100%;" cols="40" rows="4" required min="5" data-description=""></textarea>
                                            <input type="submit" class="form-control col-4 ml-auto mr-0" value="Commentez !">
                                        </div>
                                    </div>
                                    <div class="col-auto"></div>
                                </div>
                                <script language="javascript" type="module" src="./js/addComment.js"></script>
                            <?php
                        }
                    ?>
                    <!--Commentaires-->
                    <div class="row">
                        <div class="col-auto"></div>
                        <div id="listeCommentaires" class="col-10" style="text-align:justify"><?php
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<div>";
                                echo "<strong>".$row["nomUtilisateur"]." :</strong><br><span STYLE=\"padding:0 0 0 20px\">".$row["description"]."</span>";
                                echo "</div><br>";
                            }
                        ?></div>
                        <style>
                            #SpanAddedCom{
                                padding: left 20px;
                            }
                        </style>
                        <div class="col-auto"></div>
                    </div>
                </div>
            <?php
        }
    }

?>