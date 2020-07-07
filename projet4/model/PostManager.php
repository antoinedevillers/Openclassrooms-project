<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    
public function getPosts()
{
    $db = $this->dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

public function getPost($postId)
{
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}
public function insertPost($title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(author, content, comment_date) VALUES(?, ?, NOW())');
        $affectedPost = $posts->execute(array($title, $content));

        return $affectedPost;
    }

public function editPost($id, $title, $content)
    {
       $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE posts SET title = ?, content = ?, comment_date = NOW() WHERE id = ?');
        $modifiedPost = $comments->execute(array($title, $content, $id));

        return $modifiedPost; 
    }

public function erasePost($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM posts WHERE id = ?');
        $erasedPost = $comments->execute(array($id));

        return $erasedPost;
    }
}