<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/ingredientController.php');
// Check if the admin is loged in 

header('Content-type: application/json');

if (isset($_POST['addRecipe'])) {
    echo var_dump($_POST);
}
if (isset($_POST['addIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->addIngredient();
    header("location: /ProjetWeb/admin/ingredients");
}
if (isset($_POST['deleteIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->deleteIngredient($_POST['ingredientId']);
    header("location: /ProjetWeb/admin/ingredients");
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
    error_log(print_r($_POST["likerecipe"], TRUE));
    $userController = new userController();
    $userController->likeRecette($_POST["recetteId"]);
}

if (isset($_POST['signUp'])) {
    $userController = new userController();
    $userController->createUser();
    header("location: /ProjetWeb/");
}


if (isset($_GET['validateRecipe'])  == 'valid') {
    $animalcontroller = new recipeController();
    $animalcontroller->validateRecipe();
}

if (isset($_GET['validateRecipe'])  == 'valid') {
    $animalcontroller = new recipeController();
    $animalcontroller->validateRecipe();
}

// header("location: /TP_PHP_MVC/admin/adminPage.php");
