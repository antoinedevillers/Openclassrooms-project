<?php
session_start();
require ('controller/frontend.php');
require ('controller/backend.php');
try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

            $listPosts = $frontend->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

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
                    $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

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
                    $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

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
                $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

                $comment = $frontend->comment($_GET['id']);
            } 
            else {
            // Autre exception
            throw new Exception('Aucun identifiant de commentaire');
            }
        } else if ($_GET['action'] == 'connexionAdmin') {
            $backend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\backend();

            $connexionAdmin = $backend->connexionAdmin();

        } else if ($_GET['action'] == 'deconnexionAdmin') {
            $backend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\backend();

            $deconnexionAdmin = $backend->deconnexionAdmin();
        } else if ($_GET['action'] == 'formConnexionAdmin'){
            $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

            $formConnexionAdmin = $frontend->formConnexionAdmin();
        } else if ($_GET['action'] == 'formPost'){
            $backend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\backend();

            $formPost = $backend->formPost();
        }
    }
    else {
        $frontend = new \OpenClassrooms\sitesPHP\Openclassroomsproject\projet4\controller\frontend();

            $listPosts = $frontend->listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
