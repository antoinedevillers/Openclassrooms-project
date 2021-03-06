<?php
session_start();
require ('controller/Frontend.php');
require ('controller/Backend.php');

use \Projet4\controller\Frontend;
use \Projet4\controller\Backend;
use \Projet4\model\Post;
use \Projet4\model\Comment;

try { 
    // affiche la liste de billets
    if (isset($_GET['action'])) {

        switch ($_GET['action']) // on indique sur quelle variable on travaille
        {
            case 'listPosts':
                $frontend = new Frontend();
                
                $listPosts = $frontend->listPosts();

            break;

            //affiche un billet
            case 'post':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend = new Frontend();

                    $post = $frontend->post();
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

    // Action ajout et affichage de commentaires

            //Action d'ajout d'un commentaire
            case 'addComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['com'])) {
                        $frontend = new Frontend();
                        $comment = new Comment($_POST);
                        $comment->setId($_GET['id']);
                        $comment->setPost_id($_GET['id']);
                        $addComment = $frontend->addComment($comment);
                    }
                    else {
                        $_SESSION['error'] = ''; 
                        header('Location: index.php?action=post&id=' . $_GET['id']);
                    }
                }            
            break;

            // Action d'affichage des commentaires du billet en question
            case 'comment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend = new Frontend();

                    $comment = $frontend->comment($_GET['id']);
                } 
                else {
                    throw new Exception('Aucun identifiant de commentaire');
                }
            break;
    //Action connexion/deconnexion à l'administration

            // Action de connexion à l'espace d'administration
            case 'connexionAdmin':
                if ($_POST['pseudo_Connexion'] == NULL OR $_POST['pass_Connexion'] == NULL){

                    $_SESSION['error'] = ''; 
                        header('Location: index.php?action=formConnexionAdmin');

                } else {
                        $backend = new Backend();
                        $connexionAdmin = $backend->connexionAdmin();
                }
            break;

            //Action de déconnexion de l'espace d'administration
            case 'deconnexionAdmin':
                $backend = new Backend();
                $deconnexionAdmin = $backend->deconnexionAdmin();
            break;

            // Affichage du formulaire de connexion à l'espace d'administration
            case 'formConnexionAdmin':
                $frontend = new Frontend();
                $formConnexionAdmin = $frontend->formConnexionAdmin();
            break;

    //Action sur les billets
            
            // affiche le formulaire de modification d'un billet
            case 'formChangePost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $backend = new Backend();
                    $formChangePost = $backend->formChangePost();
                }
                else {
                    throw new Exception('Aucun identifiant de billet');
                }
            break;

            //action de mofification dun billet
            case 'changePost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {        
                        $backend = new Backend();
                        $post = new Post($_POST);
                        $post->setId($_GET['id']);
                        $changePost = $backend->changePost($post); 

                    } else {
                        $_SESSION['error'] = ''; 
                        header('Location: index.php?action=formChangePost&id='. $_GET['id']);
                    }
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

            // affiche le formulaire d'ajout de nouveau billet
            case 'formCreatePost':     
                    $backend = new Backend();
                    $formCreatePost = $backend->formCreatePost();
            break;

            // action d'ajout de billet
            case 'addPost':
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $backend = new Backend();
                    $post = new Post($_POST);
                    $addPost = $backend->addPost($post);
                }
                else {
                    $_SESSION['error'] = ''; 
                    header('Location: index.php?action=formCreatePost');
                }
            break;

            // Action de suppression d'un billet
            case 'deletePost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {                
                    $backend = new Backend();
                    $deletePost = $backend->deletePost($_GET['id']);               
                }
                else {
                    throw new Exception('Aucun identifiant de billet');
                } 
            break;

    //Action liée au signalement de commentaire

            // Affichage du formulaire de signalement d'un commentaire
            case 'formReport':
                $frontend = new Frontend();
                $formReport = $frontend->formReport();
            break;

            // Action de signalement d'un commentaire
            case 'reportComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend = new Frontend();
                    $reportComment = $frontend->reportComment($_GET['id']);
                } 
                else {
                    throw new Exception('Aucun identifiant de commentaire');
                } 
            break;

            //Affichage des commentaires signalés  
            case 'reportedComments':
                $backend = new Backend();
                $reportedComments = $backend->reportedComments();
            break;

            // Action de suppression d'un commentaire
            case 'deleteComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {                
                    $backend = new Backend();
                    $deleteComment = $backend->deleteComment($_GET['id']);
                   } 
                else {
                    throw new Exception('Aucun identifiant de commentaire');
                } 
            break;

            // Action d'autorisation d'un commentaire signalé
            case 'allowComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {                
                    $backend = new Backend();
                    $allowComment = $backend->allowComment($_GET['id']);
                } 
                else {
                    throw new Exception('Aucun identifiant de commentaire');
                } 
            break;

            default:
                throw new Exception('Action incorrecte');
        } 
    } else {
        $frontend = new Frontend();
        $listPosts = $frontend->listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, on affiche la page errorView avec le message adapté.
    $errorMessage = $e->getMessage();

    require('view/frontend/errorview.php');

}
