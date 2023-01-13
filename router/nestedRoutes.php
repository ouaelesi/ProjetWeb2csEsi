<?php
// import The Pages 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/sharedViews.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/userPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/statsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/newsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/ingredientsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/recipesPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/singleUserPage.php");

// Get the Current URL
class nestedRoutes
{


    public function displayNestedRoutes()
    {

        // admin Pages 
        $sharedView = new sharedViews();
        $userPage = new userPage();
        $statsPage = new statsPage();
        $recipesPage = new recipesPage();
        $newspage = new newsPage();
        $ingredientspage = new ingredientsPage();
        $profileController = new singleUserPage();


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
            case '/ProjetWeb/admin':
                $statsPage->displayStatspage();
                break;
            case '/ProjetWeb/admin/statistiques':
                $statsPage->displayStatspage();
                break;
            case '/ProjetWeb/admin/recettes':
                $recipesPage->displayRecipesPage();
                break;
            case '/ProjetWeb/admin/users':
                $userPage->displayUserspage();
                break;
            case '/ProjetWeb/admin/news':
                $newspage->displayNewsPage();
                break;
            case '/ProjetWeb/admin/ingredients':
                $ingredientspage->displayIngredientsPage();
                break;
            case '/ProjetWeb/admin/user':
                $profileController->displayProfilePage();
                break;
            default:
                $sharedView->notFoundPage("Soory, We didn't find your Page", "404");
                break;
        }
    }
}