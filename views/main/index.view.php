<?php

use Toolbox\Toolbox; ?>
<div class="baseline col-12 mb-3 rounded d-flex justify-content-end align-items-center">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur.</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent consectetur, libero eget placerat efficitur, massa diam eleifend metus, nec rhoncus libero urna sed nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean ac convallis diam, ac aliquet orci. Nunc lobortis consequat varius.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <?php foreach ($articles as $article) : ?>
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img src="<?= URL . 'public/assets/images/' . $article['image'] ?>" alt="<?= $article['name'] ?>" class="articles_img">
                </div>
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><?= $article['name'] ?></strong>
                    <h3 class="mb-0"><?= $article['title'] ?></h3>
                    <div class="mb-1 text-muted"><?= (new DateTime($article['createdAt']))->format("d/m/Y") ?></div>
                    <p class="card-text mb-auto"><?= (mb_strlen($article['content']) <= 80) ? '' : substr($article['content'], 0, 80) . '...' ?></p>
                    <a href="articles/<?= $article['id'] ?>" class="stretched-link">Lire l'article</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <h3>Categories</h3>
        <ul class="list-group">
            <?php foreach ($categories as $categorie) : ?>
                <li class="list-group-item"><a href="/articles?search=<?= $categorie['name'] ?>" class="text-decoration-none"><?= $categorie['name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>