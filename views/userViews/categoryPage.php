<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/recipePage.php');
class categoryPage
{

    public function header()
    {
?>
        <div class="container-xl px-5 d-flex justify-content-between">
            <div class="artFont h1">
                Page des: <?php echo $_GET["id"] ?>
            </div>
            <div class="py-3 text-warning" role="button" onclick="gotoUrl('/ProjetWeb/ideas')">
                 Voir tous les recettes 
            </div>
        </div>
<?php
    }
    public function displayCategoryPage()
    {
        $sharedComponents = new sharedViews();
        $recipePage = new recipePage();
        $recipeController = new recipeController();
        $recipes  = $recipeController->getrecipesByCateg(1);
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Catégorie: ' . $_GET["id"], "footerBg.png");
        // navLinks 
        $sharedComponents->navLinks();

        // header 
        $this->header();

        // recipes
        $recipePage->recipesList($recipes);

        // this is the footer
        $sharedComponents->Footer();
    }
}
