<?php
namespace Projet4\model;

require_once("model/Manager.php");
require_once("model/Post.php");

class PostManager extends Manager
{   
    public function getPosts() // récupère la liste des billets
    {   
        $posts=[];

        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 3; // On limite à 3 le nombre de billets par page de billets
        $debut = ($page - 1) * $limite;
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM posts ORDER BY creation_date DESC LIMIT :limite OFFSET :debut');
        $req->bindParam(':limite', $limite, \PDO::PARAM_INT);
        $req->bindParam(':debut', $debut, \PDO::PARAM_INT);
        
        $req->execute();
        while ($data = $req->fetch())
        {
          $posts[] = new Post($data);
        }
        return $posts;
    }
    public function countPosts() // compte le nombre de billets
    {   
        $limite = 3; // On limite à 3 le nombre de billets par page de billets
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

    public function getPost($postId) //récupère un billet sélectionné
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        $req->bindValue(':id', $postId);
        $req->execute();
        $post = $req->fetch();
        if ($post == false){
            return false;
        }
        return new Post($post);
    }
    public function insertPost(Post $post) // insère un nouveau billet
    {       
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(:title, :content, NOW())');
            $req->bindValue(':title', $post->title());
            $req->bindValue(':content',$post->content());
            $req->execute();
            
    }

    public function editPost(Post $post)// récupère le billet à modifier
    {
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE posts SET title = :title, content = :content, creation_date = NOW() WHERE id = :id');
            $req->bindValue(':title', $post->title());
            $req->bindValue(':content',$post->content());
            $req->bindValue(':id', $post->id());
            $req->execute(); 
    }

    public function erasePost($id) // récupère le billet à supprimer
    {
            $db = $this->dbConnect();
            $comments = $db->exec('DELETE FROM posts WHERE id = '. $id);
    }
}