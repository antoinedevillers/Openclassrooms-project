<?php
namespace Projet4\model;

class Comment
{
  private $_id;
  private $_post_id;
  private $_author;
  private $_comment;
  private $_coment_date;
  private $_comment_report;

  public function __construct($donnees)
   {
    $this->hydrate($donnees);
   }
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
  }  
  public function id() { return $this->_id; }
  public function post_id() { return $this->_post_id; }
  public function author() { return $this->_author; }
  public function comment() { return $this->_comment; }
  public function comment_date() { return $this->_comment_date; }
  public function comment_report() { return $this->_comment_report; }
  public function comment_date_fr() { 
    $date = new \DateTime($this->_comment_date);
    return $date->format('d/m/Y H:i:s');
  }

  public function setId($id)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->_id = (int) $id;
  }
        
  public function setPost_id($post_id)
  {
      $this->_post_id = (int) $post_id;
  }

  public function setAuthor($author)
  {         
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($author) && strlen($author) <= 30)
    {
      $this->_atuhor = $author;
    }

  }

  public function setComment($comment)
  {
    $comment = (int) $comment;

  if (is_string($comment) && strlen($comment) <= 300)
    {
      $this->_comment = $comment;
    }
  }

  public function setComment_date($comment_date)
  {
    
      $this->_comment_date = $comment_date;
  }

  public function setComment_report($comment_report)
  {
        $this->_comment_report = $comment_report;
  }
}