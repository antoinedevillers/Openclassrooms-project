<?php
namespace Projet4\model;

class Login
{
  private $_id;
  private $_login;
  private $_pass;


  // Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
  public function hydrate(array $donnees)
  {
      foreach ($donnees as $key => $value)
    {
      // On récupère le nom du setter correspondant à l'attribut.
      $method = 'set'.ucfirst($key);
          
      // Si le setter correspondant existe.
      if (method_exists($this, $method))
      {
        // On appelle le setter.
        $this->$method($value);
      }
    }
    if (isset($donnees['id']))
    {
      $this->setId($donnees['id']);
    }

    if (isset($donnees['login']))
    {
      $this->setLogin($donnees['login']);
    }

    if (isset($donnees['pass']))
    {
      $this->setPass($donnees['pass']);
    }
  }
  public function id() { return $this->_id; }
  public function login() { return $this->_login; }
  public function pass() { return $this->_pass; }

  public function setId($id)
  {
    // L'identifiant du login sera, quoi qu'il arrive, un nombre entier.
    $this->_id = (int) $id;
  }
        
  public function setLogin($login)
  {
    if (is_string($login) && strlen($login) <= 30)
    {
      $this->_login = $login;
    }
  }

  public function setPass($pass)
  {         
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($pass) && strlen($pass) <= 30)
    {
      $this->_pass = $pass;
    }
  }
}