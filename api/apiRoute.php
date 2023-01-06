<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
// Check if the admin is loged in 


header('Content-type: application/json');


if (isset($_POST['recipeRating'])) {
    error_log(print_r($_POST["note"], TRUE));
    $userController = new userController();
    $userController->rateRecipe($_POST["userID"], $_POST["recetteID"], $_POST["note"]);
}

if (isset($_POST['signUp'])) {
    $userController = new userController();
    $userController->createUser();
    header("location: /ProjetWeb/");
}


if (isset($_POST['addRecipe'])) {
    echo "helllow";
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
