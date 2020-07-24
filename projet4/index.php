<?php
session_start();
require ('controller/Frontend.php');
require ('controller/Backend.php');

use \Projet4\controller\Frontend;
use \Projet4\controller\Backend;

try { 
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontend = new Frontend();
            
            $listPosts = $frontend->listPosts();
        }
        else if ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();

                $post = $frontend->post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
// Action ajout et affichage de commentaires
        else if ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend = new Frontend();

                    $addComment = $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    $_SESSION['error'] = ''; 
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                }
            }            
        } else if($_GET['action'] == 'comment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();

                $comment = $frontend->comment($_GET['id']);
            } 
            else {
                throw new Exception('Aucun identifiant de commentaire');
            }

//Action connexion/deconnexion à l'administration

        } else if ($_GET['action'] == 'connexionAdmin') {
            if ($_POST['pseudo_Connexion'] == NULL OR $_POST['pass_Connexion'] == NULL){

                $_SESSION['error'] = ''; 
                    header('Location: index.php?action=formConnexionAdmin');

            } else {
                    $backend = new Backend();
                    $connexionAdmin = $backend->connexionAdmin();
            }
        } else if ($_GET['action'] == 'deconnexionAdmin') {
            $backend = new Backend();
            $deconnexionAdmin = $backend->deconnexionAdmin();

        } else if ($_GET['action'] == 'formConnexionAdmin'){
            $frontend = new Frontend();
            $formConnexionAdmin = $frontend->formConnexionAdmin();

//Action sur les billets

        } else if ($_GET['action'] == 'formPost'){
            $backend = new Backend();
            $formPost = $backend->formPost();

        } else if ($_GET['action'] == 'formChangePost'){
            $backend = new Backend();
            $formChangePost = $backend->formChangePost();

        } else if ($_GET['action'] == 'changePost'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {        
                    $backend = new Backend();
                    $changePost = $backend->changePost($_POST['title'],$_POST['content'], $_GET['id']); 
                } else {
                    $_SESSION['error'] = ''; 
                    header('Location: index.php?action=formChangePost&id='. $_GET['id']);
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } else if($_GET['action'] == 'formCreatePost'){       
                $backend = new Backend();
                $formCreatePost = $backend->formCreatePost();
                
        } elseif ($_GET['action'] == 'addPost') {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $backend = new Backend();

                    $addPost = $backend->addPost($_POST['title'], $_POST['content']);
                }
                else {
                    $_SESSION['error'] = ''; 
                    header('Location: index.php?action=formCreatePost');
                }
        } else if ($_GET['action'] == 'deletePost'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $deletePost = $backend->deletePost($_GET['id']);               
            }
            else {
                throw new Exception('Aucun identifiant de billet');
            } 
//Action liée au signalement de commentaire
        } else if ($_GET['action'] == 'formReport'){
            $frontend = new Frontend();
            $formReport = $frontend->formReport();

        } else if ($_GET['action'] == 'reportComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();
                $reportComment = $frontend->reportComment($_GET['id']);
            } 
            else {
                throw new Exception('Aucun identifiant de commentaire');
            }   
        } else if ($_GET['action'] == 'reportedComments'){
            $backend = new Backend();
            $reportedComments = $backend->reportedComments();

        } else if ($_GET['action'] == 'deleteComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $deleteComment = $backend->deleteComment($_GET['id']);
               } 
            else {
                throw new Exception('Aucun identifiant de commentaire');
            } 
        } else if ($_GET['action'] == 'allowComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $allowComment = $backend->allowComment($_GET['id']);
            } 
            else {
                throw new Exception('Aucun identifiant de commentaire');
            } 
        } 
    } else {
        $frontend = new Frontend();
        $listPosts = $frontend->listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();

    require('view/frontend/errorView.php');

}
