<?php

namespace Openclassrooms\sitesPHP\projet4\model;

require_once("model/Manager.php");

class LoginManager extends Manager
{
	public function insertLoginAndPass($login, $pass_hache)
	{	
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO login(login, pass) VALUES(:login, :pass)');
		$req->execute(array(
		    'login' => $login,
		    'pass' => $pass_hache,
		    ));
		return $req;
			
	}
	
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
