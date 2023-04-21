<?php 
require_once('lib/session.php');
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
    <link href="./assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-image bg-size-half" style="background-image: url('./assets/images/background.jpg')">
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-5">

    <nav class="navbar fixed-top navbar-expand-lg container-fluid border-bottom bg-dark">
        <div class="col-md-5-lg-6 mb-2 me-2">
    <a class="navbar-brand" href="index.php">
      <img src="./assets/images/logo-horizontal.jpg" alt="Bootstrap">
    </a>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
    </svg>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class= "navbar-nav container-fluid">
      <?php foreach($mainMenu as $key => $value) { ?>
            <li class="nav-item" ><a href="<?= $key; ?>" class="nav-link<?php if ($currentPage === $key) {echo ' active';} ?>"><?= $value ;?></a></li>
            <?php } ?>
      </ul>
      <div class="container-fluid p-3">
            <?php if(!isset($_SESSION['user'])){?>
                <a href="login.php" class="btn btn-outline-primary col-md-5-lg-6 mb-2 me-2">Se connecter</a>
                <a href="inscription.php" class="btn btn-outline-primary col-md-5-lg-6 mb-2 me-2">S'inscrire</a>
            <?php } else { ?>
                <a href="logout.php" class="btn btn-primary">Se déconnecter</a>
            <?php } ?>
    </div>
  </div>
</nav>
</header>

