<?php

namespace App\Controllers;

use App\Models\ArticlesModels;
use App\Models\UsersModels;

class UsersController extends Controller
{
    private $usersManager;
    private $articlesManager;

    public function __construct()
    {
        $this->usersManager = new UsersModels;
        $this->articlesManager = new ArticlesModels;
    }
    
    /**
     * Connexion de l'utilisateur
     *
     * @return void
     */
    public function login()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            $this->redirectReponse("profile");
        }
        return $this->render("users/login");
    }
    
    /**
     * Inscription de l'utilisateur
     *
     * @return void
     */
    public function register()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            $this->redirectReponse("profile");
        }
        return $this->render("users/register");
    }
    
    /**
     * Profil de l'utilisateur
     *
     * @return void
     */
    public function profil()
    {
        $this->isLoggedin();
        $articleUser = $this->articlesManager->fetchUserArticles($_SESSION["profil"]['id']);
        return $this->render('users/profile', [
            "utilisateur" => $_SESSION['profil'],
            "articles" => $articleUser
        ]);
    }
    
    /**
     * Déconnexion de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['auth']);
        session_destroy();
        $this->addFlash("success", "La déconnexion est effectuée.");
        $this->redirectReponse('/');
    }

        
    /**
     * Post connexion de l'utilisateur
     *
     * @return void
     */
    public function loginPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->secureHTML($_POST['email']);
                $password = $this->secureHTML($_POST['password']);

                if ($this->usersManager->getByUserFromEmail($email)) {
                    $user = $this->usersManager->getByUserFromEmail($email);
                    if (password_verify($password, $user['password'])) {
                        $_SESSION["profil"] = [
                            "id" => $user['id'],
                            "firstname" => $user['firstname'],
                            "lastname" => $user['lastname'],
                            "email" => $user['email'],
                            "role" => $user['role']
                        ];
                        $_SESSION["auth"] = true;
                        $this->addFlash("success", "Bon retour parmis nous :)");
                        $this->redirectReponse("profile");
                    } else {
                        $this->addFlash("danger", "Votre email ou votre mot de passe est incorrect");
                        $this->redirectReponse("login");
                    }
                } else {
                    $this->addFlash("danger", "Votre email ou votre mot de passe est incorrect");
                    $this->redirectReponse("login");
                }
            } else {
                $this->addFlash("danger", "Veuillez compléter tous les champs...");
                $this->redirectReponse("login");
            }
        }
    }
    
    /**
     * Post inscription de l'utilisateur
     *
     * @return void
     */
    public function registerPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmpassword'])) {

                $firstname = $this->secureHTML(($_POST['firstname']));
                $lastname = $this->secureHTML(($_POST['lastname']));
                $email = $this->secureHTML(($_POST['email']));
                $password = $this->secureHTML(($_POST['password']));
                $confirmpassword = $this->secureHTML(($_POST['confirmpassword']));

                if ($confirmpassword !== $password) {
                    $this->addFlash("danger", "Le mot de passe de confirmation est différent");
                    $this->redirectReponse("register");
                }

                if (!$this->usersManager->getByUserFromEmail($email)) {
                    $hashedPassword = password_hash($confirmpassword, PASSWORD_DEFAULT);
                    if ($this->usersManager->registerUser($firstname, $lastname, $email, $hashedPassword)) {
                        $this->addFlash("success", "Le compte a été créer, vous pouvez vous connecté");
                        $this->redirectReponse("login");
                    }
                } else {
                    $this->addFlash("danger", "L'adresse email existe déjà");
                    $this->redirectReponse("register");
                }
            } else {
                $this->addFlash("danger", "Veuillez compléter tous les champs...");
                $this->redirectReponse("register");
            }
        }
    }
}
