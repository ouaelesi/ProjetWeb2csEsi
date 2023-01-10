<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/recipePage.php');
class categoryPage
{

    public function displayCategoryPage()
    {
        $sharedComponents = new sharedViews();
        $recipePage = new recipePage();
        $recipeController = new recipeController();
        $recipes  = $recipeController->getrecipesByCateg(1);
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Catégorie: ' . $_GET["id"]);
        // navLinks 
        $sharedComponents->navLinks();
        // search input 
        $recipePage->searchInput();

        // filters 
        $recipePage->filterSection();

        // recipes
        $recipePage->recipesList($recipes);
    }
}
