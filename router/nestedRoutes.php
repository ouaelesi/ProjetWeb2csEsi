<?php
// import The Pages 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/userViews/sharedViews.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/userPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/statsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/newsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/ingredientsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/recipesPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/singleUserPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/paramsPage.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/notificationsPage.php");

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
        $paramsPage = new paramsPage();
        $notifPage = new notificationsPage();

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
            case '/ProjetWeb/admin/recette':
                $recipesPage->displaySinglePage();
                break;
            case '/ProjetWeb/admin/editrecipe':
                $recipesPage->displayEditrecipe();
                break;

            case '/ProjetWeb/admin/addrecipe':
                $recipesPage->displayAddRecipe();
                break;
            case '/ProjetWeb/admin/addRecipeIngr':
                $recipesPage->displayAddIngRec();
                break;
            case '/ProjetWeb/admin/addrecStep':
                $recipesPage->displayAddIngStep();
                break;
            case '/ProjetWeb/admin/confirmRecipe':
                $recipesPage->confirmRecipeCreation();
                break;
            case '/ProjetWeb/admin/addnews':
                $newspage->displayaddNewsPage();
                break;
            case '/ProjetWeb/admin/editnews':
                $newspage->displayEditNewsPage();
                break;
            case '/ProjetWeb/admin/paramaitres':
                $paramsPage->displyParamsPage();
                break;
            case '/ProjetWeb/admin/notifications':
                $notifPage->displayNotificationsPage();
                break;




            default:
                $sharedView->notFoundPage("Soory, We didn't find your Page", "404");
                break;
        }
    }
}
