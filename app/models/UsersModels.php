<?php

namespace App\Models;

use PDO;
use Database\Database;

class UsersModels extends Database
{
        
    /**
     * La méthode getByUserFromEmail() récupérer un user à partir de son e-mail
     *
     * @param  string $emailUser
     * @return void
     */
    public function getByUserFromEmail(string $emailUser)
    {
        $req = "SELECT * FROM users WHERE email = :emailUser";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":emailUser", $emailUser, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }
    
    /**
     * La méthode registerUser() insert l'utilisateur crée
     *
     * @param  string $firstname
     * @param  string $lastname
     * @param  string $email
     * @param  string $password
     * @return void
     */
    public function registerUser(string $firstname,string $lastname,string $email,string $password)
    {
        $req = "INSERT INTO users VALUES (DEFAULT, :firstname, :lastname, :email, :password, :role)";
        $statement = $this->getDbb()->prepare($req);
        $statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
        $statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $statement->bindValue(":email", $email, PDO::PARAM_STR);
        $statement->bindValue(":password", $password, PDO::PARAM_STR);
        $statement->bindValue(":role", "utilisateur", PDO::PARAM_STR);
        $statement->execute();
        $register = ($statement->rowCount() > 0);
        $statement->closeCursor();
        return $register;
    }
}