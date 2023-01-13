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
                <button class="btn btn-red"> Ajouter une recette </button>
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
        <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 mt-5 TableHeader" role="button">
            <div class="col-3">Titre</div>
            <div class="col-1 text-center">Categorie</div>
            <div class="col-1 text-center">Rating</div>
            <div class="col-1 text-center">rest Time</div>
            <div class="col-1 text-center">cook time</div>
            <div class="col-1 text-center">preparation</div>
            <div class="col-2 text-center">Status</div>
            <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
        </div>
        <?php
        foreach ($recipes as $recipe) {
            $category = $categoryController->getCategoryById($recipe['categoryID']);
        ?>
            <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $recipe['id'] ?>')">
                <div class="col-3 "><?php echo $recipe['title'] ?></div>
                <div class="col-1 text-center bluredBox pt-1"><?php echo $category['name'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['note'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['restTime'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['cookTime'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['preparationTime'] ?></div>
                <div class="col-2">
                    <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($recipe['status'] == 'valid') echo 'bg-success';
                                                                                    else if ($recipe['status'] == 'rejected') echo 'bg-danger';
                                                                                    else echo 'bg-warning' ?>"><?php echo $recipe['status'] ?></div>
                </div>
                <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
            </div>
        <?php
        }
        ?>
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


    public function displaySinglePage(){
        echo "single page" ; 
    }
}
