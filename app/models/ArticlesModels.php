<?php

namespace App\Models;

use PDO;
use Database\Database;
use DateTime;

class ArticlesModels extends Database
{
    private $createdAt;

    public function __construct()
    {
        date_default_timezone_set('Europe/Paris');
        $this->createdAt = (new DateTime())->format("Y-m-d");
    }
    
    /**
     * Récupère tous les articles
     *
     * @return void
     */
    public function fetchAll()
    {
        $req = "SELECT articles.*, category.name 
                FROM articles 
                INNER JOIN category ON articles.category_id = category.id";
        $statement = $this->getDbb()->prepare($req);
        $statement->execute();
        $articles = $statement->fetchAll();
        $statement->closeCursor();
        return $articles;
    }

        
    /**
     * Récupère un article à partir de son id
     *
     * @param  int $idArticle
     * @return void
     */
    public function fetchOne($idArticle)
    {
        $req = "SELECT articles.*, category.name, users.firstname
                FROM articles 
                INNER JOIN category ON articles.category_id = category.id 
                INNER JOIN users ON articles.author_id = users.id 
                WHERE articles.id = :idArticle";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":idArticle", $idArticle, PDO::PARAM_INT);
        $statement->execute();
        $article = $statement->fetch();
        $statement->closeCursor();
        return $article;
    }
    
    /**
     * searchArticle
     *
     * @param  mixed $search
     * @return void
     */
    public function searchArticle($search)
    {
        $req = "SELECT articles.*, category.name, users.firstname
                FROM articles 
                INNER JOIN category ON articles.category_id = category.id 
                INNER JOIN users ON articles.author_id = users.id 
                WHERE articles.title LIKE :search OR category.name LIKE :search 
                ORDER BY id DESC";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);
        $statement->execute();
        $articleSearch = $statement->fetchAll();
        $statement->closeCursor();
        return $articleSearch;
    }
    
    /**
     * Récupère tous les catégories
     *
     * @return void
     */
    public function fetchCategory()
    {
        $req = "SELECT * FROM category";
        $statement = $this->getDbb()->prepare($req);
        $statement->execute();
        $category = $statement->fetchAll();
        $statement->closeCursor();
        return $category;
    }
    
    /**
     * Récupère les articles de l'utilisateur à partir de l'id de l'auteur
     *
     * @param  int $userId
     * @return void
     */
    public function fetchUserArticles(int $userId)
    {
        $req = "SELECT articles.*, category.name 
                FROM articles 
                INNER JOIN category ON articles.category_id = category.id 
                WHERE articles.author_id = :userId
                ORDER BY articles.id DESC";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":userId", $userId, PDO::PARAM_INT);
        $statement->execute();
        $articlesUser = $statement->fetchAll();
        $statement->closeCursor();
        return $articlesUser;
    }

    
    /**
     * Modifie l'article à partir de l'id de l'article
     *
     * @param  int $articleID
     * @param  string $title
     * @param  int $id
     * @param  string $content
     * @return void
     */
    public function updateOne(int $articleID, string $title,string $id,string $content)
    {
        $req = "UPDATE articles
                SET 
                title = :title,
                category_id = :categoryID,
                content = :content
                WHERE id = :articleID";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":title", $title, PDO::PARAM_STR);
        $statement->bindValue(":categoryID", $id, PDO::PARAM_INT);
        $statement->bindValue(":content", $content, PDO::PARAM_STR);
        $statement->bindValue(":articleID", $articleID, PDO::PARAM_INT);
        $statement->execute();
        $articleEdit = ($statement->rowCount() > 0);
        $statement->closeCursor();
        return $articleEdit;
    }
    
    /**
     * Supprime un article à partir de l'id de l'article
     *
     * @param  int $idArticle
     * @return void
     */
    public function deleteOne(int $idArticle)
    {
        $req = "DELETE FROM articles WHERE id = :articleID LIMIT 1";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":articleID", $idArticle, PDO::PARAM_INT);
        $statement->execute();
        return $idArticle;
    }

        
    /**
     * Crée un article
     *
     * @param  string $title
     * @param  string $image
     * @param  int $categoryId
     * @param  string $content
     * @param  int $idUser
     * @return void
     */
    public function createOne(string $title,string $image,int $categoryId,string $content, int $idUser)
    {
        $req = "INSERT INTO articles VALUES (
            DEFAULT,
            :title,
            :image,
            :content,
            :createdAt,
            :category_id,
            :author_id
        )";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":title", $title, PDO::PARAM_STR);
        $statement->bindValue(":image", $image, PDO::PARAM_STR);
        $statement->bindValue(":content", $content, PDO::PARAM_STR);
        $statement->bindValue(":createdAt", $this->createdAt);
        $statement->bindValue(":category_id", $categoryId, PDO::PARAM_INT);
        $statement->bindValue(":author_id", $idUser, PDO::PARAM_INT);
        $statement->execute();
        $createArticle = ($statement->rowCount() > 0);
        $statement->closeCursor();
        return $createArticle;
    }
}