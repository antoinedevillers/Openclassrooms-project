<?php
namespace Projet5\controller;

use \Projet5\model\ArticleManager;
use \Projet5\model\LoginManager;
use \Projet5\model\CommentManager;
use \Projet5\model\Article;
// Chargement des classes
require_once('model/LoginManager.php');

class Backend
{
// Fonctions pour la gestion des billets

    public function formChangeArticle()
    {	
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
            $articleManager = new ArticleManager();
        	$article = $articleManager->getArticle($_GET['id']);
            if ($article === false){
                throw new Exception('Numéro d\'identifiant non valide!');  
            } else {
                require('view/backend/formChangeArticle.php'); // Affiche la vue du formulaire de modification du billet
            }
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function changeArticle(Article $article)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$articleManager = new ArticleManager();
        	$modifiedArticle = $articleManager->editArticle($article);
        	if ($modifiedArticle === false) {
                throw new \Exception('Impossible de modifier le billet !');
            }
            else {
                header('Location: index.php?action=formChangeArticle&id='. $_GET['id']); 
            } 
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function formCreateArticle()
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
    	   require('view/backend/formCreateArticle.php');
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function addArticle(Article $article)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
            $articleManager = new ArticleManager();

            $affectedArticle = $articleManager->insertArticle($article);

            if ($affectedArticle === false) {
                throw new \Exception('Impossible d\'ajouter le billet !');
            }
            else {
                header('Location: index.php#derniersbillets'); // s'il n'y a pas d'erreur on revient sur la page d'accueil pour voir l'ajout du nouveau billet
            }
        } else {
            throw new \Exception('Vous n\'êtes pas connecté'); 
        }
    }

    public function deleteArticle ($id)
    {
        if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
        	$articleManager = new ArticleManager();

        	$deleteArticle = $articleManager->eraseArticle($id);
        	if ($deleteArticle === false) {
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

        header('Location: index.php?');
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