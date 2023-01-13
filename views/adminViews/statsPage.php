<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedAdminView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/recipeController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/userController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/newsController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/ingredientController.php");
class statsPage
{
    public function usersStats()
    {
        $userController = new userController();
        $nbUsers = $userController->getNbUsers();
?>
        <div class="d-flex justify-content-center py-5">
            <?php
            $this->statsCard("Nombre des <br/> Utilisateurs", $nbUsers['nbUsers'], "nbUsersCard", "edit.png", "users");
            ?>
        </div>
    <?php
    }


    public function statsCard($title, $statNumber, $bgColor, $icon, $url)
    {
    ?>
        <div class="statsCard <?php echo $bgColor ?> w-25" role="button" onclick="gotoUrl('/ProjetWeb/admin/<?php echo $url ?>')">
            <div class="d-flex justify-content-between">
                <div class="h3"><?php echo $title ?></div>
                <img src="/ProjetWeb/public/icons/<?php echo $icon ?>" width='50px' height="50px" />
            </div>
            <div class="h1 statsNumber artFont">
                <?php echo $statNumber ?>
            </div>
        </div>
    <?php
    }
    public function generalStats()
    {
        $recipeController = new recipeController();
        $nbRecipes = $recipeController->getNbRecipes();
        $newsController = new newsController();
        $nbNews = $newsController->getNbNews();
        $ingredientsController = new ingredientController();
        $nbIngredients = $ingredientsController->getNbIgredients();
    ?>
        <div class="d-flex justify-content-around py-5">
            <?php
            $this->statsCard("Nombre des <br/> Recettes", $nbRecipes["nbRecipes"], "nbRecipesCard", "edit.png", "recettes");
            $this->statsCard("Nombre des <br/> News", $nbNews["nbNews"], "nbNewsCard", "edit.png", "news");
            $this->statsCard("Nombre des <br/> Nutrutions", $nbIngredients["nbIngredients"], "nbNutrutionCard", "edit.png", "ingredients")
            ?>
        </div>
<?php
    }
    public function displayStatspage()
    {
        // imports 
        $sharedViews = new sharedadminView();

        // page title
        $sharedViews->pageHeader('Statestiques');

        // users stats 
        $this->usersStats();

        // general stats
        $this->generalStats();
    }
}
