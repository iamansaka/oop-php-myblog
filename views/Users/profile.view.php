<section class="profile">
    <h1 class="mb-3">Mon espace personnel</h1>
    <h2 class="mb-3">Mes informations</h2>
    <div class="card mb-4">
        <div class="card-body">
            <ul>
                <li><strong>Nom :</strong> <?= $utilisateur["lastname"] ?></li>
                <li><strong>Prénom :</strong> <?= $utilisateur["firstname"] ?></li>
                <li><strong>Role :</strong> <?= $utilisateur["role"] ?></li>
                <li><strong>Email :</strong> <?= $utilisateur["email"] ?>
                    <button class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <h2>Mes articles</h2>
        <a href="/articles/new" class="btn btn-success d-flex align-items-center">Écrire un article</a>
    </div>
    <div class="d-flex flex-column">
        <?php foreach ($articles as $article) : ?>
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="width: 100%;">
                <div class="col-auto d-none d-lg-block">
                    <img src="<?= URL . 'public/assets/images/' . $article['image'] ?>" alt="<?= $article['name'] ?>" class="articles_img">
                </div>
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><?= $article['name'] ?></strong>
                    <h3 class="mb-0"><?= $article['title'] ?></h3>
                    <div class="mb-1 text-muted"><?= $date = (new DateTime($article['createdAt']))->format("d/m/Y") ?></div>
                    <p class="card-text mb-auto"><?= (mb_strlen($article['content']) <= 80) ? '' : substr($article['content'], 0, 80) . '...' ?></p>
                    <div class="actions">
                        <div class="btn-group actions" role="group" aria-label="actions article">
                            <a href="articles/<?= $article['id'] ?>" class="btn btn-primary">Voir l'article</a>
                            <a href="articles/edit/<?= $article['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="articles/delete/<?= $article['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>