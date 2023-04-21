<?php

    require_once('templates/header.php');
    require_once('lib/recipe.php');

  $recipes = getRecipes($pdo, _HOME_RECIPES_LIMIT);
    
?>


<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="logo-horizontal col-10 col-sm-8 col-lg-6">
        <img src="./assets/images/logo.jpg" alt="Logo Cuisinea" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Cuisinea - Recettes de cuisine</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem provident perspiciatis sed aut numquam enim similique dicta corporis fugiat quam minus nemo, deleniti obcaecati possimus ducimus. Odio ea quo aliquam.</p>
        <div class="col-12 d-flex justify-content-center">
        <a href="recettes.php" class="btn btn-primary mt-3">Voir nos recettes</a>
        </div>
      </div>
    </div>

    <div class="row">

        <?php foreach ($recipes as $key => $recipe) {
            include('templates/recipe_partial.php');
        } ?>

    </div>

<?php
 require_once('templates/footer.php');
 ?>