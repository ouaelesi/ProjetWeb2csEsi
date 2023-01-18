<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/ingredientController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/stepController.php');
class singleRecipePage
{

    public function recipeInfos($recipe)
    {
        $userController = new userController();
        $user = $userController->getUserById($recipe['createdBy']);
?>
        <div class=" ">

            <div class="h1 mt-4">
                <?php echo $recipe['title'] ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="py-3  bluredBox rounded-4 px-3 gap-2 my-3 position-relative d-flex flex-wrap justify-content-between">
                        <div class="">Rating:
                            <?php if ($recipe['note'] == null) {
                                echo "0";
                            } else {
                                echo number_format($recipe["note"], 2, '.', ',');
                            } ?>/5 <img src="/ProjetWeb/public/icons/yellow_Star.png" width='20px' class="mx-1" />
                        </div>
                        <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Préparation: <?php echo $recipe["preparationTime"] ?> min</div>
                        <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Cuisson: <?php echo $recipe["cookTime"] ?>
                            min</div>
                        <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Repos: <?php echo $recipe["restTime"] ?> min
                        </div>
                    </div>
                    <p class="recipeBigDescription">
                        <?php echo $recipe['description'] ?>
                    </p>
                    <p>
                        by <?php echo $user['firstName'] ?>
                        <?php echo $user['lastName'] ?>
                    </p>
                </div>
                <div class="col-6">
                    <img src="/ProjetWeb/public/images/recipeImages/<?php echo $recipe['coverImage'] ?>" class="rounded-3 d-block ml-auto mt-3" width="100%" />
                </div>
            </div>
        </div>


    <?php

    }

    // recipe stats 

    public function recipeStats($recipe)
    {

    ?>
        <div class=" position-relative">
            <div class="bg-light px-3 py-3 position-absolute rounded-5 opacity-50"></div>
            <div class="bluredBox py-4 px-5 my-3 position-relative d-flex justify-content-between">
                <div class="">
                    <?php if ($recipe['note'] == null) {
                        echo "-";
                    } else {
                        echo number_format($recipe["note"], 2, '.', ',');
                    } ?> <img src="/ProjetWeb/public/icons/yellow_Star.png" width='20px' class="mx-1" />
                </div>
                <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Préparation: <?php echo $recipe["preparationTime"] ?> min</div>
                <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Cuisson: <?php echo $recipe["cookTime"] ?>
                    min</div>
                <div><img src="/ProjetWeb/public/icons/timer.png" width="20px" class="mx-1" /> Repos: <?php echo $recipe["restTime"] ?> min
                </div>
            </div>
        </div>

    <?php
    }

    public function ingredients($ingredients)
    {

    ?>
        <div class=" my-5">
            <div class="h3">Les Ingredients</div>
            <div class="d-flex flex-wrap">
                <?php foreach ($ingredients as $ingredient) {
                ?>
                    <div role="button" onclick="gotoUrl('/ProjetWeb/ingredient?id=<?php echo $ingredient['id'] ?>')" class="bluredBox px-3 py-3 rounded-4 me-3 my-2 position-relative ingredientBox"><?php echo $ingredient["quantity"] ?>

                        <?php echo $ingredient["name"] ?> <img src="/ProjetWeb/public/icons/<?php if ($ingredient["healthy"]) {
                                                                                                echo "healthy.png";
                                                                                            } else {
                                                                                                echo "nothealthy.png";
                                                                                            } ?>" width="18px" class="ms-2" />
                    </div>
                <?php
                } ?>
            </div>
        </div>

        <?php
    }

    public function recipeSteps($recipeId)
    { {
            $stepController = new stepController();
            $steps = $stepController->getrecipeSteps($recipeId);
        ?>
            <div class="  my-5">
                <div class="h3 mb-4">Les Etapes</div>
                <div class="bluredBox px-4 py-4">
                    <?php foreach ($steps as $step) {
                    ?>
                        <div>
                            <p class="h3"><img src="/ProjetWeb/public/icons/step.png" width="20px" class="me-2" /> <?php echo $step['title'] ?></p>
                            <p class="ps-5 recipeBigDescription">- <?php echo $step['description'] ?></p>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>

        <?php
        }
    }

    public function recipeVideo($recipe)
    {
        ?>
        <div class=" my-5">
            <div class="h3 mb-4">Video</div>
            <div class="row">
                <iframe class="rounded-4 mx-auto d-block col-8" width="100%" height="500" src="<?php echo $recipe['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <div class="col-4">
                    <p>Write your notes here:</p>
                    <textarea class="bluredBox notesSection"></textarea>
                    <button class="btn btn-red d-block ms-auto">save note</button>
                </div>
            </div>
        </div>
    <?php
    }


    public function ratingSection($recipeId)
    {
        $userController = new userController();
        $rating = $userController->getUserRecipeRating($recipeId);
        if (!$rating) {
            $rating['note'] = 0;
        }
        $topNote = 5;
    ?>
        <div class=" ">
            <div class="bluredBox px-5 py-4 h3 d-flex justify-content-between ratingSection">
                <div class="pt-1">Did you like the recipe ?</div>
                <div class="ratingBox" id="starsBox">
                    <?php for ($i = 0; $i < $rating['note']; $i++) {
                    ?>
                        <img id="starRating" src="/ProjetWeb/public/icons/Yellow_Star.png" width="40px" class="starRating " onclick="rateRecipe(3 , <?php echo $recipeId ?> ,  <?php echo $i + 1 ?>)" />
                    <?php
                    } ?>
                    <?php for ($i = $rating['note']; $i < $topNote; $i++) {
                    ?>
                        <img id="starRating" src="/ProjetWeb/public/icons/emptyStar.png" width="40px" class="starRating " onclick="rateRecipe(<?php echo $recipeId ?> ,  <?php echo $i + 1 ?>)" />
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    <?php
    }


    public function commentSection()
    {
    ?>
        <div class="my-5">
            <div class="h3 mb-4">Ajouter un Commentaire</div>
            <form class="">
                <textarea class="bluredBox notesSection py-4" rows="10" placeholder="Ajouter votre commentaire..."></textarea>
                <button class="btn btn-red d-block ms-auto mt-3 py-2 px-4">Ajouter commentaire</button>
            </form>
        </div>
    <?php
    }

    public function displaySignleRecipe()
    {
        // recipe Data
        $recipeId = $_GET["id"];
        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($recipeId);

        // 

        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getRecipeIngredients($recipe[0]);


        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("recipe Id " . $recipeId, "footerBg.png");
        // navLinks 
        $sharedComponents->navLinks();
    ?>
        <div class="w-75 container mx-auto  my-5">
            <?php
            // recipe infos 
            $this->recipeInfos($recipe);
            // recipe stats 
            // $this->recipeStats($recipe);
            // ingredients 
            $this->ingredients($ingredients);
            // recipe steps
            $this->recipesteps($recipe[0]);
            // recipe video 
            $this->recipeVideo($recipe);
            // rating section 
            $this->ratingSection($recipe[0]);
            // comment section
            $this->commentSection();
            ?>
        </div>
<?php
        // The footer 
        $sharedComponents->Footer();
    }
}
