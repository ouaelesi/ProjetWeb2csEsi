<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
// Check if the admin is loged in 

if (isset($_POST['addRecipe'])) {
    $animalcontroller = new recipeController();
    $animalcontroller->addRecipe();
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