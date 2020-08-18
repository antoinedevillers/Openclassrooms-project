<?php

namespace Projet5\model;

require_once("model/Manager.php");
require_once("model/Comment.php");

class CommentManager extends Manager
{
    public function getComments($articleId)
    {   
        //On récupère tous les commentaires pour chaque article
        $comments=[];
        $pageComment = (!empty($_GET['pageComment']) ? $_GET['pageComment'] : 1);
        $limite = 3; // On limite à 3 le nombre de commentaires par page de commentaires
        $debut = ($pageComment - 1) * $limite;
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE article_id = :article_id ORDER BY comment_date DESC LIMIT :limite OFFSET :debut');
        $req->bindParam(':article_id', $articleId, \PDO::PARAM_INT);
        $req->bindParam(':limite', $limite, \PDO::PARAM_INT);
        $req->bindParam(':debut', $debut, \PDO::PARAM_INT);
        $req->execute();
        while ($data = $req->fetch())
        {
          $comments[] = new Comment($data);
        }
        return $comments;

    }
    public function countComments($articleId)
    {   
        $limite = 3; // On limite à 3 le nombre de commentaires par page de commentaires
        $db = $this->dbConnect();
        /* On commence par récupérer le nombre d'éléments total. Comme c'est une requête,
         * il ne faut pas oublier qu'on ne récupère pas directement le nombre.
         * Ici, comme la requête ne contient aucune donnée client pour fonctionner,
         * on peut l'exécuter ainsi directement */
        $req = $db->prepare('SELECT COUNT(id) AS number_comments FROM comments WHERE article_id= :article_id'); 
        $req->execute(['article_id' => $articleId]);
        $nombredElementsTotal = $req->fetchColumn(); 
        /* On calcule le nombre de pages */
        $nombreDePages = ceil($nombredElementsTotal / $limite);
        return $nombreDePages;
    }

    public function addArticleComment(Comment $comment)
    {
        $db = $this->dbConnect();
        // On insère un nouveau commentaire
        $req = $db->prepare('INSERT INTO comments(article_id, author, com, comment_date, comment_report) VALUES(:article_id, :author, :com, NOW(), 0)');
        $req->bindValue(':article_id',$comment->article_id());
        $req->bindValue(':author',$comment->author());
        $req->bindValue(':com',$comment->com());
        $req->execute();

    }
    public function getComment($id)
    {
        $db = $this->dbConnect();
        // On récupère un commentaire avec son id
        $req = $db->prepare('SELECT id, article_id, author, com, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Comment($data);
    }

    public function insertReport($id)
    {
        $db = $this->dbConnect();
        // On modifie ici le champs comment_report de la base de donnée pour lui indiquer que le commentaire est signalé. Par défaut, comment_report = 0. Si le commentaire est signalé, comment_report = 1.
        $req = $db->prepare('UPDATE comments SET comment_report = 1 WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        
    }
    public function getCommentReported()
    {
        $db = $this->dbConnect();
    // On récupère les commentaires signalés , soit ceux dont le champs comment_report = 1.
        $req = $db->query('SELECT * FROM comments WHERE comment_report = 1');
       
        while ($data = $req->fetch())
        {
            $commentReported[] = new Comment($data);
            
        }
        if (isset($commentReported))
        {
            return $commentReported;
        }
    }
    public function eraseComment($id)
    {
        $db = $this->dbConnect();
        // On supprime un commentaire
        $req = $db->exec('DELETE FROM comments WHERE id = '. $id);
    }
    public function allowCommentReported($id)
    {
        $db = $this->dbConnect();
    // On modifie la valeur du commentaire de 1 à 0 dans le champ comment_report pour autoriser sa publication. 
        $req = $db->prepare('UPDATE comments SET comment_report = 0 WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
       
        return $allowComment;
    }
}
