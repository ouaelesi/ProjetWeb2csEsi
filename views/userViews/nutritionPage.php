<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/recipePage.php');
class nutritionPage
{

    public function displayNutritionPage()
    {
        $sharedComponents = new sharedViews();
        $recipepage = new singleRecipePage();

        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getIngredients();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Les Nutritions' , 'ingredients.jpg');
        // navLinks 
        $sharedComponents->navLinks();

        // ingredient list
        $recipepage->ingredients($ingredients);
    }

    public function displaySingleNutrition(){

    }
}
