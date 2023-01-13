<?php
// import The Pages 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/HomePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/recipePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/sharedViews.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/singleRecipePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/profilePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/addRecipePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/categoryPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/healthyPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedadminView.php");
// Get the Current URL
$request = $_SERVER['REQUEST_URI'];

// remove the last / from the URL 
if ($request[strlen($request) - 1] == '/' && $request != "/ProjetWeb/") {
    header("location:" . substr($request, 0, -1));
};

// 
if (strpos($request, "?")) {
    $request = substr($request, 0, - (strlen($request) - strpos($request, "?")));
}

if (strpos($request, "/admin")) {
    $request = "/ProjetWeb/admin";
 
}

// Display Pages 
$sharedView = new SharedViews();
$homeview = new HomePage();
$recipeview = new recipePage();
$singleRecipePage = new singleRecipePage();
$profilePage = new profilePage();
$addrecipe = new addRecipePage();
$categorypPage = new categoryPage();
$healthyPage = new healthyPage();
$sharedAdminViews = new sharedadminView() ; 
switch ($request) {
    case '/ProjetWeb/':
        $homeview->displayHome();
        break;
    case '/ProjetWeb/index.php':
        $homeview->displayHome();
        break;
    case '/ProjetWeb/ideas':
        $recipeview->displayRecipePage();
        break;
    case '/ProjetWeb/recette':
        $singleRecipePage->displaySignleRecipe();
        break;
    case '/ProjetWeb/signUp':
        $sharedView->signUpForm();
        break;
    case '/ProjetWeb/profile':
        $profilePage->displayProfile();
        break;
    case '/ProjetWeb/addrecipe':
        $addrecipe->displayRecipePage();
        break;
    case '/ProjetWeb/categories':
        $categorypPage->displayCategoryPage();
        break;
    case '/ProjetWeb/healthy':
        $healthyPage->displayHealthyPage();
        break;

        // admin dashboard 
    case '/ProjetWeb/admin':
        $sharedAdminViews->adminDashboardTempale() ; 
        break;
    case '/about':
        require __DIR__ . '/views/about.php';
        break;
    default:
        $sharedView->notFoundPage("Soory, We didn't find your Page", "404");
        break;
}
