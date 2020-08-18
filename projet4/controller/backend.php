<?php
namespace Projet4\controller;

use \Projet4\model\PostManager;
use \Projet4\model\LoginManager;
use \Projet4\model\CommentManager;
use \Projet4\model\Post;
// Chargement des classes
require_once('model/LoginManager.php');

class Backend
{
// Fonctions pour la gestion des billets

    public function formChangePost()
    {	
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
            $postManager = new PostManager();
        	$post = $postManager->getPost($_GET['id']);
            if ($post === false){
                throw new Exception('Numéro d\'identifiant non valide!');  
            } else {
                require('view/backend/formChangePost.php'); // Affiche la vue du formulaire de modification du billet
            }
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function changePost(Post $post)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$postManager = new PostManager();
        	$modifiedPost = $postManager->editPost($post);
        	if ($modifiedPost === false) {
                throw new \Exception('Impossible de modifier le billet !');
            }
            else {
                header('Location: index.php'); 
            } 
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function formCreatePost()
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
    	   require('view/backend/formCreatePost.php');
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function addPost(Post $post)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
            $postManager = new PostManager();

            $affectedPost = $postManager->insertPost($post);

            if ($affectedPost === false) {
                throw new \Exception('Impossible d\'ajouter le billet !');
            }
            else {
                header('Location: index.php#derniersbillets'); // s'il n'y a pas d'erreur on revient sur la page d'accueil pour voir l'ajout du nouveau billet
            }
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function deletePost ($id)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$postManager = new PostManager();

        	$deletePost = $postManager->erasePost($id);
        	if ($deletePost === false) {
                throw new \Exception('Impossible de supprimer le commentaire !');
            }
            else {
                header('Location: index.php');// S'il n'y a pas d'erreur, on revient sur la page d'accueil
            } 
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

//Fonctions pour connexion/deconnexion à l'espace d'administration

    public function connexionAdmin()
    {       
    	$loginManager = new loginManager();

    	$req = $loginManager->getLoginAndPass();
    	$resultat = $req->fetch();

    	// Comparaison du pass envoyé via le formulaire avec la base
    	$isPasswordCorrect = password_verify($_POST['pass_Connexion'], $resultat['pass']);

    	if (!$resultat)// si les identifiants sont différents, on revient sur la page de connexion avec un message d'erreur
    	{
    		$_SESSION['errorId'] = ''; 
                    header('Location: index.php?action=formConnexionAdmin');
    	} else { // Si les identifiants sont égaux, on démarre la session
    	    if ($isPasswordCorrect) {
              session_start();
              $_SESSION['id'] = $resultat['id'];
              $_SESSION['login'] = $_POST['pseudo_Connexion'];

              header('Location: index.php');

    	    } else {

               $_SESSION['errorId'] = ''; 
                    header('Location: index.php?action=formConnexionAdmin');
    	    }
    	}
    }

    public function deconnexionAdmin()
    {   
        session_start();
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();

        header('Location: index.php?action=listPosts');
    }

//Fonctions pour la gestion des commentaires signalés

    public function reportedComments()
    {   
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
            $commentManager = new CommentManager();

            $reportedComments = $commentManager->getCommentReported();

            require ('view/backend/reportedComments.php'); // Affiche la vue de la liste des commentaires signalés
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function deleteComment($id)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$commentManager = new CommentManager();

            $deleteComment = $commentManager->eraseComment($id);

            if ($deleteComment === false) {
                throw new \Exception('Impossible de supprimer le commentaire !');
            }
            else {
                header('Location: index.php?action=reportedComments'); // S'il n'y a pas d'erreur, on retourne sur la vue de la liste des commentaires signalés
            } 
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function allowComment($id)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$commentManager = new CommentManager();

            $allowComment = $commentManager->allowCommentReported($id);

            if ($allowComment === false) {
                throw new \Exception('Impossible d\'autoriser le commentaire !');
            }
            else {
                header('Location: index.php?action=reportedComments'); // S'il n'y a pas d'erreur, on retourne sur la vue de la liste des commentaires signalés
            }
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }
}