<?php
namespace Projet4\controller;

use \Projet4\model\PostManager;
use \Projet4\model\CommentManager;
use \Projet4\model\Comment;
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Frontend
{

    public function listPosts()
    {   
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 3;
        $debut = ($page - 1) * $limite;
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        $countPosts=$postManager->countPosts();

        require('view/frontend/listPostsView.php'); // On affiche la liste des billets sur la page d'accueil
    }

    public function post()
    {   
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        $countComments=$commentManager->countComments($_GET['id']);

        if ($post === false) {
            throw new \Exception('Numéro d\'identifiant non valide !');
        }

        require('view/frontend/postView.php'); // on affiche le billet, les commentaires de ce billet, et un formulaire d'ajout de commentaire
    }

    public function addComment(Comment $comment)
    {   
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->addPostComment($comment);
        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $_GET['id']); // s'il n'y a pas d'erreur, on revient sur la page du billet après ajout du commentaire
        }
    }

    public function formReport()
    {   
        $commentManager = new CommentManager();

        $comment = $commentManager->getComment($_GET['id']);
        require('view/frontend/formReport.php'); // On affiche la vue du formulaire de signalement d'un commentaire
    }

    public function reportComment($id)
    {
        $commentManager = new CommentManager();

        $reportComment = $commentManager->insertReport($id); 

        if ($reportComment === false) {
            throw new \Exception('Impossible de signaler le commentaire..');
        }
        else {
            $_SESSION['message_confirmation_reported_comment'] = '';
            header('Location: index.php?action=post&id='. $_POST['postId']); // s'il n'y a pas d'erreur, on revient sur la page du billet après signalement du commentaire
        } 
           
    }

    public function formConnexionAdmin()
    {
        require ('view/frontend/formConnexionAdmin.php'); // On affiche la vue du formulaire de connexion à l'espace d'administration
    }

    public function page()
    {   $postManager = new PostManager();
        $posts = $postManager->countPosts();
    }
}

