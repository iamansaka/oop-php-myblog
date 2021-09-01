<h1>Écrire un article</h1>

<form method="POST" action="/articles/new">
  <div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Titre">
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="text" class="form-control" name="image" id="image" aria-describedby="image" placeholder="image">
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Catégorie</label>
    <select name="category" id="category" class="form-select">
      <?php foreach ($category as $c) : ?>
          <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Contenu</label>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Votre contenu ici.."></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>