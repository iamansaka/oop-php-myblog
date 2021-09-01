<?php

namespace App\Controllers;

abstract class Controller
{
    protected function render(string $path,array $donnees = [],string $template ='default')
    {
        extract($donnees);
        ob_start();
        require_once ROOT .'/views/'. $path.'.view.php';
        $content = ob_get_clean();
        require_once ROOT .'/views/layout/'. $template .'.php';
    }
        
    /**
     * Vérifie si on est connecté
     *
     * @return void
     */
    protected function isLoggedin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            return true;
        } else {
            return $this->redirectReponse("login");
        }
    }
    
    /**
     * Vérifie si on est admin
     *
     * @return void
     */
    protected function isAdmin() 
    {
        if (isset($_SESSION['profil']) && $_SESSION['profil']['role'] === "Administrateur") {
            return true;
        }
    }
    
    /**
     * La méthode redirectReponse() redirige vers une route, lien, etc...
     *
     * @param  string $path
     * @return void
     */
    protected function redirectReponse(string $path)
    {
        header("Location: ".URL.$path);
        exit();
    }
    
    /**
     * La méthode est addFlash() définit un message dans la session 
     *
     * @param  string $type
     * @param  string $message
     */
    protected function addFlash($type, $message)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }

        
    /**
     * La méthode secureHTML() convertit les caractères HTML
     *
     * @param  mixed $chaine
     */
    protected function secureHTML($chaine)
    {
        return htmlentities($chaine);
    }
}