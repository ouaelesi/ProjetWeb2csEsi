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
        $sharedComponents->pageHeader('Les Nutritions', 'ingredients.jpg');
        // navLinks 
        $sharedComponents->navLinks();

?>
        <div class="container px-5">
            <?php
            // ingredient list
            $recipepage->ingredients($ingredients);
            ?>
        </div>

    <?php

    }

    public function generalIngInfos($ingredient, $infos)
    {
      
    ?>
        <div class="h1"> <?php echo $ingredient['name'] ?></div>
        <div class="d-flex gap-4">
            <div class="bluredBox px-3 py-2"><?php if ($ingredient['healthy']) echo "Healthy ";
                                                else echo "Not Healthy "; ?> <img width="20px" src="/ProjetWeb/public/icons/<?php if ($ingredient['healthy']) echo "healthy.png ";
                                                                                                                            else echo "nothealthy.png"; ?>" /></div>
            <div class="bluredBox px-3 py-2">Saison: <?php echo $ingredient['season'] ?></div>
            <div class="bluredBox px-3 py-2">Calories: <?php echo $ingredient['calories'] ?></div>
        </div>
        <div class="mt-5 h3">
            Les informations d'ingredient
        </div>
        <div class="d-flex gap-4">
            <?php foreach ($infos as $info) {
                
            ?>
                <div class="bluredBox px-3 py-2"><?php echo $info['name'].": ".$info['quantity'].'  |  seuil : '.$info['seuil']  ?></div>
            <?php
            }
            ?>
        </div>
    <?php
    }

    public function displaySingleNutrition()
    {
        $sharedComponents = new sharedViews();

        $ingredientController = new ingredientController();
        $ingredient = $ingredientController->getIngredientByID($_GET['id']);

        $infos = $ingredientController->getIngredientInfos($ingredient['id']);

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("ingredient: " . $ingredient['name'], 'ingredients.jpg');
        // navLinks 
        $sharedComponents->navLinks();

    ?>
        <div class="container px-5">

            <?php
            // ingredient infos
            $this->generalIngInfos($ingredient, $infos);
            ?>
        </div>

<?php

    }
}
