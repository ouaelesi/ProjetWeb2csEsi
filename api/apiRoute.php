<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/ingredientController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/newsController.php');
// Check if the admin is loged in 

header('Content-type: application/json');

if (isset($_POST['addRecette'])) {
    $recipeController = new recipeController();
    $recipeController->addRecipe();
}
if (isset($_POST['addIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->addIngredient();
    header("location: /ProjetWeb/admin/ingredients");
}
if (isset($_POST['deleteIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->deleteIngredient($_POST['ingredientId']);
}
if (isset($_POST['validateRecipe'])) {
    $recipeController = new recipeController();
    $recipeController->validateRecipe($_POST['recipeId']);
}
if (isset($_POST['saveNews'])) {
    $userController = new userController();
    $userController->saveNews($_POST["newsID"]);
}


if (isset($_POST['rejectRecipe'])) {
    $recipeController = new recipeController();
    $recipeController->rejectRecipe($_POST['recipeId']);
}
if (isset($_POST['addNews'])) {
    $newsController = new newsController(); 
    $newsController->addNews() ; 
    header("location: /ProjetWeb/admin/news");
}




if (isset($_POST['editIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->editIngredient($_POST['ingredientId']);
}

if (isset($_POST['validateAccount'])) {
    $userController = new userController();
    $userController->validateAccount($_POST["userId"]);
}
if (isset($_POST['rejectAccount'])) {
    $userController = new userController();
    $userController->rejectAccount($_POST["userId"]);
}

if (isset($_POST['recipeRating'])) {
    error_log(print_r($_POST["note"], TRUE));
    $userController = new userController();
    $userController->rateRecipe($_POST["recetteID"], $_POST["note"]);
}
if (isset($_POST['likerecipe'])) {
    $userController = new userController();
    $userController->likeRecette($_POST["recetteId"]);
}

if (isset($_POST['signUp'])) {
    $userController = new userController();
    $userController->createUser();
    header("location: /ProjetWeb/");
}
if (isset($_POST['addRecIngredient'])) {
    $recipeController = new recipeController();
    $recipeController->addIngredientToRecipe();
}

if (isset($_POST['addRecStep'])) {
    $recipeController = new recipeController();
    $recipeController->addStepToRecipe();
}





// header("location: /TP_PHP_MVC/admin/adminPage.php");
