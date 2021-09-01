<?php

use Toolbox\Toolbox; ?>
<div class="main">

    <div class="mb-4 bg-light rounded-3 articles">
        <img src="<?= URL . 'public/assets/images/' . $article['image'] ?>" alt="<?= $article['title'] ?>" />
    </div>

    <div class="container-small">
        <div class="text-center">
            <h1><?= $article['title'] ?></h1>
            <p class="text-secondary">Publié par <?= $article['firstname'] ?> ~ <?= (new DateTime($article['createdAt']))->format("d/m/Y") . ' ( il y a ' . Toolbox::time_elapsed_string($article['createdAt']) . ')' ?></p>
            <p><?= $article['name'] ?></p>
            <div class="btn-group">
                <a href="articles/edit/<?= $article['id'] ?>" class="btn btn-warning">Modifier</a>
                <a href="articles/delete/<?= $article['id'] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
        <div class="content">
            <?= $Parsedown->text($article['content']) ?>
        </div>
    </div>
</div>