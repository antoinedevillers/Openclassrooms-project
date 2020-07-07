<?php
session_start();
require ('controller/frontend.php');
require ('controller/backend.php');
try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
                    changeComment($_GET['id'], $_POST['comment']);
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
                comment($_GET['id']);
            } 
            else {
            // Autre exception
            throw new Exception('Aucun identifiant de commentaire');
            }
        } else if ($_GET['action'] == 'addAdmin'){
            if (!empty($_POST['pseudo_Subscription']) && !empty($_POST['pass_Subscription1']) && !empty($_POST['pass_Subscription2'])) {
                    addAdmin($_POST['pseudo_Subscription'], $_POST['pass_Subscription1']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }

        } else if ($_GET['action'] == 'formInscriptionAdmin')  {
            formInscriptionAdmin();

        } else if ($_GET['action'] == 'connexionAdmin') {
            connexionAdmin();

        } else if ($_GET['action'] == 'deconnexionAdmin') {
            deconnexionAdmin();

        } else if ($_GET['action'] == 'sessionAdmin') {
            sessionAdmin();

        } else if ($_GET['action'] == 'formConnexionAdmin'){
            formConnexionAdmin();
        } else if ($_GET['action'] == 'formPost'){
            formPost();
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
