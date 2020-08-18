<?php
namespace Projet5\model;

class Comment
{
  private $id;
  private $post_id;
  private $author;
  private $com;
  private $comment_date;
  private $comment_report;

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
  public function id() { return $this->id; }
  public function post_id() { return $this->post_id; }
  public function author() { return $this->author; }
  public function com() { return $this->com; }
  public function comment_date() { return $this->comment_date; }
  public function comment_report() { return $this->comment_report; }
  public function comment_date_fr() { 
    $date = new \DateTime($this->comment_date);
    return $date->format('d/m/Y H:i:s');
  }

  public function setId($id)
  {
    // L'identifiant du commentaire sera, quoi qu'il arrive, un nombre entier.
    $this->id = (int) $id;
  }
        
  public function setPost_id($post_id)
  {
      $this->post_id = (int) $post_id;
  }

  public function setAuthor($author)
  {         
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($author) && strlen($author) <= 30)
    {
      $this->author = $author;
    }

  }

  public function setCom($com)
  {

  if (is_string($com) && strlen($com) <= 300)
    {
      $this->com = $com;
    }
  }

  public function setComment_date($comment_date)
  {
    
      $this->comment_date = $comment_date;
  }

  public function setComment_report($comment_report)
  {
        $this->comment_report = $comment_report;
  }
}