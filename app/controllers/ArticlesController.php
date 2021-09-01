<?php

namespace App\Controllers;

use Parsedown;
use App\Models\ArticlesModels;

class ArticlesController extends Controller
{
    private $articlesManager;

    public function __construct()
    {
        $this->articlesManager = new ArticlesModels();
    }
    
    /**
     * Vérifie si l'article à partient à l'utilisateur
     *
     * @param  int $idArticle
     * @return void
     */
    public function checkUserArticle(int $idArticle)
    {
        $article = $this->articlesManager->fetchOne($idArticle);

        if ($article['author_id'] === $_SESSION['profil']['id']) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Cette méthode affiche une page listant toutes les articles de la base de données
     *
     * @return void
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
            $userSearch = $_GET['search'] ?? '';

            $articles = $this->articlesManager->fetchAll();
            $articlesSearch = $this->articlesManager->searchArticle($userSearch);

            $showArticle = ($userSearch) ? $articlesSearch : $articles;

            if (!$showArticle) {
                $this->addFlash("danger", "Votre recherche n'existe pas");
            }

            return $this->render("articles/index", [
                "articles" => $showArticle
            ]);
        }
    }
    
    /**
     * Affiche le formulaire pour crée un article
     *
     * @return void
     */
    public function new()
    {
        $category = $this->articlesManager->fetchCategory();
        return $this->render("articles/new", [
            "category" => $category
        ]);
    }
    
    /**
     * Affiche 1 article
     *
     * @param  int $id
     * @return void
     */
    public function show(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $article = $this->articlesManager->fetchOne($id);

            $Parsedown = new Parsedown();
            $Parsedown->setSafeMode(true);

            return $this->render("articles/show", [
                "article" => $article,
                "Parsedown" => $Parsedown
            ]);
        }
    }
    
    /**
     * Affiche le template modifier un article
     *
     * @param  int $id
     * @return void
     */
    public function edit(int $id)
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            $article = $this->articlesManager->fetchOne($id);
            $category = $this->articlesManager->fetchCategory();

            if ($article['author_id'] === $_SESSION['profil']['id'] || $this->isAdmin()) {
                $this->render("articles/edit", [
                    "article" => $article,
                    "category" => $category
                ]);
            } else {
                $this->addFlash("danger", "Cette article n'existe pas ou vous n'ête pas l'autheur");
                $this->redirectReponse("profile");
            }
        } else {
            $this->redirectReponse("login");
        }
    }
    
    /**
     * Modifie un article
     *
     * @param  int $id
     * @return void
     */
    public function editPost($id)
    {
        $title = $this->secureHTML($_POST['title']);
        $categoryID = $this->secureHTML($_POST['category']);
        $content = $this->secureHTML($_POST['content']);

        if ($this->articlesManager->updateOne($id, $title, $categoryID, $content)) {
            $this->addFlash("success", "L'article a été modifié avec succès");
            $this->redirectReponse("profile");
        } else {
            $this->addFlash("danger", "Une erreur est survenue");
            $this->redirectReponse("profile");
        }
    }
    
    /**
     * Supprime un article
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {

            if ($this->checkUserArticle($id) || $this->isAdmin()) {
                if ($this->articlesManager->deleteOne($id)) {
                    $this->addFlash("success", "L'article à bien été supprimé");
                    $this->redirectReponse("profile");
                } else {
                    $this->addFlash("danger", "Une erreur est survenue");
                    $this->redirectReponse("profile");
                }
            } else {
                $this->addFlash("danger", "Une erreur est survenue");
                $this->redirectReponse("profile");
            }
        } else {
            $this->redirectReponse("login");
        }
    }
    
    /**
     * Ajoute un article
     *
     * @return void
     */
    public function newPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST["title"]) && !empty($_POST["image"]) && !empty($_POST["category"]) && !empty($_POST["content"])) {
                $title = $this->secureHTML($_POST["title"]);
                $image = $this->secureHTML($_POST["image"]);
                $category = (int)$this->secureHTML($_POST["category"]);
                $content = $this->secureHTML($_POST["content"]);

                if ($this->articlesManager->createOne($title, $image, $category, $content, $_SESSION["profil"]["id"])) {
                    $this->addFlash("success", "L'article à bien été crée");
                    $this->redirectReponse("articles/new");
                } else {
                    $this->addFlash("danger", "Une erreur est survenue");
                    $this->redirectReponse("articles/new");
                }
            } else {
                $this->addFlash("danger", "Veuillez renseigner les champs");
                $this->redirectReponse("articles/new");
            }
        }
    }
}
