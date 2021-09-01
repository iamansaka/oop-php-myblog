<h1>Edition de l'article n°<?= $article['id'] ?></h1>

<form method="POST" action="/articles/edit/<?= $article['id'] ?>">
  <div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="<?= $article['title'] ?>">
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Catégorie</label>
    <select name="category" id="category" class="form-select">
      <?php foreach ($category as $c) : ?>
          <option <?= $article['category_id'] === $c['id'] ? 'selected' : '' ?> value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Contenu</label>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10"><?= $article['content'] ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Modifier</button>
</form>