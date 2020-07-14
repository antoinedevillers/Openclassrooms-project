<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    
public function getPosts()
{   
    $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
    $limite = 3;
    $debut = ($page - 1) * $limite;
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :limite OFFSET :debut');
    $req->bindParam(':limite', $limite, \PDO::PARAM_INT);
    $req->bindParam(':debut', $debut, \PDO::PARAM_INT);
    
    $req->execute();
    return $req;
}
public function countPosts()
{   $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
    $limite = 3;
    $debut = ($page - 1) * $limite;
    $db = $this->dbConnect();
    /* On commence par récupérer le nombre d'éléments total. Comme c'est une requête,
     * il ne faut pas oublier qu'on ne récupère pas directement le nombre.
     * Ici, comme la requête ne contient aucune donnée client pour fonctionner,
     * on peut l'exécuter ainsi directement */
    $req = $db->query('SELECT COUNT(id) AS number_posts FROM posts'); 
    $nombredElementsTotal = $req->fetchColumn(); 
    /* On calcule le nombre de pages */
    $nombreDePages = ceil($nombredElementsTotal / $limite);
    return $nombreDePages;
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
        $posts = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedPost = $posts->execute(array($title, $content));

        return $affectedPost;
    }

public function editPost( $title, $content, $id)
    {
       $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE posts SET title = ?, content = ?, creation_date = NOW() WHERE id = ?');
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