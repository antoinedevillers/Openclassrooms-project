<?php
namespace Projet5\controller;

use \Projet5\model\ArticleManager;
use \Projet5\model\CommentManager;
use \Projet5\model\Comment;
// Chargement des classes
require_once('model/ArticleManager.php');
require_once('model/CommentManager.php');

class Frontend
{

    public function home()
    {   
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 3;
        $debut = ($page - 1) * $limite;
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticles();
        $countArticles=$articleManager->countArticles();

        require('view/frontend/homeView.php'); // On affiche la liste des billets sur la page d'accueil
    }

    public function article()
    {   
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();

        $article = $articleManager->getArticle($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        $countComments=$commentManager->countComments($_GET['id']);

        if ($article === false) {
            throw new \Exception('Numéro d\'identifiant non valide !');
        }

        require('view/frontend/articleView.php'); // on affiche le billet, les commentaires de ce billet, et un formulaire d'ajout de commentaire
    }

    public function articles()
    {   
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 10;
        $debut = ($page - 1) * $limite;
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticles();
        $countArticles=$articleManager->countArticles();
        require('view/frontend/articlesView.php'); // On affiche la liste des billets sur la page d'accueil
    }
    public function addComment(Comment $comment)
    {   
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->addArticleComment($comment);
        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=article&id=' . $_GET['id']); // s'il n'y a pas d'erreur, on revient sur la page du billet après ajout du commentaire
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
            header('Location: index.php?action=article&id='. $_POST['articleId']); // s'il n'y a pas d'erreur, on revient sur la page du billet après signalement du commentaire
        } 
           
    }

    public function formConnexionAdmin()
    {
        require ('view/frontend/formConnexionAdmin.php'); // On affiche la vue du formulaire de connexion à l'espace d'administration
    }

    public function page()
    {   $articleManager = new ArticleManager();
        $articles = $articleManager->countArticles();
    }
    public function formContact()
    {  
        require ('view/frontend/formContact.php'); // On affiche la vue du formulaire de contact
    }
}

