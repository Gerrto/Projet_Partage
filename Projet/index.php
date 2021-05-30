<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <!-- En-tête -->
	<head>
        <!-- Titre du Site -->
		<title>Mang@List</title>
        <!-- Langue -->
	    <meta charset="UTF-8">
	    <!-- Icon de la barre de navigation -->
        <link rel="icon" type="image/png" href="Images/Logo.png"/>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
		<style>
			html{
				padding:0 0 0 0;
				width: 100vw;
				height: 100vh;
			}
			body{
				width: 100%;
				height: 100%;
			}
		</style>
	</head>
	
    <!-- Corps -->
    <body>
        
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="index.php?module=Spectacle&action=AffRecherche">Recherche</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?module=Spectacle&action=ListeSpectacle">Listes spectacles</a>
					</li>
				</ul>
			</div>
			
			<?php
				if (isset($_SESSION['login'])) {
					echo "<a href=\"index.php?module=Compte&action=Deconnexion\"><input type=\"button\" name=\"deconnecter\" value=\"se deconnecter\" /></a>";
				}
				else{
					echo "<a href=\"index.php?module=Compte&action=FormConnexion\"><input type=\"button\" value=\"se connecter\"/></a>";
					echo "<a href=\"index.php?module=Compte&action=FormInscription\"><input type=\"button\" value=\"créer son compte\"/></a>";
				}
			?>
		</nav> 
		</nav>
		<?php
			if (!isset($_GET['module'])) {
				$module="Spectacle";
				$_GET['action'] = "AffRecherche";
			}
			else {
				$module=htmlspecialchars($_GET['module']);
			}
			switch($module){
				case "Compte":
					include 'module/'.$module.'/mod'.$module.'.php';
				break;
				case "Spectacle":
					include 'module/'.$module.'/mod'.$module.'.php';
				break;
				default :
					die("Erreur Index : Module inacessible.");
			}
		?>
	</body>
</html>
            