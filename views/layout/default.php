<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon super blog</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL ?>public/css/style.css">
    <link rel="stylesheet" href="<?= URL ?>public/css/prism.css">
</head>

<body>
    <div class="wb-site">
        <?php require_once ROOT . '/views/layout/menu.php' ?>

        <div class="content">
            <div class="container">
                <?php if (!empty($_SESSION['alert'])) : ?>
                    <?php foreach ($_SESSION['alert'] as $alert) : ?>
                        <div class="alert alert-<?= $alert['type'] ?>" role="alert">
                            <?= $alert['message'] ?>
                        </div>
                    <?php endforeach; ?>
                <?php unset($_SESSION['alert']); endif; ?>

                <?= $content ?>
            </div>
        </div>

        <?php require_once ROOT . '/views/layout/footer.php' ?>
    </div>

    <!-- JS Bootstrap -->
    <script src="<?= URL ?>public/js/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>