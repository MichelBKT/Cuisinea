<?php

function getRecipeById(PDO $pdo, int $id){
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function getRecipeImage(string|null $image){
    if ($image === null){
        return _ASSETS_IMG_PATH_.'recipe_default.jpg';
      } else {
        return _RECIPES_IMG_PATH_.$image;
      }
}

function getRecipes(PDO $pdo, int $limit = null){
  $sql = 'SELECT * FROM recipes ORDER BY id DESC';
  if ($limit) {
    $sql .= ' LIMIT :limit';
  }
  $query = $pdo->prepare($sql);
  if($limit){
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
  }
  $query->execute();
  return $query -> fetchAll();
}

function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string|null $image){
  $sql= "INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image)";
  $query = $pdo->prepare($sql);
  $query->bindParam(':category_id', $category, PDO::PARAM_INT);
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);
  $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);  
  $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
  $query->bindParam(':image', $image, PDO::PARAM_STR);
  return $query->execute();
}

function GetRecipebyTitle(PDO $pdo, string $title){
  $query = $pdo->prepare("SELECT * FROM recipes WHERE title = :title");
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->execute();
  return $query->fetch();
}

function saveModification(PDO $pdo, int $id, string $ingredients, string $instructions){
  $sql = "UPDATE recipes SET ingredients = :ingredients, instructions = :instructions WHERE recipes.id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);  
  $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
  return $query->execute();
  
}
function GetIdByTitle(PDO $pdo, string $title){
  $query = $pdo->prepare("SELECT `id` FROM recipes WHERE `title` = :title");
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->execute();
  return $query->fetch();
}

function deleteRecipe(PDO $pdo, int $id){
  $sql = "DELETE FROM recipes WHERE `recipes`.`id` = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  return $query->execute();
}
function GetTitlebyId(PDO $pdo, int $id){
  $query = $pdo->prepare("SELECT `title` FROM recipes WHERE `id` = :id");
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  return $query->fetch();
}