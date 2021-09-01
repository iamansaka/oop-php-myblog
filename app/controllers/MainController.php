<?php

namespace App\Controllers;

use Parsedown;
use App\Models\MainModels;

class MainController extends Controller
{
    private $mainManager;

    public function __construct() {
        $this->mainManager = new MainModels();;
    }

    public function index()
    {
        $Parsedown = new Parsedown();
        $Parsedown->setSafeMode(true);
        
        $articles = $this->mainManager->findAll();
        $category = $this->mainManager->findCategory();
        
        return $this->render('main/index', [
            "articles" => $articles,
            "categories" => $category,
            "Parsedown" => $Parsedown,
        ]);
    }

    public function date()
    {
        return $this->render("main/date");
    }

    public function notFound()
    {
        return $this->render("error/error");
    }
} 