<?php

// Chargement des classes
require_once('model/loginManager.php');


function formPost()
{
	require('view/frontend/formPost.php');
}

function addAdmin($login, $pass_hache)
{	
	// Vérification de la validité des identifiants
	if($_POST['pseudo_Subscription'] == NULL OR $_POST['pass_Subscription1'] == NULL OR $_POST['pass_Subscription2'] == NULL){

	echo 'Vous n\'avez pas rempli tous les champs';

	} else {
		// On rend inoffensives les balises HTML que le visiteur a pu rentrer
		$pseudo = htmlspecialchars($_POST['pseudo_Subscription']);
		$pass_Subscription1 = $_POST['pass_Subscription1'];
		$pass_Subscription2 = $_POST['pass_Subscription2'];

		if($pass_Subscription1 == $pass_Subscription2){

			// Hachage du mot de passe
			$pass_hache = password_hash($pass_Subscription1, PASSWORD_DEFAULT);

		    $loginManager = new \OpenClassrooms\sitesPHP\projet4\model\loginManager();

		    $affectedLogin = $loginManager->insertLoginAndPass($login, $pass_hache);

		    if ($affectedLogin === false) {
		        throw new Exception('Impossible d\'ajouter le nouvel administrateur !');
		    }
		    else {
		        header('Location: index.php?action=formConnexionAdmin');
		    }
		} else {
			echo 'les mots de passe ne sont pas identiques';
		}
	}
}
function connexionAdmin()
{   
    if ($_POST['pseudo_Connexion'] == NULL OR $_POST['pass_Connexion'] == NULL){

        echo 'Vous n\'avez pas rempli tous les champs';

	} else {
		$loginManager = new \OpenClassrooms\sitesPHP\projet4\model\loginManager();

		$req = $loginManager->getLoginAndPass();
		$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass_Connexion'], $resultat['pass']);

		if (!$resultat)
		{
		echo 'Mauvais identifiant ou mot de passe !';
		} else {
		    if ($isPasswordCorrect) {
		          session_start();
		          $_SESSION['id'] = $resultat['id'];
		          $_SESSION['login'] = $_POST['pseudo_Connexion'];

		          header('Location: index.php');

		    } else {

		          echo 'Mauvais identifiant ou mot de passe !';
		    }
		}
	}
}
function sessionAdmin()
{
	$loginManager = new \OpenClassrooms\sitesPHP\projet4\model\loginManager();

	$req = $loginManager->getUser();
}

function deconnexionAdmin()
{

session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('pseudo', '');
setcookie('pass', '');

header('Location: index.php?action=listPosts');
}