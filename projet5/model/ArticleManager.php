<?php
namespace Projet5\model;

require_once("model/Manager.php");
require_once("model/Article.php");

class ArticleManager extends Manager
{   
    public function getArticles() // récupère la liste des billets
    {   
        $articles=[];

        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 3; // On limite à 3 le nombre de billets par page de billets
        $debut = ($page - 1) * $limite;
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM articles ORDER BY creation_date DESC LIMIT :limite OFFSET :debut');
        $req->bindParam(':limite', $limite, \PDO::PARAM_INT);
        $req->bindParam(':debut', $debut, \PDO::PARAM_INT);
        
        $req->execute();
        while ($data = $req->fetch())
        {
          $articles[] = new Article($data);
        }
        return $articles;
    }
    public function countArticles() // compte le nombre de billets
    {   
        $limite = 3; // On limite à 3 le nombre de billets par page de billets
        $db = $this->dbConnect();
        /* On commence par récupérer le nombre d'éléments total. Comme c'est une requête,
         * il ne faut pas oublier qu'on ne récupère pas directement le nombre.
         * Ici, comme la requête ne contient aucune donnée client pour fonctionner,
         * on peut l'exécuter ainsi directement */
        $req = $db->query('SELECT COUNT(id) AS number_articles FROM articles'); 
        $nombredElementsTotal = $req->fetchColumn(); 
        /* On calcule le nombre de pages */
        $nombreDePages = ceil($nombredElementsTotal / $limite);
        return $nombreDePages;
    }

    public function getArticle($articleId) //récupère un billet sélectionné
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM articles WHERE id = :id');
        $req->bindValue(':id', $articleId);
        $req->execute();
        $article = $req->fetch();
        if ($article == false){
            return false;
        }
        return new Article($article);
    }
    public function insertArticle(Article $article) // insère un nouveau billet
    {       
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO articles(title, content, creation_date) VALUES(:title, :content, NOW())');
            $req->bindValue(':title', $article->title());
            $req->bindValue(':content',$article->content());
            $req->execute();
            
    }

    public function editArticle(Article $article)// récupère le billet à modifier
    {
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE articles SET title = :title, content = :content, creation_date = NOW() WHERE id = :id');
            $req->bindValue(':title', $article->title());
            $req->bindValue(':content',$article->content());
            $req->bindValue(':id', $article->id());
            $req->execute(); 
    }

    public function eraseArticle($id) // récupère le billet à supprimer
    {
            $db = $this->dbConnect();
            $comments = $db->exec('DELETE FROM articles WHERE id = '. $id);
    }
}