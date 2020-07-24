<?php
namespace Projet4\controller;

use \Projet4\model\PostManager;
use \Projet4\model\loginManager;
use \Projet4\model\CommentManager;
// Chargement des classes
require_once('model/loginManager.php');

class Backend
{

    public function formChangePost()
    {	
        $postManager = new PostManager();
    	$post = $postManager->getPost($_GET['id']);
    	require('view/backend/formChangePost.php');
    }

    public function changePost( $title, $content,$id)
    {
    	$postManager = new PostManager();
    	$modifiedPost = $postManager->editPost( $title, $content, $id);
    	if ($modifiedPost === false) {
            throw new \Exception('Impossible de modifier le billet !');
        }
        else {
            header('Location: index.php?action=formChangePost&id='. $_GET['id']);
        } 
    }

    public function formCreatePost()
    {
    	require('view/backend/formCreatePost.php');
    }

    public function addPost($title, $content)
    {
        $postManager = new PostManager();

        $affectedPost = $postManager->insertPost($title, $content);

        if ($affectedPost === false) {
            throw new \Exception('Impossible d\'ajouter le billet !');
        }
        else {
            header('Location: index.php');
        }
    }

    public function deletePost ($id)
    {
    	$postManager = new PostManager();

    	$deletePost = $postManager->erasePost($id);
    	if ($deletePost === false) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        }
        else {
            header('Location: index.php');
        } 
    }

    public function connexionAdmin()
    {       
    	$loginManager = new loginManager();

    	$req = $loginManager->getLoginAndPass();
    	$resultat = $req->fetch();

    	// Comparaison du pass envoyé via le formulaire avec la base
    	$isPasswordCorrect = password_verify($_POST['pass_Connexion'], $resultat['pass']);

    	if (!$resultat)
    	{
    		$_SESSION['errorId'] = ''; 
                    header('Location: index.php?action=formConnexionAdmin');
    	} else {
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

    public function reportedComments()
    {
        $commentManager = new CommentManager();

        $reportedComments = $commentManager->getCommentReported();

        require ('view/backend/reportedComments.php'); 
    }

    public function deleteComment($id)
    {
    	$commentManager = new CommentManager();

        $deleteComment = $commentManager->eraseComment($id);

        if ($deleteComment === false) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        }
        else {
            header('Location: index.php?action=reportedComments');
        } 
    }

    public function allowComment($id)
    {
    	$commentManager = new CommentManager();

        $allowComment = $commentManager->allowCommentReported($id);

        if ($allowComment === false) {
            throw new \Exception('Impossible d\'autoriser le commentaire !');
        }
        else {
            header('Location: index.php?action=reportedComments');
        }
    }
}