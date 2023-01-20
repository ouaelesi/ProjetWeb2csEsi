<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/ingredientController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/newsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/menuController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/swiperController.php');


// Check if the admin is loged in 

header('Content-type: application/json');

if (isset($_POST['sendEmail'])) {
    $userController = new userController() ; 
    $userController->sendMessage();
  
}
if (isset($_POST['editprofile'])) {
    echo var_dump($_POST);
    $userController = new userController();
    $userController->updateProfile();
    header("location: /ProjetWeb/profile?id=" . $_POST['userId']);

    unset($_POST);
}

if (isset($_POST['updateProfilePic'])) {
    $userController = new userController();
    $userController->profilePic();
    header("location: /ProjetWeb/profile?id=" . $_POST['userId']);

    unset($_POST);
}


if (isset($_POST['addRecette'])) {
    $recipeController = new recipeController();
    $response = $recipeController->addRecipe();
    header("location: /ProjetWeb/admin/addRecipeIngr?id=" . $response);
}
if (isset($_POST['editRecipe'])) {
    $recipeController = new recipeController();
    $response = $recipeController->editrecipe();
    header("location: /ProjetWeb/admin/recette?id=" . $_POST['recetteID']);
}

if (isset($_POST['addRecipeUser'])) {
    $recipeController = new recipeController();
    $response = $recipeController->addRecipe();
    header("location: /ProjetWeb/addRecipeIngr?id=" . $response);
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
    header("location: /ProjetWeb/admin/recettes");
}
if (isset($_POST['saveNews'])) {
    $userController = new userController();
    $userController->saveNews($_POST["newsID"]);
}
if (isset($_GET['getIngredients'])) {
    $ingredientController = new ingredientController();
    $response = $ingredientController->getIngredients();
    echo json_encode($response);
}


if (isset($_POST['rejectRecipe'])) {
    $recipeController = new recipeController();
    $recipeController->rejectRecipe($_POST['recipeId']);
}
if (isset($_POST['addNews'])) {
    $newsController = new newsController();
    $newsController->addNews();
    header("location: /ProjetWeb/admin/news");
}
if (isset($_POST['editNews'])) {
    $newsController = new newsController();
    $newsController->editNews();
    header("location: /ProjetWeb/admin/editnews?id=" . $_POST['newsId']);
    unset($_POST);
}


if (isset($_POST['editIngredient'])) {
    $ingredientController = new ingredientController();
    $ingredientController->editIngredient($_POST['ingredientId']);
}

if (isset($_POST['validateAccount'])) {
    $userController = new userController();
    $userController->validateAccount($_POST["userId"]);
    header("location: /ProjetWeb/admin/users");
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
if (isset($_POST['logIn'])) {
    $userController = new userController();
    $response = $userController->logIn();
    echo json_encode($response);
}

if (isset($_POST['logout'])) {
    setcookie("logedIn_user", "", time() - 3600, "/");
}

if (isset($_POST['addRecIngredient'])) {
    $recipeController = new recipeController();
    $recipeController->addIngredientToRecipe();
    header("location: /ProjetWeb/admin/addRecipeIngr?id=" . $_POST['recetteID']);
}
if (isset($_POST['addIngredientUser'])) {
    $recipeController = new recipeController();
    $recipeController->addIngredientToRecipe();
    header("location: /ProjetWeb/addRecipeIngr?id=" . $_POST['recetteID']);
    unset($_POST);
}


if (isset($_POST['addRecStep'])) {
    $recipeController = new recipeController();
    $recipeController->addStepToRecipe();
    header("location: /ProjetWeb/admin/addrecStep?id=" . $_POST['recetteID']);
    unset($_POST);
}
if (isset($_POST['addStepUser'])) {
    $recipeController = new recipeController();
    $recipeController->addStepToRecipe();
    header("location: /ProjetWeb/addrecStep?id=" . $_POST['recetteID']);

    unset($_POST);
}

if (isset($_POST['addlink'])) {
    $menuContoller = new menuController();
    $menuContoller->addLink();
    header("location: /ProjetWeb/admin/paramaitres");
}

if (isset($_POST['changeLogo'])) {
    $menuContoller = new menuController();
    $menuContoller->changeLogo();
    header("location: /ProjetWeb/admin/paramaitres");
}

if (isset($_POST['addSlide'])) {
    $swiperController = new swiperController();
    $swiperController->addSlide();
    header("location: /ProjetWeb/admin/paramaitres");
}
if (isset($_POST['removeIngredent'])) {
    $ingredientController = new ingredientController();
    $ingredientController->removeIngredient();
    // header("location: /ProjetWeb/admin/addRecipeIngr?id=" . $_POST['recetteID']);
}

if (isset($_POST['addComment'])) {
    $recipeController = new recipeController();
    $recipeController->addComment();
    header("location: /ProjetWeb/recette?id=" . $_POST['recetteID']);
}

if (isset($_POST['sendMessage'])) {
    $userController = new userController();
    $userController->sendMessage();
}

if (isset($_POST['changeSeuil'])) {
    $recipeController = new recipeController() ; 
    $recipeController->updateSeuil() ; 
    header("location: /ProjetWeb/admin/paramaitres");
}












// header("location: /TP_PHP_MVC/admin/adminPage.php");
