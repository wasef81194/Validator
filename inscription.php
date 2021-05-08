<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/inscription/forminscription.php';

//----------------------------------------------------------------------------------------------
echo Nav('Inscription');
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class
?>
<form action="getinscription.php" method="post" enctype="multipart/form-data">
		<div class="container ">

			<h2> Inscription <h2>
			<div class="form-row">
				<div class="col-md-6">
					<label for="nom"> Nom : </label>
					<input type="nom" name="nom" id="nom" class="form-control" placeholder="Smith" required>
				</div>
			
				<div class="col-md-6">
					<label for="prenom"> Prenom : </label>
					<input type="prenom" name="prenom" id="prenom" class="form-control" placeholder="Jean" required >
				</div>
			</div>


			<div class="form-row">
				<div class="col-md-6">
					<label for="email"> E-mail : </label>
					<input type="email" name="email" id="email" class="form-control" placeholder="nom@exemple.com" required> 
				</div>
			
				<div class="col-md-6">
					<label for="tel"> Télephone : </label>
					<input type="tel" name="tel" id="tel" class="form-control" placeholder="06 23 56 84 12 (optionel)" >
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-6">
					<label for="login"> Login : </label>
					<input type="login" name="login" id="login" class="form-control" placeholder="NomPrenom75" required> 
				</div>
			
				<div class="col-md-6">
					<label for="password"> Mot de passe : </label>
					<input type="password" name="password" id="password" class="form-control" placeholder="6 caratère minimum" required>
				</div>
			</div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary" name="submit" id="buttonInscription" type="submit"> Valider l'inscription </button>
            </div>

			
		</div>
		<div class="Messages"></div>
</form>
<?php
echo Footer();
?>

<script>
    $(document).ready(function(){
        $("#buttonInscription").click(function() {
            var Nomuser = $("input[name=nom]").val();
            var PrenomUser = $("input[name=prenom]").val();
            var email = $("input[name=email]").val();
            var tel = $("input[name=tel]").val();
            var login = $("input[name=login]").val();
            var pwd = $("input[name=password]").val();

            var form_data = new FormData();
            form_data.append('nom',Nomuser);
            form_data.append('prenom',PrenomUser) ;
            form_data.append('email', email);
            form_data.append('tel',tel);
            form_data.append('login',login);
            form_data.append('password',pwd);

            $.ajax({
                type: "post",
                dataType : 'json',
                url: "./class/inscription/forminscription.php",
                cache: false,
                contentType: false,
                processData: false,
                data:form_data,
                success: function(data, statut){
                    
                    // Contenue en cas de réussite
                    $(".Messages").children().remove();
                    if (data.errorMessage != ""){
                        //si les champs du formulaire ne sont pas remplis
                        error = data.errorMessage;
                        
                        $('.Messages').append(`
                            <div class="alert alert-danger text-center mt-4" role="alert">
                                ${error}
                            </div>
                        `);
                    }else{
                        if(data.mailExist){
                            $('.Messages').append(`
                                <div class="alert alert-danger text-center mt-4" role="alert">
                                    L'adresse mail est déjà pris !
                                </div>
                            `);
                        }
                        if(data.loginExist){
                            $('.Messages').append(`
                                <div class="alert alert-success text-center mt-4" role="alert">
                                    Le login est déjà pris !
                                </div>
                            `);
                        }
                        else if(data.inscriptionOk){
                            $('.Messages').append(`
                                <div class="alert alert-success text-center mt-4" role="alert">
                                   	Vous êtes bien inscris! Rendez-vous <a href="formconnexion.php">ici</a> pour accéder à votre compte
                                </div>
                            `);
                            $('#formInscription')[0].reset();
                        }

                        
                    }
                }
            });
        });
    });
</script>
