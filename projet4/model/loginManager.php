<?php

namespace Projet4\model;

require_once("model/Manager.php");
require_once("model/Login.php");

class LoginManager extends Manager
{	

    public function getLoginAndPass()
    {
		$db = $this->dbConnect();
		//  Récupération de l'utilisateur et de son pass hashé
	    $req = $db->prepare('SELECT id, pass FROM login WHERE login = :login');
	   	$req->execute(array(
        'login' => $_POST['pseudo_Connexion']
    ));
	    return $req;
    }

}
