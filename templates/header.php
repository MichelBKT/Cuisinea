<?php 
require_once('lib/config.php');
require_once('lib/pdo.php');
$currentPage = basename($_SERVER['SCRIPT_NAME']);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/override-bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
 
   <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="./assets/images/logo-cuisinea-horizontal.jpg" alt="Logo Cuisinea" width= "250">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 nav nav-pills">
            <?php foreach($mainMenu as $key => $value) { ?>
            <li class="nav-item"><a href="<?= $key; ?>" class="nav-link <?php if ($currentPage === $key) {echo 'active';} ?>"><?= $value ;?></a></li>
            <?php } ?>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
    </header>
