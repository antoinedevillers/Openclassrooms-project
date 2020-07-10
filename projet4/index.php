<?php
session_start();
require ('controller/Frontend.php');
require ('controller/Backend.php');

use \Openclassrooms\sitesPHP\Openclassroomsproject\projet4\controller\Frontend;
use \Openclassrooms\sitesPHP\Openclassroomsproject\projet4\controller\Backend;

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontend = new Frontend();

            $listPosts = $frontend->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();

                $post = $frontend->post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend = new Frontend();

                    $addComment = $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
         }    
        elseif ($_GET['action'] == 'changeComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    $frontend = new Frontend();

                    $changeComment = $frontend->changeComment($_GET['id'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }    
            }  else {
            // Autre exception
            throw new Exception('Aucun identifiant de billet envoyé');
            }          
        } else if($_GET['action'] == 'comment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();

                $comment = $frontend->comment($_GET['id']);
            } 
            else {
            // Autre exception
            throw new Exception('Aucun identifiant de commentaire');
            }
        } else if ($_GET['action'] == 'connexionAdmin') {
            $backend = new Backend();
            $connexionAdmin = $backend->connexionAdmin();

        } else if ($_GET['action'] == 'deconnexionAdmin') {
            $backend = new Backend();
            $deconnexionAdmin = $backend->deconnexionAdmin();

        } else if ($_GET['action'] == 'formConnexionAdmin'){
            $frontend = new Frontend();
            $formConnexionAdmin = $frontend->formConnexionAdmin();

        } else if ($_GET['action'] == 'formPost'){
            $backend = new Backend();
            $formPost = $backend->formPost();

        } else if ($_GET['action'] == 'formChangePost'){
            $backend = new Backend();
            $formChangePost = $backend->formChangePost();

        } else if ($_GET['action'] == 'changePost'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $changePost = $backend->changePost($_POST['title'],$_POST['content'], $_GET['id']);
                
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
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
        } else if ($_GET['action'] == 'deletePost'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $deletePost = $backend->deletePost($_GET['id']);
                
            }
        } else if ($_GET['action'] == 'formReport'){
            $frontend = new Frontend();
            $formReport = $frontend->formReport();

        } else if ($_GET['action'] == 'reportComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new Frontend();
                $reportComment = $frontend->reportComment($_GET['id']);
            } 
            else {
            // Autre exception
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
            
        } else if ($_GET['action'] == 'allowComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {                
                $backend = new Backend();
                $allowComment = $backend->allowComment($_GET['id']);
               } 
            }
    } else {
        $frontend = new Frontend();
        $listPosts = $frontend->listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
