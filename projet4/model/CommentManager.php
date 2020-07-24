<?php

namespace Projet4\model;

require_once("model/Manager.php");
require_once("model/Comment.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {   $comments=[];
        $pageComment = (!empty($_GET['pageComment']) ? $_GET['pageComment'] : 1);
        $limite = 3;
        $debut = ($pageComment - 1) * $limite;
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC LIMIT :limite OFFSET :debut');
        $req->bindParam(':post_id', $postId, \PDO::PARAM_INT);
        $req->bindParam(':limite', $limite, \PDO::PARAM_INT);
        $req->bindParam(':debut', $debut, \PDO::PARAM_INT);
        $req->execute();
        while ($data = $req->fetch())
        {
          $comments[] = new Comment($data);
        }
        return $comments;

    }
    public function countComments($postId)
    {   
     
        $limite = 3;
        
        $db = $this->dbConnect();
        /* On commence par récupérer le nombre d'éléments total. Comme c'est une requête,
         * il ne faut pas oublier qu'on ne récupère pas directement le nombre.
         * Ici, comme la requête ne contient aucune donnée client pour fonctionner,
         * on peut l'exécuter ainsi directement */
        $req = $db->prepare('SELECT COUNT(id) AS number_comments FROM comments WHERE post_id= :post_id'); 
        $req->execute(['post_id' => $postId]);
        $nombredElementsTotal = $req->fetchColumn(); 
        /* On calcule le nombre de pages */
        $nombreDePages = ceil($nombredElementsTotal / $limite);
        return $nombreDePages;
    }

    public function addPostComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, comment_report) VALUES(:post_id, :author, :comment, NOW(), 0)');
        $req->bindValue(':post_id',$comment->post_id());
        $req->bindValue(':author',$comment->author());
        $req->bindValue(':comment',$comment->comment());
        $req->execute();
    }
    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Comment($data);
    }

    public function insertReport(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment_report = 1 WHERE id = :id');
        $req->bindValue(':id', $comment->id());
        $req->execute();
        
    }
    public function getCommentReported()
    {
        $db = $this->dbConnect();
    // On récupère les commentaires signalés 
        $req = $db->query('SELECT * FROM comments WHERE comment_report = 1');
       
        while ($data = $req->fetch())
        {
            $commentReported[] = new Comment($data);
            
        }
        return $commentReported;
    }
    public function eraseComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->exec('DELETE FROM comments WHERE id = '.$comment->id());
    }
    public function allowCommentReported(Comment $comment)
    {
        $db = $this->dbConnect();
    // On modifie la valeur du commentaire dans le champ comment_report pour autoriser sa publication
        $req = $db->prepare('UPDATE comments SET comment_report = 0 WHERE id = :id');
        $req->bindValue(':id', $comment->id());
        $req->execute();
       
        return $allowComment;
    }
}
