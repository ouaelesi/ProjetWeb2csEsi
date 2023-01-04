<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/ingredientController.php');
class singleRecipePage
{

    public function recipeInfos($recipe)
    {

        $tags = ["tag 1", "tag 1", "tag 1", "tag 1"];
        $userController = new userController();
        $user = $userController->getUserById($recipe['createdBy']);
?>
        <div class="container">
            <div class="h1"><?php echo $recipe['title'] ?></div>
            <div class="row">
                <div class="col-6">
                    <div class="mt-3">
                        <?php foreach ($tags as $tag) {
                        ?>
                            <span class="recetteTag"><?php echo $tag ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <p class="recipeBigDescription">
                        <?php echo $recipe['description'] ?>
                    </p>
                    <p>
                        by <?php echo $user['firstName'] ?> <?php echo $user['lastName'] ?>
                    </p>
                </div>
                <div class="col-6">
                    <img src="public/images/recipeImages/<?php echo $recipe['coverImage'] ?>" class="rounded-3 d-block ml-auto mt-3" width="85%" />
                </div>
            </div>
        </div>


    <?php

    }

    // recipe stats 

    public function recipeStats($recipe)
    {

    ?>
        <div class="container position-relative">
            <div class="bg-light px-3 py-3 position-absolute rounded-5 opacity-50"></div>
            <div class="bluredBox py-4 px-5 my-3 position-relative d-flex justify-content-between">
                <div class=""> <?php if ($recipe['note'] == null) {
                                    echo "-";
                                } else {
                                    echo number_format($recipe["note"], 2, '.', ',');
                                } ?> <img src="public/icons/yellow_Star.png" width='20px' class="mx-1" /></div>
                <div><img src="public/icons/timer.png" width="20px" class="mx-1" /> Préparation: <?php echo $recipe["preparationTime"] ?> min</div>
                <div><img src="public/icons/timer.png" width="20px" class="mx-1" /> Cuisson: <?php echo $recipe["cookTime"] ?> min</div>
                <div><img src="public/icons/timer.png" width="20px" class="mx-1" /> Repos: <?php echo $recipe["restTime"] ?> min</div>
            </div>
        </div>

    <?php
    }

    public function ingredients($recipeID)
    {
        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getRecipeIngredients($recipeID);
    ?>
        <div>
            <div></div>
            <div class="d-flex d-flex-wrap container">
                <?php foreach ($ingredients as $ingredient) {
                ?>
                    <div class="bluredBox px-3 py-2 rounded-3 me-3 my-3"><?php echo $ingredient["quantity"] ?> <?php echo $ingredient["name"] ?></div>
                <?php
                } ?>
            </div>
        </div>

<?php
    }

    public function displaySignleRecipe()
    {
        // recipe Data
        $recipeId = $_GET["id"];
        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($recipeId);

        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("recipe Id " . $recipeId);
        // navLinks 
        $sharedComponents->navLinks();
        // recipe infos 
        $this->recipeInfos($recipe);
        // recipe stats 
        $this->recipeStats($recipe);
        // ingredients 
        $this->ingredients($recipe[0]);
        // The footer 
        $sharedComponents->Footer();
    }
}
