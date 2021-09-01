<?php

namespace App\Models;

use Database\Database;

class MainModels extends Database
{    
    /**
     * Récupère les articles
     *
     * @return void
     */
    public function findAll()
    {
        $req = "SELECT articles.*, category.name FROM articles INNER JOIN category ON articles.category_id = category.id ORDER BY articles.id DESC";
        $statement = $this->getDbb()->prepare($req);
        $statement->execute();
        $articles = $statement->fetchAll();
        $statement->closeCursor();
        return $articles;
    }

        
    /**
     * Récupère les catégories
     *
     * @return void
     */
    public function findCategory()
    {
        $req = "SELECT * FROM category";
        $statement = $this->getDbb()->prepare($req);
        $statement->execute();
        $category = $statement->fetchAll();
        $statement->closeCursor();
        return $category;
    }
}