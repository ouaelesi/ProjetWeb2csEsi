<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/HomePage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
class recipePage
{

    public function recipesList()
    {
        $recipeController = new recipeController();
        $recipes  = $recipeController->getRecipes($_GET);
        $homeViews = new HomePage();
        $categoryController = new categoryController();
?>
        <div class="row justify-content-md-center container  mx-auto ">
            <div class="px-4 mt-4">Results: <?php echo sizeof($recipes) ?> recettes</div>
            <?php
            foreach ($recipes as $recipe) {
                $category = $categoryController->getCategoryById($recipe["categoryID"]);
            ?>
                <div class="col-3 mt-3 mb-5">
                    <?php
                    $homeViews->recipeCard($recipe, $category['name']);
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
<?php
    }

    public function filterSection()
    {
        //categories list 
        $categoryController = new categoryController();
        $categories = $categoryController->getCategories();

        $sharedComponents = new sharedViews();
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
            ] , 
            [
                "name" => "Temps de cuisson",
                "index" => "cookTime",
                "options" => [
                    ["id" => "0-15", "name" => "moins que 15min"],
                    ["id" => "15-60", "name" => "entre 15min et 1h"],
                    ["id" => "60-10000", "name" => "plus que 1h"],
                ]
            ] , 
            [
                "name" => "Temps total",
                "index" => "totalTime",
                "options" => [
                    ["id" => "0-15", "name" => "moins que 15min"],
                    ["id" => "15-60", "name" => "entre 15min et 1h"],
                    ["id" => "60-10000", "name" => "plus que 1h"],
                ]
            ] , 
            [
                "name" => "Nombre de calories",
                "index" => "nbCalories",
                "options" => [
                    ["id" => "between 0 and 15", "name" => "moins que 15min"],
                    ["id" => "between 15 and 60", "name" => "entre 15min et 1h"],
                    ["id" => "between 60 and 10000", "name" => "plus que 1h"],
                ]
            ] , 
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
        ]);
    }

    public function displayRecipePage()
    {
        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Tous les recettes");
        // navLinks 
        $sharedComponents->navLinks();
        // filters 
        $this->filterSection();
        // recipes list 
        $this->recipesList();
    }
}
