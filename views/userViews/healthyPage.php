<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/recipePage.php');

class healthyPage
{
    public function filterSection()
    {
?>
        <div class="container">
            <div class="h1 artFont d-flex gap-3 w-50 mx-auto mb-5">
                definir vos critére d'une recette healthy <img src="public/icons/healthy.png"  width='40px' height="40px"/>
            </div>
            <div>
                <?php
                $sharedComponents = new sharedViews();
                $sharedComponents->filterInputs([
                    [
                        "name" => "Seuil",
                        "index" => "seuil",
                        "options" =>     ["id" => "2", "name" => "plus de 2 ingredient"],
                        ["id" => "5", "name" => "plus de 5 ingredient"],
                        ["id" => "10", "name" => "plus de 10 ingredient"],
                    ],
                    [
                        "name" => "Methode de cuisson",
                        "index" => "preparationTime",
                        "options" => [
                            ["id" => "0-15", "name" => "moins que 15min"],
                            ["id" => "15-60", "name" => "entre 15min et 1h"],
                            ["id" => "60-10000", "name" => "plus que 1h"],
                        ]
                    ],
                    [
                        "name" => "Nombre de calories",
                        "index" => "cookTime",
                        "options" => [
                            ["id" => "0-15", "name" => "moins que 15min"],
                            ["id" => "15-60", "name" => "entre 15min et 1h"],
                            ["id" => "60-10000", "name" => "plus que 1h"],
                        ]
                    ]

                ] , "Filtrer les recettes"); ?>
            </div>
        </div>

<?php

    }
    public function displayHealthyPage()
    {
        $sharedComponents = new sharedViews();
        $recipePage = new recipePage();
        $recipeController = new recipeController();
        $recipes  = $recipeController->getHealthyRecipes(1);

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Les recette healthy', "healthy.png");
        // navLinks 
        $sharedComponents->navLinks();
        // search input 
        $this->filterSection();
        // filters 
        // $recipePage->filterSection();

        // recipes
        $recipePage->recipesList($recipes);
    }
}
