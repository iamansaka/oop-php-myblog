<main class="form-signin">
    <form action="/auth-login" method="POST">
        <img class="mb-4" src="<?= URL ?>public/assets/images/logo.png" alt="logo du site" width="150">
        <h1 class="h3 mb-3 fw-normal">Se connecter</h1>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="<?= $_POST["email"] ?? '' ?>">
            <label for="floatingInput">Adresse email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" <?= $_POST["password"] ?? '' ?>>
            <label for="floatingPassword">Mot de passe</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Se connecter</button>
        <p>Besoin d'un compte ? <a href="/register">S'inscrire</a></p>
    </form>
</main>