<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';
//require_once('style/style.css');

//----------------------------------------------------------------------------------------------
//echo Nav('Connexion');

if(isset($_SESSION["id_user"])){
	//Recuperer les informations de l'utilisateur
	$session=$_SESSION['id_user'];
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	$request=("SELECT * FROM user WHERE id_user='$session'");
	$data= $ConnexionBDD->getResults($conn,$request);
	while ($row = $data -> fetch_array(MYSQLI_NUM)) {
	
		$nom=$row[1];
		$prenom=$row[2];
		$email=$row[3];
		$PhoneNumber=$row[4];
		$login=$row[5];
	}
?>
 <div> <?php echo Nav('Profil');?></div>

 	<div class="leftside-menu">
		<div class="card">
		  <div class="card-body">
		    <h4 class="card-title">Mes informations personnelles</h4>
		    <p class="card-text"><strong>Nom:</strong> <?= $nom; ?></p>
		    <p class="card-text"><strong>Prénom:</strong> <?= $prenom; ?></p>
		    <p class="card-text"><strong>Login:</strong> <?= $login; ?></p>
		    <p class="card-text"><strong>Adresse mail:</strong> <?= $email; ?></p>
		    <p class="card-text"><strong>Numéro de téléphone:</strong> 0<?= $PhoneNumber; ?></p>

		    <a type="button" id="btn" class="btn btn-primary">Modifier mon profil</a>
		  </div>
		</div>
	</div>
	<?php echo Footer(); ?>

<?php }else{
	header('Location: /index.php');
} ?>