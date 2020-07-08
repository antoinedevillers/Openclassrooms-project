<?php

namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    public function getComment($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comments->execute(array($id));
        $comment = $comments->fetch();


        return $comment;
    }
    public function editComment($id, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $modifiedLines = $comments->execute(array($comment, $id));

        return $modifiedLines; 
    }
    function insertReport($id){
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(comment_report) VALUES(1) WHERE id =?');
        $reportComment = $comments->execute(array($id));

        return $reportComment;
    }
    function countCommentReported($commentReported){
        $db = $this->dbConnect();
        // On récupère le nombre de signalements par commentaire
        $req = $db->prepare('SELECT count(*) FROM membres WHERE comment_report = :comment_report')or die(print_r($db->errorInfo()));
        $req->execute(array(
            'comment_report'=>$commentReported
        ));
    return $req;
    }
    function getCommentReported(){
        $db = $this->dbConnect();
    // On récupère les commentaires signalés 
        $req = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE comment_report > 0');
       
    return $req;
    }
}
