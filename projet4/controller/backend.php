<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\controller;
// Chargement des classes
require_once('model/loginManager.php');

class Backend
{

function formCreatePost()
{
	require('view/backend/formCreatePost.php');
}
function formChangePost()

{	$postManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager();
	$post = $postManager->getPost($_GET['id']);
	require('view/backend/formChangePost.php');
}
function changePost( $title, $content,$id)
{
	$postManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager();

	$modifiedPost = $postManager->editPost( $title, $content, $id);
	if ($modifiedPost === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id='. $_GET['id']);
    } 
}
function connexionAdmin()
{   
    if ($_POST['pseudo_Connexion'] == NULL OR $_POST['pass_Connexion'] == NULL){

        echo 'Vous n\'avez pas rempli tous les champs';

	} else {
		$loginManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\loginManager();

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

function reportedComments()
{
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $reportedComments = $commentManager->getCommentReported();
    
    require ('view/backend/reportedComments.php'); 
}
}