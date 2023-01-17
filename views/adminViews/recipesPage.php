<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedAdminView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/recipeController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/userController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/newsController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/ingredientController.php");

class recipesPage
{
    public function recipesHeader()
    {
        $sharedViews = new sharedadminView();
?>
        <div class="d-flex justify-content-between">
            <div>
                <?php $sharedViews->pageHeader('Gestion des recettes'); ?>
            </div>
            <div>
                <button class="btn btn-red" onclick="gotoUrl('/ProjetWeb/admin/addrecipe')"> Ajouter une recette </button>
            </div>
        </div>
    <?php
    }

    public function recipesList()
    {
        $recipeController = new recipeController();
        $recipes = $recipeController->getRecipes($_GET);

        $categoryController = new categoryController();

    ?>
        <table data-search="true" data-toggle="table" class="table-style">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">
                    <th data-sortable="true" class="col-4">Titre</div>
                    <th data-sortable="true" class="col-1 text-center">Categorie</th>
                    <th data-sortable="true" class="col-1 text-center">Rating</th>
                    <th data-sortable="true" class="col-1 text-center">rest Time</th>
                    <th data-sortable="true" class="col-1 text-center">cook time</th>
                    <th data-sortable="true" class="col-1 text-center">preparation</th>
                    <th data-sortable="true" class="col-2 text-center">Status</th>
                    <th data-sortable="true" class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($recipes as $recipe) {
                    $category = $categoryController->getCategoryById($recipe['categoryID']);
                ?>
                    <tr class="d-flex bluredBox  rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $recipe[0] ?>')">
                        <td class="text-light col-4 ">
                            <div class="pt-1" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $recipe[0] ?>')"><?php echo $recipe['title'] ?></div>
                        </td>
                        <td class="text-light col-1 text-center  pt-1">
                            <div class="pt-2"> <span class="bluredBox p-1 px-2"><?php echo $category['name'] ?></span></div>
                        </td>
                        <td class="text-light col-1 text-center">
                            <div class="pt-1"><?php if ($recipe["note"] != null) echo number_format($recipe["note"], 1, '.', ',');
                                                else echo "0" ?>/5 <img src="/ProjetWeb/public/icons/Yellow_Star.png" width="18px" class="mx-1" /></div>
                        </td>
                        <td class="text-light col-1 text-center">
                            <div class="pt-1"><?php echo $recipe['restTime'] ?> min </div>
                        </td>
                        <td class="text-light col-1 text-center">
                            <div class="pt-1"><?php echo $recipe['cookTime'] ?> min </div>
                        </td>
                        <td class="text-light col-1 text-center">
                            <div class="pt-1"><?php echo $recipe['preparationTime'] ?> min </div>
                        </td>
                        <td class="text-light col-2">
                            <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($recipe['status'] == 'valid') echo 'bg-success';
                                                                                            else if ($recipe['status'] == 'rejected') echo 'bg-danger';
                                                                                            else echo 'bg-warning' ?>"><?php echo $recipe['status'] ?></div>
                        </td>
                        <td class="text-light col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    <?php
    }
    public function displayRecipesPage()
    {
        // imports 
        $sharedViews = new sharedadminView();
        $sharedComponents = new SharedViews();
        $categoryController = new categoryController();
        $categories = $categoryController->getCategories();
        // page title
        $this->recipesHeader();

        $sharedComponents->filterInputs([
            [
                "name" => "category",
                "index" => "category",
                "options" => $categories
            ],
            [
                "name" => "Temps de preparation",
                "index" => "preparationTime",
                "options" => [
                    ["id" => "0-15", "name" => "moins que 15min"],
                    ["id" => "15-60", "name" => "entre 15min et 1h"],
                    ["id" => "60-10000", "name" => "plus que 1h"],
                ]
            ],
            [
                "name" => "Temps de cuisson",
                "index" => "cookTime",
                "options" => [
                    ["id" => "0-15", "name" => "moins que 15min"],
                    ["id" => "15-60", "name" => "entre 15min et 1h"],
                    ["id" => "60-10000", "name" => "plus que 1h"],
                ]
            ],
            [
                "name" => "Temps total",
                "index" => "totalTime",
                "options" => [
                    ["id" => "0-15", "name" => "moins que 15min"],
                    ["id" => "15-60", "name" => "entre 15min et 1h"],
                    ["id" => "60-10000", "name" => "plus que 1h"],
                ]
            ],
            [
                "name" => "Nombre de calories",
                "index" => "nbCalories",
                "options" => [
                    ["id" => "between 0 and 15", "name" => "moins que 15min"],
                    ["id" => "between 15 and 60", "name" => "entre 15min et 1h"],
                    ["id" => "between 60 and 10000", "name" => "plus que 1h"],
                ]
            ],
            [
                "name" => "Note",
                "index" => "note",
                "options" => [
                    ["id" => "0", "name" => "0-1 starts"],
                    ["id" => "2", "name" => "1-2 starts"],
                    ["id" => "3", "name" => "2-3 stars"],
                    ["id" => "4", "name" => "3-4 stars"],
                    ["id" => "5", "name" => "4-5 starts"],
                ]
            ]
        ], "");

        // recipes List 
        $this->recipesList();
    }


    public function singlerecipeHeader($recipe)
    {
        $sharedViews = new sharedadminView();
    ?>
        <div class="d-flex justify-content-between">
            <div>
                <?php $sharedViews->pageHeader($recipe['title']); ?>
            </div>
            <div>
                <?php if ($recipe['status'] == "pending") {
                ?>
                    <button id="validateAccountBtn" class="btn btn-yellow mx-2" onclick="validateRecipe(<?php echo $recipe['id'] ?>)">Valider la recette</button>
                    <button id="validateAccountBtn" class="btn btn-red" onclick="rejectRecipe(<?php echo $recipe['id'] ?>)">rejecter la recette</button>
                <?php
                } ?>
            </div>
        </div>
    <?php
    }

    public function recipeVideo($recipe)
    {
    ?>
        <div class="container my-5">
            <div class="h3 mb-4">Video</div>

            <iframe class="rounded-4 mx-auto d-block " width="100%" height="500" src="<?php echo $recipe['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>


        </div>
    <?php
    }

    public function displaySinglePage()
    {
        $singleRecipePage = new singleRecipePage();
        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($_GET['id']);

        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getRecipeIngredients($_GET['id']);

        // header 
        $this->singlerecipeHeader($recipe);
        // 
        $singleRecipePage->recipeInfos($recipe);
        // recipe stats 
        $singleRecipePage->recipeStats($recipe);
        // ingredients 
        $singleRecipePage->ingredients($ingredients);
        // recipe steps
        $singleRecipePage->recipesteps($recipe[0]);
        // recipe video 
        $this->recipeVideo($recipe);
    }

    public function addRecipeForm()
    {
    ?>
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
        <div class="bluredBox px-3 pt-4 pb-2   mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Information Génerale
            </div>
            <form class="row" action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                <div class="my-2 col-6">
                    <label class="mb-1">Titre</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="title" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Description</label>
                    <textarea class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="description"></textarea>
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Category</label>
                    <select name="category" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light">
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
                <div class="my-2 col-6">
                    <label class="mb-1">Fete </label>

                    <select name="event" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light">
                        <option value="null">aucune</option>

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
                <div class="my-2 col-6">
                    <label class="mb-1">Image de couverture</label>
                    <input name="coverImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Image du carte </label>
                    <input name="cardImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Video </label>
                    <input name="video" placeholder="video" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Temps de cuisson </label>
                    <input name="cookTime" placeholder="Temps de cuisson" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Temps de préparation </label>
                    <input name="preparationTime" placeholder="Temps de préparation" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Temps de repos </label>
                    <input name="restTime" placeholder="Temps de repos" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div>
                    <button class="btn btn-yellow d-block ms-auto px-4 my-3" type="submit" name="addRecette">Suivant</button>
                </div>
            </form>
        </div>
    <?php
    }



    public function displayAddRecipe()
    {
        $sharedViews = new sharedadminView();

        // header 
        $sharedViews->pageHeader("Ajouter une recette");
        // add recipe form 
        $this->addRecipeForm();
    }

    public function addRecipeIngredientForm()
    {
    ?>
        <div class="d-flex justify-content-center pb-5">
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    1
                </div>
                <p class="text-center mt-2">Ajouter</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle activeStep">
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
        <div class="bluredBox px-3 pt-4 pb-2   mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Ajouter les ingredients
            </div>
            <form class="row" action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                <div class="my-2 col-6">
                    <label class="mb-1">Ingredient</label>
                    <select name="ingredientID" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light">
                        <?php
                        $ingredientController = new ingredientController();
                        $ingredients = $ingredientController->getIngredients();
                        foreach ($ingredients as $ingredient) {
                        ?>
                            <option value="<?php echo $ingredient["id"] ?>"><?php echo $ingredient["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Quantité</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Quantité" name="quantity" />
                </div>
                <input hidden value="<?php echo $_GET['id'] ?>" name="recetteID" />
                <div>
                    <button class="btn btn-yellow d-block ms-auto px-4 my-3" type="submit" name="addRecIngredient">Ajouter ingredient</button>
                </div>
            </form>
        </div>
    <?php
    }

    public function confirmButton($url)
    {

    ?>
        <div class=""><button class="d-block ms-auto btn btn-yellow px-3" onclick="gotoUrl('<?php echo $url ?>')">Suivant</button></div>
    <?php
    }

    // La page pour ajouter des ingredient a une recette 
    public function displayAddIngRec()
    {
        $sharedViews = new sharedadminView();
        $recipepage = new singleRecipePage();

        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getRecipeIngredients($_GET['id']);

        // header 
        $sharedViews->pageHeader("Les ingredients de la recette");
        // add recipe form 
        $this->addRecipeIngredientForm();
        // added ingredients
        $recipepage->ingredients($ingredients);
        // confirm
        $this->confirmButton('/ProjetWeb/admin/addrecStep?id=' . $_GET['id']);
    }

    public function addStepForm()
    {
    ?>
        <div class="d-flex justify-content-center pb-5">
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    1
                </div>
                <p class="text-center mt-2">Ajouter</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    2
                </div>
                <p class="text-center mt-2">Step details</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle activeStep">
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
        <div class="bluredBox px-3 pt-4 pb-2   mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Ajouter les étapes
            </div>
            <form class="row" action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                <div class="my-2 col-6">
                    <label class="mb-1">Titre de l'étape</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="titre de l étape" name="title" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Déscription</label>
                    <textarea class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Quantité" name="description" rows="4"></textarea>
                </div>
                <input hidden value="<?php echo $_GET['id'] ?>" name="recetteID" />
                <div>
                    <button class="btn btn-yellow d-block ms-auto px-4 my-3" type="submit" name="addRecStep">Ajouter Etape</button>
                </div>
            </form>
        </div>
    <?php
    }
    public function displayAddIngStep()
    {
        $sharedViews = new sharedadminView();
        $recipepage = new singleRecipePage();

        // header 
        $sharedViews->pageHeader("Les étapes de la recette");
        // add recipe form 
        $this->addStepForm();
        // added ingredients
        $recipepage->recipeSteps($_GET['id']);
        // confirm
        $this->confirmButton("/ProjetWeb/admin/confirmRecipe?id=" . $_GET['id']);
    }

    public function recipePreview($recipe, $category)
    {
        $sharedViews = new HomePage();
    ?>
        <div class="d-flex justify-content-center pb-5">
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    1
                </div>
                <p class="text-center mt-2">Ajouter</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    2
                </div>
                <p class="text-center mt-2">Step details</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle ">
                    3
                </div>
                <p class="text-center mt-2">Step details</p>
            </div>
            <div class="stepLine"></div>
            <div>
                <div class="rounded-circle text-center bluredBox stepCircle activeStep">
                    4
                </div>
                <p class="text-center mt-2">Step details</p>
            </div>
        </div>
        <div class="w-25  mx-auto d-flex justify-content-center">
            <?php $sharedViews->recipeCard($recipe, $category['name']) ?>
        </div>

<?php
    }

    public function confirmRecipeCreation()
    {
        $sharedViews = new sharedadminView();
        $recipepage = new singleRecipePage();

        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($_GET['id']);

        $categoryController = new categoryController();
        $category = $categoryController->getCategoryById($recipe['categoryID']);
        // header 
        $sharedViews->pageHeader("Confirmer la creation de la recette");
        // add recipe form 
        $this->recipePreview($recipe, $category);

        // confirm
        $this->confirmButton("/ProjetWeb/admin/recettes");
    }
}
