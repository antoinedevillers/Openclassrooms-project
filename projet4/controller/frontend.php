<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\controller;

use \Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model\PostManager;
use \Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model\CommentManager;
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Frontend
{

public function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

public function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

public function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->addPostComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

public function comment($id)
{
   //On récupère le commentaire
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($_GET['id']);
    
    require ('view/backend/modifyComment.php') ;   //On affiche la vue du formulaire 
   
}

public function changeComment($id, $comment)
{   
    $commentManager = new CommentManager();

    $modifiedLines = $commentManager->editComment($id, $comment);

    if ($modifiedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id='. $_POST['postId']);
    } 
}
public function formReport()
{   
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($_GET['id']);
    require('view/frontend/formReport.php');
}
public function reportComment($id)
{
    $commentManager = new CommentManager();

    $reportComment = $commentManager->insertReport($id); 
    if ($reportComment === false) {
        throw new Exception('Impossible de signaler le commentaire..');
    }
    else {
        header('Location: index.php?action=post&id='. $_POST['postId']);
    } 
       
}
public function formConnexionAdmin()
{
    require ('view/frontend/formConnexionAdmin.php');
}

}

