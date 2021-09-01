<section id="register">
    <h1>Inscription</h1>
    <form action="/auth-register" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstnameHelp">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastnameHelp">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirmation mot de passe</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</section>