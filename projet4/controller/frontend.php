<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\controller;
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Frontend
{

function listPosts()
{
    $postManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager();
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function comment($id)
{
   //On récupère le commentaire
    $postManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager();
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $comment = $commentManager->getComment($_GET['id']);
    
    require ('view/backend/modifyComment.php') ;   //On affiche la vue du formulaire 
   
}

function changeComment($id, $comment)
{   
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $modifiedLines = $commentManager->editComment($id, $comment);

    if ($modifiedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id='. $_POST['postId']);
    } 
}
function formReport()
{   
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $comment = $commentManager->getComment($_GET['id']);
    require('view/frontend/formReport.php');
}
function reportComment($id)
{
    $commentManager = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager();

    $reportComment = $commentManager->insertReport($id); 
    if ($reportComment === false) {
        throw new Exception('Impossible de signaler le commentaire..');
    }
    else {
        header('Location: index.php?action=post&id='. $_POST['postId']);
        echo 'Votre requête de signalement a bien été envoyé à l\'administrateur du site';
    } 
       
}
function formConnexionAdmin()
{
    require ('view/frontend/formConnexionAdmin.php');
}

}

