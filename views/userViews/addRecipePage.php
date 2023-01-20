<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
class addRecipePage
{
    public function addRecipeForm()
    {
?>
        <div class="container-xl w-75">
            <div class="d-flex justify-content-center pb-5">
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle activeStep">
                        1
                    </div>
                    <p class="text-center mt-2">Ajouter</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        2
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        3
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        4
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
            </div>
            <div enctype="multipart/form-data" class="bluredBox p-4 rounded-3 d-flex mb-5 flex-wrap gap-4 justify-content-between">
                <div class="col-12 artFont text-warning h1">1. Les informations générales de la recette
                    <hr />
                </div>
                <div class="my-2 col-5 ">
                    <label>Titre</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="title" placeholder="titre du recette" type="text" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Déscription</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="description" placeholder="description du recette" type="text" required />
                </div>

                <div class="my-2 col-5  ">
                    <label>Category</label>
                    <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="category">
                        <?php
                        $categoryController = new categoryController();
                        $categories = $categoryController->getCategories();
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="my-2 col-5  ">
                    <label>Image de couverture</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="coverImage" type="file" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Image du carte </label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="cardImage" type="file" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Event </label>

                    <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="event">
                        <?php
                        $eventsController = new eventsController();
                        $events = $eventsController->getEvents();
                        foreach ($events as $event) {
                        ?>
                            <option value="<?php echo $event["id"] ?>"><?php echo $event["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="my-2 col-5  ">
                    <label>video</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="video" placeholder="video" type="text" required />
                </div>
                <div class="my-2 col-5">
                    <label>temps de préparation</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="preparationTime" placeholder="video" type="number" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>temps de cuisson</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="cookTime" placeholder="video" type="number" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>temps de rest</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="restTime" placeholder="video" type="number" required />
                </div>
                <div class="col-12">
                    <button name="addRecipe" class="btn btn-red ms-auto d-block" onclick='addRecipeByUser()'>Suivant </button>
                </div>
            </div>
            <!-- <form method="post" action="/ProjetWeb/api/apiRoute.php"  class="bluredBox p-4 rounded-3 d-flex mb-5 flex-wrap gap-4 justify-content-between">
               
            </form> -->

        </div>

    <?php
    }
    public function generalInfosPage()
    {
        $recipePage = new recipesPage();

    ?>
        <div class="container-xl px-5 mb-5">
            <?php $recipePage->addRecipeForm('addRecipeUser');  ?>
        </div>
    <?php
    }
    public function displayRecipePage()
    {
        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Ajouter une recette", "footerBG.png");
        // navLinks 
        $sharedComponents->navLinks();
        // add recipe form
        // $this->addRecipeForm();

        $this->generalInfosPage();

        // footer
        $sharedComponents->Footer();
    }

    public function addIngredientsForm()
    {
        $formPage = new recipesPage();
        $recipePage = new singleRecipePage();
        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getRecipeIngredients($_GET['id']);
    ?>
        <div class="container-xl  px-5">
            <?php        // add recipe form 
            $formPage->addRecipeIngredientForm("addIngredientUser");
            // added ingredients
            $recipePage->ingredients($ingredients);
            // confirm
            $formPage->confirmButton('/ProjetWeb/addrecStep?id=' . $_GET['id']); ?>
        </div>
    <?php
    }

    public function addIngredientsPage()
    {
        $sharedComponents = new sharedViews();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Ajouter les ingredients", "footerBG.png");
        // navLinks 
        $sharedComponents->navLinks();
        // add recipe form
        $this->addIngredientsForm();
        // footer
        $sharedComponents->Footer();
    }

    public function addStepForm()
    {
        $formPage = new recipesPage();
        $recipePage = new singleRecipePage();
    ?>
        <div class="container-xl  px-5">
            <?php        // add recipe form 
            $formPage->addStepForm("addStepUser");
            // added ingredients
            $recipePage->recipeSteps($_GET['id']);

            // confirm
            $formPage->confirmButton('/ProjetWeb/confirmRecipe?id=' . $_GET['id']); ?>
        </div>
    <?php
    }
    public function addStepspage()
    {
        $sharedComponents = new sharedViews();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Ajouter les ingredients", "footerBG.png");
        // navLinks 
        $sharedComponents->navLinks();
        // add recipe form
        $this->addStepForm();
        // footer
        $sharedComponents->Footer();
    }


    public function confirmSection()
    {
        $formPage = new recipesPage();
        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($_GET['id']);

        $categoryController = new categoryController();
        $category = $categoryController->getCategoryById($recipe['categoryID']);
    ?>
        <div class="container-xl px-5 mb-5">
            <div class="h1 text-center ">Verifier votre recette</div>
            <div class="h6 text-center mb-5"> cette recette va etre publier apres la confirmation d'admine</div>
            <?php
            // add recipe form 
            $formPage->recipePreview($recipe, $category);
            // confirm
            $formPage->confirmButton('/ProjetWeb/') ?>
        </div>
<?php
    }
    public function confirmRecipePage()
    {
        $sharedComponents = new sharedViews();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Confirmer la creation de la recette", "footerBg.png");
        // navLinks 
        $sharedComponents->navLinks();
        // add recipe form
        $this->confirmSection();
        // footer
        $sharedComponents->Footer();
    }
}
