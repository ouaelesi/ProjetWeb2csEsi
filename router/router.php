<?php
// import The Pages 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/HomePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/recipePage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/sharedViews.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/singleRecipePage.php");

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

// Display Pages 
switch ($request) {
    case '/ProjetWeb/':
        $view = new HomePage();
        $view->displayHome();
        break;
    case '/ProjetWeb/index.php':
        $view = new HomePage();
        $view->displayHome();
        break;
    case '/ProjetWeb/ideas':
        $view = new recipePage();
        $view->displayRecipePage();
        break;
    case '/ProjetWeb/recette':
        $view = new singleRecipePage();
        $view->displaySignleRecipe();
        break;

    case '/about':
        require __DIR__ . '/views/about.php';
        break;
    default:
        $sharedView = new SharedViews();
        $sharedView->notFoundPage("Soory, We didn't find your Page", "404");
        break;
}
