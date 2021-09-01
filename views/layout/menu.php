<nav class="navbar navbar-expand-lg navbar-light my-3 container">
    <a class="navbar-brand" href="/">Mon blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/') ? 'active' : '' ?>" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/articles') ? 'active' : '' ?>" href="/articles">Articles</a>
            </li>
        </ul>
        <div class="left d-flex align-items-center">
            <a href="/articles" aria-label="Search" class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </a>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']) : ?>
                <a href="/logout" class="me-3 link text-decoration-none">Se déconnecter</a>
                <a href="/profile" class="header-profile bg-primary text-white text-decoration-none"><?= $_SESSION["profil"]["firstname"][0].$_SESSION["profil"]["lastname"][0] ?></a>
            <?php else : ?>
                <a href="/login" class="btn btn-success">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>