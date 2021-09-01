<section class="d-flex flex-column container-small">
    <form method="get" class="d-flex mb-3">
        <div class="col-8">
            <input type="text" name="search" id="search" class="form-control" value="<?= $_GET['search'] ?? '' ?>">
        </div>
        <div class="col-4 d-grid ms-2">
            <button type="submit" class="btn btn-success btn-block">Rechercher</button>
        </div>
    </form>
    <?php foreach ($articles as $article) : ?>
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col-auto d-none d-lg-block">
                <img src="<?= URL . 'public/assets/images/' . $article['image'] ?>" alt="test" class="articles_img">
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
</section>