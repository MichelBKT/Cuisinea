<?php
    require_once('templates/header.php');
    require_once('lib/recipe.php');
    require_once('lib/tools.php');
    require_once('lib/category.php');

if(!isset($_SESSION['user'])){
    header('location: login.php');
}
$id = (int)$_GET['id'];
$recipe = getRecipeById($pdo, $id)['title'];
$errors = [];
$messages = [];

?>




<?php
if (isset($_POST['saveModification'])) {
    $fileName = null;
    //si un fichier est envoyé
    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != ''){
        // la méthode getimagesize va retourner false si le fichier n'est pas une image
        $checkImage = getimagesize($_FILES ['file']['tmp_name']);
        if($checkImage !== false){
            //si c'est une image on traite
            $fileName = uniqid(). '-' .slugify($_FILES ['file']['tmp_name']);
            //deplacer le fichier uploader vers le dossier de notre choix
            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_.$fileName);
        }else{
            //sinon on affiche un message d'erreur
            $errors[] = 'Le fichier n\'est pas une image';
        }
    }
    if (isset($_POST['deleteRecipe']) && ($_POST['ingredients'] != null && $_POST['instructions'] != null)){
        if (!$errors){
        $res = saveModification($pdo, $id, $_POST['ingredients'], $_POST['instructions']);
        $messages[] = 'La recette a bien été modifiée!';
        } else {
        $errors[] = 'La recette n\' a pas été modifiée';
        }
    } else {
        $errors[] = 'Merci de compléter le champs vide';
    }
}

?>
<h1>Modification d'une recette</h1>

<form method = "POST" enctype="multipart/form-data">
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Suppression de la recette</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <strong>Confirmez-vous la suppression de la recette?</strong>
        <p>La suppression est totale et définitive.<p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="no">Non
        <?php
        if (isset($_POST['no'])) {
        $errors[] = 'Suppression annulée';}?>
        </button>
        <button type="submit" class="btn btn-primary" name="yes">Oui, je confirme
        <?php
        if (isset($_POST['yes'])) {
            deleteRecipe($pdo, $id);
            $messages[] = 'Recette supprimée avec succès!';}?>
        </button>
      </div>
    </div>
  </div>
</div>
</form>
<?php

foreach ($messages as $message){ ?>
    <div class="alert alert-success">
        <?=$message; ?>
    </div>

<?php } ?>

<?php foreach ($errors as $error){ ?>
    <div class="alert alert-danger">
        <?=$error; ?>
    </div>
<?php } 
?>

<form method = "POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="<?=$recipe;?>">
    </div>
    <div class="mb-3">
        <label for="ingredients" class="form-label ingredients">Ingrédients</label>
        <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="instructions" class="form-label instructions">Instructions</label>
        <textarea name="instructions" id="instructions" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file" id="file">
    </div>
    <input type="submit" value="Enregistrer" name="saveModification" class="btn btn-primary">
    <a href="index.php"class="btn btn-secondary">Annuler</a>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Supprimer la recette</button>
</form>
 <?php
 require_once('templates/footer.php');
 ?>